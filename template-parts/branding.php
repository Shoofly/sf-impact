<?php
/**
 * The template used for displaying branding
 *
 * @package shoofly
  * @subpackage sf-impact
 * @since sf-impact 1.0
 */
?>
<?php   
require_once ( dirname(__DIR__) . "/inc/theme-mods.php" );

$sf_impact_Theme_Mods = sf_impact_Theme_Mods::get_instance('sf_impact');

$sf_impact_logo_image = $sf_impact_Theme_Mods->getMod('sf_impact_logo_image');

?>
    <div id="site-logo-title">

	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
            <?php if($sf_impact_logo_image != '')
            {?>
                <img src="<?php echo $sf_impact_logo_image; ?>"/>
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