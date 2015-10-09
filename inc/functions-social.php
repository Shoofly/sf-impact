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
        global $sf_impact_Theme_Mods;
        
        $social_sites = sf_impact_social_media_array();
        $social_icons = sf_impact_social_icons_array();
 
        // any inputs that aren't empty are stored in $active_sites array
        $sf_impact_icon_size = $sf_impact_Theme_Mods->getMod( 'sf_impact_icon_size' );
        for ($i=0; $i < count($social_sites); ++$i) 
        {

            $social_site = $social_sites[$i];
            if( strlen( $sf_impact_Theme_Mods->getMod( $social_site ) ) > 0 ) {
                
                $active_sites[] = $social_site;
                $links[] = $sf_impact_Theme_Mods->getMod( $social_site );
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