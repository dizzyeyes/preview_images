<?php
function _get($str){ 
$val = !empty($_GET[$str]) ? $_GET[$str] : null; 
return $val; 
} 
?>