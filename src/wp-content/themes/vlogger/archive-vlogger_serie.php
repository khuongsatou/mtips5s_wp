<?php
/*
Package: Vlogger
Template Name: Series archive
*/


/**
 * [$paged current paged number]
 * @var [int]
 */
$paged = vlogger_get_paged();


?>
<?php 
get_header(); 
?>
	<?php  
	get_template_part( 'phpincludes/menu'); 
	?>

	<!-- ======================= MAIN SECTION  ======================= -->
	<div id="maincontent" class="qt-main qt-paper">
	
		<!-- ======================= HEADER SECTION ======================= -->
		<?php 
        if( get_post_meta(get_the_id(), 'vlogger_hide_header', true) !== "1" && $paged <= 1){
		  get_template_part( 'phpincludes/part-header'); 
        }
		?>
		<!-- ======================= HEADER SECTION END ======================= -->

        <?php  
        /**
         * ADS slot output
         */
        vlogger_ads_display('vlogger_ads_under_header');
        ?>


        <?php  
        if(is_page() &&  $paged == 1){
            if ( have_posts() ) : while ( have_posts() ) : the_post();
                the_content(); 
            endwhile; endif;
        } 
        ?>




        <?php wp_reset_postdata(); ?>

		<!-- ======================= CONTENT SECTION ======================= -->
		<div id="qtcontents" class="qt-container qt-vertical-padding-l">
            <?php  
            if(is_page() && $paged > 1){
                ?>
                    <div class="qt-row">
                        <div class="col s12">
                            <h4><?php esc_html_e('Page','vlogger');?>: <?php esc_html_e($paged); ?></h4>
                        </div>
                    </div>
                    <hr class="qt-spacer-m">
                <?php
            } 
            ?>
			<div class="row">
                <?php 
                if(is_page()){
                    /**
                     * [$args Query arguments]
                     * @var array
                     */
                    $args = array(
                        'post_type' => 'vlogger_serie',
                        'posts_per_page' => '9',
                        'post_status' => 'publish',
                        'orderby' =>  array ('menu_order' => 'ASC', 'date' => 'DESC'),
                        'paged' => $paged,
                    );
                    /**
                     * [$wp_query execution of the query]
                     * @var WP_Query
                     */
                    $wp_query = new WP_Query( $args );
                    if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
                        ?>
                        <div class="col s12 m4 qt-spacer-s">
                            <?php get_template_part (  'phpincludes/part-archive-item-card-simple' ); ?>
                        </div>
                        <?php
                    endwhile; else: ?>
                        <h3><?php esc_html_e("Sorry, nothing here","vlogger")?></h3>
                    <?php endif;
                    wp_reset_postdata();
                } else {
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                        ?>
                        <div class="col s12 m4 qt-spacer-s">
                            <?php get_template_part (  'phpincludes/part-archive-item-card-simple' ); ?>
                        </div>
                        <?php
                    endwhile; else: ?>
                        <h3><?php esc_html_e("Sorry, nothing here","vlogger")?></h3>
                    <?php endif;
                }
                ?>
            </div>	
		</div>
		<!-- ======================= CONTENT SECTION END ======================= -->
	</div>
	<?php 
	get_template_part( 'phpincludes/part-pagination'); 
	?> 
	<!-- ======================= MAIN SECTION END ======================= -->
	<?php 
	get_template_part ('phpincludes/footerwidgets'); ?>
<?php get_footer(); ?>