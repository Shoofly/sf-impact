<?php
/**
 * The sidebar containing the footer widget area.
 *
 * @package shoofly
  * @subpackage sf-impact
 * @since sf-impact 1.0
 */
 if (is_active_sidebar('sfly-footersidebar-top'))
 {  ?>
    <div id="footersidebar-top" class="widget-area fixed" role="complementary">
 	      <?php dynamic_sidebar( 'sfly-footersidebar-top' ); ?>
    </div>
    <?php 
 
 }

