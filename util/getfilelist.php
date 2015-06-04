<?php
function get_files_list($dir)
{
	$files1 = scandir($dir);
	$files1 = array_slice($files1,2);
	return $files1;
}
function get_images_list($dir)
{
	$files1 = scandir($dir);
	$files1 = array_slice($files1,3);
	return $files1;
}


?>