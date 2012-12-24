<?php
include_once('../config.php');
define('INDEX', true);
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Slickr Administration</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" media="screen" type="text/css" title="Design" href="style.css" />
</head>
	<body>
		<div id="container">
			<div class="header">
				<em>Administration...<em>
			</div>
			<div id="content" class="gray">
				<?php
				if(empty($_SESSION['log']) OR $_SESSION['log'] !== md5(USERNAME . PASSWORD))
				{
					include_once('./pages/login.php');
				}
				else
				{
	
					if($_GET['a'] == 'save')
					{
					?>
					<div class="update">
					<?php
						include_once('./pages/trt.php');
					?>
					</div>
					<?php
					}
		
					include_once('./pages/admin.php');
				}
				?>
			</div>
		</div>
	</body>
</html>
