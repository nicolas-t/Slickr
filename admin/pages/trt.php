<?php
if(!defined('INDEX')){die();}
include('../lib/admin.class.php');
$admin = new Admin(array_map('htmlspecialchars',$_POST));

$admin->manage();
if($admin->writeConf($admin->createConf())){
	echo 'Changes saved. <a href="../index.php">Go back</a><br /> In most cases it\'s recommended to empty the folder <span class="blue">/cache/</span>.';
}
?>