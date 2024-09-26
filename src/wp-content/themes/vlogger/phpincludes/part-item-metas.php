<?php
/*
Package: Vlogger
*/
$post = get_post(get_the_ID());
$user_id = $post->post_author;
$avatar = get_avatar_url($user_id );

?>
	<?php if('' !== $avatar){ ?>
	<a href="<?php echo esc_attr( get_author_posts_url( $user_id ) ); ?>" class="qt-author-thumb"><img src="<?php echo  esc_url($avatar); ?>" alt="<?php echo esc_attr("Avatar", "vlogger"); ?>"></a> 
	<?php } ?>

	<a href="<?php echo esc_attr( get_author_posts_url( $user_id ) ); ?>" class="qt-authorurl"><?php the_author_meta( 'display_name', $user_id ); ?></a> | <?php echo vlogger_international_date(); ?>
