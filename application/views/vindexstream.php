<?php include 'header.php'; ?>

<div class="container" id="container-body">

	<!-- jika media adalah videos -->
	<?php if($_GET["media"] == "v"): ?>
	<?php $url = parse_url($_GET["v"]); parse_str($url["query"], $array); ?>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<iframe src="https://www.youtube.com/embed/<?php echo $array['v']; ?>?fs=1" width="640" height="480" allowfullscreen></iframe>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<ul class="nav nav-tabs">
					<?php if($hasil["get_prev_media"] == true):?>
					<li>
					<a href="<?php echo "{$base_url}index.php/Cindex/Cindexstream?media=v&v={$hasil["prev_media"][0]->link}&id={$hasil["prev_media"][0]->id}";?>"><<< Prev </a> 
					<?php endif; ?>
					</li>
					<li>
						<a >||</a>
					</li>
					<li>
						<?php if($hasil["get_next_media"] == true): ?>
					<a href="<?php echo "{$base_url}index.php/Cindex/Cindexstream?media=v&v={$hasil["next_media"][0]->link}&id={$hasil["next_media"][0]->id}";?>">Next >>></a>
					<?php endif; ?>
				</li>
			</ul>
		</div>
	</div>
	<?php endif; ?>

	<!-- jika media adalah playlists -->
	<?php if($_GET["media"] = "p" && isset($_GET["p"])): ?>
	<?php $url = parse_url($_GET["p"]); parse_str($url["query"], $array); ?>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<iframe src="https://www.youtube.com/embed?listType=playlist&list=<?php echo $array['list']; ?>" width="640" height="480" allowfullscreen></iframe>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<ul class="nav nav-tabs">
				<?php if($hasil["get_prev_media"] == true): ?>
				<li>
					<a href="<?php echo "{$base_url}index.php/Cindex/Cindexstream?media=p&p={$hasil["prev_media"][0]->link}&id={$hasil["prev_media"][0]->id}";?>"><<< Prev</a>
				</li>
				<?php endif; ?>
				<li>
					<a >||</a>
				</li>
				<?php if($hasil["get_next_media"] == true): ?>
				<li>
					<a href="<?php echo "{$base_url}index.php/Cindex/Cindexstream?media=p&p={$hasil["next_media"][0]->link}&id={$hasil["next_media"][0]->id}";?>">Next >>></a>
				</li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
	<?php endif; ?>


</div>

<?php include 'footer_admin.php'; ?>