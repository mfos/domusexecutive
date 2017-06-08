<?php
/**
 * The template for displaying contact page.
 *
 *
 * @package every1
 */

get_header(); ?>


<div class="page-wrapper internal-page contact-page">

	<div class="head-top-section light anim-section">
	    <div class="container">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1  col-md-10 col-md-offset-1 col-lg-offset-2 col-lg-8">
					<h1 class="animated fadeInUp">How to get in touch</h1>
					<div id="bread-container" >
				    	<?php if ( function_exists('yoast_breadcrumb') ) 
				    {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>
					</div>
					
					<?php the_field('top_content'); ?>
				</div>
			</div>
		</div>
    </div>


	<div class="contact-form-section anim-section">
	    <div class="container">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1  col-md-10 col-md-offset-1 col-lg-offset-2 col-lg-8">
					
					<?= do_shortcode( '[gravityform id="1" title="false" description="false" ajax="false"]' );?>
				</div>
			</div>
		</div>
    </div>

	
	<div class="address-section anim-section">
	    <div class="container">
			<div class="row">
		    	<div class="col-sm-6">
			    	<div class="contact-info">
				    	<h3>Head office</h3>
				    	<hr>
				    	<ul>
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
					    	<li>EMAIL: contact@brandricksearch.com</li>
				    	</ul>
			    	</div>
			    	<div id="map-canvas-ramsbottomoffice" class="map-container"></div>
		    	</div>
		    	<div class="col-sm-6">
			    	<div class="contact-info">
				    	<h3>Maidenhead office</h3>
				    	<hr>
				    	<ul>
					    	<li>Suite 9,  Second Floor,</li>
					    	<li>110 High Street,</li>
					    	<li>Maidenhead</li>
					    	<li>Berkshire</li>
					    	<li>SL6 1P</li>
					    	</ul>
					    <ul>
					    	<li>TEL: 01628 630 104</li>
					    </ul>
					    <ul>
					    	<li>EMAIL: contact@brandricksearch.com</li>
				    	</ul>
			    	</div>
			    	<div id="map-canvas-maidenheadoffice" class="map-container"></div>
		    	</div>
			</div>
	    </div>
	</div>



</div>
<!-- End page-wrapper -->

<?php get_footer(); ?>