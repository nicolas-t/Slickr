<?php
if(!defined('INDEX')){die();}
include('../lib/admin.class.php');
$admin = new Admin(array_map('htmlspecialchars',$_POST));

$admin->manage();
if($admin->writeConf($admin->createConf())){
	echo 'Changes saved. <br /> In most cases it\'s recommended to empty the folder <em>/cache/</em>.';
}
else{
	echo 'An error occured.';
}
?>