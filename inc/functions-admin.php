<?php
if ( is_admin() ) {
    add_action( 'load-post.php', 'sfly_post_meta' );
    add_action( 'load-post-new.php', 'sfly_post_meta' );
}

/** 
 * The Class.
 */
 if (!class_exists('sfly_post_meta')):
    class sfly_post_meta {

	    /**
	     * Hook into the appropriate actions when the class is constructed.
	     */
	    public function __construct() {
		    add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		    add_action( 'save_post', array( $this, 'save' ) );
            add_filter( 'admin_post_thumbnail_html', array($this, 'add_image_meta' ));
	    }

	    /**
	     * Adds the meta box container.
	     */
	    public function add_meta_box( $post_type ) {
                $post_types = array('post');     //limit meta box to certain post types
                if ( in_array( $post_type, $post_types )) {
		    add_meta_box(
			    'sfly_post_features'
			    ,__( 'Post Settings', 'sf-impact' )
			    ,array( $this, 'render_meta_box_content' )
			    ,$post_type
			    ,'side'
			    ,'high'
		    );
                }
	    }

	    /**
	     * Save the meta when the post is saved.
	     *
	     * @param int $post_id The ID of the post being saved.
	     */
	    public function save( $post_id ) {
	
		    /*
		     * We need to verify this came from the our screen and with proper authorization,
		     * because save_post can be triggered at other times.
		     */

		    // Check if our nonce is set.
		    if ( ! isset( $_POST['sf_impact_inner_custom_box_nonce'] ) )
            {
                write_log( 'invalid nonce');
			    return $post_id;
            }
     
      
            $this->updateCheckBox($post_id, "hide_featured_image");
       
 
		    $nonce = $_POST['sf_impact_inner_custom_box_nonce'];

		    // Verify that the nonce is valid.
		    if ( ! wp_verify_nonce( $nonce, 'sf_impact_inner_custom_box' ) )
            {
                write_log( 'invalid nonce');
			    return $post_id;
            }
		    // If this is an autosave, our form has not been submitted,
                    //     so we don't want to do anything.
		    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			    return $post_id;

		    // Check the user's permissions.
		    if ( 'page' == $_POST['post_type'] ) {
				    return $post_id;
	
		    } else {

			    if ( ! current_user_can( 'edit_post', $post_id ) )
				    return $post_id;
		    }
            $this->updateCheckbox($post_id, "post_hide_sidebar");
            $this->updateCheckbox($post_id, "post_show_in_slideshow");
	
	    }

        function add_image_meta( $content ) {
     
                global $post;
                if ($post->post_type === 'post') {
                    $text = __( 'Don\'t display image in post.', 'sf-impact' );
      
                    $defvalue = !get_theme_mod('sf_impact_post_featured', TRUE);
    
        
                    $meta = get_post_meta( $post->ID, "hide_featured_image", true );
        
                    if ($meta != NULL)
                        $value = get_post_meta( $post->ID, "hide_featured_image", true );
                    else 
                        $value = $defvalue;
     
                     $label = '<label for="hide_featured_image" class="selectit">
                        <input name="hide_featured_image" type="checkbox" id="hide_featured_image" ' . checked( $value, 1, false) .'> ' . $text .'
                        </label>';
                     $content .= $label;
                }
                return $content;
            }
        public function updateCheckbox($post_id, $id)
        {
           $value =  isset( $_POST[$id]) && $_POST[$id]  ? 1 : 0;
     

            update_post_meta( $post_id, esc_attr($id), $value ); //save value
        }
         public function createCheckbox($id, $label, $default = NULL)
         {
            global $post;
            if (!$default)
              $default = FALSE;
            $meta = esc_attr( get_post_meta( $post->ID, $id, true ) );
            $value = $meta != NULL ? $meta : $default;
 
            echo '<div><label for="' . $id . '" class="selectit"><input name="' . $id . '" type="checkbox" id="' . $id . '" value="' . $value . ' "'. checked( $value, 1, false) .'> ' . $label .'</label></div>';
	    }
        /**
	     * Render Meta Box content.
	     *
	     * @param WP_Post $post The post object.
	     */
	    public function render_meta_box_content( $post ) {
	
		    // Add an nonce field so we can check for it later.
		    wp_nonce_field( 'sf_impact_inner_custom_box', 'sf_impact_inner_custom_box_nonce' );
            $defaultval = !get_theme_mod('sf_impact_post_sidebar', FALSE);
            $this->createCheckbox("post_hide_sidebar", "Hide Sidebar (Full Page)", $defaultval);
            $this->createCheckbox("post_show_in_slideshow", "Include in Slide Show", TRUE);
	
	    }
    }
endif;

?>
