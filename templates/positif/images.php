<!DOCTYPE html>
<html>
	<head>
		<title><?php echo stripslashes(NAME); ?> Portfolio - <?php echo $slickr->setInfo['photoset']['title']['_content']; ?></title>
        <meta charset="utf-8" />
		<meta name="description" content="<?php echo stripslashes(DESC); ?>" />
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery.chocolat.js"></script></head>
		<link href="http://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="templates/<?php echo stripslashes(TEMPLATE); ?>/style.css" type="text/css"/>
		<link rel="stylesheet" href="css/chocolat.css" type="text/css" media="screen"  charset="utf-8" />
	</head>
<body>
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
			$('.choco a').Chocolat({user : '<?php echo USER; ?>'});
		});
	</script>
	<header>
		<div id="content">
			<a href="index.php"><?php echo stripslashes(NAME); ?></a>
			<span class="sub">&raquo; <?php echo $parent['title']; ?> </span>
		</div>
	</header>
	<div id="container">
		<?php 
		if(!empty($parent['description']) AND $slickr->getP() == 1 AND SHOW_PHOTOSET_DESCRIPTION)
		{
		?>
			<section class="photoset-desc"><?php echo $parent['description']; ?></section>
		<?php
		}
		?>
		<section style="text-align:center;">
			<div class="choco" >
				<?php
				foreach($images as $image)
				{
				?>
					<a rel="<?php echo $parent['title']; ?>" href="<?php echo $slickr->createUrl($image, '_l'); ?>" class="<?php echo THUMBS_SIZE; ?>" rev="<?php echo $image['id']; ?>" title="<?php echo $image['title']; ?>">
						 <img src="<?php echo $cache->getImage($slickr->createUrl($image, THUMBS_SIZE)); ?>" alt="<?php echo $image['title']; ?>" /> 
					</a>
				<?php
				}
				?>
			</div><br />
			<div id="back" class="sub" style="margin-top:2px;margin-left:15px;float:left;"><a href="index.php">Home</a></div>
			<div id="pages">
				<?php echo $slickr->getPages(); ?>
			</div><br />
		</section>
	</div>
	<?php include_once('templates/'.stripslashes(TEMPLATE).'/footer.php');?>
</body>
</html>