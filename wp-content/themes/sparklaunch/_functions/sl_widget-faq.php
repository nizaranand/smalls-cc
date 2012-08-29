<?php 

add_action('widgets_init', 'faq_load_widgets');

// Register widget
function faq_load_widgets() {
	register_widget( 'SL__FAQ_Widget' );
}

// Widget class
class SL__FAQ_Widget extends WP_Widget {

	
	function SL__FAQ_Widget() {
		// Settings
		$widget_ops = array('classname' => 'featured-faq', 'description' => 'Displays random FAQ item.');

		// Control settings
		$control_ops = array('width' => 200, 'height' => 350, 'id_base' => 'faq-widget');

		// Create widget
		$this->WP_Widget('faq-widget', __('Spark Launch: FAQ', ''), $widget_ops, $control_ops);
	}


	// Display widget
	function widget( $args, $instance ) {
		extract( $args );

		// Our variables from the widget settings
		$title = apply_filters('widget_title', $instance['faq_title'] );
	
		// Before widget (defined by theme functions file)
		echo $before_widget;
	
		// Display the widget title if one was input
		if ( $title )
			echo $before_title . $title . $after_title;
			
		// Display widget
		?>

			<?php $faq = new WP_Query(array ('post_type' => 'faq', 'orderby' => 'rand', 'posts_per_page' => '1')); ?>
			<dl>
				<?php while ($faq->have_posts() ) : $faq->the_post(); sl_post_meta(); ?>
					<dt><?php the_title(); ?></dt>
					<dd><?php the_content(); ?></dd>	
				<?php endwhile; ?>
			</dl>
			<?php wp_reset_query(); ?>
	
		<?php
		
		// After widget (defined by theme functions file)
		echo $after_widget;
	}

	// Update widget settings
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['faq_title'] = strip_tags( $new_instance['faq_title'] );

		return $instance;
	}


	function form( $instance ) {

		// Set up some default widget settings.
		$defaults = array( 'title' => ('FAQ'));
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id('faq_title'); ?>"><?php _e('Widget title:'); ?></label>
			<input id="<?php echo $this->get_field_id('faq_title'); ?>" name="<?php echo $this->get_field_name('faq_title'); ?>" value="<?php echo $instance['faq_title']; ?>" class="widefat" />
		</p>

<?php
	}
}
?>