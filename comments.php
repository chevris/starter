<?php
/**
 * Template part for displaying comments.
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
*/
if ( post_password_required() ) {
	return;
}

if ( have_comments() ) :
	?>

	<div id="comments" class="comments">

		<?php
		$comments_number = absint( get_comments_number() );

		if ( 'product' == get_post_type() ) {
			// Translators: %s = the number of reviews.
			$comments_title = sprintf( _nx( '%s Review', '%s Reviews', $comments_number, 'Translators: %s = the number of reviews', 'themeslug' ), $comments_number );
		} else {
			// Translators: %s = the number of comments.
			$comments_title = sprintf( _nx( '%s Comment', '%s Comments', $comments_number, 'Translators: %s = the number of comments', 'themeslug' ), $comments_number );
		}

		// Filter the comments title before output.
		$comments_title = apply_filters( 'theme_slug_filter_comments_title', $comments_title, $comments_number, get_post_type() );

		if ( $comments_title ) {
			?>
			<div class="comments-header">
				<h2 class="comment-reply-title"><?php echo esc_html( $comments_title ); ?></h2>
			</div><!-- .comments-header -->
			<?php
		}

		wp_list_comments(
			array(
				'avatar_size' => 120,
				'style'       => 'div',
			)
		);

		$comment_pagination = paginate_comments_links(
			array(
				'echo'      => false,
				'end_size'  => 0,
				'mid_size'  => 0,
				'next_text' => '<span class="text">' . esc_html__( 'Newer', 'themeslug' ) . '</span><span class="arrow">&rarr;</span>',
				'prev_text' => '<span class="arrow">&larr;</span><span class="text">' . esc_html__( 'Older', 'themeslug' ) . '</span>',
			)
		);

	if ( $comment_pagination ) {

		// If we're only showing the "Next" link, add a class indicating so.
		$pagination_classes = ( false === strpos( $comment_pagination, 'prev page-numbers' ) ) ? ' only-next' : '';
		?>

		<nav class="comments-pagination pagination<?php echo esc_attr( $pagination_classes ); ?>">
			<div class="comments-pagination-inner">
				<?php echo wp_kses_post( $comment_pagination ); ?>
			</div><!-- .comments-pagination-inner -->
		</nav>

		<?php
	}
	?>

	</div><!-- comments -->

	<?php
endif;

if ( comments_open() || pings_open() ) {
	comment_form(
		array(
			'cancel_reply_before' => '</span><small>',
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title"><span class="title">',
			'title_reply_after' => '</h2>',
		)
	);
}
