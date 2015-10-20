<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package shoofly
 * @subpackage sf-impact
 * @since sf-impact 1.0
 */
 global $sf_impact_Theme_Mods;
 
 $sf_impact_custom_footer_css      = $sf_impact_Theme_Mods->getMod( 'sf_impact_custom_footer_css' );
?>

	</div><!-- #content -->

 
	<footer id="colophon" class="site-footer fixed" role="contentinfo">
       <?php $sf_impact_social_above_footer = $sf_impact_Theme_Mods->getMod('sf_impact_social_above_footer');
           
            if ($sf_impact_social_above_footer) sf_impact_social_media_icons(); ?>
        <?php get_sidebar('footer');
        $footer =   $sf_impact_footer_text = $sf_impact_Theme_Mods->getMod("sf_impact_footer_text");
        ?>
        
	
	</footer><!-- #colophon -->
 
</div><!-- #page -->
  
<?php wp_footer(); ?>
<?php $dev = '<span>Theme developed by &nbsp; </span> <a href="http://shooflysolutions.com/"> Shoofly Solutions</a>'; ?>
<div id="bottomwrapper">
    <div id="shoofly-footer"><?php echo $footer  ?></div>
    <div class="site-info fixed"><?php echo $dev?></div>
</div>

</body>
</html>
