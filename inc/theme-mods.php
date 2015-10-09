<?php

/**
 * Centralizes all theme mod settings for easier swapping out of defaults.
 */
class sf_impact_Theme_Mods 
{
    private static $_this, $mods;
    private $handle;
    
    private function __construct()
    {
    }
    
    public static function get_instance($handle) {
        
        if( !isset(self::$_this[$handle]) ) {
            self::$_this[$handle] = new self();    
            self::$_this[$handle]->handle = $handle;
        } 
        
        return self::$_this[$handle];
    }
    
    public function setMod($key, $default) {
        
        self::$mods[$this->handle][$key] = $default;
        
        set_theme_mod($key, $default);
        
        return self::$mods[$this->handle][$key];   
    }
    
    public function setMods(Array $array) {
        self::$mods[$this->handle] = array_merge(self::$mods[$this->handle],$array);
    }
    
    public function getMod($key, $default=null) {
        $mods = get_theme_mods();
        
 
        if(isset(self::$mods[$this->handle][$key])) {
            
            return get_theme_mod($key, self::$mods[$this->handle][$key]);
        } elseif ( isset($default) ) {
            return $default;
        } else {
            return get_theme_mod($key);
        }
    }
    
    public function dumpAll() {
        var_dump(self::$mods[$this->handle]);
    }
}

$sf_impact_Theme_Mods = sf_impact_Theme_Mods::get_instance('sf_impact');