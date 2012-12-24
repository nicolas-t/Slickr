<!DOCTYPE html>
<html>
	<head>
		<title><?php echo stripslashes(NAME); ?> Portfolio - <?php echo $slickr->collecSet['collections']['collection'][0]['title']; ?></title>
        <meta charset="utf-8" />
		<meta name="description" content="<?php echo stripslashes(DESC); ?>" />
		<link href="http://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="templates/<?php echo stripslashes(TEMPLATE); ?>/style.css" type="text/css"/>
</head>
<body>
	<header>
		<div id="content">
			<a href="index.php"><?php echo stripslashes(NAME) .'  <span class="sub">&raquo; '.$parent['title']; ?></a></span>
		</div>
	</header>
	<div id="container">

	<?php
	if(!empty($slickr->collecSet['collections']['collection'][0]['description']) AND SHOW_PHOTOSET_DESCRIPTION)
	{
	?>
		<section class="photoset-desc"><?php echo ' . $slickr->collecSet['collections']['collection'][0]['description'] . '; ?></section>
	<?php
	}
	?>
		<section id="photosets">
		<?php
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
		</section>
	</div>
	<?php include_once('templates/'.stripslashes(TEMPLATE).'/footer.php');?>
</body>
</html>