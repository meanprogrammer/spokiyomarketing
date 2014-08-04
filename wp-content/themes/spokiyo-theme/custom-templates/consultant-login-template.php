<?php
/**
 * The template for logging in as zoho
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
	Template Name: ConsultantLoginTemplate
*/
?>
<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">
		<br />
		<div class="container">
			<form action="<?php echo get_site_url(); ?>/login-handler/" method="post">
				<div class="panel panel-default" style="width:400px;margin:0 auto;">
					  <div class="panel-heading">Login</div>
					  <div class="panel-body">
					    	<div class="row">
					    		<div class="col-md-12 form-group">
					    			<label for="username">Username</label>
					    			<input type="text" id="username" name="username" class="form-control input-lg full-width" />
					    		</div>
					    	</div>
					    	<div class="row">
					    		<div class="col-md-12 form-group">
					    			<label for="password">Password</label>
					    			<input type="password" id="password" name="password" class="form-control input-lg full-width" />
					    		</div>
					    	</div>
					    	<div class="row">
					    		<div class="col-md-12" style="text-align:right;">
					    			<input type="submit" class="btn btn-primary btn-lg" value="Login" />
					    			<!-- <a class="btn btn-primary btn-lg" id="dologin" name="dologin" >Login</a> -->
					    		</div>
					    	</div>
					  </div>
				</div>
			</form>
		</div>
	</div>
</div>