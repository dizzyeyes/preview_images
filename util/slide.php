<script>
    var cur_img=0;
    function changePost(direction)
    {
        var imageList=document.getElementById('imglist');
        var labelList=document.getElementById('labellist');
        var imgs = imageList.getElementsByTagName('a');
        var label = labelList.getElementsByTagName('a');
        imgs[cur_img].style.display="none";
        label[cur_img].style.display="none";
        
        cur_img+=direction;
        if(cur_img>imgs.length-1) cur_img=0;
        if(cur_img<0) cur_img=imgs.length-1;
        
        imgs[cur_img].style.display="block";
        label[cur_img].style.display="block";
    }
    
    function changeImage(direction)
    {
        var imageList=document.getElementById('img');
        var labelList=document.getElementById('label');
        var img = imageList.children[0];
        var label = labelList.children[0].children[0]; 
        
        cur_img+=direction;
        if(cur_img>imagelist.length-1) cur_img=0;
        if(cur_img<0) cur_img=imagelist.length-1;
        
        imageList.href=full_file_name_list[cur_img];
        labelList.href=full_file_name_list[cur_img];
        if(thumb_file_name_list.length==0)
        {
               //file not exists
            img.src=full_file_name_list[cur_img];
        }
        else
        {       //file exists               
            img.src=thumb_file_name_list[cur_img];
        }
        label.innerHTML=imagelist[cur_img];        
    }
    
</script>

