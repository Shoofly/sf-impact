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
global $sf_impact_Theme_Mods;
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
$sf_impact_logo_image = $sf_impact_Theme_Mods->getMod('sf_impact_logo_image');

$headerLogo = false;

$headerText = false;
$logoCss = "";
if ($sf_impact_logo_image != '') {
    $headerLogo = true;
    $logoCss = ' class="site-logo"';
} elseif (display_header_text() == 1) {
    $headerText = true;
    $logoCss = ' class="site-text"';
}
?>


  
      <div id="site-logo-title"<?php echo $logoCss; ?>>

            <?php if($sf_impact_logo_image != '')
            {?>
        	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                <img src="<?php echo esc_url($sf_impact_logo_image); ?>" alt="get_the_title"/>
        	</a>
            <?php 
            }
            else
            {?>
                <div class="site-title">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <?php echo get_bloginfo('name'); ?>
                    </a>
                </div>
                <div class="site-description">
                    <?php echo get_bloginfo('description');?>
                </div>
                <?php
            } 
            ?>
            
    </div>
