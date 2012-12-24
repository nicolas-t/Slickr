<!DOCTYPE html>
<html>
	<head>
		<title><?php echo stripslashes(NAME); ?> Portfolio - Collections</title>
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
		<section id="collecs">
		<?php
			if(count($collections)){
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
			}
			else{
				?>
				<p style="padding-top:15px;padding-bottom:15px;text-align:center;">No collection found.<p>
				<?php
			}
			?>
		<div class="clear"></div>
		</section>
	</div>
	<?php include_once('templates/'.stripslashes(TEMPLATE).'/footer.php');?>
</body>
</html>