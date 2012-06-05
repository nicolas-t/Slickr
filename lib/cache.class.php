<?php
class Cache{
	private $cacheFolder = 'cache/';
	private $delay = CACHE_DELAY;
	private $name;

	public function __construct($adress)
	{
		if(URL_REWRITING)
			{$this->name = md5($adress.TEMPLATE.'rewritetrue').'.cache';}
		else
			{$this->name = md5($adress.TEMPLATE.'rewritefalse').'.cache';}
	}
	public function saveCache($content){
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