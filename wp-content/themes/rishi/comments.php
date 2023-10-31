<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Rishi
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

$defaults                    = rishi__cb__get_layout_defaults();
$ed_comment_form_above_clist = get_theme_mod( 'ed_comment_form_above_clist', $defaults['ed_comment_form_above_clist'] ); ?>

<?php do_action('rishi:comments:before'); ?>

<div id="comments" class="comments-area">
	<?php do_action('rishi:comments:top'); ?>
	<?php
		if( $ed_comment_form_above_clist == 'yes' ) comment_form();

		// You can start editing here -- including this comment!
		if ( have_comments() ) :
			?>
			<h2 class="comments-title">
				<?php
					printf( // WPCS: XSS OK.
						/* translators: 1: comment count number. */
						esc_html( _nx( '%1$s Comment', '%1$s Comments', get_comments_number(), 'comments title', 'rishi' ) ),
						number_format_i18n( get_comments_number() )
					);
				?>
			</h2><!-- .comments-title -->

			<ol class="comment-list">
				<?php
					wp_list_comments( array(
						'style'      => 'ol',
						'short_ping' => true,
						'callback'   => 'rishi_comment_callback',
						'avatar_size' => 48,
					) );
				?>
			</ol><!-- .comment-list -->

			<?php
			the_comments_navigation();

			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() ) :
				?>
				<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'rishi' ); ?></p>
				<?php
			endif;

		endif; // Check for have_comments().

		if( $ed_comment_form_above_clist == 'no' ) comment_form();
	?>
	<?php do_action('rishi:comments:bottom'); ?>
</div><!-- #comments -->

<?php do_action('rishi:comments:after');