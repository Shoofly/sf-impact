<?php
    defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
    $hover_color     = '#1ABEF6';
    $menu_color      = '#B3B3DA';
    $border_color    = '#000276';
    return array(
        'stylesheet_template'        => 'template',
    	'background_color'           => '#FFF',
    	'main_link_color'           => '#008BC3',
    	'main_link_hover_color'     => $hover_color,
    	'main_header_color'           => '#10AEE5',
    	'main_header_link_color'       => '#000276',
    	'main_header_link_color_hover'  => '#0095CC',
    	'content_text_color'          => '#3A3A3A',
    	'main_accent_color'           => '#F64D19',
    	'f_image_title_color'          => '#F3F6F9',
    	'border_color'              => $border_color,
    	'dropdownmenu_color'        => $menu_color,
    	'dropdownmenu_hover_color'  => $hover_color,
    	'dropdownmenu_border_color' => $menu_color,
    	'dropdownmenu_bg'            => '#FFF',
    	'dropdown_submenu_bg'         => '#FFF',
    	'dropdownmenu_hover_color'    => $border_color,
    	'dropdownmenu_color'         => $border_color,
    	'dropdownmenu_hover_bg'       => '#EFEFEF',
    	'submenu_border_color'       => 'rgb(85,85,85,0.97)',
    	'dropdownmenu_shadow'        => '6px 0px 10px 2px #666',
    	'submenu_color'              => $border_color,
    	'submenu_hover_color'         => '#4DE2FF',
    	'header_color'               => '#00398F',
    	'sidebar_link_color'          => '#0069BA',
    	'sidebar_link_hover_color'    => '#001369',
    	'footer_link_color'           => $border_color,
    	'footer_link_hover_color'     => '#0069BA',
    	'comments_bg_hover_color'     => 'rgba(255,255,255,0.7)',
    );
    require("template.min.php"); 