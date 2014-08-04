<?php 
$fullpath = get_template_directory()."/codes/zohocontact.php";
include $fullpath;

$zc = new zohocontact();

$type = $_POST['updatetype'];
switch ($type) {
	case 'bio':
		 $id = $_POST['id'];
		 $bio = $_POST['bio'];
		 $zc->updateUserAccountBio($id, $bio);
	break;
}
