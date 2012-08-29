<?php 

add_action('widgets_init', 'team_load_widgets');

// Register widget
function team_load_widgets() {
	register_widget( 'SL__Team_Widget' );
}

// Widget class
class SL__Team_Widget extends WP_Widget {

	
	function SL__Team_Widget() {
		// Settings
		$widget_ops = array('classname' => 'featured-team', 'description' => 'Displays random Team Member.');

		// Control settings
		$control_ops = array('width' => 200, 'height' => 350, 'id_base' => 'team-widget');

		// Create widget
		$this->WP_Widget('team-widget', __('Spark Launch: Random Team Member', ''), $widget_ops, $control_ops);
	}


	// Display widget
	function widget( $args, $instance ) {
		extract( $args );

		// Our variables from the widget settings
		$title = apply_filters('widget_title', $instance['team_title'] );
	
		// Before widget (defined by theme functions file)
		echo $before_widget;
	
		// Display the widget title if one was input
		if ( $title )
			echo $before_title . $title . $after_title;
			
		// Display widget
		?>

			<?php $members = new WP_Query(array ('post_type' => 'team', 'orderby' => 'rand', 'posts_per_page' => '1')); ?>
			<?php while ($members->have_posts()) : $members->the_post(); sl_post_meta(); ?>
			<?php global $meta;?>
			
				<div class="member">
					<?php the_post_thumbnail('teammember_small'); ?>
					<h5><?php the_title(); ?><?php if(!empty($meta['title'])) { ?><em>, <?php echo $meta['title']; ?></em><?php } ?></h5>
					<?php the_content(); ?>
				</div><!-- /member -->
			
			<?php endwhile; wp_reset_query(); ?>
	
		<?php
		
		// After widget (defined by theme functions file)
		echo $after_widget;
	}

	// Update widget settings
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['team_title'] = strip_tags( $new_instance['team_title'] );

		return $instance;
	}


	function form( $instance ) {

		// Set up some default widget settings.
		$defaults = array( 'title' => ('Team Member'));
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id('team_title'); ?>"><?php _e('Widget title:'); ?></label>
			<input id="<?php echo $this->get_field_id('team_title'); ?>" name="<?php echo $this->get_field_name('team_title'); ?>" value="<?php echo $instance['team_title']; ?>" class="widefat" />
		</p>

<?php
	}
}
?>