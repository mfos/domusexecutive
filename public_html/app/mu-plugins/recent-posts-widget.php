<?php
/*Plugin Name: Recent Posts Widget
Description: This widget checks if the current page has parent or child pages and if so, outputs a list of the highest ancestor page and its descendants. This file supports part 1 of the series to create the widget and doesn't give you a functioning widget.
Version: 0.1
Author: Rachel McCollin
Author URI: http://rachelmccollin.com
License: GPLv2
*/

function tutsplus_register_list_pages_widget() {
    register_widget( 'Tutsplus_List_Pages_Widget' );
}
add_action( 'widgets_init', 'tutsplus_register_list_pages_widget' );

/**
 * Widget API: WP_Widget_Recent_Posts class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Core class used to implement a Recent Posts widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class Tutsplus_List_Pages_Widget extends WP_Widget {

    /**
     * Sets up a new Recent Posts widget instance.
     *
     * @since 2.8.0
     * @access public
     */
    public function __construct() {
        $widget_ops = array('classname' => 'widget_recent_entries', 'description' => __( "HB site&#8217;s most recent Posts.") );
        parent::__construct('hb-recent-posts', __('Custom Widget: Recent Posts'), $widget_ops);
        $this->alt_option_name = 'widget_recent_entries';
    }

    /**
     * Outputs the content for the current Recent Posts widget instance.
     *
     * @since 2.8.0
     * @access public
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Recent Posts widget instance.
     */
    public function widget( $args, $instance ) {
        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
        if ( ! $number )
            $number = 5;
        $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

        /**
         * Filter the arguments for the Recent Posts widget.
         *
         * @since 3.4.0
         *
         * @see WP_Query::get_posts()
         *
         * @param array $args An array of arguments used to retrieve the recent posts.
         */
        $r = new WP_Query( apply_filters( 'widget_posts_args', array(
            'posts_per_page'      => $number,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true
        ) ) );

        if ($r->have_posts()) :
            ?>
            <?php echo $args['before_widget']; ?>
            <?php if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        } ?>
            <ul class="no-list">
                <?php while ( $r->have_posts() ) : $r->the_post(); ?>
                    <li>
                        <div class="blog-preview-image">
                            <a class="entry-title" href="<?php echo the_permalink(); ?>" title="<?php the_title();?>">
                                <?php
                                if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) {
                                    the_post_thumbnail();
                                } else {
                                    // get backup image if exists in blog post
                                    echo main_image();
                                }
                                ?>
                            </a>
                        </div>
                        <div class="blog-preview-excerpt">
                            <div class="entry-meta">
                                <?php harringtonbrooks_posted_on(); ?>
                            </div><!-- .entry-meta -->
                            <a class="entry-title" href="<?php echo the_permalink(); ?>"><h4><?php echo the_title(); ?></h4></a>
                            <div class="excerpt">
                                <?php

                                // Instead of the default excerpt, use the one created by yoast seo.
                                $yoast_wpseo_metadesc = get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true);
                                if (!empty($yoast_wpseo_metadesc)) {
                                    echo $yoast_wpseo_metadesc;
                                }
                                ?>
                                <a class="continue-reading-inline-tag" href="<?php echo the_permalink(); ?>" title="<?php the_title();?>">Read more &raquo;</a>
                            </div><!--/excerpt-->
                        </div>



                        <hr class="light">
                    </li>
                <?php endwhile; ?>
            </ul>
            <?php echo $args['after_widget']; ?>
            <?php
            // Reset the global $the_post as this query will have stomped on it
            wp_reset_postdata();

        endif;
    }

    /**
     * Handles updating the settings for the current Recent Posts widget instance.
     *
     * @since 2.8.0
     * @access public
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['number'] = (int) $new_instance['number'];
        $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
        return $instance;
    }

    /**
     * Outputs the settings form for the Recent Posts widget.
     *
     * @since 2.8.0
     * @access public
     *
     * @param array $instance Current settings.
     */
    public function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
        ?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
            <input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>

        <p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
            <label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label></p>
        <?php
    }
}