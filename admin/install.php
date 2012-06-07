<?php
function getFeed($methode,$params)
{
	foreach($params as $b=>$c){$d.='&'.$b.'='.$c;}
	$rsp = file_get_contents('http://api.flickr.com/services/rest/?method=flickr.'.$methode.'&api_key=802be55ee2af5512f2b3e7962acc45f5'.$d.'&format=php_serial');
	$b = unserialize($rsp);
	return $b;
}
function getInfos($input)
{
	if(strpos($input,'.')){
		$r = getFeed('people.findByEmail',array('find_email'=>$input));
		return array('stat' => $r['stat'], 'nsid' => $r['user']['nsid'], 'username' => $r['user']['username']['_content']);
	}
	else{
		$r = getFeed('people.getInfo',array('user_id'=>$input));
		return array('stat' => $r['stat'],'nsid' => $r['person']['nsid'], 'username' => $r['person']['username']['_content'], 'realname' => '('.$r['person']['realname']['_content'].')');
	}
}
$get = array_map('htmlspecialchars',$_GET);
$post = array_map('htmlspecialchars',$_POST);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Slickr Installation</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" media="screen" type="text/css" title="Design" href="style.css" />
	</head>
	<body>
		<div id="container">
			<div class="header">
				<em>Install...<em>
			</div>
			<div id="content">
				<?php 
				
					if(!empty($post['nsid']) AND $get['a'] == 'nsid')
					{
						$info = getInfos($post['nsid']);
						if($info['stat'] == 'ok' ){
		
								echo '<span class="gray" style="float:left;">&nbsp;Are you <span class="blue">&nbsp;'. $info['username'].$info['realname'] .'</span> ?</span>
									<form action="install.php?a=passW" method="post">
										<input class="input" type="hidden" name="nsid" value="'.$info['nsid'].'"/>
										<input class="input" type="hidden" name="name" value="'.$info['username'].'"/>
										<input type="submit" class="submit"  style="padding:8px;position:relative;top:-10px;" value="Yes &raquo;"/>
									</form>
									<a class="submit no" href="install.php" style="position:relative;top:-10px;font-style:normal;width:35px;" />&laquo;No</a>';
						}
						else{
							echo '<form action="install.php?a=nsid" method="post">
											<label class="blue">&nbsp;Enter your Flickr Email or NSID :
											<input class="input" type="text" name="nsid"/></label>
											<input type="submit" class="submit"  style="position:relative;top:-10px;" value ="Next &raquo;"/>
											<span class="gray">&nbsp;You don\'t know how to find it ?</span><a href="http://idgettr.com/" target="_blank" class="blue">&nbsp;Try this</a>
										</form>';
							}
					}
					elseif($get['a'] == 'passW')
					{
						echo
						'<form action="install.php?a=true" method="post">
							<label class="blue">&nbsp;Username :
							<input class="input" type="text" name="username"/></label>
							<label class="blue">&nbsp;Password :
							<input class="input" type="password" name="password"/></label>
							<input class="input" type="hidden" name="nsid" value="'.$post['nsid'].'"/></label>
							<input class="input" type="hidden" name="name" value="'.$post['name'].'"/></label>
							<div style="width:340px;" class="gray">&nbsp;These informations will be required to connect to the administration page</div>
							<input type="submit" class="submit"  style="position:relative;top:-35px;" value ="Next &raquo;"/>
						</form>	';
					}
					elseif($get['a'] == 'true')
					{
						if(!empty($post['password']) AND !empty($post['username'])){
							$settings = array('password' => md5($post['password']), 'username' => $post['username'], 'user' => $post['nsid'], 'name' => $post['name'], 'homepage' => 'latest', 'images_per_page' => 24, 'thumbs_size' => '_s', 'description' => $post['name'] . '\'s online portfolio - (slickr.net)');
							include('../lib/admin.class.php');
							$admin = new Admin($settings);
							$admin->writeConf($admin->createConf());
							 if(!@unlink('install.php')){
								 $mess='<span class="blue" style="font-size:25px;">Don\'t forget to delete admin/install.php before contunuing.</span><br /><br />';
							 }
							echo $mess.'<span class="gray">YAY !<br />
										your configuration file is <span class="blue">config.php</span>.<br /> If you forget your password add your new password (md5 hash) in this file.<br />
										You can modify your preferences at this page <a href="./index.php" class="blue">/admin</a><br /><br />
										<span style="font-size:25px;">Continue to your <a href="../index.php">portfolio</a>.</span>
										</span>';
						}
						else{
						
						}
					}
					else
					{
						echo '<form action="install.php?a=nsid" method="post">
											<label class="blue">&nbsp;Enter your Flickr Email or NSID :
											<input class="input" type="text" name="nsid"/></label>
											<input type="submit" class="submit" style="position:relative;top:-10px;" value ="Next &raquo;"/>
											<span class="gray">&nbsp;You don\'t know how to find it ?</span><a href="http://idgettr.com/" target="_blank" class="blue">&nbsp;Try this</a>
										</form>';
					}
				?>
			</div>
		</div>
	</body>
</html>
