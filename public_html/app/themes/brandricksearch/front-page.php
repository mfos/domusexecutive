<?php
/**
 * The template for displaying all pages.
 *
 *
 * @package every1
 */

get_header(); ?>


<div class="front-page">
    
    <div class="content-wrapper">
	    <div class="text-float">
		    <div class="text-inner">
			    <div class="text-container">
			   		<h1 class="visible-xs-block">Planning.<br>Control.<br><span>Precision.</span></h1>
			   		<h1 class="hidden-xs">Planning.Control.<span>Precision.</span></h1>
			   		<span class="animated fadeIn subtitle">Executive search and talent consulting.</span>
			   		<hr class="animated fadeIn">
			    </div>
				<?php get_template_part( 'template-includes/service-link-blocks' ); ?>

			    
			    
		    </div>
	    </div>
    


    </div>
    

	  
    

</div>
<!-- End page-wrapper -->

<?php get_footer(); ?>
