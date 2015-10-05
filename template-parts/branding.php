<?php
/**
 * The template used for displaying branding
 *
 * @package shoofly
  * @subpackage sf-impact-lite
 * @since sf-impact-lite 1.0
 */
?>
<?php   

 $sf_impact_lite_logo_image = get_theme_mod("sf_impact_lite_logo_image", '');
?>
    <div id="site-logo-title">

	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
            <?php if($sf_impact_lite_logo_image != '')
            {?>
                <img src="<?php echo $sf_impact_lite_logo_image; ?>"/>
            <?php 
            }
            else
                {?>
                    <div class="site-title">
                    <?php echo get_bloginfo('name'); ?>
                </div>
                <div class="site-description">
                    <?php echo get_bloginfo('description');?>
                </div>
                <?php } 
            ?>
        </a>
</div>