<?php
/**
 * The template for displaying contact page.
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

<div class="page-wrapper internal-page contact-page">

    
    <div class="container">
	    <div class="row">
	    	<div class="col-sm-7 col-sm-offset-1 col-md-7 col-md-offset-1">
		    	
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
				<?= do_shortcode( '[gravityform id="1" title="false" description="false" ajax="false"]' );?>
	    	</div>
	    	<div class="col-sm-3">
		    	<div class="contact-info">
			    	<h3>Contact details</h3>
			    	
			    	<ul>
				    	<li><strong>Head office</strong></li>
				    	<li>1, (5 & 6) Princes Court,</li>
				    	<li>Silver Street,</li>
				    	<li>Ramsbottom</li>
				    	<li>Bury</li>
				    	<li>BL0 0BJ</li>
				    	</ul>
				    <ul>
				    	<li>TEL: 0800 299 299</li>
				    </ul>
				    <ul>
				    	<li>EMAIL: contact@domusexecutive.com</li>
			    	</ul>
		    	</div>
	    	</div>
		</div>
    </div>


</div>
<!-- End page-wrapper -->

<?php get_footer(); ?>