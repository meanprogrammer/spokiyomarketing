<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Spokiyo_Theme
 * @since January 2014
 */

get_header(); ?>


<?php
/*
	Template Name: HomeTemplate
*/
?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		        <div class="banner">
		        <br />
            <h1 class="home-h1">Work-Life Balanced</h1>
            <p class="home-intro">We assist in improving the quality of life of highly skilled individuals and the quality of work for clients by providing them an innovative platform that is easy to use</p>
            <!-- <div class="button-group">
                <a href="#"><button class="gray-bg rounded" style="margin-right:10px;" type="button" data-toggle="modal" data-target="#videoModal">Watch Video</button></a>
                <a href="#"><button class="default-bg rounded" type="button" data-toggle="modal" data-target="#signupModal">Sign Up Now</button></a>
            </div> -->
            <div class="home-button-container">
		            <h3>Looking for</h3>
		           <!-- <div class="btn-group"> --> 
					  <a class="btn btn-default btn-lg">Consultants</a>
					  <a class="btn btn-default btn-lg">BPO Partner</a>
					  <a class="btn btn-default btn-lg">Consulting Opportunity</a>
				<!-- 	</div> -->
				<a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#signupModal">Sign Up For Newsletter</a>
			</div>
            <div class="hero-image">
                <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/spokiyo/banner-hero.png" />
            </div>
        </div><!--end of banner-->

		
		<div class="modal prevent-vscroll" id="videoModal">
          <div class="modal-dialog" style="padding-top:80px;">
              <div class="modal-body">
                <button type="button" style="position:relative; top:-20px; right:60px;" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <iframe width="420" height="315" src="http://www.youtube.com/embed/y9LlnLTH87U" frameborder="0" allowfullscreen></iframe>
              </div>
          </div><!-- /.modal-dialog -->
        </div>
     </div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>