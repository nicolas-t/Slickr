<?php
if(!defined('INDEX')){die();}

if (file_get_contents('http://slickr.net/version.txt') != VERSION){
	echo '<a href="http://slickr.net" class="update">New version available. Update Slickr now.</a>';
}

$falseButton = array('');
$trueButton = array('');
$thumbSize = array(
					'_sq' => '75px',
					'_t'  => '100px',
					'_q'  => '150px',
					'_s'  => '240px',
					'_n'  => '320px',
					'_m'  => '500px',
					'_z'  => '640px',
					);
$homepage = array(
					'latest'      => 'Latest Uploads',
					'collections' => 'Collections',
					'photosets'   => 'Photosets',
					);
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
		$matchHompage = (isset($_POST['homepage'])) ? $_POST['homepage'] : HOMEPAGE;
		foreach($homepage as $k=>$v)
		{
			$selected = '';
			if($k == $matchHompage){
				$selected = 'selected="selected"';
			}
			echo '<option '.$selected.' value="'.$k.'">'.$v.'</option>';
		}
		?>
		</select>
	<div class="label">Thumbs size : </div>
		<select border="0" name="thumbs_size" class="inputpetit"/>
		<?php
		$matchThumbSize = (isset($_POST['thumbs_size'])) ? $_POST['thumbs_size'] : THUMBS_SIZE;
		foreach($thumbSize as $k=>$v)
		{
			$selected = ($k == $matchThumbSize) ? 'selected="selected"' : '';
			echo '<option '.$selected.' value="'.$k.'">'.$v.'</option>';
		}
		?>
		</select>
	<div class="label">Number of images per page : </div>
		<input type="text" value="<?php echo (int)IMAGES_PER_PAGE; ?>" border="0" name="images_per_page" class="inputpetit"/>
	<div class="label">Cache memory lifespan (hours) : </div>
		<input type="text" value="<?php echo CACHE_DELAY; ?>" border="0" name="cache_delay" class="inputpetit"/>
	<div class="label">Image cache memory lifespan (hours) : </div>
		<input type="text" value="<?php echo CACHE_IMAGE_DELAY; ?>" border="0" name="cache_image_delay" class="inputpetit"/>
	<div class="label">Blacklisted sets (comma separated id): </div>
		<input type="text" value="<?php echo stripslashes(implode(",", $setBlackList)); ?>" border="0" name="setBL" class="inputpetit"/>
	<div class="label">Blacklisted collections (comma separated id) : </div>
		<input type="text" value="<?php echo stripslashes(implode(",", $collecBlackList)); ?>" border="0" name="collecBL" class="inputpetit"/>
	<br />
	<div class="label" style="display:inline;">Show photoset description: </div>
		<?php
		$matchShowDesc = (isset($_POST['showDesc'])) ? $_POST['showDesc'] : SHOW_PHOTOSET_DESCRIPTION;
		if($matchShowDesc){
			$trueButtonShowDesc = 'checked = "checked"';
			$falseButtonShowDesc = '';
		}
		else{
			$falseButtonShowDesc = 'checked = "checked"';
			$trueButtonShowDesc = '';
		}
		?>
		<input type="radio" name="showDesc" <?php echo $trueButtonShowDesc; ?> value="1" id="true" /> Yes
		<input type="radio" name="showDesc"<?php echo $falseButtonShowDesc; ?> value="0" id="false" /> No
		<br />
		<br />
	<div class="label" style="display:inline;">Enable url_rewriting: </div>
		<?php
		$matchRewrite = (isset($_POST['rewrite'])) ? $_POST['rewrite'] : URL_REWRITING;
		if($matchRewrite){
			$trueButtonRewrite = 'checked = "checked"';
			$falseButtonRewrite = '';
		}
		else{
			$falseButtonRewrite = 'checked = "checked"';
			$trueButtonRewrite = '';
		}
		?>
		<input type="radio" name="rewrite" <?php echo $trueButtonRewrite; ?> value="1" id="true" /> Yes
		<input type="radio" name="rewrite" <?php echo $falseButtonRewrite; ?> value="0" id="false" /> No
		<input type="hidden" name="act" value="set"/>

		<input type="submit" value="Submit" border="0" class="submit" style="margin-top:-20px;margin-right:-10px;"/>
</form>	
<br />
