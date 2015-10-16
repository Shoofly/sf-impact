<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package shoofly
  * @subpackage sf-impact
 * @since sf-impact 1.0
 */
 global $wp_version;
 
 if ($wp_version < 4.3)
 {
    
    if ( ! function_exists( 'the_posts_navigation' ) ) :
    /**
     * Display navigation to next/previous set of posts when applicable.
     *
     * @todo Remove this function when WordPress 4.3 is released.
     */
    function the_posts_navigation() {
	    // Don't print empty markup if there's only one page.

	    if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		    return;
	    }
	    ?>
	    <nav class="navigation posts-navigation" role="navigation">
	
		    <div class="nav-links">

			    <?php if ( get_next_posts_link() ) : ?>
			    <div class="nav-previous"><?php next_posts_link( esc_html__( 'Older posts', 'sf-impact' ) ); ?></div>
			    <?php endif; ?>

			    <?php if ( get_previous_posts_link() ) : ?>
			    <div class="nav-next"><?php previous_posts_link( esc_html__( 'Newer posts', 'sf-impact' ) ); ?></div>
			    <?php endif; ?>

		    </div><!-- .nav-links -->
	    </nav><!-- .navigation -->
	    <?php
    }
    endif;

    if ( ! function_exists( 'the_post_navigation' ) ) :
    /**
     * Display navigation to next/previous post when applicable.
     *
     * @todo Remove this function when WordPress 4.3 is released.
     */
    function the_post_navigation() {
	    // Don't print empty markup if there's nowhere to navigate.
	    $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	    $next     = get_adjacent_post( false, '', false );

	    if ( ! $next && ! $previous ) {
		    return;
	    }
	    ?>
	    <nav class="navigation post-navigation" role="navigation">

		    <div class="nav-links">
			    <?php
				    previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
				    next_post_link( '<div class="nav-next">%link</div>', '%title' );
			    ?>
		    </div><!-- .nav-links -->
	    </nav><!-- .navigation -->
	    <?php
    }
    endif;
    if ( ! function_exists( 'the_archive_title' ) ) :
    /**
     * Shim for `the_archive_title()`.
     *
     * Display the archive title based on the queried object.
     *
     * @todo Remove this function when WordPress 4.3 is released.
     *
     * @param string $before Optional. Content to prepend to the title. Default empty.
     * @param string $after  Optional. Content to append to the title. Default empty.
     */
    function the_archive_title( $before = '', $after = '' ) {
	    if ( is_category() ) {
		    $title = sprintf( esc_html__( 'Category: %s', 'sf-impact' ), single_cat_title( '', false ) );
	    } elseif ( is_tag() ) {
		    $title = sprintf( esc_html__( 'Tag: %s', 'sf-impact' ), single_tag_title( '', false ) );
	    } elseif ( is_author() ) {
		    $title = sprintf( esc_html__( 'Author: %s', 'sf-impact' ), '<span class="vcard">' . get_the_author() . '</span>' );
	    } elseif ( is_year() ) {
		    $title = sprintf( esc_html__( 'Year: %s', 'sf-impact' ), get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'sf-impact' ) ) );
	    } elseif ( is_month() ) {
		    $title = sprintf( esc_html__( 'Month: %s', 'sf-impact' ), get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'sf-impact' ) ) );
	    } elseif ( is_day() ) {
		    $title = sprintf( esc_html__( 'Day: %s', 'sf-impact' ), get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'sf-impact' ) ) );
	    } elseif ( is_tax( 'post_format' ) ) {
		    if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			    $title = esc_html_x( 'Asides', 'post format archive title', 'sf-impact' );
		    } elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			    $title = esc_html_x( 'Galleries', 'post format archive title', 'sf-impact' );
		    } elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			    $title = esc_html_x( 'Images', 'post format archive title', 'sf-impact' );
		    } elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			    $title = esc_html_x( 'Videos', 'post format archive title', 'sf-impact' );
		    } elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			    $title = esc_html_x( 'Quotes', 'post format archive title', 'sf-impact' );
		    } elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			    $title = esc_html_x( 'Links', 'post format archive title', 'sf-impact' );
		    } elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			    $title = esc_html_x( 'Statuses', 'post format archive title', 'sf-impact' );
		    } elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			    $title = esc_html_x( 'Audio', 'post format archive title', 'sf-impact' );
		    } elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			    $title = esc_html_x( 'Chats', 'post format archive title', 'sf-impact' );
		    }
	    } elseif ( is_post_type_archive() ) {
		    $title = sprintf( esc_html__( 'Archives: %s', 'sf-impact' ), post_type_archive_title( '', false ) );
	    } elseif ( is_tax() ) {
		    $tax = get_taxonomy( get_queried_object()->taxonomy );
		    /* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		    $title = sprintf( esc_html__( '%1$s: %2$s', 'sf-impact' ), $tax->labels->singular_name, single_term_title( '', false ) );
	    } else {
		    $title = esc_html__( 'Archives', 'sf-impact' );
	    }

	    /**
	     * Filter the archive title.
	     *
	     * @param string $title Archive title to be displayed.
	     */
	    $title = apply_filters( 'get_the_archive_title', $title );

	    if ( ! empty( $title ) ) {
		    echo $before . $title . $after;  // WPCS: XSS OK.
	    }
    }
    endif;

    if ( ! function_exists( 'the_archive_description' ) ) :
    /**
     * Shim for `the_archive_description()`.
     *
     * Display category, tag, or term description.
     *
     * @todo Remove this function when WordPress 4.3 is released.
     *
     * @param string $before Optional. Content to prepend to the description. Default empty.
     * @param string $after  Optional. Content to append to the description. Default empty.
     */
    function the_archive_description( $before = '', $after = '' ) {
	    $description = apply_filters( 'get_the_archive_description', term_description() );

	    if ( ! empty( $description ) ) {
		    /**
		     * Filter the archive description.
		     *
		     * @see term_description()
		     *
		     * @param string $description Archive description to be displayed.
		     */
		    echo $before . $description . $after;  // WPCS: XSS OK.
	    }
    }
    endif;
 }

if (! function_exists('sf_impact_title')) :
     function sf_impact_title()
     {
     			    if ( is_single() || is_page()) :
				    the_title( '<h1 class="entry-title">', '</h1>' );
			    else :
		            the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); 
                endif;
     }
 endif;

 
if ( ! function_exists( 'sf_impact_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function sf_impact_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'sf-impact' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'sf-impact' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'sf_impact_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
 function sf_impact_entry_footer() {
	// Hide category and tag text for pages only show on single posts.

    if (is_single() || is_page())
    {
        
	    if ( 'post' == get_post_type() ) {
   
		    /* translators: used between list items, there is a space after the comma */
		    $categories_list = get_the_category_list( __( ', ', 'sf-impact' ) );
		    if ( $categories_list && sf_impact_categorized_blog() ) {
			    printf( '<div class="cat-links footer-links">' . __( 'Posted in %1$s', 'sf-impact' ) . '</div>', $categories_list );
		    }

		    /* translators: used between list items, there is a space after the comma */
		    $tags_list = get_the_tag_list( '', __( ', ', 'sf-impact' ) );
		    if ( $tags_list ) {
			    printf( '<div class="tags-links footer-links">' . __( 'Tagged %1$s', 'sf-impact' ) . '</div>', $tags_list );
		    }
	    }
    
        $sf_impact_show_author = get_theme_mod('sf_impact_show_author', true);
   	    if ( is_single() &&   $sf_impact_show_author  ) :
			    get_template_part( 'template-parts/author-bio' );
		    endif;
    
        if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		    echo '<div class="comments-link">';
		    comments_popup_link( __( 'Leave a comment', 'sf-impact' ), __( '1 Comment', 'sf-impact' ), __( '% Comments', 'sf-impact' ) );
		    echo '</div>';
	    }
 
	    edit_post_link( __( 'Edit', 'sf-impact' ), '<div class="edit-link">', '</div>' );
    }
}
endif;



/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function sf_impact_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'sf_impact_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'sf_impact_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so sf_impact_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so sf_impact_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in sf_impact_categorized_blog.
 */
function sf_impact_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'sf_impact_categories' );
}
add_action( 'edit_category', 'sf_impact_category_transient_flusher' );
add_action( 'save_post',     'sf_impact_category_transient_flusher' );
if (!function_exists('sf_impact_thumbnail')):

 function sf_impact_thumbnail()
 {
     global $post;
     if ($post->post_type == "post")
     {
        $sf_impact_post_featured = get_theme_mod('sf_impact_post_featured', true);
        $sf_impact_post_header = get_theme_mod('sf_impact_post_header', false); //Check if this should go in the header instead 
     }
     else
     {
       $sf_impact_post_featured = get_theme_mod('sf_impact_page_featured', true);
        $sf_impact_post_header = get_theme_mod('sf_impact_page_header', false); 
     }
    if ($sf_impact_post_header)  //This is going to go into the header instead
        return;
    $meta = get_post_meta( $post->ID, 'show_featured_image', $sf_impact_post_featured  ) ;
 
    $showthumb = esc_attr( get_post_meta( $post->ID, 'show_featured_image', true ) ) != NULL ? esc_attr( get_post_meta( $post->ID, 'show_featured_image', true ) ) :  $sf_impact_post_featured;;
         if ($showthumb):
     
     ?>
        <div class="post_img">
		<?php 
        if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
            the_post_thumbnail();?>
            <hr><?php            
        }?>
        </div><!--post_img-->
 <?php 
        endif;
    
 }
 endif;