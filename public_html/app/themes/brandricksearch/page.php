<?php
/**
 * The template for displaying all pages.
 *
 *
 * @package every1
 */

get_header(); ?>


<?php 
//$post = the_post();
if(isset($post->ID)) {
	$postId            = $post->ID;
	$headerImageUrl    = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	$thumb_id          = get_post_thumbnail_id($postId);
	$alt               = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php if ($headerImageUrl): ?>
	<div class="hero-img-wrapper">
		<img src="<?php echo $headerImageUrl[0] ?>"  alt="<?php echo $alt ?>" >
			<div class="img-title-container">
						<h1 class="animated fadeInUp"><?php the_title(); ?> </h1>
			</div>			
		

	</div>
	<?php endif; ?>

	<div class="page-wrapper internal-page anim-section">
	
	    
	    <div class="container">
		    <div class="row">
		    	<div class="col-sm-10 col-sm-offset-1  col-md-10 col-md-offset-1 col-lg-offset-2 col-lg-8">
			    	
	    			<div id="bread-container" >
				    	<?php if ( function_exists('yoast_breadcrumb') ) 
				    {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>
					</div>
			    	
			    	
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
	<!-- End page-wrapper -->

</article>

<?php if (! is_page('contact')): ?>
	<!-- Contact footer form -->
	<?php get_template_part( 'template-includes/project-planner-form' ); ?>
<?php endif; ?>



<?php get_footer(); ?>