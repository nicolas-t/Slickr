<!DOCTYPE html>
<html>
	<head>
		<title><?php echo stripslashes(NAME); ?> Portfolio - Photosets</title>
        <meta charset="utf-8" />
		<meta name="description" content="<?php echo stripslashes(DESC); ?>" />
		<link href="http://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="templates/<?php echo stripslashes(TEMPLATE); ?>/style.css" type="text/css"/>
</head>
<body>
	<header>
		<div id="content">
			<a href="index.php"><?php echo stripslashes(NAME); ?></a>
		</div>
	</header>
	<div id="container">
		<section id="photosets">
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
		</section>
	</div>
	<?php include_once('templates/'.stripslashes(TEMPLATE).'/footer.php');?>
</body>
</html>