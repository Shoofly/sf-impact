<?php
/**

 * post page template for link from thumbnail grid when no category is selected
 * @subpackage sf-impact
 * @since sf-impact 1.0
  */  
get_header(); 
$sf_impact_grid_title = get_theme_mod( 'sf_impact_grid_title', "Recent Posts");
?>
 
	<div id="primary" class="content-area">
		<div id="main" class="site-main" role="main">
        <header class="page-header">
				<h1 class="page-title"><?php echo $sf_impact_grid_title ?></h1>
		</header>
	    <?php sf_impact_home_query();?>
           
		</div><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
