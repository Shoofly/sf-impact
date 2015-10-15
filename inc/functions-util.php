<?php
//Utility Functions
/*
* Get the base current URL
*/
if (!function_exists('sf_impact_geturi')):

     function sf_impact_geturi()
     {
        global $wp;
        return home_url(add_query_arg(array(),$wp->request)); 
     }
 endif;
 /*
 * Convert hex color to rgb
 * $hex = hex color
 */
if (!function_exists('sf_impact_hex2rgb')):
    function sf_impact_hex2rgb($hex)
    {
        $hex = str_replace("#", "", $hex);

       if(strlen($hex) == 3) {
          $r = hexdec(substr($hex,0,1).substr($hex,0,1));
          $g = hexdec(substr($hex,1,1).substr($hex,1,1));
          $b = hexdec(substr($hex,2,1).substr($hex,2,1));
       } else {
          $r = hexdec(substr($hex,0,2));
          $g = hexdec(substr($hex,2,2));
          $b = hexdec(substr($hex,4,2));
       }
       $rgb = array($r, $g, $b);
       return $rgb;
    }
endif;
/*
* Get RGBA style string
* $hex = hex color
* $opacity = opacity
*/
if (!function_exists('sf_impact_rgbastyle')):
    function sf_impact_rbgastyle($hex, $opacity)
    {
    
        $rgb = join(",", sf_impact_hex2rgb($hex));
        $rgba = $rgb . "," . strval($opacity/100);
  
        return
        " background-color: $hex;
        background-color: rgba($rgba); ";
    }
endif;
/*
* For debugging only
*/
if ( ! function_exists('write_log')) {
   function write_log ( $log )  {
      if ( is_array( $log ) || is_object( $log ) ) {
         error_log( print_r( $log, true ) );
      } else {
         error_log( $log );
      }
   }
}
?>