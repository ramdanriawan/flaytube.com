<?php include 'header.php'; ?>
<div class="container" id="container-form">
	<div class="row" id="row-form">
		<div class="col-md-10 col-md-offset-2">
			<form id="form-search" class="form-inline col-md-12" method="get" action="<?php echo "{$base_url}index.php/Cindex/cari";?>">
				<div class="form-group row">
				<input class="form-control" type="search" name="q" placeholder="cari video..." style="width: 500px;">
				<input type="hidden" name="media" value="v">
				<input class="form-control btn btn-primary" type="submit" name="submit" value="cari">
				</div>
			</form>
		</div>

		<div id="tab-cari" class="col-md-10 col-md-offset-2">
			<ul class="nav nav-tabs">
				<li><a href="<?php echo "{$base_url}index.php/Cindex/cari?media=c&q=$_GET[q]&page=$_GET[page]&limit=$_GET[limit]"; ?>">Chanel</a></li>
				<li><a href="<?php echo "{$base_url}index.php/Cindex/cari?media=v&q=$_GET[q]&page=$_GET[page]&limit=$_GET[limit]"; ?>">Videos</a></li>
				<li><a href="<?php echo "{$base_url}index.php/Cindex/cari?media=p&q=$_GET[q]&page=$_GET[page]&limit=$_GET[limit]"; ?>">Playlists</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="container" id="container-body">
	<?php echo "<h1>$index[data_total] hasil pencarian untuk \"$_GET[q]\"</h1>"; ?>
	<!--  jika media adalah videos atau tidak diset -->
	<?php  if(($this->input->get("media") == "v" && isset($_GET["media"])) && $index["data_total"] > 0): ?>
	<div class="row">
		<div class="col-md-12">
		<?php foreach($index["data"] as $key => $value): ?>
			<div class="col-md-3">
				<div class="thumbnail" style="height: 200px;">
					<img src="<?php echo $value->gambar;?>" />
					<div class="caption">
						<span>
							<a href="<?php echo "{$base_url}index.php/Cindex/Cindexstream?media=v&v=$value->link&id=$value->id";?>" target="_blank"><?php echo $value->judul; ?></a>
						</span><br>
						<span>
							<b><?php echo $value->name; ?></b>
						</span> | 
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
					echo "<li>
							<a href='{$base_url}index.php/Cindex/cari?media=v&page=$page&limit=$index[limit]&active=active&q=$_GET[q]'><<< Prev</a>
						  </li>";
				}
				?>
			<?php for($i = $index["page"]; $i <= $index["page"] + 10 && $i <= $index["page_total"]; $i++): ?>
			<?php if($i == $_GET["page"]){$active = "active";}else{$active = "";} ?>
				<li class="<?php echo $active; ?>">
					<a href="<?php echo  "{$base_url}index.php/Cindex/cari?media=v&page=$i&limit=$index[limit]&active=active&q=$_GET[q]";?>"><?php echo $i; ?></a>
				</li>
			<?php endfor; ?>
					<?php if($_GET["page"] < $index["page_total"]){
						if(isset($_GET["page"]))
						{
							$page = $_GET["page"] + 1;
						}else {
							$page = 2;
						}
					echo "<li><a href='{$base_url}index.php/Cindex/cari?media=v&page=$page&limit=$index[limit]&active=active&q=$_GET[q]'>Next >>></a></li>";
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
					$page = $_GET["page"] - 1;
					
					echo "<li><a href='{$base_url}index.php/Cindex/cari?media=c&page=$page&limit=$index[limit]&active=active&q=$_GET[q]'><<< Prev</a></li>";
				}
				?>
				<?php for($i = $index["page"]; $i <= $index["page"] + 10 && $i <= $index["page_total"]; $i++): ?>
				<?php if($i == $_GET["page"]){$active = "active";}else{$active = "";} ?>
					<li class="<?php echo $active; ?>">
						<a href="<?php echo "{$base_url}index.php/Cindex/cari?media=c&page=$i&limit=$index[limit]&active=active&q=$_GET[q]";?>"><?php echo $i; ?></a>
					</li>
				<?php endfor; ?>
				<?php if($_GET["page"] < $index["page_total"]){
					if(isset($_GET["page"]))
					{
						$page = $_GET["page"] + 1;
					}else {
						$page = 2;
					}
					
					echo "<li><a href='{$base_url}index.php/Cindex/cari?media=c&page=$page&limit=$index[limit]&active=active&q=$_GET[q]'>Next >>></a></li>";
				}
				?>
				<li class="end_pagination"> <a style="background: #333; color: white;">Of: <?php echo "$index[page_total], $index[data_total] data"; ?></a></li>
			</ul>
		</div>
	</div>
	<?php endif;?>
	
	<!-- jika media adalah playlists -->
	<?php if($this->input->get("media") == "p" && $index["data_total"] > 0):?>
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
					echo "<li><a href='{$base_url}index.php/Cindex/cari?media=p&page=$page&limit=$index[limit]&active=active&q=$_GET[q]'><<< Prev</a></li>";
				}
				?>
				<?php for($i = $index["page"]; $i <= $index["page"] + 10 && $i <= $index["page_total"]; $i++): ?>

				<?php if($i == $_GET["page"]){$active = "active";}else{$active = "";} ?>
					<li class="<?php echo $active; ?>">
						<a href="<?php echo "{$base_url}index.php/Cindex/cari?media=p&page=$i&limit=$index[limit]&active=active&q=$_GET[q]";?>"><?php echo $i; ?></a>
					</li>
				<?php endfor; ?>
				<?php if($_GET["page"] < $index["page_total"]){
					if(isset($_GET["page"]))
					{
						$page = $_GET["page"] + 1;
					}else {
						$page = 2;
					}
					
					echo "<li><a href='{$base_url}index.php/Cindex/cari?media=p&page=$page&limit=$index[limit]&active=active&q=$_GET[q]'>Next >>></a></li>";
				}
				?>
				<li class="end_pagination"> <a style="background: #333; color: white;">Of: <?php echo "$index[page_total], $index[data_total] data"; ?></a></li>
		</ul>
		</div>
	</div>
	<?php endif; ?>
</div>

<?php include "footer_admin.php"; ?>