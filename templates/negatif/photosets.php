<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<head>
		<title><?php echo stripslashes(NAME); ?> - Photosets</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="description" content="<?php echo stripslashes(DESC); ?>" />
		<link rel="stylesheet" href="templates/<?php echo stripslashes(TEMPLATE); ?>/style.css" type="text/css"/>
</head>
<body>
	<div id="header">
		<div id="content">
			<a href="index.php"><?php echo stripslashes(NAME); ?></a>
		</div>
	</div>
	<div id="container">
	<?php
	foreach( $sets as $set)
	{
		if(!in_array($set['id'],$setBlackList))
		{
		?>
		<div class="set">
			<a href="<?php echo $slickr->link('id', $set['id'], 1); ?>">
			<img src="<?php echo $slickr->createUrl($set, '_s'); ?>" alt="<?php echo $set['title']['_content']; ?>" title="<?php echo $set['title']['_content']; ?>"/>
			</a>
			<br /><span class="titre"><?php echo $set['title']['_content']; ?></span>
			<br />(<?php echo $set['photos']; ?> photos)
		</div>
		<?php
		}
	}
	?>
		<div class="clear"></div>
		<br />
		<?php include_once('templates/'.stripslashes(TEMPLATE).'/footer.php');?>
	</div>
</body>
</html>