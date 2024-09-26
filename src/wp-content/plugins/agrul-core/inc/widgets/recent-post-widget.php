<?php
/**
* agrul Recent Post widget
*
* Displays Recent Post widget
*
* @author       validthemes
* @category     Widgets
* @package      agrul-core/widgets
* @version      1.0.0
* @extends      WP_Widget
*/
class agrul_Recent_Post_Widget extends WP_Widget {

    /**
     * Sets up a new Recent Posts widget instance.
     */
    public function __construct() {
        $widget_ops = array(
            'classname'                   => 'recent-post',
            'description'                 => esc_html__('The most recent posts on your site', 'agrul-core'),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'agrul-recent-posts', esc_html__('Agrul Recent Posts', 'agrul-core'), $widget_ops );

    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
        if ( ! $number ) {
            $number = 5;
        }

        $title_length = ( ! empty( $instance['title_length'] ) ) ? absint( $instance['title_length'] ) : 5;
        if ( ! $title_length ) {
            $title_length = 5;
        }


        $r = new WP_Query(
            /**
             * Filters the arguments for the Recent Posts widget.
             * @see WP_Query::get_posts()
             *
             * @param array $args     An array of arguments used to retrieve the recent posts.
             * @param array $instance Array of settings for the current widget.
             */
            apply_filters(
                'widget_posts_args',
                array(
                    'posts_per_page'      => $number,
                    'no_found_rows'       => true,
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => true,
                ),
                $instance
            )
        );

        if ( ! $r->have_posts() ) {
            return;
        }
        ?>
        <?php echo $args['before_widget']; ?>
        <?php
        if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        ?>
        <ul>
            <?php foreach ( $r->posts as $recent_post ) : ?>
                <?php
                $post_title   = get_the_title( $recent_post->ID );
                $title  = ( ! empty( $post_title ) ) ? $post_title : esc_html__( 'no title', 'agrul-core' );
                $image  = wp_get_attachment_image_src( get_post_thumbnail_id($recent_post->ID));
                ?>

                <li>
                    <?php if (has_post_thumbnail( $recent_post->ID )) : ?>
                    <div class="thumb">
                        <a href="<?php the_permalink( $recent_post->ID ); ?>">
                            <img src="<?php echo esc_url( $image[0] ) ?>" alt="<?php echo esc_attr__( 'agrul', 'agrul-core' ); ?>">
                        </a>
                    </div>
                    <?php endif; ?>
                    <div class="info">
                        <div class="meta-title">
                        <span class="post-date"><?php echo get_the_date( get_option('date_format'), $recent_post->ID ); ?></span>
                        </div>
                        <?php if ( $post_title ) : ?><a href="<?php the_permalink($recent_post->ID ); ?>"><?php echo esc_html(wp_trim_words($post_title,$title_length ,'')); ?></a> <?php endif;
                             ?>
                    </div>
                </li>
            <?php endforeach; ?>
            <?php wp_reset_postdata(); ?>
        </ul>
        <?php
        echo $args['after_widget'];
    }
    /**
     * Update the widget settings.
     *
     * @param array $new_instance New widget instance.
     * @param array $old_instance Old widget instance.
     *
     * @return array
     */
    public function update( $new_instance, $old_instance ) {
        $instance              = $old_instance;
        $instance['title']     = sanitize_text_field( $new_instance['title'] );
        $instance['number']    = (int) $new_instance['number'];
        $instance['title_length']    = (int) $new_instance['title_length'];
        return $instance;
    }

    /**
     * Widget form.
     *
     * @param array $instance Widget instance.
     *
     * @return void
     */
    public function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        $title_length    = isset( $instance['title_length'] ) ? absint( $instance['title_length'] ) : 5;
        ?>
        <p><label for="<?php echo wp_specialchars_decode( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'agrul-core' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo wp_specialchars_decode( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

        <p><label for="<?php echo wp_specialchars_decode( $this->get_field_id( 'number' ) ); ?>"><?php echo esc_html__( 'Number of posts to show:', 'agrul-core' ); ?></label>
        <input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo wp_specialchars_decode( $this->get_field_name( 'number' ) ); ?>" type="number" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>

        <p><label for="<?php echo wp_specialchars_decode( $this->get_field_id( 'title_length' ) ); ?>"><?php echo esc_html__( 'Title Length:', 'agrul-core' ); ?></label>
        <input id="<?php echo esc_attr( $this->get_field_id( 'title_length' ) ); ?>" name="<?php echo wp_specialchars_decode( $this->get_field_name( 'title_length' ) ); ?>" type="title_length" value="<?php echo esc_attr( $title_length ); ?>" size="3" /></p>

        <?php
    }
}

function agrul_register_custom_widgets() {
    register_widget( 'agrul_Recent_Post_Widget' );
}
add_action( 'widgets_init', 'agrul_register_custom_widgets' );  