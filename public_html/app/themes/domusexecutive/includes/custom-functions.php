<?php
// Remove P tags from images
function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');


// add slug to body classes
function add_slug_body_class( $classes ) {
global $post;
if ( isset( $post ) ) {
$classes[] = $post->post_type . '-' . $post->post_name;
}
return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );





//Form down to bottom 
if (!is_page('thank-you')) {
        add_filter( 'gform_confirmation_anchor', '__return_true' );
 }



add_filter( 'gform_validation_message', 'change_message', 10, 2 );
function change_message( $message, $form ) {
    return "<div class='validation_error'>There is an error with your submission. Please complete the forms highlighted below.</div>";
}


/*
// Insert 'styleselect' into the $buttons array
function my_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}

// For adding wysiwig classes
// Use 'mce_buttons' for button row #1, mce_buttons_3' for button row #3

add_filter('mce_buttons_2', 'my_mce_buttons_2');

function my_mce_before_init_insert_formats( $init_array ) {
    $style_formats = array(
          array(
             'title' => 'Lead', // Title to show in dropdown
             'selector' => 'p', // Element to add class to
             'classes' => 'lead' // CSS class to add
         )
     );
     $init_array['style_formats'] = json_encode( $style_formats );
     return $init_array;
 }

add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );
*/