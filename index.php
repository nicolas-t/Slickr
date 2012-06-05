<?php 

include('lib/core.class.php');
include('lib/slickr.class.php');
include('lib/cache.class.php');
@include('config.php');
if(!defined('USER')){header('Location: admin/install.php');}
$slickr = new Slickr(USER);
$cache = new Cache($_SERVER['REQUEST_URI']);
$cache->getCache();

if(!empty($_GET['id'])){// on affiche les photos
	list($images, $parent) = $slickr->getPhotos();
	@include('templates/'.TEMPLATE.'/images.php');
}
elseif(!empty($_GET['c_id'])){// on affiche des photosets
	list($collecSets, $sets, $parent) = $slickr->getPhotosets();
	@include('templates/'.TEMPLATE.'/collecphotosets.php');
}
elseif(!empty($_GET['b_id'])){// on affiche des collections dans des collections
	list($collections, $parent) = $slickr->getCollections();
	$collections = $collections[$slickr->getBid()]['collection'];
	@include('templates/'.TEMPLATE.'/collections.php');
}
else{ // page par defaut
	if(HOMEPAGE == 'collections'){
	//(collections)
		list($collections, $parent) = $slickr->getCollections();
		$parent = array('title'=> 'Collections');
		@include('templates/'.TEMPLATE.'/collections.php');
	}
	elseif(HOMEPAGE == 'photosets'){
	//(photosets)
		list($collecSets, $sets) = $slickr->getPhotosets();
		@include('templates/'.TEMPLATE.'/photosets.php');
	}
	else{
	//(dernieres photos)
		list($images, $parent) = $slickr->getLatestPhotos();
		@include('templates/'.TEMPLATE.'/images.php');
	}
}

$cache->saveCache(ob_get_contents());
?>