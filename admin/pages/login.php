<?php
if(!defined('INDEX')){die();}
$errorMessage = '';

if(!empty($_POST['username']) && !empty($_POST['password']))
{
	// Sont-ils les mêmes que les constantes ?
	if($_POST['username'] !== USERNAME)
	{
		$errorMessage = 'Incorrect username';
	}
	elseif(md5($_POST['password']) !== PASSWORD)
	{
		$errorMessage = 'Incorrect password';
	}
	else
	{		
		$_SESSION['log'] = md5(USERNAME . PASSWORD);
		include_once('./pages/admin.php');
		exit();
	}
}

?>
<form action="index.php" method="post">
		<?php
			if(!empty($errorMessage))
			{
				echo '<p>', htmlspecialchars($errorMessage) ,'</p>';
			}
		?>
		<p>
			<div class="label">Username :</div>
			<input type="text" name="username" class="inputpetit" value="" />
		</p>
		<p>
			<div class="label">Password :</div>
			<input type="hidden" name="act" value="login" />
			<input type="password" name="password" class="inputpetit" id="password" value="" />
			<input type="submit" name="submit" class="submit" value="Log in" style="margin-top:-32px;"/>
		</p>
</form>
