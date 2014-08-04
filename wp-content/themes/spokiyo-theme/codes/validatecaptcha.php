<?php
session_start();
if(
	isset($_POST["captcha"]) && $_POST["captcha"] != "" &&
	$_SESSION["captcha_code"] == $_POST["captcha"])
{
	echo  '1';
}
else
{
	echo '-1';
}
unset($_SESSION["captcha_code"]);