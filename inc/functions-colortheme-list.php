<?php
if (!class_exists('sf_impact_CustomColorThemes')):
{
    class sf_impact_CustomColorThemes {
/**
 * Load the available style templates. If a child theme exists,
 * load parent and child theme choices.
 */
        private $choices, $themename, $custom_style;
        const parentDir = 1, childDir = 2;
    
        public function __construct($themename) 
        {      
            $this->themename = $themename;  
            $this->loadAllThemeOptions();
        }  
    
        public function getCustomThemePath( $choice ) 
        {
            return $this->choices[$choice]['dir'] . "/" . $choice . ".css.php";
        }
    
        public function getLinkThemesForCustomizer()
        {
            $result = array();
        
            foreach($this->choices as $choice) {
                $ucstring = ucfirst($choice['customizer']);
                $result[$choice['customizer']] = $ucstring;
            }
            return $result;   
        }
    
        private function getThemesFromFolder($dir, $folder) 
        {
            $themes = array();
        
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
                    
                        $themes[$string[1]] = array( 
                            'uri' => $uri . $folder,
                            'dir' => $dir . $folder,
                            'customizer' => $string[1],
                        );
                    }
                }
            }
        
            return $themes;     
        }
               
        private function loadAllThemeOptions ()
        {
            $choices = $this->getThemesFromFolder( self::parentDir, "/style-parts" );
        
            if(( $styledir = get_stylesheet_directory() ) !== ( $themedir = get_template_directory() )) {
        	    $childChoices = $this->getThemesFromFolder( self::childDir, "/style-parts" );
        	
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