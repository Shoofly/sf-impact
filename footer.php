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
?>

	</div><!-- #content -->
 
	<footer id="colophon" class="site-footer fixed" role="contentinfo">
      
        <?php get_sidebar('footer');
        $footer =   $sf_impact_footer_text = get_theme_mod("sf_impact_footer_text", "&copy; 2015 Shoofly Solutions ");
        ?>
        
	
	</footer><!-- #colophon -->
 
</div><!-- #page -->
  
<?php wp_footer(); ?>
<?php $dev = '<span>Theme developed by &nbsp; </span> <a href="http://shooflysolutions.com/"> Shoofly Solutions</a>'; ?>
<div id="shoofly-footer"><?php echo $footer  ?></div>
<div class="site-info fixed"><?php echo $dev?></div>
</body>
</html>
