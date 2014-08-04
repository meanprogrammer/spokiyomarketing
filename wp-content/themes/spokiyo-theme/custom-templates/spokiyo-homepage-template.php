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
 Template Name: SpokiyoHomepageTemplate
 */
?>

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">
		<div class="banner">
			<br />
			<h1 class="home-h1">COMPETITIVE CONSULTING - SOLID EXPERIENCE</h1>
			<p class="home-intro">SPOKIYO has hundreds of consultants in our
				matching system available at short notice and at reasonable rates -
				up to a third of the cost of other consulting companies. Our
				consultants are happier too! Find out more by requesting more
				information below.</p>
			<!-- <div class="button-group">
                <a href="#"><button class="gray-bg rounded" style="margin-right:10px;" type="button" data-toggle="modal" data-target="#videoModal">Watch Video</button></a>
                <a href="#"><button class="default-bg rounded" type="button" data-toggle="modal" data-target="#signupModal">Sign Up Now</button></a>
            </div> -->

			<!-- <div class="row" style="text-align: center; margin: 0 auto;">
           	<div class="col-md-3">
           	</div>
           		<div class="col-md-6">
           			<a class="btn btn-default btn-lg btn-block" id="signuplink">Sign Up For The Spokiyo Newsletter</a>
           		</div>	
           	</div> -->

			<div class="row"
				style="text-align: center; margin: 0 auto; margin-top: 10px;">
				<!--  visible-lg visible-md -->
				<div class="col-md-6 col-md-offset-3">
					<div class="input-group">
						<input id="emailaddresstext" name="emailaddresstext" type="text"
							class="form-control input-lg input-md"
							placeholder="Email Address"> <span class="input-group-btn"> <a
							id="signuplink" class="btn btn-primary btn-lg btn-md">Sign up to
								Newsletter</a> </span>
					</div>
				</div>
				<!-- <div class="col-md-6 col-md-offset-3 visible-sm visible-xs">
					<input id="emailaddresstext2" name="emailaddresstext2" type="text" class="form-control input-lg" placeholder="Email Address" style="width:100% !important;margin: 0 0 10px !important;">
				</div>
				<div class="col-md-6 col-md-offset-3 visible-sm visible-xs">
					<a id="signuplink2" class="btn btn-primary btn-block btn-lg">Sign up to Newsletter</a>
				</div> -->
			</div>
			<div class="row" style="text-align: center; margin: 0 auto;">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 col-md-offset-6" style="margin-top: 10px;">
							<a class="btn btn-spokiyo btn-lg btn-block" id="consultantslink">Consulting
								Proposal</a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-md-offset-6" style="margin-top: 10px;">
							<a class="btn btn-spokiyo btn-lg btn-block" id="bpopartnerlink">BPO
								Proposal</a>
						</div>
					</div>
				</div>
				<div class="col-md-3" style="margin-top: 10px;">
					<a class="btn btn-danger btn-lg btn-block big-button"
						id="consultingopplink">Consultant Registration</a>
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
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6">&nbsp;</div>
						<div class="col-md-6" style="margin-top: 10px;">
							<a class="btn btn-primary btn-lg btn-block" id="loginbutton"
								name="loginbutton" data-toggle="modal">Log In</a>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6" style="margin-top: 10px;">
							<a class="btn btn-primary btn-lg btn-block" id="signupbutton"
								name="signupbutton" data-toggle="modal">Signup</a>
						</div>
						<div class="col-md-6">&nbsp;</div>
					</div>
				</div>
			</div>
			<!-- <div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6">&nbsp;</div>
						<div class="col-md-6" style="margin-top: 10px;">
							<a class="btn btn-default btn-lg btn-block"
								href="<?php echo get_site_url()."/create-account" ?>">Create
								Account</a>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6" style="margin-top: 10px;">
							<a class="btn btn-default btn-lg btn-block"
								href="<?php echo get_site_url()."/create-lead" ?>">Create Lead</a>
						</div>
						<div class="col-md-6">&nbsp;</div>
					</div>
				</div>
			</div> -->
			<div class="row hero-image">
				<!-- <div class="hero-image"> -->
				<img class="img-responsive"
					src="<?php echo get_template_directory_uri(); ?>/images/spokiyo/banner-hero-900x401.png" />
				<!-- </div> -->
			</div>
		</div>
		<!--end of banner-->

		<div class="modal fade" id="consultantsModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true">&times;</button>
						<h4 class="modal-title">Consulting Proposal</h4>
					</div>
					<div class="modal-body">
					<?php echo do_shortcode("[contact-form-7 id=\"55\" title=\"Consulting-Needs-Form\"]")?>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->

		<div class="modal fade" id="bpoPartnerModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true">&times;</button>
						<h4 class="modal-title">BPO Proposal</h4>
					</div>
					<div class="modal-body">
					<?php echo do_shortcode("[contact-form-7 id=\"58\" title=\"BPO-Partner-Form\"]")?>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->

		<div class="modal fade" id="consultingOpportunityModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true">&times;</button>
						<h4 class="modal-title">Looking For Consulting Opportunities</h4>
					</div>
					<div class="modal-body">
					<?php echo do_shortcode("[contact-form-7 id=\"60\" title=\"Consulting-Opportunity-Form\"]")?>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->

		<div class="modal fade" id="subscribeModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true">&times;</button>
						<h4 class="modal-title">Sign Up for Newsletter</h4>
					</div>
					<div class="modal-body">
					<?php echo do_shortcode("[show-mailchimp-form formkey=\"MjcxMmMwMTEzZjk,\" version=\"inline\"]")?>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->

		<div class="modal prevent-vscroll" id="videoModal">
			<div class="modal-dialog" style="padding-top: 80px;">
				<div class="modal-body">
					<button type="button"
						style="position: relative; top: -20px; right: 60px;" class="close"
						data-dismiss="modal" aria-hidden="true">&times;</button>
					<iframe width="420" height="315"
						src="http://www.youtube.com/embed/y9LlnLTH87U" frameborder="0"
						allowfullscreen></iframe>
				</div>
			</div>
			<!-- /.modal-dialog -->
		</div>
	</div>
	<!-- #content -->
</div>
<!-- #primary -->


<div class="modal" id="signupModal">
	<div class="modal-dialog"
		style="display: block; height: 500px; width: 900px;">
		<div class="modal-body">
			<button type="button" class="close" data-dismiss="modal"
				aria-hidden="true">&times;</button>
			<!--<a href="quicktour.html"><img class="img-responsive" src="images/register.jpg"/></a>-->
			<div class="modal-content"
				style="background: #f6f6f6; border-radius: 0; padding: 20px;">
				<div class="row">
					<div class="col-md-6">
						<h2 style="margin-top: 0px !important;">Join Spokiyo</h2>
					</div>
					<div class="col-md-6">
						<img class="right clear"
							src="<?php echo get_template_directory_uri(); ?>/images/spokiyo/logo-sm.png" />
					</div>
				</div>
				<div class="modal-body clearfix modal-body-override">
					<form name="register-consultant-form" id="register-consultant-form"
						method="POST" action="consultant-page">
						<div class="row">
							<div class="col-md-4">
								<img class="left"
									src="<?php echo get_template_directory_uri(); ?>/images/spokiyo/login-btns.png" />
							</div>
							<div class="col-md-8 vertical-divider">
								<div class="row">
									<div class="col-md-6 form-group">
										<label for="firstname" class="control-label">First Name</label>
										<input name="firstname" id="firstname" type="text"
											class="form-control input-sm full-width input-margin-override" />
									</div>
									<div class="col-md-6 form-group">
										<label for="lastname" class="control-label">Last Name</label>
										<input name="lastname" id="lastname" type="text"
											class="form-control input-sm full-width input-margin-override" />
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 form-group">
										<label for="username" class="control-label">Username</label> <input
											name="username" id="username" type="text"
											class="form-control input-sm full-width input-margin-override" />
									</div>
									<div class="col-md-6 form-group">
										<label for="email" class="control-label">Email</label> <input
											name="email" id="email" type="text"
											class="form-control input-sm full-width input-margin-override" />
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 form-group">
										<label for="password" class="control-label">Password</label> <input
											name="password" id="password" type="password"
											class="form-control input-sm full-width input-margin-override" />
									</div>
									<div class="col-md-6 form-group">
										<label for="retypepassword" class="control-label">Re-type
											Password</label> <input name="retypepassword"
											id="retypepassword" type="password"
											class="form-control input-sm full-width input-margin-override" />
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 form-group">
										<label for="captcha" class="control-label">Enter Captcha</label>
										<input name="captcha" id="captcha" type="text"
											class="form-control input-sm input-margin-override" autocomplete="off" style="display: inline-block;" />
											<img id="captchaimage" alt="" src="<?php echo get_template_directory_uri();?>/codes/captcha.php" />
									</div>
									
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8 form-group">
								<input id="iagree" name="iagree" type="checkbox"
									class="agree-checkbox" /> By checking the box and clicking
								"Join", I understand that I am joining Spokiyo, and I have read
								and accepted the <a href="#">Terms of Use Agreement</a> and
								consent to the <a href="#">Privacy Policy</a>.
							</div>
							<div class="col-md-4" style="text-align: right;">
								<button type="button" value="Login" id="joinbutton"
									class="btn btn-primary btn-lg">JOIN</button>
								<button type="button" value="Cancel" data-dismiss="modal"
									class="btn btn-default btn-lg">CANCEL</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- /.modal-dialog -->
</div>

<div class="modal" id="loginModal">
	<div class="modal-dialog"
		style="display: block; height: 500px; width: 750px;">
		<div class="modal-body">
			<button type="button" class="close" data-dismiss="modal"
				aria-hidden="true">&times;</button>
			<!--<a href="quicktour.html"><img class="img-responsive" src="images/register.jpg"/></a>-->
			<div class="modal-content"
				style="background: #f6f6f6; border-radius: 0; padding: 20px;">
				<div class="row">
					<div class="col-md-6">
						<h2 style="margin-top: 0px !important;">Login</h2>
					</div>
					<div class="col-md-6">
						<img class="right clear"
							src="<?php echo get_template_directory_uri(); ?>/images/spokiyo/logo-sm.png" />
					</div>
				</div>
				<div class="modal-body clearfix modal-body-override">
					<div class="row">
						<div class="col-md-5">
							<img class="left"
								src="<?php echo get_template_directory_uri(); ?>/images/spokiyo/login-btns.png" />
						</div>
						<div class="col-md-7 vertical-divider">
							<form name="register-consultant-form"
								id="register-consultant-form" method="POST"
								action="consultant-page">
								<div class="row">
									<div class="col-md-12 form-group">
										<label for="loginusername" class="control-label">Username</label>
										<input name="loginusername" id="loginusername"
											class="form-control input-sm full-width input-margin-override" type="text" />
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 form-group">
										<label for="loginpassword" class="control-label">Password</label>
										<input name="loginpassword" id="loginpassword"
											class="form-control input-sm full-width input-margin-override" type="password" />
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<a id="consultantloginbutton" name="consultantloginbutton"
											class="btn btn-primary btn-lg">Login</a> <a
											class="btn btn-default btn-lg" data-dismiss="modal">Cancel</a>
									</div>
								</div>
							</form>
						</div>

					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- /.modal-dialog -->
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/homepage.js"></script>
