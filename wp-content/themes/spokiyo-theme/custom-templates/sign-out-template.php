<?php
/**
 * The template for sign out
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
	Template Name: ConsultantSignOutTemplate
*/
/*
 	Contact = User
 */
?>

<?php 

session_start();

$_SESSION['logged_user'] = null;
unset($_SESSION['logged_user']);
exit;