<?php

class sf_impact_Theme_Mods 
{
    private $mods;
    
    public function __construct()
    {         
    }
    
    public function setMod($key, $default) {
        $this->mods[$key] = $default;
    }
    
    public function getMod($key) {
        if(isset($this->mods[$key])) {
            return get_theme_mod($key, $this->mods[$key]);
        } else {
            return get_theme_mod($key);
        }
    }
}

$sf_impact_Theme_Mods = new sf_impact_Theme_Mods();