<?php
/*
Package: Vlogger
*/

//================================================================================================


/**
 *
 *	Vogliamo poter usare template tutorial anche per post senza video
 * 	abbiamo 3 templates:
 * 	- default
 * 	- video simple
 * 	- tutorial
 *
 * 	Caso 1: default quando non ho selezionato tutorial e non ho un video
 * 	Caso 2: quando non ho selezionato tutorial e HO video
 * 	Case 3 : ho scelto template "tutorial"
 * 
 */

$template = get_post_meta(get_the_ID(), 'vlogger_post_template', true);

switch ($template){
	case "tutorial":
		get_template_part("template-tutorial" );
		break;
	case "default":
	default:
		if (vlogger_is_post_format_video(get_the_ID())){
			get_template_part("template-video" );
		}
		else {
			get_template_part("template-default" );
		}
}
