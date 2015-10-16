<?php

/**
 * Centralizes all theme mod settings for easier swapping out of defaults.
 */
class sf_impact_Theme_Mods 
{
    private static $_this, $mods, $default;
    private $handle;
    
    private function __construct()
    {
    }
    
    public static function get_instance($handle) {
        
        if( !isset(self::$_this[$handle]) ) {
            self::$_this[$handle] = new self();    
            self::$_this[$handle]->handle = $handle;
            self::$default[$handle] = get_theme_mods();
        } 
        
        return self::$_this[$handle];
    }
    
    public function setMod($key, $val) 
    {
        set_theme_mod($key, $val);
        
        return $val;
    }
    public function getDefault($key)
    {
       return get_theme_mod($key, $this->retrieveDefault($key)) ? get_theme_mod($key, $this->retrieveDefault($key)) : NULL;
        
    }
    public function setDefault($key, $default) 
    {

        if( $default === false ) $default = 0;
        self::$default[$this->handle][$key] = $default;
        
       $this->getMod($key);

 
        
        return self::$mods[$this->handle][$key];   
    }
    
    public function setDefaults(Array $array) {
        
        self::$defaults[$this->handle] = array_merge(self::$defaults[$this->handle],$array);
    }
    
    private function retrieveDefault($key) {
        if ( isset(self::$default[$this->handle][$key]) ) {
            return self::$default[$this->handle][$key];
        } else {
            return null;
        }
    }
    
    /*
    * Get the theme mod setting
    * $key - the name of the modification
    * $default - overrides the set default
    * returns the value
    */
    public function getMod($key, $default=null) {

        switch(true) {
            case isset($default):  //Use the override default first if the key does not exist
                return get_theme_mod($key, $default);
                break;
            case isset(self::$default[$this->handle][$key]): //Use the preset override if the key does not exist
                return get_theme_mod($key, self::$default[$this->handle][$key]);
                break;
            default:
                return get_theme_mod($key); //Return the key
        }
    }
    
    public function dumpAll() {
        var_dump(self::$default[$this->handle]);
    }
}

$sf_impact_Theme_Mods = sf_impact_Theme_Mods::get_instance('sf_impact');