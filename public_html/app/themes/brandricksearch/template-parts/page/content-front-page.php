<?php
/**
 * Displays content for front page
 *
 * @package WordPress
 * @subpackage Domus Executive
 * @since 1.0
 * @version 1.0
 */

?>

    
	<?php
		/* translators: %s: Name of current post */
		the_content( sprintf(
			__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'brandricksearch' ),
			get_the_title()
		) );
	?>



