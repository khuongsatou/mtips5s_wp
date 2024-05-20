<?php
/**
 * Template Name: Team Single
 * Description: The template file for displaying team single pages
 *
 * @package agrul
 */

get_header();?>
	
	    <?php
	     while ( have_posts() ) : the_post();

			the_content();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

    
<?php 
get_footer();