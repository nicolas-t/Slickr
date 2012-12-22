<?php
class Admin{
	private $cacheFolder = '../cache/';
	private $configFile = '../config.php';
	private $configFileTemp = '../config.template.php';
	private $newConfig = array();
	private $defaultConfig = array( 'template' => 'positif',
									'showDesc' => 0,
									'cache_delay' => 168,
									'rewrite' => 0,
									'user' => USER,
									'name' => NAME,
									'homepage' => HOMEPAGE,
									'description' => DESC,
									'images_per_pages' => IMAGES_PER_PAGE,
									'username' => USERNAME,
									'password' => PASSWORD,
									'version' => '0.5.2',
									'setBL' => '',
									'collecBL' => ''
									);
									
	public function __construct($post)
	{
		$this->newConfig = $post;
	}
	private function checkRights()
	{
		if(!is_writable($this->configFile)){
			return false;
		}
		else{return true;}
	}
	private function deleteCache()
	{
		$handle=opendir($this->cacheFolder);
		while (false !== ($file = readdir($handle)))
		{
			if ($file != "." && $file != "..") {
				@unlink($this->cacheFolder . $file);
			} 
		} 
	}
	public function manage()
	{
		if((THUMBS_SIZE != (int)$this->newConfig['thumbs_size']) OR (IMAGES_PER_PAGE != (int)$this->newConfig['images_per_page']) OR (HOMEPAGE != (int)$this->newConfig['homepage']) OR (SHOW_PHOTOSET_DESCRIPTION != (int)$this->newConfig['showDesc']) OR (URL_REWRITING != (int)$this->newConfig['rewrite']) OR (NAME != $this->newConfig['name']) OR (DESC != $this->newConfig['description']) ){
			$this->deleteCache();
		}
		if((int)$this->newConfig['rewrite']){
			@rename('../disabled.htaccess', '../.htaccess'); 
		}
		else{
			@rename('../disabled.htaccess', '../disabled.htaccess'); 
		}
	}
	public function createConf()
	{
		$array = array_merge($this->defaultConfig, $this->newConfig);

		$config_install = '<?php'."\n";
		$config_install .= 'define(\'TEMPLATE\',                 	\''.addslashes($array['template']).'\');' . "\n";
		$config_install .= 'define(\'SHOW_PHOTOSET_DESCRIPTION\',  '.(int)$array['showDesc'].');' . "\n";
		$config_install .= 'define(\'CACHE_DELAY\',                '.(int)$array['cache_delay'].');' . "\n";
		$config_install .= 'define(\'URL_REWRITING\',              '.(int)$array['rewrite'].');' . "\n";
		$config_install .= 'define(\'USER\',						\''.$array['user'] .'\');' . "\n";
		$config_install .= 'define(\'NAME\',					 	\''.addslashes($array['name']).'\');' . "\n";
		$config_install .= 'define(\'DESC\',					 	\''.addslashes($array['description']).'\');' . "\n";
		$config_install .= 'define(\'IMAGES_PER_PAGE\',				'.(int)$array['images_per_page'].');' . "\n";
		$config_install .= 'define(\'HOMEPAGE\',					\''.addslashes($array['homepage']).'\');' . "\n";
		$config_install .= 'define(\'THUMBS_SIZE\',					\''.addslashes($array['thumbs_size']).'\');' . "\n";
		$config_install .= 'define(\'USERNAME\',					\''.addslashes($array['username']) .'\');' . "\n";
		$config_install .= 'define(\'PASSWORD\',					\''.$array['password'] .'\');' . "\n";
		$config_install .= 'define(\'VERSION\',						\'0.5.2\');' . "\n";
		$config_install .= '$setBlackList = array(\''.str_replace(',', '\',\'', addslashes($array['setBL'])).'\');' . "\n";
		$config_install .= '$collecBlackList = array(\''.str_replace(',', '\',\'', addslashes($array['collecBL'])).'\');' . "\n";
		$config_install .= '?>'."\n";
		return $config_install;
	}
	public function writeConf($content){
		if(!file_exists($this->configFile)){
			rename($this->configFileTemp ,$this->configFile)
		}
		if($this->checkRights()){
			$f = @fopen($this->configFile,"w+"); 
			@fputs($f,$content);
			@fclose($f); 
			return true;
		}
		else{
			return false;
		}
	}
}
?>