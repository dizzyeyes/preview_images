<?php
require_once('util/resizeimage.php');	
require_once('util/safe_get.php');	
require_once('util/getfilelist.php');
require_once('util/util.php');


$folder = _get("f");
$camera = _get("c");
if($folder==null)
    $folder = '20150604103152_lf/';
if($camera==null)
    $camera = '1';
for($camera=60;$camera>=1;$camera--)
{
if(substr($folder,-1,1)!='/') $folder.='/';    
$dir=$folder.get_camera_name($camera)."/";
$prefix="//192.168.100.23/share/ScenesImages/";
$prefix_server="//172.18.49.115/share/";
$images_arr=get_images_list($prefix.$dir);
$files_arr=get_files_list($prefix);
$search_page='folder.php';





    if(!file_exists('thumb/'.$dir))
        mkdir('thumb/'.$dir,0777,true);
            
    $cnt=0;
    foreach($images_arr as $image)
    {
        $full_image_name=$prefix.$dir.$image;    
        
        $wid=1024;
        $hei=544;
        $c=0;
        
        if(file_exists('thumb/'.$dir.$image))
            continue;
            
        $dstpath='thumb/'.$dir.$image;
        $test= new resizeimage($full_image_name, $wid, $hei,$c,$dstpath);

        $cnt++;
        echo $cnt.'. '.$dstpath.'<br>';
    }
    echo $dir." Finished!<br>";
}
echo "all Finished!"
?>