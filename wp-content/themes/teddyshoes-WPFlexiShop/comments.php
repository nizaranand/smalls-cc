
<div id="comments">

<?php if ( post_password_required() ) : ?>
				<p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'flexishop' ); ?></p>
<?php

		return;
	endif;
?>

<?php if ( have_comments() ) : ?>
			<h3 id="comments-title"><?php
			printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'flexishop' ),
			number_format_i18n( get_comments_number() ), '' . get_the_title() . '' );
			?></h3>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
				<?php previous_comments_link( __( '&larr; Older Comments', 'flexishop' ) ); ?>
				<?php next_comments_link( __( 'Newer Comments &rarr;', 'flexishop' ) ); ?>
<?php endif; ?>

			<ul class="comments-list">
				<?php
					wp_list_comments( array( 'callback' => 'flexishop_comment' ) );
				?>
			</ul>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
				<?php previous_comments_link( __( '&larr; Older Comments', 'flexishop' ) ); ?>
				<?php next_comments_link( __( 'Newer Comments &rarr;', 'flexishop' ) ); ?>
<?php endif; ?>

<?php else : 
	if ( ! comments_open() ) :
?>
	<p><?php _e( 'Comments are closed.', 'flexishop' ); ?></p>
<?php endif; ?>

<?php endif; ?>

<?php comment_form(); ?>

</div>