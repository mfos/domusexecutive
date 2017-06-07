<?php
/**
 * The template for displaying Post Category pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package every1
 */

get_header(); ?>

    <?php $cat = get_query_var('cat');
          $yourcat = get_category ($cat);
    ?> 
 
<div class="page-wrapper">
    
</div>
<!-- End page-wrapper -->

<?php 
get_footer(); ?>