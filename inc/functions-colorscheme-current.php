<?php
 defined( 'ABSPATH' ) or die( 'No script kiddies please!' );   
if (!class_exists('sf_impact_CurrentCustomColorScheme')):
{
    class sf_impact_CurrentCustomColorScheme {
/**
 * Load the available style templates. If a child theme exists,
 * load parent and child theme choices.
 */
        private $custom_style, $current_schemename;
    
        public function __construct($current_schemename) 
        {     
            $this->current_schemename = $current_schemename;
            $this->setCustomStyle();
        }  
    
        public function getCustomSchemePath( $filename ) 
        {
            
            $child_template = get_stylesheet_directory() . "/style-parts/" . $filename;
            $parent_template = get_template_directory() . "/style-parts/" . $filename;
           
            if ( file_exists($child_template) ) {
                return $child_template;
            } elseif ( file_exists($parent_template) ) {
                return $parent_template;
            } else { 
                return false;
            }
        }
    
        
        
        private function setCustomStyle ( )
        { 
            if  ( file_exists( $this->getCustomSchemePath($this->current_schemename . ".css.php") ) ) {                
                $this->custom_style = include( $this->getCustomSchemePath($this->current_schemename . ".css.php") );   
                return true;
            } else {
                return false;
            }
        }
        
        public function getSchemeSettings ( ) 
        {
            return $this->custom_style;
        }
        
        public function getSchemeSetting ( $key ) 
        {
            if ( isset($this->custom_style[$key]) ) {
                return $this->custom_style[$key];                    
            } else {
                return false;
            }
        }
        
        public function getStylesheet ( $template = "template" )
        {           
            require( $this->getCustomSchemePath($template . ".min.php") );  
            return array ( 
                "css" => getCss($this->getSchemeSettings($this->custom_style)), 
                "backgroundColor" => $this->getSchemeSetting("background_color") 
            );
        }
        
    }
}
endif;
