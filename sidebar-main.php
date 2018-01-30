<?php

?>

<?php
/**
 * The sidebar containing the main widget area on the home page.
 *
 * @package shoofly
  * @subpackage sf-impact
 * @since sf-impact 1.0
 */
    defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
    if ( is_active_sidebar( 'homepage-sidebar-left' ) ) { //tests to see if the sidebar is in use
    ?>
        <div id="main-sidebar" class="widget-area" role="complementary">
            <?php dynamic_sidebar( 'homepage-sidebar-left' );?>
            <hr/>
        </div>
     <?php
   } 
?>
