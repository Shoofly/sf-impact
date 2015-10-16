<?php
/**
 * Settings for Featured Highlights
 *
 *
 * @package shoofly
 * @subpackage sf-impact
 * @since sf-impact 1.0
 */

?>
<?php 
    $sf_impact_highlight_boxes = get_theme_mod('sf_impact_highlight_boxes', 0);
    for ($x = 1; $x <= $sf_impact_highlight_boxes; ++$x) 
    {
        ${'sf_impact_highlight_image' . $x} = get_theme_mod('sf_impact_highlight_image' . $x, '');
        ${'sf_impact_highlight_header' . $x} = get_theme_mod('sf_impact_highlight_header' . $x, '');
        ${'sf_impact_highlight_text' . $x} = get_theme_mod('sf_impact_highlight_text' . $x, '');
        ${'sf_impact_highlight_link' . $x} = get_theme_mod('sf_impact_highlight_link' . $x, '#');
    } 
?>