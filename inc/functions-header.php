<?php
/*
* Array of possible Social Media Icons
*/
if (!function_exists('sf_impact_social_icons_array')):
     function sf_impact_social_icons_array() {
 
		return array( 'twitter', 'facebook', 'google-plus', 'flickr', 'pinterest', 'youtube', 'vimeo', 'tumblr', 'dribbble', 'rss', 'linkedin', 'instagram', 'user',  'shopping-cart');
  }
  endif;
/*
* Array of possible Social Media Links
*/
if (!function_exists('sf_impact_social_media_array')):
     function sf_impact_social_media_array() {
 
	// store social site names in array
	$social_sites = array( 
        __('twitter', 'sf-impact'), 
        __('facebook', 'sf-impact'), 
        __('google-plus', 'sf-impact'), 
        __('flickr',  'sf-impact'), 
        __('pinterest', 'sf-impact'), 
        __('youtube', 'sf-impact'), 
        __('vimeo', 'sf-impact'), 
        __('tumblr', 'sf-impact'), 
        __('dribbble', 'sf-impact'), 
        __('rss', 'sf-impact'),
        __('linkedin', 'sf-impact'), 
        __('instagram', 'sf-impact'), 
        __('account', 'sf-impact'),  
        __('shopping-cart', 'sf-impact'));
 
	return $social_sites;
  }
  endif;
/*
* Display Social Media Icons
*/
if (!function_exists('sf_impact_social_media_icons')):

    function sf_impact_social_media_icons() {
     
        $social_sites = sf_impact_social_media_array();
        $social_icons = sf_impact_social_icons_array();
 
        // any inputs that aren't empty are stored in $active_sites array
         $sf_impact_icon_size = get_theme_mod('sf_impact_icon_size', 'lg');
        for ($i=0; $i < count($social_sites); ++$i) 
       {

            $social_site = $social_sites[$i];
            if( strlen( get_theme_mod( $social_site ) ) > 0 ) {
                
                $active_sites[] = $social_site;
                $links[] = get_theme_mod( $social_site );
                $icons[] = $social_icons[$i];
            }
        }
 
        // for each active social site, add it as a list item 
        if(!empty($active_sites)) {
          ?><div id="shoofly-social-media-container" class="fixed">
                <div id="shoofly-social-media"><?php
                for ($i=0; $i < count($active_sites); ++$i)
                {
                    $site = $active_sites[$i];
                    $link = $links[$i];
                    $icon = $icons[$i];
                ?>
   
                    <a href="<?php echo $link?>" target="_blank" title="<?php echo ucfirst($site); ?>"><i class="fa fa-<?php echo $icon?> fa-<?php echo $sf_impact_icon_size ?>"></i></a>
                <?php }?>
           </div><!--shoofly-social-media-->
        </div><!--shoofly-social-media-container--><?php
        
    }
   }
 endif;
 /*
* Main code for the header image
*/
if (!function_exists('sf_impact_header')):
    function sf_impact_header()
    {
        $top = TRUE;
      
  
        $sf_impact_header_image = get_theme_mod('sf_impact_header_image', '');
        $sf_impact_logo_location = get_theme_mod('sf_impact_logo_location', 'image');
        $sf_impact_home_header_type = get_theme_mod('sf_impact_home_header_type', '3');
     
      
        if ($sf_impact_header_image && $sf_impact_logo_location == 'image')
            $top = FALSE;
            
        $style = sf_impact_get_home_header_style();
 
    
   
         if ($sf_impact_home_header_type == "1")
         {     
            $wstyle = sf_impact_get_home_header_width();
            $hstyle = sf_impact_get_home_header_height();
            sf_impact_get_slideshow($wstyle, $hstyle);
         }
         else 
         {
             if ($sf_impact_header_image && $sf_impact_home_header_type == "0")
             {
                ?>

                <img class="headerimg headerimg-home" alt="header" style="<?php echo  $style?>;" src="<?php echo $sf_impact_header_image?>"/>
           
                <?php 
                $output = "";
                $output = apply_filters('sf_impact_home_post_bar', $output);
                if ( $output != '' )
                {
                    ?><div id="homepostbar">
                    <?php
                            echo $output;?>
                    </div>
                    <?php
                }
             }
         }
    
    }
endif;
/*
* Create the settings for the thumbnail grid array. 
* $type = page or post
* $category = the category to display
* $posts = Number of posts to display
* $height = Height of thumbnail if not default
* $width = Width of thumbnail if not default
* $imagesize = wordpress image size (ie, thumbnail, medium, etc)
* $cellwidth - not currently used - use cell width & height to display even grid when image sizes are not uniform.
* $cellheight - not currently used
*/
if (!function_exists('sf_impact_get_thumbnailarray')):
    function sf_impact_get_thumbnailarray($type, $category, $posts, $height, $width,  $imagesize, $cellwidth, $cellheight, $captionwidth, $gridwidth )
    {
    
         $arra = array('post_type' => $type, 'posts_per_page' => $posts,  'aligngrid' => 'autocenter',   'imagesize' => $imagesize, 'cellwidth' => $cellwidth, 'cellheight'=>$cellheight, 'captionwidth' => $captionwidth, 'ignore_sticky_posts' => 1);

           if ($height)
                $arra['height'] = $height;
            if ($width)
                $arra['width'] = $width;
        if ($category)
                $arra['cat']  = $category;
        if ($gridwidth)
            $arra['gridwidth'] = $gridwidth;
        return ($arra);
    }
endif;
/*
* Get the URL of the post thumbnail 
*/
//Get thumbnail url
if (!function_exists('sf_impact_get_thumbnailurl')):
    function sf_impact_get_thumbnailurl($category, $page)
    {
        if ($category)
            $url = get_category_link($category);
        else
            $url = get_permalink( $page );
        return $url;
    }
endif;

?>

