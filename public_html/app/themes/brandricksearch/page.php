<?php
/**
 * The template for displaying all pages.
 *
 *
 * @package every1
 */

get_header(); ?>

<div class="page-wrapper internal-page">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	

	<div class="head-top-section dark">
	    <div class="container">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1  col-md-10 col-md-offset-1 col-lg-offset-2 col-lg-8 anim-section">
					<h1><?php the_title(); ?></h1>
					<div id="bread-container">
				    	<?php if ( function_exists('yoast_breadcrumb') ) 
				    {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>
					</div>
					
						<?php the_field('top_content'); ?>
					
				</div>
			</div>
		</div>
    </div>


	
	<div class="middle-section anim-section">    
	    <div class="container">
		    <div class="row">
		    	<div class="col-sm-10 col-sm-offset-1  col-md-10 col-md-offset-1 col-lg-offset-2 col-lg-8">
					<?php // Show the selected frontpage content.
					if ( have_posts() ) :
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/page/content', 'page' );
						endwhile;
					else : // I'm not sure it's possible to have no posts when this page is shown, but WTH.
						get_template_part( 'template-parts/post/content', 'none' );
					endif; ?>
		    	</div>
			</div>
	    </div>
	</div>


	<?php if (is_page('what-we-do')): ?>
		<?php get_template_part( 'template-includes/service-link-blocks' ); ?>
	<?php endif; ?>

	<?php if(have_rows('block_grid')): ?>  
			<div class="block-grid animated">
				<?php while ( have_rows('block_grid') ) : the_row(); ?>
                
	 		    <div class="block-grid-item">
				    	<h3><?php the_sub_field('title'); ?></h3>
				    	 <?php the_sub_field('copy'); ?>
			    </div>

				<?php endwhile; ?>
			</div>
	<?php endif; ?>           


	<?php if(get_field('extra_copy_field')): ?>
	    <div class="container">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1  col-md-10 col-md-offset-1 col-lg-offset-2 col-lg-8">
						<?php the_field('extra_copy_field'); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>


</article>

</div>
<!-- End page-wrapper -->

<?php if (! is_page('contact')): ?>
	<!-- Contact footer form -->
	<?php get_template_part( 'template-includes/project-planner-form' ); ?>
<?php endif; ?>


<?php get_footer(); ?>