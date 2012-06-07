<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title><?php echo stripslashes(NAME); ?> Portfolio - <?php echo $slickr->setInfo['photoset']['title']['_content']; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="description" content="<?php echo stripslashes(DESC); ?>" />
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery.chocolat.js"></script></head>
		<link rel="stylesheet" href="templates/<?php echo stripslashes(TEMPLATE); ?>/style.css" type="text/css"/>
		<link rel="stylesheet" href="css/chocolat.css" type="text/css" media="screen"  charset="utf-8" />
	</head>
<body>
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
			$(function() {
				$('.choco').Chocolat({
);
			});
			$(document).ready(function(){
			$(function() {
				$('.choco a').Chocolat({
				user : '<?php echo USER; ?>',
				overlayColor: '#000',
				overlayOpacity: 0.7,
				leftImg : 'images/leftw.gif',
				rightImg : 'images/rightw.gif',
				closeImg: 'images/closew.gif'}
				});
			});
		});
		});
	</script>
	<?php
	if(THUMBS_SIZE== ''){
		$thumbClass = '_n'; 
	}
	else{
		$thumbClass = THUMBS_SIZE; 
	}
	?>
	<div id="header">
		<div id="content">
			<a href="index.php"><?php echo stripslashes(NAME); ?></a>
			<span class="sub">&raquo; <?php echo $parent['title']; ?> </span>
		</div>
	</div>
	<div id="container">
	<?php 
		if(!empty($parent['description']) AND $slickr->getP() == 1 AND SHOW_PHOTOSET_DESCRIPTION)
		{
		?>
			<p class="left"><?php echo $parent['description']; ?></p>
		<?php
		}
		?>
		<div class="choco" title="<?php echo $parent['title']; ?>">
			<?php
			foreach($images as $image)
			{
			?>
				<a rel="<?php echo $parent['title']; ?>" href="<?php echo $slickr->createUrl($image, '_c'); ?>" class="<?php echo $thumbClass; ?>" rev="<?php echo $image['id']; ?>" title="<?php echo $image['title']; ?>"><!-- image' size : _z; _c; _b; _biggest; (_biggest : deprecated) or leave empty more infos http://www.flickr.com/services/api/misc.urls.html -->
					 <img src="<?php echo $slickr->createUrl($image, THUMBS_SIZE); ?>" alt="<?php echo $image['title']; ?>" /> 
				</a>
			<?php
			}
			?>
		</div>
		<br />
		<div id="back" class="sub" style="margin-top:2px;margin-left:15px;float:left;"><a href="index.php">Home</a></div>
		<div id="pages">
			<?php echo $slickr->getPages(); ?>
		</div>
		<br />
		<?php include_once('templates/'.stripslashes(TEMPLATE).'/footer.php');?>
	</div>
</body>
</html>