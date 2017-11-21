<?php error_reporting(0);

$url = $file;
$get = file_get_contents($url);

if($get){
  echo "success";
}else{
  echo "false";
}

?>