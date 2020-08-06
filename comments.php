<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments-view" class="comments-area">
	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		echo putH2Index('コメント');

		wp_list_comments(array('walker' => new My_Walker_Comment,));
		
		the_comments_navigation();

	else :
		//echo "コメントなし";
	endif; // Check for have_comments().

	
	?>

</div>
<div id="comments-post" class="comments-area">
	<?php
		if ( ! comments_open() ) :
			echo '<p class="no-comments">' . esc_html_e( 'コメントは募集してませんよ', '_s' ) . '</p>';
		else:
			comment_form();
		endif;
	?>
</div>
