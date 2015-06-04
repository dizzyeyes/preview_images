<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php 
	require_once('util/getfilelist.php');
	require_once('util/util.php');	
	
$dir = '/';
$prefix="//192.168.100.23/share/ScenesImages/";
$prefix_server="//172.18.49.115/share/";
$files_arr=get_files_list($prefix.$dir);
$search_page="folder.php";
$search_page_full="http://172.18.49.115/preview/folder.php";
?>
<form class="search" action="<?php echo $search_page;?>" method="get">
<?php                    
echo '<select name="f">';
$cnt=0;
foreach($files_arr as $file)
{
	$full_file_name=$prefix_server.$dir.$file;  
    echo '<option class="folder" value="'.$file.'">';
	echo '<label>采集任务：'.$file.'</label>';
	echo "</option>";
	$cnt++;
}
echo '</select>';
?>

<?php                    
echo '<select name="c">';
for($item=1;$item<61;$item++)
{
    $camera=get_camera_name($item);
    echo '<option class="camera" value="'.$item.'">';
	echo '<label>相机:'.$camera.'</label>';
	echo "</option>";
	$cnt++;
}
echo '</select>';
?>
 <input type="submit" value="Go" />
</form>