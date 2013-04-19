<?php
class Cache{
	private $cacheFolder      = 'cache';
	private $cacheImageFolder = 'cache-images';
	private $delayImage       = CACHE_IMAGE_DELAY;
	private $delay            = CACHE_DELAY;
	private $name;

	public function __construct($adress)
	{
		if(URL_REWRITING)
			{$this->name = md5($adress.TEMPLATE.'rewritetrue').'.cache';}
		else
			{$this->name = md5($adress.TEMPLATE.'rewritefalse').'.cache';}
	}
	public function saveCache($content)
	{
		$path = $this->cacheFolder.'/'.$this->name;
		$file = fopen($path, 'w+');
		$fwrite =  fwrite($file, $content);
		$fclose = fclose($file); 
		if($fwrite AND $fclose){
			return true;
		}
		else{
			return false;
		}
	}
	public function saveCacheImage($img)
	{
		return file_put_contents($this->cacheImageFolder.'/'.md5($img).'.jpg', file_get_contents($img));
	}
	public function getImage($img)
	{
		if($this->delayImage){
			if(!file_exists($this->cacheImageFolder.'/'.md5($img).'.jpg') || @filemtime($this->cacheImageFolder.'/'.md5($img).'.jpg') > time() - ($this->delayImage * 3600))
			{
				$this->saveCacheImage($img);
			}
			return $this->cacheImageFolder.'/'.md5($img).'.jpg';
		}
		else{
			return $img;
		}
	}
	public function getCache(){
		if(file_exists($this->cacheFolder.'/'.$this->name) && @filemtime($this->cacheFolder.'/'.$this->name) > time() - ($this->delay * 3600))
		{
			readfile($this->cacheFolder.'/'.$this->name);
			exit();
		}
		else{
			ob_start();	 
		}
	}
}

?>