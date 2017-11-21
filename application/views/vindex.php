<?php include 'header.php'; ?><?php /*echo "<pre>";print_r($hasil);*/ ?>


<div class="container" id="container-form">
	<div class="row" id="row-form">
		<div class="col-md-10 col-md-offset-1 col-xs-12">
			<form id="form-search" class="form-inline col-md-12" method="get" action="<?php echo "{$base_url}index.php/Cindex/cari";?>">
				<input type="hidden" name="media" value="v">
				<div class="form-group row">
				<input class="form-control" type="search" name="q" placeholder="cari video..." style="width: 500px;">
				<input class="form-control btn btn-primary" type="submit" name="submit" value="cari">
				</div>
			</form>
		</div>
	</div>
</div>


<?php 
if(!isset($_GET["media"])):
$a = 0;

foreach($hasil["data"] as $key => $value) if($a < 10)
{
echo '<div class="row">
	<div class="col-md-10 col-md-offset-1">';
	echo "<h1>Videos dari {$value[0]->name}</h1>";

	foreach ($value as $key => $value2) {
echo <<<EOD
				<div class="col-md-3">
				<div class="thumbnail" style="height: 200px;">
					<img src="$value2->gambar" />
					<div class="caption">
						<span><a href="{$base_url}index.php/Cindex/Cindexstream?media=v&v=$value2->link&id=$value2->id" target="_blank"> $value2->judul</a></span><br>
						<span><b>$value2->name</b></span> | 
						<span>$value2->time</span>
					</div>
				</div>
			</div>
EOD;
	}
echo "<p>";
echo <<<EOD
<div class="col-md-3">
				<div id="selengkapnya" class="thumbnail" style="height: 200px;">
					<a href="{$base_url}index.php/Cindex/cindexf?media=v&c={$value[0]->chanel}&videos=active&name={$value[0]->name}" target="_blank"><h3>Selengkapnya >>> </h3></a>
					</div>
				</div>
			</div>';
EOD;
echo '</div>
</div>';

$a++;
}

?>

<div class="row">
	<div  id="lihat_semua_chanel" class="col-md-6 col-md-offset-3">
		<a href="http://<?php echo $_SERVER[SERVER_NAME];?>/index.php/Cindex/cindexf?media=c&chanel=active">Lihat 
			<?php echo $sidebar["data_total"];?> Chanel Lainnya</a>
	</div>
</div>
<?php endif; ?>

<div class="container" id="container-body">
	<!--  jika media adalah videos atau tidak diset -->
	<?php  if($this->input->get("media") == "v" && !isset($_GET["c"])  && $index["data_total"] > 0): ?>
	<div class="row">
		<div class="col-md-12">
		<?php foreach($index["data"] as $key => $value): ?>
			<div class="col-md-3">
				<div class="thumbnail" style="height: 200px;">
					<img src="<?php echo $value->gambar;?>" />
					<div class="caption">
						<span><a href="<?php echo "{$base_url}index.php/Cindex/Cindexstream?media=v&v=$value->link&id=$value->id";?>" target="_blank"><?php echo $value->judul; ?></a></span><br>
						<span><b><?php echo $value->name; ?></b></span> | 
						<span><?php echo $value->time; ?></span>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<ul class="pagination">
			<li class="first_pagination"><a  style="background: #333; color: white;">Page:: </a></li>
				<?php if($_GET["page"] > 1){$page = $_GET["page"] - 1;
					echo "<li><a href='{$base_url}index.php/Cindex/cindexf?media=v&page=$page&limit=$index[limit]&active=active'><<< Prev</a></li>";
				}
				?>
			<?php for($i = $index["page"]; $i <= $index["page"] + 10 && $i <= $index["page_total"]; $i++): ?>
			<?php if($i == $index["page"]){$active = "active";}else{$active = "";} ?>
				<li class="<?php echo $active; ?>">
					<a href="<?php echo  "{$base_url}index.php/Cindex/cindexf?media=v&page=$i&limit=$index[limit]&active=active";?>"><?php echo $i; ?></a>
				</li>
			<?php endfor; ?>
					<?php if($_GET["page"] < $index["page_total"]){
						if(isset($_GET["page"]))
						{
							$page = $_GET["page"] + 1;
						}else {
							$page = 2;
						}
					echo "<li><a href='{$base_url}index.php/Cindex/cindexf?media=v&page=$page&limit=$index[limit]&active=active'>Next >>></a></li>";
				}
				?>
			<li class="end_pagination"> <a style="background: #333; color: white;">Of: <?php echo "$index[page_total], $index[data_total] data"; ?></a></li>
			</ul>
		</div>
	</div>
	<?php endif; ?>
	
	<!-- jika media adalah chanel -->
	<?php if($this->input->get("media") == "c"  && $index["data_total"] > 0 ):?>
	<div class="row">
		<div class="col-md-12">
		<?php foreach($index["data"] as $key => $value): ?>
			<div class="col-md-3">
				<div class="thumbnail" style="height: 200px;">
					<img src="<?php echo $value->logo;?>" />
					<div class="caption">
						<span><a href="<?php echo "$value->link";?>" target="_blank"><?php echo $value->name; ?></a></span><br>
						<span>
							<b><?php echo $value->subscriber; ?></b> Subscriber | 
							<?php $videos_total = $this->db->query("select * from videos where chanel='$value->link'")->num_rows(); ?>
							<a href="<?php echo "{$base_url}index.php/Cindex/cindexf?media=v&c=$value->link&videos=active&c=$value->link&name=$value->name"?>">
								<b><?php echo $videos_total;?></b> Videos |
							</a>
							<?php $playlists_total = $this->db->query("select * from playlists where chanel='$value->link'")->num_rows(); ?>
							<a href="<?php echo "{$base_url}index.php/Cindex/cindexf?media=p&c=$value->link&playlists=active&p=$value->link&name=$value->name"?>">
								<b><?php echo $playlists_total;?></b> Playlists 
							</a>
						</span>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<ul class="pagination">
				
				<li class="first_pagination"><a  style="background: #333; color: white;">Page:: </a></li>
				<?php if($_GET["page"] > 1){
					if(isset($_GET["page"]))
					{
						$page = $_GET["page"] + 1;
					}else {
						$page = 2;
					}
					echo "<li><a href='{$base_url}index.php/Cindex/cindexf?media=v&page=$page&limit=$index[limit]&active=active'><<< Prev</a></li>";
				}
				?>
				<?php for($i = $index["page"]; $i <= $index["page"] + 10 && $i <= $index["page_total"]; $i++): ?>
				<?php if($i == $index["page"]){$active = "active";}else{$active = "";} ?>
					<li class="<?php echo $active; ?>">
						<a href="<?php echo "{$base_url}index.php/Cindex/cindexf?media=c&page=$i&limit=$index[limit]&active=active";?>"><?php echo $i; ?></a>
					</li>
				<?php endfor; ?>
				<?php if($_GET["page"] > 1){$page = $_GET["page"] - 1;
					echo "<li><a href='{$base_url}index.php/Cindex/cindexf?media=v&page=$page&limit=$index[limit]&active=active'><<< Prev</a></li>";
				}
				?>
				<li class="end_pagination"> <a style="background: #333; color: white;">Of: <?php echo "$index[page_total], $index[data_total] data"; ?></a></li>
			</ul>
		</div>
	</div>
	<?php endif;?>
	
	<!-- jika media adalah playlists -->
	<?php if($this->input->get("media") == "p" && $index["data_total"] > 0 && !isset($_GET["c"]) && $index["data_total"] > 0):?>
	<div class="row">
		<div class="col-md-12">
		<?php foreach($index["data"] as $key => $value): ?>
			<div class="col-md-3">
				<div class="thumbnail" style="height: 200px;">
					<img src="<?php echo $value->gambar;?>" />
					<div class="caption">
						<span><a href="<?php echo "{$base_url}index.php/Cindex/Cindexstream?media=p&p=$value->link&id=$value->id";?>" target="_blank"><?php echo $value->judul; ?></a></span><br>
						<span><b><?php echo $value->total_videos; ?></b> videos</span> | 
						<span><?php echo $value->name; ?></span>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<ul class="pagination">
				<li class="first_pagination"><a  style="background: #333; color: white;">Page:: </a></li>
				<?php if($_GET["page"] > 1){$page = $_GET["page"] - 1;
					echo "<li><a href='{$base_url}index.php/Cindex/cindexf?media=p&page=$page&limit=$index[limit]&active=active'><<< Prev</a></li>";
				}
				?>
				<?php for($i = $index["page"]; $i <= $index["page"] + 10 && $i <= $index["page_total"]; $i++): ?>

				<?php if($i == $index["page"]){$active = "active";}else{$active = "";} ?>
					<li class="<?php echo $active; ?>">
						<a href="<?php echo "{$base_url}index.php/Cindex/cindexf?media=p&page=$i&limit=$index[limit]&active=active";?>"><?php echo $i; ?></a>
					</li>
				<?php endfor; ?>
				<?php if($_GET["page"] < $index["page_total"]){
					if(isset($_GET["page"]))
					{
						$page = $_GET["page"] + 1;
					}else {
						$page = 2;
					}
					
					echo "<li><a href='{$base_url}index.php/Cindex/cindexf?media=p&page=$page&limit=$index[limit]&active=active'>Next >>></a></li>";
				}
				?>
				<li class="end_pagination"> <a style="background: #333; color: white;">Of: <?php echo "$index[page_total], $index[data_total] data"; ?></a></li>
		</ul>
		</div>
	</div>
	<?php endif; ?>

	<!-- jika media adalah v dan dia ingin melihat videos -->
	<?php if($this->input->get("media") == "v" && isset($_GET["videos"]) && isset($_GET["c"]) && $index["data_total"] > 0):?>
	<div class="row">
	<div class="col-md-12">
	<h1>Data videos berdasarkan chanel <?php echo $_GET["name"]; ?></h1>
	<?php foreach($index["data"] as $key => $value): ?>
		<div class="col-md-3">
			<div class="thumbnail" style="height: 200px;">
				<img src="<?php echo $value->gambar;?>" />
				<div class="caption">
					<span><a href="<?php echo "{$base_url}index.php/Cindex/Cindexstream?media=v&v=$value->link&id=$value->id";?>" target="_blank"><?php echo $value->judul; ?></a></span><br>
					<span><b><?php echo $value->name; ?></b></span> | 
					<span><?php echo $value->time; ?></span>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<ul class="pagination">
		<li class="first_pagination"><a  style="background: #333; color: white;">Page:: </a></li>
		<?php if($_GET["page"] > 1){$page = $_GET["page"] - 1;
			echo "<li><a href='{$base_url}index.php/Cindex/cindexf?media=v&c={$index[data][0]->chanel}&videos=active&page=$page&limit=$index[limit]&active=active&name=$_GET[name]'><<< Prev</a></li>";
		}
		?>
		<?php for($i = $index["page"]; $i <= $index["page"] + 10 && $i <= $index["page_total"]; $i++): ?>
		<?php if($i == $index["page"]){$active = "active";}else{$active = "";} ?>
			<li class="<?php echo $active; ?>">
				<a href="<?php echo  "{$base_url}index.php/Cindex/cindexf?media=v&c={$index["data"][0]->chanel}&videos=active&page=$i&limit=$index[limit]&active=active&name=$_GET[name]";?>"><?php echo $i; ?></a>
			</li>
		<?php endfor; ?>
		<?php if($_GET["page"] < $index["page_total"]){
						if(isset($_GET["page"]))
						{
							$page = $_GET["page"] + 1;
						}else {
							$page = 2;
						}
					echo "<li><a href='{$base_url}index.php/Cindex/cindexf?media=v&c={$index[data][0]->chanel}&videos=active&page=$page&limit=$index[limit]&active=active&name=$_GET[name]'>Next >>></a></li>";
				}
				?>
		<li class="end_pagination"> <a style="background: #333; color: white;">Of: <?php echo "$index[page_total], $index[data_total] data"; ?></a></li>
		</ul>
	</div>
</div>
<?php endif; ?>

<!-- jika media adalah playlists -->
<?php if($this->input->get("media") == "p" && isset($_GET["playlists"]) && isset($_GET["c"]) && $index["data_total"] > 0):?>
<div class="row">
	<div class="col-md-12">
	<h1>Data playlists berdasarkan chanel <?php echo $_GET["name"]; ?></h1>
	<?php foreach($index["data"] as $key => $value): ?>
		<div class="col-md-3">
			<div class="thumbnail" style="height: 200px;">
				<img src="<?php echo $value->gambar;?>" />
				<div class="caption">
					<span><a href="<?php echo "{$base_url}index.php/Cindex/Cindexstream?media=p&p=$value->link&id=$value->id&name=$value->name";?>" target="_blank"><?php echo $value->judul; ?></a></span><br>
					<span><b><?php echo $value->total_videos; ?></b> videos</span> | 
					<span><?php echo $value->name; ?></span>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<ul class="pagination">
			<li class="first_pagination"><a  style="background: #333; color: white;">Page:: </a></li>
							<?php if($_GET["page"] > 1){$page = $_GET["page"] - 1;
					echo "<li><a href='{$base_url}index.php/Cindex/cindexf?media=p&c={$index["data"][0]->chanel}&playlists=active&page=$page&limit=$index[limit]&active=active&name=$_GET[name]'><<< Prev</a></li>";
				}
				?>
			<?php for($i = $index["page"]; $i <= $index["page"] + 10 && $i <= $index["page_total"]; $i++): ?>
			<?php if($i == $index["page"]){$active = "active";}else{$active = "";} ?>
				<li class="<?php echo $active; ?>">
					<a href="<?php echo "{$base_url}index.php/Cindex/cindexf?media=p&c={$index["data"][0]->chanel}&playlists=active&page=$i&limit=$index[limit]&active=active&name=$_GET[name]";?>"><?php echo $i; ?></a>
				</li>
			<?php endfor; ?>
			<?php if($_GET["page"] < $index["page_total"]){
						if(isset($_GET["page"]))
						{
							$page = $_GET["page"] + 1;
						}else {
							$page = 2;
						}
					echo "<li><a href='{$base_url}index.php/Cindex/cindexf?media=p&c={$index["data"][0]->chanel}&playlists=active&page=$page&limit=$index[limit]&active=active&name=$_GET[name]'>Next >>></a></li>";
				}
				?>
			<li class="end_pagination"> <a style="background: #333; color: white;">Of: <?php echo "$index[page_total], $index[data_total] data"; ?></a></li>
	</ul>
	</div>
</div>
<?php endif; ?>

<!-- untuk menampilkan data videos berdasarkan beberapa chanel -->
	
</div>

<?php include 'footer_admin.php'; ?>