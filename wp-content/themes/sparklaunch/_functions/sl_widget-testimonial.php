<?php 

add_action('widgets_init', 'testimonial_load_widgets');

// Register widget
function testimonial_load_widgets() {
	register_widget( 'SL__Testimonial_Widget' );
}

// Widget class
class SL__Testimonial_Widget extends WP_Widget {

	
	function SL__Testimonial_Widget() {
		// Settings
		$widget_ops = array('classname' => 'featured-testimonial', 'description' => 'Displays random Testimonial.');

		// Control settings
		$control_ops = array('width' => 200, 'height' => 350, 'id_base' => 'testimonial-widget');

		// Create widget
		$this->WP_Widget('testimonial-widget', __('Spark Launch: Random Testimonial', ''), $widget_ops, $control_ops);
	}


	// Display widget
	function widget( $args, $instance ) {
		extract( $args );

		// Our variables from the widget settings
		$title = apply_filters('widget_title', $instance['testimonial_title'] );
	
		// Before widget (defined by theme functions file)
		echo $before_widget;
	
		// Display the widget title if one was input
		if ( $title )
			echo $before_title . $title . $after_title;
			
		// Display widget
		?>

			<?php $testimonials = new WP_Query(array( 'post_type' => 'testimonial', 'orderby' => 'rand', 'posts_per_page' => '1')); ?>
			<?php while ($testimonials->have_posts() ) : $testimonials->the_post(); sl_post_meta(); ?>
		
			<div class="testimonial">
			
				<?php global $meta;?>
			
				<blockquote>
					<?php the_content(); ?>
				</blockquote>
				
				<cite><?php the_title(); ?>, <a href="<?php echo $meta['sourceurl']; ?>"><?php echo $meta['sourcecompany']; ?></a>, <?php echo $meta['sourcelocation']; ?></cite>
									
			</div><!-- /testimonial -->
			
			<?php endwhile; wp_reset_query(); ?>
	
		<?php
		
		// After widget (defined by theme functions file)
		echo $after_widget;
	}

	// Update widget settings
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['testimonial_title'] = strip_tags( $new_instance['testimonial_title'] );

		return $instance;
	}


	function form( $instance ) {

		// Set up some default widget settings.
		$defaults = array( 'title' => ('Testimonials'));
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id('testimonial_title'); ?>"><?php _e('Widget title:'); ?></label>
			<input id="<?php echo $this->get_field_id('testimonial_title'); ?>" name="<?php echo $this->get_field_name('testimonial_title'); ?>" value="<?php echo $instance['testimonial_title']; ?>" class="widefat" />
		</p>

<?php
	}
}
?>