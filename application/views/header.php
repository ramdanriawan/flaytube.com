<?php error_reporting(0); ?>
<?php $base_url = base_url(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Header</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="../../node_modules/jquery/dist/jquery.min.js"></script>
	<script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="../../script/script.js"></script>
	<link rel="stylesheet" type="text/css" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>
<body>

<div class="container-fluid" id="container-fluid-header">
	<div class="container" id="container-header">
		<div class="row">

			<div class="col-md-4 col-xs-12">
				<div class="glyphicon glyphicon-th" id="chanel_toggler"></div> 
				<span><a href="/" id="logo">Grabyoutube</a></span>
			</div>

			<div class="col-md-8 col-xs-12">
				<ul class="nav nav-tabs pull-right">
					<li class="<?php echo $this->input->get("chanel"); ?>"><a href="<?php echo "{$base_url}index.php/Cindex/cindexf?media=c&chanel=active";?>">Chanel</a></li>
					<li class="<?php echo $this->input->get("videos"); ?>"><a href="<?php echo "{$base_url}index.php/Cindex/cindexf?media=v&videos=active";?>">Videos</a></li>
					<li class="<?php echo $this->input->get("playlists"); ?>"><a href="<?php echo "{$base_url}index.php/Cindex/cindexf?media=p&playlists=active";?>">Playlists</a></li>
					<li><a href="<?php echo "{$base_url}index.php/Cadmin/clogin";?>"><span class="glyphicon glyphicon-user" id="admin_login"> Admin</span></a></li>
				</ul>
			</div>

		</div>
	</div>
</div>


<div id="sidebar">
	<ul>
			<?php if(!isset($_GET["media"]) && $_GET["media"] != "c")
			{
				$media = "videos";
			}elseif($_GET["media"] == "v" && $_GET["media"] != "c"){
				$media = "videos";
			}elseif($_GET["media"] == "p" && $_GET["media"] != "c"){
				$media = "playlists";
			}elseif($_GET["media"] == "c"){
				$media = "chanel";
			}else{
				$media = "not found";
			}?>

		<li class="header"><?php echo $sidebar["data_total"];?> CHANEL (media <?php echo $media; ?>)</li>

		<?php foreach($sidebar["data"] as $key => $value): ?>
				<?php 
				if($_GET["media"] == "v" || !isset($_GET["media"])){
					$link = "{$base_url}index.php/Cindex/cindexf?media=v&c=$value->link&videos=active&name=$value->name";
				}elseif($_GET["media"] == "p"){
					$link = "{$base_url}index.php/Cindex/cindexf?media=p&c=$value->link&playlists=active&p=$value->playlists&name=$value->name";
				}elseif($_GET["media"] == "c"){
					$link = "$value->link";
				}
				 ?>
			<li><a href="<?php echo $link;?>" target="_blank"><?php echo $value->name;?></a></li>
		<?php endforeach; ?>
	</ul>
</div>