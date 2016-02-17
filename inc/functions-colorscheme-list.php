<?php
if (!class_exists('sf_impact_CustomColorSchemes')):
{
    class sf_impact_CustomColorSchemes {
/**
 * Load the available style templates. If a child theme exists,
 * load parent and child theme choices.
 */
        private $choices, $schemename, $custom_style;
        const parentDir = 1, childDir = 2;
    
        public function __construct($schemename) 
        {      
            $this->schemename = $schemename;  
            $this->loadAllSchemeOptions();
        }  
    
        public function getCustomSchemePath( $choice ) 
        {
            return $this->choices[$choice]['dir'] . "/" . $choice . ".css.php";
        }
    
        public function getLinkSchemesForCustomizer()
        {
            $result = array();
        
            foreach($this->choices as $choice) {
                $ucstring = ucfirst($choice['customizer']);
                $result[$choice['customizer']] = $ucstring;
            }
            return $result;   
        }
    
        private function getSchemesFromFolder($dir, $folder) 
        {
            $schemes = array();
        
            if( $dir === self::parentDir ) {
                $dir = get_template_directory();
                $uri = get_template_directory_uri();
            } elseif ( $dir === self::childDir ) {
                $dir = get_stylesheet_directory();
                $uri = get_stylesheet_directory_uri();
            } else {
                die('Incorrect usage, should be const::parent or const::child');
            }
            if(is_dir( $dir . $folder )) {
                $files = scandir( $dir . $folder );
            
                //Strip out . and ..
                $files = array_diff( $files, array( ".",".." ) );

                foreach($files as $file) {
                    if(preg_match("/([a-zA-Z0-9\-]+)\.css\.php/",$file,$string)) {
                    
                        $ucstring = str_replace( "-", " ", ucfirst( $string[1] ) );
                    
                        $schemes[$string[1]] = array( 
                            'uri' => $uri . $folder,
                            'dir' => $dir . $folder,
                            'customizer' => $string[1],
                        );
                    }
                }
            }
        
            return $schemes;     
        }
               
        private function loadAllSchemeOptions ()
        {
            $choices = $this->getSchemesFromFolder( self::parentDir, "/style-parts" );
        
            if(( $styledir = get_stylesheet_directory() ) !== ( $schemedir = get_template_directory() )) {
        	    $childChoices = $this->getSchemesFromFolder( self::childDir, "/style-parts" );
        	
        	    $choices = array_merge(
        	        $choices,
        	        $childChoices
    	        );
            }
        
            $this->choices = $choices;
        }
    }
}
endif;