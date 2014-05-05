<?php
/**
 * The sidebar containing the footer widget area
 *
 * If no active widgets in this sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Spokiyo_Theme
 * @since January 2014
 */

if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<!-- Added the clearfix -->
	<div id="secondary" class="sidebar-container clearfix" role="complementary">
		<!-- <div class="widget-area"> -->
			<!-- Added html block -->
			<div class="home-features">
            	<h2 class="center">Services</h2>
	            <div class="container">
		            <div class="row">
			        	<div class="col-md-6">
			            	<h2><a href="talent-opportunity-matching/"><img src="<?php echo get_template_directory_uri(); ?>/images/spokiyo/toms-header.png" class="img-responsive"></a></h2>
			            	<p>Engaging qualified professionals with consulting opportunities from clients. </p>
			                <a class="read-more" href="talent-opportunity-matching/">Read more&nbsp;<img src="<?php echo get_template_directory_uri(); ?>/images/spokiyo/icon-read-more.jpg"></a>
			            </div>
			        	<div class="col-md-6">
			            	<h2><a href="business-process-outsourcing-matching/"><img src="<?php echo get_template_directory_uri(); ?>/images/spokiyo/bpo-header.png" class="img-responsive"></a></h2>
			            	<p>Providing credit cards, group medical insurance, old-age funds, &amp; more financial services. </p>
			                <a class="read-more" href="business-process-outsourcing-matching/">Read more&nbsp;<img src="<?php echo get_template_directory_uri(); ?>/images/spokiyo/icon-read-more.jpg"></a>
			            </div>
		            </div>
	            </div>
        	</div>
        	<!-- END: Added html block -->
		<!-- </div> --><!-- .widget-area -->
	</div><!-- #secondary -->
<?php endif; ?>