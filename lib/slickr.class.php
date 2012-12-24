<?php
class Slickr extends Core
{
	public function getPhotos(){
		$this->getFeed('img','photosets.getPhotos',array('photoset_id' => $this->id, 'extras' => 'url_sq,url_t,url_s,url_q,url_m,url_n,url_z,url_c,url_l,url_o', 'per_page' => IMAGES_PER_PAGE, 'page' => $this->p));
			$images = $this->parse($this->img['photoset']['photo']);
		
		$this->getFeed('setInfo','photosets.getInfo',array('photoset_id' => $this->id));
			$setInfo = $this->parse($this->setInfo);
			$parent = array('title'=>$setInfo[$this->id]['title']['_content'], 'description'=>$setInfo[$this->id]['description']['_content']);
		return array($images, $parent);
	}
	public function getLatestPhotos(){
		$this->getFeed('img','people.getPublicPhotos',array('user_id' => $this->user, 'extras' => 'url_sq,url_t,url_s,url_q,url_m,url_n,url_z,url_c,url_l,url_o', 'per_page' => IMAGES_PER_PAGE, 'page' => $this->p));
			$images = $this->parse($this->img['photos']['photo']);
			$parent = array('title'=>'Latest Images', 'description'=>'');
		return array($images, $parent);
	}
	public function getPhotosets(){
		if(!empty($this->c_id)){// ces trois instruction ne sont pas necessaire dans photoset homepage.
			$this->getFeed('collecSet', 'collections.getTree',array('collection_id' => $this->c_id, 'user_id' => $this->user));
				$c = $this->parse($this->collecSet['collections']['collection']);
				$collecSets = $c[$this->c_id]['set'];
				$parent = array('title' => $c[$this->c_id]['title']);
		}
		$this->getFeed('set', 'photosets.getList',array('user_id' => $this->user));
			$sets = $this->parse($this->set['photosets']['photoset']);
		return array($collecSets, $sets, $parent);
	}
	public function getCollections(){
		$this->getFeed('collec','collections.getTree',array('user_id' => $this->user, 'collection_id' => $this->b_id));
			$collections = $this->parse($this->collec['collections']['collection']);
			$parent = array('title'=>$collections[$this->b_id]['title'],'description'=>$collections[$this->b_id]['description']);
		return array($collections,$parent);
	}
}
