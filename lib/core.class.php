<?php
class Core
{
	protected $id;
	protected $c_id;
	protected $b_id;
	protected $p = 0;
	public function __construct($user)
	{
		$this->user = $user;
		if(!empty($_GET['c_id']) AND is_numeric(str_replace('-','',$_GET['c_id'])))
		{
			$this->c_id = $_GET['c_id'];
		}
		if(!empty($_GET['id']) AND is_numeric(str_replace('-','',$_GET['id'])))
		{
			$this->id = $_GET['id'];
		}
		if(!empty($_GET['b_id']) AND is_numeric(str_replace('-','',$_GET['b_id'])))
		{
			$this->b_id = $_GET['b_id'];
		}
		if(!empty($_GET['p']) AND is_numeric($_GET['p']))
		{
			$this->p = $_GET['p'];
		}
	}

	protected function result($rsp)
	{
		if($rsp == 'fail'){return false;}
		else{return true;}
	}
	protected function getFeed($varName,$methode,$params)
	{
		foreach($params as $b=>$c){$d.='&'.$b.'='.$c;}
		$rsp = file_get_contents('http://api.flickr.com/services/rest/?method=flickr.'.$methode.'&api_key=802be55ee2af5512f2b3e7962acc45f5'.$d.'&format=php_serial');
		$this->$varName = unserialize($rsp);
		if(count($this->{$varName}, COUNT_RECURSIVE) <= 2)//this sucks...
		{
			//echo 'nothing found';
			return false;
		}
		else
		{
			if(!$this->result($this->{$varName}['stat'])){
				//echo 'nothing found';
			}
			return $this->result($this->{$varName}['stat']);
		}
	}
	protected function parse($a){
		$z = array();
		if($a){
			foreach ($a as $entry) {
				$id = (string)$entry['id'];
				$z[$id]['id'] = $id ;
				$z[$id]['primary'] = $id ;
				$z[$id] = $entry;
			}
		}
		return $z;
	}
	public function createUrl($image,$size)
	{
		$sizes = array('url_sq','url_t','url_s','url_q','url_m','url_n','url_z','url_c','url_l','url_o');
		$sizes = array_reverse($sizes);
		$k = array_search('url'.$size, $sizes);
		for ($i = $k; $i<count($sizes); $i++){
			if(isset($image[$sizes[$i]])){
				return $image[$sizes[$i]];
			}
		}
	}
	public function getPages()
	{
		$r = '';
		if(empty($this->id)){// last images
			$type='photos';
		}
		else{ // images in a set
			$type='photoset';
		}
		$page = (int)$this->img[$type]['page'];
		if($this->img[$type]['pages'] > 1)
		{
			if( $page!= 1){
				$p = $page-1;
				$r .='<a href="'.$this->link('id', $this->img[$type]['id'],$p).'" class="sub"> &laquo; previous </a>';
			}
			if($page !== (int)$this->img[$type]['pages']){
				$p = $page+1;
				$r .= '<a href="'.$this->link('id', $this->img[$type]['id'],$p).'" class="sub"> next &raquo; </a>';
			}
		}
		return $r;
	}
	public function link($type, $id, $pageN = 1)
	{
		$rules = array('c_id'=>'sets','b_id'=>'collections','id'=>'photos', ''=>'photos');
		if(URL_REWRITING){
			if(empty($id)){$id = 0;}
			return $rules[$type].'-'.htmlentities($id).'-'.htmlentities($pageN).'.html';
		}
		else{
			return 'index.php?'.$type.'='.htmlentities($id).'&p='.htmlentities($pageN);
		}
	}
	public function getBid(){
		return $this->b_id;
	}
	public function getCid(){
		return $this->c_id;
	}
	public function getId(){
		return $this->id;
	}
	public function getP(){
		return $this->p;
	}
}
