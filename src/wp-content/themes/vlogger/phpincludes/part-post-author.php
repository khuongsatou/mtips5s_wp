<?php
/*
Package: Vlogger
*/

if(get_theme_mod('vlogger_show_author', '1' )){
	$user_id = get_the_author_meta('ID');
	$avatar = get_avatar_url($user_id );

	$desc = get_the_author_meta( 'description' );
	if($desc){
	?>
	<!-- AUTHOR PART ========================= -->
	<div class="qt-post-author qt-content-primary qt-fullwidth">
			<?php if($avatar){ ?>
			<a class="qt-author-thumbnail" href="<?php echo esc_attr( get_author_posts_url( $user_id ) ); ?>">
				<img src="<?php echo esc_url($avatar); ?>" alt="<?php echo esc_attr("Avatar", "vlogger"); ?>">
			</a>
			<?php } ?>
			<div class="qt-post-author-data">
				<div class="qt-authorheader">
					
					<a href="<?php echo esc_attr( get_author_posts_url( $user_id ) ); ?>" class="qt-authorname qt-capfont"><?php echo get_the_author(); ?></a>
					<p class="qt-authorsocial">
						<?php  
						vlogger_user_social_icons($user_id );
						?>
					</p>
				</div>
				<p class="qt-post-author-bio">
				<?php echo wp_kses($desc, array() ); ?>
				</p>
			</div>
	</div>
	<!-- AUTHOR PART END ========================= -->
	<?php  
	} else { 
		?>
		<hr>
		<p class="qt-small qt-spacer-s">

		<em><?php esc_html_e("Written by", "vlogger"); ?> <a href="<?php echo esc_attr( get_author_posts_url( $user_id ) ); ?>" class="qt-authorname"><?php echo get_the_author(); ?></a></em>
		</p><?php
	}
}