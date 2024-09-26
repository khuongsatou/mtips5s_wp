<?php
/*
Package: Vlogger
*/
?>
<form method="get" class="form-horizontal qw-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<input value="<?php echo esc_attr(get_search_query()); ?>" name="s" placeholder="<?php echo esc_attr_x( 'Type and press enter &hellip;', 'placeholder', 'vlogger' ); ?>" type="text" />
</form>
