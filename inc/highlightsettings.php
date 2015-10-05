<?php
/**
 * Settings for Featured Highlights
 *
 *
 * @package shoofly
 * @subpackage sf-impact-lite
 * @since sf-impact-lite 1.0
 */

?>
<?php 
    $sf_impact_lite_highlight_boxes = get_theme_mod('sf_impact_lite_highlight_boxes', 0);
    for ($x = 1; $x <= $sf_impact_lite_highlight_boxes; ++$x) 
    {
        ${'sf_impact_lite_highlight_image' . $x} = get_theme_mod('sf_impact_lite_highlight_image' . $x, '');
        ${'sf_impact_lite_highlight_header' . $x} = get_theme_mod('sf_impact_lite_highlight_header' . $x, '');
        ${'sf_impact_lite_highlight_text' . $x} = get_theme_mod('sf_impact_lite_highlight_text' . $x, '');
        ${'sf_impact_lite_highlight_link' . $x} = get_theme_mod('sf_impact_lite_highlight_link' . $x, '#');
    } 
?>