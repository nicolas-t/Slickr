<?php
if(!defined('INDEX')){die();}

if (file_get_contents('http://slickr.net/version.txt') != VERSION){
	echo '<a href="http://slickr.net" class="update">New version available. Update Slickr now.</a>';
}

$falseButton = array('');
$trueButton = array('');
$thumbSize = array(
					'_s' => '75px',
					'_t' => '100px',
					'_m' => '240px',
					'' => '500px',
					'_z' => '640px',
					);
$homepage = array(
					'latest' => 'Latest Uploads',
					'collections' => 'Collections',
					'photosets' => 'Photosets',
					);
$options = array(SHOW_PHOTOSET_DESCRIPTION, URL_REWRITING);
foreach ($options as $k=>$v){
	if($v){$trueButton[$k] = 'checked';}
	else{$falseButton[$k] = 'checked';}
}

?>
<form action="index.php?a=save" method="post">
	
	<div class="label">Template folder : </div>
		<input type="text" value="<?php echo stripslashes(TEMPLATE); ?>" border="0" name="template" class="inputpetit"/>
	<div class="label">Site name : </div>
		<input type="text" value="<?php echo stripslashes(NAME); ?>" border="0" name="name" class="inputpetit"/>
	<div class="label">Site description : </div>
		<input type="text" value="<?php echo stripslashes(DESC); ?>" border="0" name="description" class="inputpetit"/>
	<div class="label">Homepage : </div>
		<select border="0" name="homepage" class="inputpetit"/>
		<?php
		foreach($homepage as $k=>$v)
		{
			$selected = '';
			if($k == HOMEPAGE){
				$selected = 'selected="selected"';
			}
			echo '<option '.$selected.' value="'.$k.'">'.$v.'</option>';
		}
		?>
		</select>
	<div class="label">Thumbs size : </div>
		<select border="0" name="thumbs_size" class="inputpetit"/>
		<?php
		foreach($thumbSize as $k=>$v)
		{
			$selected = '';
			if($k == THUMBS_SIZE){
				$selected = 'selected="selected"';
			}
			echo '<option '.$selected.' value="'.$k.'">'.$v.'</option>';
		}
		?>
		</select>
	<div class="label">Number of images per page : </div>
		<input type="text" value="<?php echo (int)IMAGES_PER_PAGE; ?>" border="0" name="images_per_page" class="inputpetit"/>
	<div class="label">Cache memory lifespan (hours) : </div>
		<input type="text" value="<?php echo CACHE_DELAY; ?>" border="0" name="cache_delay" class="inputpetit"/>
	<div class="label">Blacklisted sets (comma separated id): </div>
		<input type="text" value="<?php echo stripslashes(implode(",", $setBlackList)); ?>" border="0" name="setBL" class="inputpetit"/>
	<div class="label">Blacklisted collections (comma separated id) : </div>
		<input type="text" value="<?php echo stripslashes(implode(",", $collecBlackList)); ?>" border="0" name="collecBL" class="inputpetit"/>
	<br /><div class="label" style="display:inline;">Show photoset description: </div>
		<input type="radio" name="showDesc" <?php echo $trueButton[0]; ?> value="1" id="true" /> Yes
		<input type="radio" name="showDesc"<?php echo $falseButton[0]; ?> value="0" id="false" /> No
		<br />
		<br />
	<div class="label" style="display:inline;">Enable url_rewriting: </div>
		<input type="radio" name="rewrite" <?php echo $trueButton[1]; ?> value="1" id="true" /> Yes
		<input type="radio" name="rewrite" <?php echo $falseButton[1]; ?> value="0" id="false" /> No
		<input type="hidden" name="act" value="set"/>

		<input type="submit" value="Submit" border="0" class="submit" style="margin-top:-20px;margin-right:-10px;"/>
</form>	
<br />
