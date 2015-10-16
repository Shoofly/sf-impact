<?php
/**
 * The sidebar containing the footer widget area.
 *
 * @package shoofly
  * @subpackage sf-impact
 * @since sf-impact 1.0
 */
 if (is_active_sidebar('sfly-footersidebar-left') || is_active_sidebar('sfly-footersidebar-middle') || is_active_sidebar('sfly-footersidebar-right')):
 ?>

<div id="footersidebar" class="widget-area fixed" role="complementary">
    <div class="widget-footer">
        <div id="footer-left">
	        <?php dynamic_sidebar( 'sfly-footersidebar-left' ); ?>
        </div>
    </div>
    <div  class="widget-footer">
        <div id="footer-middle">
	        <?php dynamic_sidebar( 'sfly-footersidebar-middle' ); ?>
        </div>
    </div>

     <div class="widget-footer">
    <div id="footer-right">
        <?php dynamic_sidebar( 'sfly-footersidebar-right' );?>
    </div>
</div>
</div><!-- #secondary -->
<?php endif;?>
