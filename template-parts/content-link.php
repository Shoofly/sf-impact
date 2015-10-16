<?php
/**
 * The template for displaying posts in the Link post format
 *
 * @package shoofly
 * @subpackage sfimpact
 * @since sfImpact 1.0
 */

 $myLink = sf_impact_get_url(); 
?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
       <header class="entry-header">
 	        <div class="entry-meta">
                <?php sf_impact_thumbnail();?>      
		        <?php sf_impact_posted_on(); ?>
                <?php sf_impact_title(); ?>
            </div><!-- .entry-meta -->
	
	    </header><!-- .entry-header -->

	    <div class="entry-content entry-link">
		    <?php
			    /* translators: %s: Name of current post */
                if (!($myLink))
                {
			        the_content( sprintf(
				        __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'sf-impact' ),
				        the_title( '<span class="screen-reader-text">', '</span>', false )
			        ) );
                }
                elseif (is_single()) 
                {
                ?>
                   <a href="<?php echo $myLink; ?>"><?php echo the_title(); ?></a>
                <?php 
                }

		        wp_link_pages( array(
				    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sf-impact' ),
				    'after'  => '</div>',
			    ) );
		    ?>
	    </div><!-- .entry-content -->
        <?php if (is_single())
        {?>
	    <footer class="entry-footer">
		    <?php sf_impact_entry_footer(); ?>
   
	    </footer><!-- .entry-footer -->
        <?php        }?>
    </article><!-- #post-## -->
