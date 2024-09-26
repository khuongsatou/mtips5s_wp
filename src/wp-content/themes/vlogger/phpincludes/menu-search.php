<?php
/*
Package: Vlogger
*/
?>
<li id="qtnavsearch" class="right qt-navsearch qt-menubutton">
	<form id="qtnavform" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
		<button id="qtnavsearchbutton" class="qt-navsearch-btn tooltipped qt-btn-transparent" data-position="top" data-delay="50" data-tooltip="<?php esc_html_e("Search", "vlogger" ); ?>">
			<i class="icon dripicons-search"></i>
		</button>
		<button  id="qtnavsearchclose" class="qt-navsearch-btnclose" >
			<i class="icon dripicons-cross"></i>
		</button>
        <input id="qtsearch" name="s" type="search" placeholder="<?php esc_html_e("Search", "vlogger" ); ?>">
  	</form>
</li>