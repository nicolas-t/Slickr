<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<head>
		<title><?php echo stripslashes(NAME); ?> Portfolio - <?php echo $slickr->collecSet['collections']['collection'][0]['title']; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="description" content="<?php echo stripslashes(DESC); ?>" />
		<link rel="stylesheet" href="templates/<?php echo stripslashes(TEMPLATE); ?>/style.css" type="text/css"/>
</head>
<body>
	<div id="header">
		<div id="content">
			<a href="index.php"><?php echo stripslashes(NAME) .'  <span class="sub">&raquo; '.$parent['title']; ?></a></span>
		</div>
	</div>
	<div id="container">
	<?php
	if(!empty($slickr->collecSet['collections']['collection'][0]['description']) AND SHOW_PHOTOSET_DESCRIPTION)
	{
		echo '<p class="left">' . $slickr->collecSet['collections']['collection'][0]['description'] . '</p>';
	}
	foreach( $collecSets as $collecSet)
	{ 
	
		if(!in_array($collecSet['id'],$setBlackList))// un set privée renvoie un array vide. AND !empty($sets[(string)$collecSet['id']])
		{
		?>
		<div class="set">
			<a href="<?php echo $slickr->link('id', $collecSet['id'], 1); ?>">
				<img src="<?php echo $slickr->createUrl($sets[(string)$collecSet['id']], '_s'); ?>" alt="<?php echo $collecSet['title']; ?>" title="<?php echo $collecSet['title']; ?>"/>
			</a><br />
			<span class="titre"><?php echo $collecSet['title']; ?></span><br />
			(<?php echo $sets[(string)$collecSet['id']]['photos']; ?> photos)
		</div>
		<?php
		}
	}
	?>
		<div class="clear"></div>
		<?php include_once('templates/'.stripslashes(TEMPLATE).'/footer.php');?>
	</div>
</body>
</html>