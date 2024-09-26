<?php
/*
Package: Vlogger
*/
?>
<!-- COMMENTS PART ========================= -->
<?php
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>
<div class="qt-vertical-padding-s qt-commentsblock">
	<h3 class="qt-commentscaption"><span><?php esc_html_e("Comments","vlogger"); ?></span></h3>
	<p class="qt-item-metas qt-commentscount">
	  <?php esc_html_e("This post currently has", "vlogger") ?> <?php comments_number( 'no responses', 'one response', '% responses' ); ?>.
	</p>
</div>
<div id="comments" class="comments-area comments-list qt-part-post-comments qt-spacer-s">
	<?php // You can start editing here -- including this comment! ?>
	<?php if ( have_comments() ) : ?>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<div class="">
				<nav id="comment-nav-above" class="comment-navigation" role="navigation">
					<h3 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', "vlogger" ); ?></h3>
					<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', "vlogger" ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', "vlogger" ) ); ?></div>
				</nav><!-- #comment-nav-above -->
			</div >
		<?php endif; // check for comment navigation ?>
			<ol class="qt-comment-list">
				<?php
				wp_list_comments( array( 'callback' => 'vlogger_s_comment' ) );
				?>
			</ol>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
				
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h3 class="qw-page-subtitle grey-text"><?php esc_html_e( 'Comment navigation', "vlogger" ); ?></h3>
			<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', "vlogger" ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', "vlogger" ) ); ?></div>
		</nav><!-- #comment-nav-below -->
			
		<?php endif; // check for comment navigation ?>
	<?php endif; // have_comments() ?>
	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_attr_e( 'Comments are closed.', "vlogger" ); ?></p>
	<?php endif; ?>
	<?php

	/*
	*
	*     Custom parameters for the comment form
	*
	*/
	$required_text = esc_html__('Required fields are marked *',"vlogger");
	if(!isset ($consent) ) { 
		$consent = ''; 
	}
	$args = array(
		'id_form'           => 'qw-commentform',
		'id_submit'         => 'qw-submit',
		'class_form'		=> 'qt-clearfix',
		'title_reply_to'    => esc_html__( 'Leave a Reply to %s', "vlogger" ),
		'cancel_reply_link' => '<i class="mdi-navigation-cancel icon-l"></i>',
		'label_submit'      => esc_html__( 'Post Comment' ,"vlogger" ),
		'class_submit'		=> 'qt-btn qt-btn-xl qt-btn-primary',
		'comment_field' =>  '<div class="input-field"><textarea id="comment" name="comment" required="required"  aria-required="true" class="materialize-textarea"></textarea><label for="comment">'.esc_html__('Comment*',"vlogger").'</label></div>',
		'title_reply'       => esc_html__( 'Leave a Reply', "vlogger" ),
		'title_reply_before' => '<h4 id="reply-title" class="comment-reply-title qt-spacer-s">',
		'title_reply_after' => '</h4>',

		'must_log_in' => '<p class="must-log-in">' .
			sprintf(
				esc_html__( 'You must be <a href="%s">logged in</a> to post a comment.' , "vlogger"),
				wp_login_url( apply_filters( 'the_permalink', esc_url(get_permalink()) ) )
			) . '</p>',
		'logged_in_as' => '<p class="logged-in-as qt-small">' .
			sprintf(
			__( '<strong>Logged in as <a href="%1$s">%2$s</a></strong>. <a href="%3$s" title="Log out of this account">Log out?</a>', "vlogger" )
				.' '.esc_html__("Your email address will not be published. Required fields are marked *","vlogger"),
				admin_url( 'profile.php' ),
				$user_identity,
				esc_url(wp_logout_url( apply_filters( 'the_permalink', esc_url(get_permalink()) ) ))
			) . '</p>',
		'comment_notes_before' => '<hr class="qt-spacer-s">',
		'comment_notes_after' => '',
		'fields' => apply_filters( 'comment_form_default_fields', array(
			
			'author'=> '
				<hr class="qt-spacer-s">
				<div class="input-field">
	          		<input id="author" name="author" type="text"  value="' . esc_attr( $commenter['comment_author'] ) .'">
	          		<label for="author">' . esc_html__( 'Name', "vlogger" ).( $req ? '*' : '' ) . '</label>
	        	</div>',


			'email'   => '
				<hr class="qt-spacer-s">
				<div class="input-field">
	          		<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .'">
	          		<label for="email">' . esc_html__( 'Email', "vlogger" ).( $req ? '*' : '' ) . '</label>
	        	</div>',

			'url'     => '
				<hr class="qt-spacer-s">
				<div class="input-field">
	          		<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .'">
	          		<label for="url">'.esc_html__( 'Website', "vlogger" ) . '</label>
	        	</div><hr class="qt-spacer-s">',
	        	// WP 4.9.6
			'cookies' => 	'
				<hr class="qt-spacer-s">
				<div class="input-field">
				<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
				'<label for="wp-comment-cookies-consent">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'vlogger' ) . '</label></p>
				</div><hr class="qt-spacer-s">',
				
			)
		),
	);


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if (  comments_open() && post_type_supports( get_post_type(), 'comments' ) ) :?>
		<?php  comment_form($args); ?>
	<?php endif; ?>

</div><!-- #comments -->
