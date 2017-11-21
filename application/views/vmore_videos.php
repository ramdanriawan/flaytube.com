<?php error_reporting();
include 'phpQuery/phpQuery/phpQuery.php';
$post = $this->input->post("file");
$html = json_decode($post);

if(is_null($html))
{
	die("gagal mendecode json yang di inputkan!");
}

$dom = phpQuery::newDocument($html->content_html);

if($this->input->post("media") == "v"){
	$table = "videos";
	$query = $this->db->query("select * from chanel where link='$_POST[chanel]' AND name='$_POST[name]'");

	if($query->num_rows() < 1){
		die("Gagal menemukan chanel dari media videos yang diminta");
	}
	else{

		$list 	= pq(".channels-content-item.yt-shelf-grid-item");
		$gambar = $list->find("img");
		$judul  = $list->find(".yt-lockup-title a");
		$time   = $list->find(".video-time span");

		foreach($list as $a => $value){
		
		$data = array(
			"chanel" => $_POST["chanel"],
			"name"	 => $_POST["name"],
			"gambar" => $gambar->eq($a)->attr("src"),
			"judul"  => $judul->eq($a)->text(),
			"link"   => "http://youtube.com" . $judul->eq($a)->attr("href"),
			"time"   => $time->eq($a)->text()
		);

		//untuk melihat data
		// print "<pre>";
		// print_r($data);
		$cek_videos = $this->db->query("select * from videos where link='$data[link]'");
		if($cek_videos->num_rows > 0)
		{
			die("terjadi duplicate pada beberapa videos yang di input");
		}

		//untuk save ke database
		if($this->db->insert("videos", $data)){
			$status = "berhasil menambah data videos";
		}else{
			die("gagal menambah data videos, silakan cek lagi response yang telah di copas");
		}
	 //
	}

	echo $status;
}
}

elseif($this->input->post("media") == "p"){
	$table = "playlists";
	$query = $this->db->query("select * from chanel where link='$_POST[chanel]' AND name='$_POST[name]'");

	if($query->num_rows() < 1){
		die("Gagal menemukan chanel dari media playlists yang diminta");
	}
	else{

	$list         = pq(".channels-content-item.yt-shelf-grid-item");
	$name         = $_POST["name"];
	$gambar       = $list->find("img");
	$link         = $list->find("a.yt-uix-sessionlink.yt-uix-tile-link.spf-link.yt-ui-ellipsis.yt-ui-ellipsis-2");
	$total_videos = $list->find("span.formatted-video-count-label b");

	//lakukan perulangan foreach untuk mengumpulkan semua data
	foreach ($list as $a => $value) {
		//data utama berita disini
		$data = array(
			"chanel"	   => $_POST["chanel"],
			"name"         => $name,
			"gambar"       => $gambar->eq($a)->attr("src"),
			"judul"        => $link->eq($a)->text(),
			"link"         => "http://youtube.com" . $link->eq($a)->attr("href"),
			"total_videos" => $total_videos->eq($a)->text()
			);

		//untuk melihat data
		// print "<pre>";
		// print_r($data);
		$cek_videos = $this->db->query("select * from playlists where link='$data[link]'");
		if($cek_videos->num_rows > 0)
		{
			die("terjadi duplicate pada beberapa playlists yang di input");
		}

		//untuk save ke database
		if($this->db->insert("playlists", $data)){
			$status = "berhasil menambah data playlists";
		}else{
			die("gagal menambah data videos, silakan cek lagi response yang telah di copas");
		}
	 //
	}

	echo $status;
}
}
?>