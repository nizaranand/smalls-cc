<?php

// A couple of functions to create custom meta boxes (for custom post types)

function sl_create_meta_box() {
	// Sidebar on/off checkbox
	add_meta_box(
	    'sl-meta-box-sidebar',     
	    'Sidebar On/Off',           
	    'sl_meta_box_sidebar',      
	    'page',                     
	    'side',                     
	    'low'                       
	);

	// Meta box for Team Member's title		
	add_meta_box(
		'sf-meta-box-title',
		'Team Member\'s Title',
		'sl_meta_box_title',
		'team',
		'normal',
		'high'
	);

	// Meta boxes for Testimonials post type
	add_meta_box(
		'sf-meta-box-sourcecompany',
		'Source Company',
		'sl_meta_box_sourcecompany',
		'testimonial',
		'normal',
		'high'
	);
	
	add_meta_box(
		'sf-meta-box-sourcelocation',
		'Source Location',
		'sl_meta_box_sourcelocation',
		'testimonial',
		'normal',
		'high'
	);
	
	add_meta_box(
		'sf-meta-box-sourceurl',
		'Source URL',
		'sl_meta_box_sourceurl',
		'testimonial',
		'normal',
		'high'
	);
	
	// Meta boxes for Slides post type
	add_meta_box(
		'sf-meta-box-slidebutton',
		'Button Text',
		'sl_meta_box_slidebutton',
		'slide',
		'normal',
		'high'
	);
	
	add_meta_box(
		'sf-meta-box-slidebuttonlink',
		'Button Link',
		'sl_meta_box_slidebuttonlink',
		'slide',
		'normal',
		'high'
	);
}

function sl_meta_box_sidebar(){
    global $post;
    $custom = get_post_custom($post->ID);
    $sl_meta_box_sidebar = $custom["sl-meta-box-sidebar"][0];
?>

<input type="checkbox" name="sl-meta-box-sidebar" <?php if( $sl_meta_box_sidebar == true ) { ?>checked="checked"<?php } ?> /> <span>Check this box to turn the sidebar off.</p>
<?php }

function sl_meta_box_title() {
	global $meta; sl_post_meta( $post->ID ); ?>
	<input type="text" name="sl_meta[title]" value="<?php echo htmlspecialchars ($meta[ 'title' ]); ?>" style="width:99%;" /><br />
<?php }

function sl_meta_box_sourcecompany() {
	global $meta; sl_post_meta( $post->ID ); ?>
	<input type="text" name="sl_meta[sourcecompany]" value="<?php echo htmlspecialchars ($meta[ 'sourcecompany' ]); ?>" style="width:99%;" /><br />
<?php }

function sl_meta_box_sourcelocation() {
	global $meta; sl_post_meta( $post->ID ); ?>
	<input type="text" name="sl_meta[sourcelocation]" value="<?php echo htmlspecialchars ($meta[ 'sourcelocation' ]); ?>" style="width:99%;" /><br />
<?php }

function sl_meta_box_sourceurl() {
	global $meta; sl_post_meta( $post->ID ); ?>
	<input type="text" name="sl_meta[sourceurl]" value="<?php echo htmlspecialchars ($meta[ 'sourceurl' ]); ?>" style="width:99%;" /><br />
<?php }

function sl_meta_box_slidebutton() {
	global $meta; sl_post_meta( $post->ID ); ?>
	<input type="text" name="sl_meta[slidebutton]" value="<?php echo htmlspecialchars ($meta[ 'slidebutton' ]); ?>" style="width:99%;" /><br />
<?php }

function sl_meta_box_slidebuttonlink() {
	global $meta; sl_post_meta( $post->ID ); ?>
	<input type="text" name="sl_meta[slidebuttonlink]" value="<?php echo htmlspecialchars ($meta[ 'slidebuttonlink' ]); ?>" style="width:99%;" /><br />
<?php }


// Add all these actions to the hook
add_action( 'admin_menu', 'sl_create_meta_box' );


/* Verify and save meta. Don't save if there is no specific meta, 
it is a revision, or the current user can't edit posts. */

	function sl_save_meta_box( $post_id, $post ) {
		global $post, $type;
	
		$post = get_post( $post_id );
	
		if( !isset( $_POST[ "sl_meta" ] ) )
			return;
	
		if( $post->post_type == 'revision' )
			return;
	
		if( !current_user_can( 'edit_post', $post_id ))
			return; 
	
		$meta = apply_filters( 'sl_post_meta', $_POST[ "sl_meta" ] );
	
		foreach( $meta as $key => $meta_box ) {
			$key = 'meta_' . $key;
			$curdata = $meta_box;
			$olddata = get_post_meta( $post_id, $key, true );
	
			if( $olddata == "" && $curdata != "" )
				add_post_meta( $post_id, $key, $curdata );
			elseif( $curdata != $olddata )
				update_post_meta( $post_id, $key, $curdata, $olddata );
			elseif( $curdata == "" )
				delete_post_meta( $post_id, $key );
		}
	
		do_action( 'sl_saved_meta', $post );
	}
	
	add_action( 'save_post', 'sl_save_meta_box', 1, 2 );


/* Gather all meta objects attached to a certain posts. 
Exclude WordPress internal meta and create an array of data. */

function sl_post_meta( $post_id = '' ) {
	global $meta, $post, $wpdb;

	if( empty( $post_id ) )
		$post_id = $post->ID;

	$meta = array();
	$custom_field_keys = get_post_custom_keys( $post_id );

	if( $custom_field_keys ) {
		foreach( $custom_field_keys as $key => $value ) {
			$valuet = trim( $value );

			if ( '_' == $valuet{0} )
				continue;

			$value_short = str_replace( 'meta_', "", $valuet );

			$meta[ $value_short ] = get_post_meta( $post_id, $value, true );
		}
	}

	return $meta;
}

// Checkbox saving
add_action('save_post', 'save_details');

function save_details($post_ID = 0) {
    $post_ID = (int) $post_ID;
    $post_type = get_post_type( $post_ID );
    $post_status = get_post_status( $post_ID );

    if ($post_type) {
    update_post_meta($post_ID, "sl-meta-box-sidebar", $_POST["sl-meta-box-sidebar"]);
    }
   return $post_ID;
}