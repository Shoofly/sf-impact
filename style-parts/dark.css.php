<?php
    defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
    $link_color1     = '#000276';
    $link_color2     = '#0069BA';
    $menu_color      = '#B3B3DA';
    $border_color    = '#001369';
    return array(
        'stylesheet_template'            => 'template',
    	'background_color'               => '#3A3A3A',
    	'main_link_color'               => $link_color1,
    	'main_link_hover_color'         => $link_color2,
    	'main_header_color'               => '#10AEE5',
    	'main_header_link_color'           => '#CBCBCB',
    	'main_header_link_color_hover'      => '#0095CC',
    	'content_text_color'              => '#3A3A3A',
    	'main_accent_color'               => '#F64D19',
    	'f_image_title_color'              => '#F3F6F9',
    	'border_color'                  => $border_color,
    	'dropdownmenu_border_color'     => $menu_color,
    	'dropdownmenu_color'            => $menu_color,
    	'dropdownmenu_bg'                => '#454545',
    	'dropdown_submenu_bg'             => '#E5E5E5',
    	'dropdownmenu_hover_color'       => '#CBCBCB',
    	'dropdownmenu_color'            => '#A6A6CD',
    	'dropdownmenu_hover_bg'           => 'rgba(85,85,85,0.97)',
    	'submenu_border_color'           => 'rgba(85,85,85,0.97)',
    	'dropdownmenu_shadow'            => '0px 1px 1px 1px #555',
    	'submenu_color'                 => $menu_color,
    	'submenu_hover_color'            => '#4DE2FF',
    	'header_color'                   => '#007539',
    	'sidebar_link_color'              => $link_color2,
    	'sidebar_link_hover_color'        => $link_color1,
    	'footer_link_color'               => '#008BC3',
    	'footer_link_hover_color'         => '#1ABEF6',
    	'comments_bg_hover_color'         => 'rgba(255,255,255,0.7)',
    );

    require("template.min.php"); 
