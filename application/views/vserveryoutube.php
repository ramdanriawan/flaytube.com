<?php
//require library
require_once("phpQuery/phpQuery/phpQuery.php");

//echo file_get_contents("https://www.youtube.com/channel/UCpSPS5yLCxYRuZSrCx-eBjA");

//fungsi untuk mendapatkan informasi chanel
function chanelinfo($chanel){
	//data get 
	$get = file_get_contents($chanel);
	//echo $get;
	//data chanel 
	$dom = phpQuery::newDocument($get);
	$list = pq(".branded-page-v2-header.channel-header.yt-card");
	$logo = $list->find(".channel-header-profile-image");
	$name = $list->find(".spf-link.branded-page-header-title-link.yt-uix-sessionlink");
	$subscriber = $list->find(".yt-subscription-button-subscriber-count-branded-horizontal.subscribed.yt-uix-tooltip");
	$videos = "$chanel/videos";
	$playlists = "$chanel/playlists";

	//masukkan data ke dalam array 
	$data = array(
		"link" => $chanel,
		"logo" => $logo->eq(0)->attr("src"),
		"name"=>$name->eq(0)->text(),
		"subscriber"=> $subscriber->eq(0)->text(),
		"videos"=>$videos,
		"playlists"=>$playlists
	);

	//print untuk melihat data
	print "<pre>";
	print_r($data);

	//jadikan data sebagai query
	$data = http_build_query($data, "", "&");

	//gabungkan url save db chanel dengan field
	$data_get = "{$base_url}index.php/Csavedb/csavedbf?media=c&" . $data;

	//tampilkan data hasil dari request ajax
		echo "status: " . file_get_contents($data_get);
		echo " " . $data_get;
}

//fungsi untuk grab semuda data videos
function grabyoutubevideos($chanel){
	//data get
	$url = "$chanel/videos";
	$get    = file_get_contents($url);
	
	//data grab youtube
	$dom    = phpQuery::newDocument($get);
	$list   = pq("#channels-browse-content-grid li.channels-content-item.yt-shelf-grid-item");
	$name   = pq(".spf-link.branded-page-header-title-link.yt-uix-sessionlink");
	$gambar = $list->find("img");
	$judul  = $list->find(".yt-lockup-title a");
	$time   = $list->find(".video-time span");

	//lakukan perulangan foreach untuk menentukan data
	foreach ($list as $a => $value) {
		//mengumpulkan data menjadi array
		$data = array(
			"chanel" => $chanel,
			"name"	 => $name->text(),
			"gambar" => $gambar->eq($a)->attr("src"),
			"judul"  => $judul->eq($a)->text(),
			"link"   => "http://youtube.com" . $judul->eq($a)->attr("href"),
			"time"   => $time->eq($a)->text()
		);

		//untuk melihat data
		print "<pre>";
		print_r($data);


		//jadikan data sebagai query
		$data      = http_build_query($data, "", "&");

		//gabungkan url save db dengan data field
		$data_get = "{$base_url}index.php/Csavedb/csavedbf?media=v&" . $data;

		//tampilkan data hasil dari request ajax
		echo "status: " . file_get_contents($data_get);

		echo " " . $data_get;
	 //
	}
}

//fungsi untuk mendapatkan data grab playlists
function grabyoutubeplaylists($chanel){
	$url = "$chanel/playlists";
	$get = file_get_contents($url);

	//data playlist
	$dom          = phpQuery::newDocument($get);
	$list         = pq("ul#channels-browse-content-grid li.channels-content-item.yt-shelf-grid-item");
	$name         = pq(".spf-link.branded-page-header-title-link.yt-uix-sessionlink");
	$gambar       = $list->find("img");
	$link         = $list->find("a.yt-uix-sessionlink.yt-uix-tile-link.spf-link.yt-ui-ellipsis.yt-ui-ellipsis-2");
	$total_videos = $list->find("span.formatted-video-count-label b");

	//lakukan perulangan foreach untuk mengumpulkan semua data
	foreach ($list as $a => $value) {
		//data utama berita disini
		$data = array(
			"chanel"	   => $chanel,
			"name"         => $name->text(),
			"gambar"       => $gambar->eq($a)->attr("src"),
			"judul"        => $link->eq($a)->text(),
			"link"         => "http://youtube.com" . $link->eq($a)->attr("href"),
			"total_videos" => $total_videos->eq($a)->text()
			);

		//untuk melihat hasil
		print "<pre>";
		print_r($data);

		//jadikan data sebagai query
		$data     = http_build_query($data, "", "&");

		//gabungkan url save db dengan data field
		$data_get = "{$base_url}index.php/Csavedb/csavedbf?media=p&" . $data;

		//tampilkan data hasil dari request ajax
		//echo "status: " . file_get_contents($data_get);

		echo " " . $data_get;
	 //
	}
}

//lakukan foreach untuk setiap data url
foreach ($hasil["data"] as $key => $value) {
	//panggil dan oper nilai url dari masing masing chanel

	  chanelinfo($value->link);
	  grabyoutubevideos($value->link);
	  grabyoutubeplaylists($value->link);

	print "<p> ==================== end chanel ke-$key ====================";
}
print_r($hasil);
?>