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
    
    public function setMod($key, $default) 
    {
        set_theme_mod($key, $default);
        $this->setDefault($key, $default);
        return $this->getMod($key, $default); 
    }

    public function setDefault($key, $default) 
    {

        if($default === false) $default = 0;
        self::$default[$this->handle][$key] = $default;
        
       $this->getMod($key);

 
        
        return self::$mods[$this->handle][$key];   
    }
    
    public function setDefaults(Array $array) {
        
        self::$defaults[$this->handle] = array_merge(self::$defaults[$this->handle],$array);
   }
    
    public function getMod($key, $default=null) {

        switch(true) {
            case isset(self::$default[$this->handle][$key]): 
                return get_theme_mod($key, self::$default[$this->handle][$key]);
                break;
            case isset($default):
                return get_theme_mod($key, $default);
                break;
            default:
                return get_theme_mod($key);
        }
    }
    
    public function dumpAll() {
        var_dump(self::$default[$this->handle]);
    }
}

$sf_impact_Theme_Mods = sf_impact_Theme_Mods::get_instance('sf_impact');