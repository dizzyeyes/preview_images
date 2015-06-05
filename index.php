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
<div class="formsearch">
<form >
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
 
</form>
<button onclick='make_submit();return;'>Go</button>
<button onclick='make_thumb();return;'>Resize</button>
</div>
<script>
function make_submit()
{
    params=document.getElementsByTagName('select');
    f=params[0];c=params[1];    
    window.location.href="folder.php?f="+f.value+"&c="+c.value;
}
function make_thumb()
{
    params=document.getElementsByTagName('select');
    f=params[0];c=params[1];    
    window.location.href="resizeall.php?f="+f.value+"&c="+c.value;
}
</script>
