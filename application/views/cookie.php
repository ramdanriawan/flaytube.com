<?php 
$base_url = base_url();
if (!isset($_COOKIE["username"])) {
	header("Location: {$base_url}index.php/Cadmin/clogin?authentication=false");
}

?>