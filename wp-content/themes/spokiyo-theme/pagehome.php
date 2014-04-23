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
		<div id="content" class="site-content container" role="main">
		        <div class="banner">
		        <br />
            <h1 class="home-h1">Work-Life Balanced</h1>
            <p class="home-intro">We assist in improving the quality of life of highly skilled individuals and the quality of work for clients by providing them an innovative platform that is easy to use</p>
            <!-- <div class="button-group">
                <a href="#"><button class="gray-bg rounded" style="margin-right:10px;" type="button" data-toggle="modal" data-target="#videoModal">Watch Video</button></a>
                <a href="#"><button class="default-bg rounded" type="button" data-toggle="modal" data-target="#signupModal">Sign Up Now</button></a>
            </div> -->

           	<div class="row" style="text-align: center; margin: 0 auto;">
           	<div class="col-md-3">
           	</div>
           		<div class="col-md-6">
           			<a class="btn btn-default btn-lg btn-block" id="signuplink">Sign Up For Newsletter</a>
           		</div>	
           	</div>
		    <div class="row" style="text-align: center; margin: 0 auto;">
		    	<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 col-md-offset-6" style="margin-top:10px;">
							<a class="btn btn-spokiyo btn-lg btn-block" id="consultantslink">Need Consultants</a>
						</div>
					</div>		    
					<div class="row">
						<div class="col-md-6 col-md-offset-6" style="margin-top:10px;">
							<a class="btn btn-spokiyo btn-lg btn-block" id="bpopartnerlink">Need BPO Partner</a>
						</div>
					</div>			
		    	</div>
		    	<div class="col-md-3" style="margin-top:10px;">
		    		<a class="btn btn-danger btn-lg btn-block big-button" id="consultingopplink">Consultant Registration</a>
		    	</div>
		    	 <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					  	<a class="btn btn-default btn-lg" id="consultantslink">Consultants</a>
						<a class="btn btn-default btn-lg" id="bpopartnerlink">BPO Partner</a>
						<a class="btn btn-default btn-lg" id="consultingopplink">Consulting Opportunities</a> -->
						<!--  <img class="img-responsive img-inline" src="<?php echo get_template_directory_uri(); ?>/images/spokiyo/vert-line.png" /> -->
						<!--  <a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#signupModal">Sign Up For Newsletter</a>-->
						<!-- <a class="btn btn-primary btn-lg" id="signuplink">Sign Up For Newsletter</a>
				</div> 		 -->
			</div>
			<div class="row hero-image">
	            <!-- <div class="hero-image"> -->
	                <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/spokiyo/banner-hero.png" />
	            <!-- </div> -->
            </div>
        </div><!--end of banner-->

<div class="modal fade" id="consultantsModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Looking For Consultants</h4>
      </div>
      <div class="modal-body">
        <?php echo do_shortcode("[contact-form-7 id=\"55\" title=\"Consulting-Needs-Form\"]")?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="bpoPartnerModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Looking For BPO Partner</h4>
      </div>
      <div class="modal-body">
        <?php echo do_shortcode("[contact-form-7 id=\"58\" title=\"BPO-Partner-Form\"]")?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="consultingOpportunityModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Looking For Consulting Opportunities</h4>
      </div>
      <div class="modal-body">
        <?php echo do_shortcode("[contact-form-7 id=\"60\" title=\"Consulting-Opportunity-Form\"]")?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
		
		<div class="modal fade" id="subscribeModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Sign Up for Newsletter</h4>
      </div>
      <div class="modal-body">
        <?php echo do_shortcode("[show-mailchimp-form formkey=\"MjcxMmMwMTEzZjk,\" version=\"inline\"]")?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
		
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
<script type="text/javascript">
<!--
	function hello(){
		alert("hello dude");
	}

	$(document).ready(function(){
		$('#consultingopplink').click(function() {
			$('html').css('overflow-y', 'hidden');
			$('html').css('margin-right', '15px');
			$('#consultingOpportunityModal').modal({keyboard:false});
		});

		$('#consultingOpportunityModal').on('hidden.bs.modal', function (e) {
			$('html').css('margin-right', '0');
			$('html').css('overflow-y', 'auto');
			
		});

		$('#consultantslink').click(function(){
			$('html').css('overflow-y', 'hidden');
			$('html').css('margin-right', '15px');
			$('#consultantsModal').modal({keyboard:false});
		});

		$('#consultantsModal').on('hidden.bs.modal', function (e) {
			$('html').css('margin-right', '0');
			$('html').css('overflow-y', 'auto');
			
		});

		$('#bpopartnerlink').click(function(){
			$('html').css('overflow-y', 'hidden');
			$('html').css('margin-right', '15px');
			$('#bpoPartnerModal').modal({keyboard:false});
		});

		$('#bpoPartnerModal').on('hidden.bs.modal', function (e) {
			$('html').css('margin-right', '0');
			$('html').css('overflow-y', 'auto');
			
		});


		$('#signuplink').click(function(){
			$('html').css('overflow-y', 'hidden');
			$('html').css('margin-right', '15px');
			$('#subscribeModal').modal({keyboard:false});
		});

		$('#subscribeModal').on('hidden.bs.modal', function (e) {
			$('html').css('margin-right', '0');
			$('html').css('overflow-y', 'auto');
			
		});
	});
//-->
</script>
<?php get_sidebar(); ?>
<?php get_footer(); ?>