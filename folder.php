<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php 
	require_once('util/slide.php');
	require_once('util/getfilelist.php');
	require_once('util/safe_get.php');	
	require_once('util/util.php');
	require_once('util/resizeimage.php');
?>
<body >
<script>
document.onkeydown=function(event){
    var e = event || window.event || arguments.callee.caller.arguments[0];
    
    switch(e.keyCode)
    {
    case 13:
    case 32:
    case 39:
        changeImage(1);
        e.preventDefault();
        break;
    case 8:
    case 37:
        changeImage(-1);
        e.preventDefault();
        break;
    }
};
</script>
<?php
$folder = _get("f");
$camera = _get("c");
$cur_image = _get("i");
if($folder==null)
    $folder = '20150604103152_lf/';
if($camera==null)
    $camera = '1';
if($cur_image==null)
    $cur_image = '0';
    
if(substr($folder,-1,1)!='/') $folder.='/';    
$dir=$folder.get_camera_name($camera)."/";
$prefix="//192.168.100.23/share/ScenesImages/";
$prefix_server="//172.18.49.115/share/";
$images_arr=get_images_list($prefix.$dir);
$files_arr=get_files_list($prefix);
$search_page='folder.php';
?>

<?php
//generate thumb images,this will be done seperately.
    // $cnt=0;
    // if(!file_exists('thumb/'.$dir))
        // mkdir('thumb/'.$dir,0777,true);
    // foreach($images_arr as $image)
    // {
        // $full_image_name=$prefix.$dir.$image;    
        
        // $wid=1024;
        // $hei=544;
        // $c=0;
        
        // if(file_exists('thumb/'.$dir.$image))
            // continue;
            
        // $dstpath='thumb/'.$dir.$image;
        // $test= new resizeimage($full_image_name, $wid, $hei,$c,$dstpath);

        // $cnt++;
    // }
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
    <?php                    
    echo '<select name="i">';
    $cnt=0;
    foreach($images_arr as $image)
    {
        if($cur_image==$cnt)
            echo '<option class="camera" value="'.$cnt.'" selected="selected">';
        else    
            echo '<option class="camera" value="'.$cnt.'">';
        echo '<label>帧数:'.($cnt+1).'</label>';
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
<script>
imagelist=[
<?php 
    $cnt=0;
    foreach($images_arr as $image)
    {      
        if($cnt==0)
            echo "'".$image."'";
        else
            echo ",'".$image."'";
        $cnt++;
    }
?>
];
full_file_name_list=[
<?php 
    $cnt=0;
    foreach($images_arr as $image)
    {
        $full_image_name=$prefix_server.$dir.$image;        
        if($cnt==0)
            echo "'".$full_image_name."'";
        else
            echo ",'".$full_image_name."'";
        $cnt++;
    }
?>
];
thumb_file_name_list=[
<?php 
    $cnt=0;
    foreach($images_arr as $image)
    {
        $thumb_img='thumb/'.$dir.$image; 
        if(!file_exists($thumb_img))    break;    
        if($cnt==0)
            echo "'".$thumb_img."'";
        else
            echo ",'".$thumb_img."'";
        $cnt++;
    }
?>
];
</script>
<table class="main_context" boder="1">
<tr><td></td><td>
<div id="labellist">      
    <a id="label" href="">
    <label><h3> imagelist  </h3></label>
    </a>
</div>
<label>共计 ：<?php echo $cnt ?></label>
</td>
<td></td>
</tr>
<tr>
<td>
<div>
<a class="button" onclick="changeImage(-1);"><img class="arrow_l" src="images/arrow_left.svg"></a>
</div>
</td><td>
<div id="imglist">
    <a class="img" id="img" href="">
    <img src="" />
    </a>
</div>
</td><td>
<div>
<a class="button" onclick="changeImage(1);"><img class="arrow_r" src="images/arrow_right.svg"></a>
</div>
</td></tr>
</table>
<script>
    cur_img=<?php echo $cur_image?>;
    changeImage(0);
</script>

</body>