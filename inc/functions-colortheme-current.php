<?php
if (!class_exists('sf_impact_CurrentCustomColorTheme')):
{
    class sf_impact_CurrentCustomColorTheme {
/**
 * Load the available style templates. If a child theme exists,
 * load parent and child theme choices.
 */
        private $custom_style, $current_themename;
    
        public function __construct($current_themename) 
        {       
            $this->current_themename = $current_themename;
            $this->setCustomStyle();
        }  
    
        public function getCustomThemePath( $filename ) 
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
            $this->custom_style = include( $this->getCustomThemePath($this->current_themename . ".css.php") );    
            return true;
        }
        
        public function getThemeSettings ( ) 
        {
            return $this->custom_style;
        }
        
        public function getThemeSetting ( $key ) 
        {
            if ( isset($this->custom_style[$key]) ) {
                return $this->custom_style[$key];                    
            } else {
                return false;
            }
        }
        
        public function getStylesheet ( $template = "template" )
        {            
            require( $this->getCustomThemePath($template . ".min.php") );  
                     
            return array ( 
                "css" => getCss($this->getThemeSettings($this->custom_style)), 
                "backgroundColor" => $this->getThemeSetting("backgroundColor") 
            );
        }
        
    }
}
endif;