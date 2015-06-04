<?php

    function get_camera_name($id)
    {
        $newStr= sprintf('CAMERA%05s', $id);
        return $newStr;
    }
?>