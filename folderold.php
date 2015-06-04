<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php 
	require_once('util/slide.php');
	require_once('util/getfilelist.php');
	require_once('util/resizeimage.php');	
	require_once('util/safe_get.php');	
	require_once('util/util.php');
?>

<?php
$folder = _get("f");
$camera = _get("c");
if($folder==null)
    $folder = '20150604103152_lf/';
if($camera==null)
    $camera = '1';
    
if(substr($folder,-1,1)!='/') $folder.='/';    
$dir=$folder.get_camera_name($camera)."/";
$prefix="//192.168.100.23/share/ScenesImages/";
$prefix_server="//172.18.49.115/share/";
$images_arr=get_images_list($prefix.$dir);
$files_arr=get_files_list($prefix);
$search_page='folderold.php';
?>

<div class="search">
    <form class="search" action="<?php echo $search_page;?>" method="get">
    <?php                    
    echo '<select name="f">';
    $cnt=0;
    foreach($files_arr as $file)
    {
        $full_file_name=$prefix_server.'/'.$file;  
        if($file.'/'==$folder)
            echo '<option class="folder" value="'.$file.'" selected="selected">';
        else    
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
        $camera_item=get_camera_name($item);
        if($camera==$item)
            echo '<option class="camera" value="'.$item.'" selected="selected">';
        else    
            echo '<option class="camera" value="'.$item.'">';
        echo '<label>相机:'.$camera_item.'</label>';
        echo "</option>";
        $cnt++;
    }
    echo '</select>';
    ?>
     <input type="submit" value="Go" />
    </form>
</div>
<style>
div.search{
    margin-top:10px;
    text-align:center;
}
form.search{  
    position:inherit;
}
</style>

<table class="main_context" boder="1">
<tr><td></td><td>
<?php                    
echo '<div id="labellist">';
$cnt=0;
foreach($images_arr as $image)
{
	$full_image_name=$prefix_server.$dir.$image;        
	if($cnt==0)
		echo '<a class="img" href="'.$full_image_name.'">';
	else
		echo '<a class="img" href="'.$full_image_name.'" style="display:none;" >';
	echo '<label><h3>文件名：'.$image.'</h3></label>';
	echo "</a>";	
	$cnt++;
}
echo '</div>';
?><label>共计 ：<?php echo $cnt ?></label>
</td>
<td></td>
</tr>
<tr>
<td>
<div>
<a class="button" onclick="changePost(-1);"><img class="arrow_l" src="images/arrow_left.svg"></a>
</div>
</td><td>
<?php                    
echo '<div id="imglist">';
$cnt=0;
foreach($images_arr as $image)
{
	$full_image_name=$prefix_server.$dir.$image;
	if($cnt==0)
		echo '<a class="img" href="'.$full_image_name.'">';
	else
		echo '<a class="img" href="'.$full_image_name.'" style="display:none;" >';
		
	// echo $image;
	echo '<img src="'.$full_image_name.'" />';
	echo "</a>";	
	$cnt++;
}
echo '</div>';
?>
</td><td>
<div>
<a class="button" onclick="changePost(1);"><img class="arrow_r" src="images/arrow_right.svg"></a>
</div>
</td></tr>
</table>

