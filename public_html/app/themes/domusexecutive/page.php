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
<?php if ($headerImageUrl): ?>
<div class="hero-img-wrapper">
	<img src="<?php echo $headerImageUrl[0] ?>"  alt="<?php echo $alt ?>" >
</div>
<?php endif; ?>

<div class="page-wrapper internal-page">

    
    <div class="container">
	    <div class="row">
	    	<div class="col-sm-10 col-sm-offset-1">
		    	
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
	<?php if (! is_page('contact')): ?>
     	<!-- Contact footer form -->
	 	<?php get_template_part( 'template-includes/contact-footer-form' ); ?>
	 <?php endif; ?>

</div>
<!-- End page-wrapper -->

<?php get_footer(); ?>