<?php
//Utility Functions

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
if (!function_exists('sf_impact_getFileDir')):
 function sf_impact_getFileDir($filename)
    {
        $themedir = get_template_directory();
        $styledir = get_stylesheet_directory();
        $path = "$themedir/$filename";
     
        if ($styledir && $styledir != $themedir)
        {
            
            $childpath = "$styledir/$filename";
        
            if (file_exists($childpath))
            {
           
                $path = $childpath;
            }
        }      
        return $path; 
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
if (!function_exists('sf_impact_getAllPostTypes')):
      function sf_impact_getAllPostTypes()
        {
            $post_types = array('post', 'page');     //limit meta box to certain post types
            $args = array(
               'public'   => true,
               '_builtin' => false
            );

            $output = 'names'; // names or objects, note names is the default
            $operator = 'and'; // 'and' or 'or'
            $post_types = array_merge($post_types, get_post_types( $args, $output, $operator )); 
            return $post_types;         
        }
endif;
        /*
* Return number of stickys for given query
*/
if (!function_exists('sf_impact_count_sticky')):
function sf_impact_count_sticky($category = NULL)
{
    $args = array(
			
			'post__in' => get_option( 'sticky_posts' ),
			'showposts' => '3'
		);
    if ($category)
        $args['cat'] = $category;
    $the_query = new WP_Query( $args );

	$count = $the_query->post_count;
    return $count;
}
 endif; 
 if (!function_exists('sf_impact_posts_by_category')):
     function sf_impact_posts_by_category($category)
     {
         $stickycount = sf_impact_count_sticky($category);
              $args	= array(
					            'post_type' => 'post',
					            'order' => 'DESC',
					            'orderby' => 'post_date',
                                'cat' => $category,
					        );
              $the_query = new WP_Query($args);
                         
               sf_impact_posts($the_query, $stickycount);  
     }
 endif;
?>