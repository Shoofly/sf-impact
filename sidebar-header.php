<?php

?>

<?php
/**
 * The sidebar containing the header widget area on the home page.
 *
 * @package shoofly
  * @subpackage sf-impact
 * @since sf-impact 1.0
 */

    if ( is_active_sidebar( 'homepage-under-header' ) ) { //tests to see if the sidebar is in use
    ?>
        <div id="header-sidebar" class="widget-area" role="complementary">
            <?php dynamic_sidebar( 'homepage-under-header' );?>
        </div>
        <hr/>
     <?php
   } 
?>
