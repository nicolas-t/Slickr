<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Collections</title>
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
		<div id="collecs">
		<?php
			foreach( $collections as $collection)
			{
				if(!in_array($collection['id'],$collecBlackList))
				{	
					if(!empty($collection['collection'])){// collections in collection
						$linkVarName = 'b_id';
					}
					else{
						$linkVarName = 'c_id';
					}
				?>
				<div class="collec">
					<a href="<?php echo $slickr->link($linkVarName, $collection['id'], 1); ?>">
					<img src="<?php echo $collection['iconlarge']; ?>" alt="<?php echo $collection['title']; ?>"/></a>
					<a href="<?php echo $slickr->link($linkVarName, $collection['id'], 1); ?>" class="sub tiquette"><?php echo $collection['title']; ?></a>
				</div>
				<?php
				}
			}
			?>
			<br />
			</div>
		<div class="clear"></div>
		<?php include_once('templates/'.stripslashes(TEMPLATE).'/footer.php');?>
	</div>
</body>
</html>