<?php 

/**
* 
*/
class Cindex extends CI_Controller
{
	
	function sidebar(){
		
      	$this->load->model("Mselectdb");
      	$result2 = $this->Mselectdb->mselectdbf("chanel");

		$data["sidebar"] = array(
			"data"		 => $result2->result(),
			"data_total" => $result2->num_rows()
		);

		return $data["sidebar"];
	}

	function index()
	{
		$base_url = base_url();
		header("Location: {$base_url}index.php/Cindex/cindexf");
	}

	function cindexf($table = "videos", $column_order = "id", $order_by ="asc", $start = 0, $limit = 10, $page = 1){
		$this->load->model("Mindex");
		
		if($this->input->get("media") == "c"){
			$table = "chanel";
		}elseif($this->input->get("media") == "v"){
			$table = "videos";
		}elseif($this->input->get("media") == "p"){
			$table = "playlists";
		}

		if(isset($_GET["page"]) && isset($_GET["limit"])){
			$start = ceil(($this->input->get("page") * $this->input->get("limit")) - $this->input->get("limit") +1);
			 $page = $this->input->get("page");
		}
		
		$result = $this->Mindex->show($table, $column_order, $order_by, $start, $limit);
		$page_total = ceil($this->db->query("select * from $table")->num_rows() / $limit);
		$data_total = $this->db->query("select * from $table")->num_rows();

		if($this->input->get("media") == "v" && isset($_GET["c"]) && isset($_GET["videos"])){
			$result = $this->db->query("select * from videos where chanel='$_GET[c]' order by $column_order $order_by LIMIT $start,$limit");
		$page_total = ceil($this->db->query("select * from $table where chanel='$_GET[c]'")->num_rows() / $limit);
		$data_total = $this->db->query("select * from $table where chanel='$_GET[c]'")->num_rows();
		}elseif($this->input->get("media") == "p" && isset($_GET["c"]) && isset($_GET["playlists"])){
			$result = $this->db->query("select * from playlists where chanel='$_GET[c]' order by $column_order $order_by LIMIT $start,$limit");
		$page_total = ceil($this->db->query("select * from $table where chanel='$_GET[c]'")->num_rows() / $limit);
		$data_total = $this->db->query("select * from $table where chanel='$_GET[c]'")->num_rows();
		}


      	$data["index"] = array(
	        "data"         => $result->result(),
	        "data_total"   => $data_total,
	        "table"        => $table,
	        "column_order" => $column_order,
	        "order_by"     => $order_by,
	        "page"         => $page,
	        "page_total"   => $page_total,
	        "limit"        => $limit,
	        "start"        => $start
      	);

      	$data["sidebar"] = $this->sidebar();

		if(!isset($_GET["media"]))
		{
			$result = $this->db->query("select id,link,name from chanel");

			$a = 0;
			foreach($result->result() as $key => $value)
			{
				$result2 = $this->db->query("select * from videos where chanel='$value->link' limit 7");

				$data["hasil"]["data"][] = $result2->result();
			}
				$this->load->view("vindex", $data);

		}
		else
		{
	      $this->load->view("vindex", $data);
		}


	}

	function cindexstream(){
		if($this->input->get("media") == "c"){
			$table = "chanel";
		}elseif($this->input->get("media") == "v"){
			$table = "videos";
		}elseif($this->input->get("media") == "p"){
			$table = "playlists";
		}

		$id = preg_replace("/\W+/", "", $_GET["id"]);
		$result = $this->db->query("select * from $table");
		$next_media = $this->db->query("select * from $table where id>$id LIMIT 1");
		$prev_media = $this->db->query("select * from $table where id<$id LIMIT 1");

		if ($next_media->num_rows() == 0) {
			$get_next_media = false;
		}else{
			$get_next_media = true;
		}

		if($prev_media->num_rows() == 0){
			$get_prev_media = false;
		}else{
			$get_prev_media = true;
		}

		 $data["hasil"] = array(
	        "data"         => $result->result(),
	        "data_total"   => $result->num_rows(),
	        "table"        => $table,
	        "get_next_media" => $get_next_media,
	        "get_prev_media" => $get_prev_media,
	        "next_media"   => $next_media->result(),
	        "prev_media"   => $prev_media->result()
      	);

		 $data["sidebar"] = $this->sidebar();

		$this->load->view("vindexstream", $data);
	}

	function cari($table = "videos", $column_order = "id", $order_by ="asc", $start = 0, $limit = 10, $page = 1)
	{
		$data["sidebar"] = $this->sidebar();
		$_GET["q"] = str_replace("990", " ", preg_replace("/\W/", "", preg_replace("/\s/", "990", $_GET["q"])));


		if(isset($_GET["page"]) && isset($_GET["limit"])){
			$start = ceil(($this->input->get("page") * $this->input->get("limit")) - $this->input->get("limit") +1);

			 $page = $this->input->get("page");
		}

		if($this->input->get("media") == "v"){
			// if($this->db->query("select * from videos where judul LIKE '%$_GET[q]%'")->num_rows <=  ($this->input->get("page") * $this->input->get("limit")))
			// {
			// 	$start = 0;
			// }
			$result = $this->db->query("select * from videos where judul LIKE '%$_GET[q]%' order by $column_order $order_by LIMIT $start,$limit");
		$page_total = ceil($this->db->query("select * from videos where judul LIKE '%$_GET[q]%'")->num_rows() / $limit);
		$data_total = $this->db->query("select * from videos where judul LIKE '%$_GET[q]%'")->num_rows();
		}elseif($this->input->get("media") == "p"){
			// if($this->db->query("select * from playlists where judul LIKE '%$_GET[q]%'")->num_rows <= ($this->input->get("page") * $this->input->get("limit")))
			// {
			// 	$start = 0;
			// }

			$result = $this->db->query("select * from playlists where judul LIKE '%$_GET[q]%' order by $column_order $order_by LIMIT $start,$limit");
		$page_total = ceil($this->db->query("select * from playlists where judul LIKE '%$_GET[q]%'")->num_rows() / $limit);
		$data_total = $this->db->query("select * from playlists where judul LIKE '%$_GET[q]%'")->num_rows();
		}
		elseif($this->input->get("media") == "c"){
			if($this->db->query("select * from chanel where name LIKE '%$_GET[q]%'")->num_rows <= ($this->input->get("page") * $this->input->get("limit")))
			{
				$start = 0;
			}
			$result = $this->db->query("select * from chanel where name LIKE '%$_GET[q]%' order by $column_order $order_by LIMIT $start,$limit");
		$page_total = ceil($this->db->query("select * from chanel where name LIKE '%$_GET[q]%'")->num_rows() / $limit);
		$data_total = $this->db->query("select * from chanel where name LIKE '%$_GET[q]%'")->num_rows();
		}

		  $data["index"] = array(
	        "data"         => $result->result(),
	        "data_total"   => $data_total,
	        "column_order" => $column_order,
	        "order_by"     => $order_by,
	        "page"         => $page,
	        "page_total"   => $page_total,
	        "limit"        => $limit,
	        "start"        => $start
      	);

	   $this->load->view("vcari", $data);
	}

	function cindexf2()
	{


	}

}
 ?>