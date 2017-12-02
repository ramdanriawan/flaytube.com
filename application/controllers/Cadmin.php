<?php
/**
 *
 */
 class Cadmin extends CI_Controller
 {

 	function cadminf()
 	{
    $this->load->model("Mindex");
    
    if($this->input->get("media") == "c"){
      $table = "chanel";
    }else if($this->input->get("media") == "v"){
      $table = "videos";
    }else if($this->input->get("media") == "p"){
      $table = "playlists";
    }else {
      $table = "videos";
    }
    
    $column_order = "id";
    $order_by     = "ASC";
    
    if(!isset($_GET["page"], $_GET["limit"])){
      $page = 1;
      $limit = 10;
      $start = 0;
    }else {
      $page         = (int) ceil($this->input->get("page"));
      $limit        = (int) ceil($this->input->get("limit"));
      $start        = (int) ceil(($page * $limit) - $limit) + 1;
    }
    
    $hasil      = $this->Mindex->show($table, $column_order, $order_by, $start, $limit);
    $data_total = $this->db->query("select * from $table");
    $page_total = ceil($data_total->num_rows() / $limit);
    
      $data["hasil"] = array(
        "data"         => $hasil->result(),
        "data_total"   => $data_total->num_rows(),
        "table"        => $table,
        "column_order" => $column_order,
        "order_by"     => $order_by,
        "page"         => $page,
        "page_total"   => $page_total,
        "limit"        => $limit,
        "start"        => $start
      );

 		$this->load->view("vadmin", $data);
 	}
  
  function cedit_admin()
  {
    if ($this->input->get("media") == "c"){
      $table = "chanel";
    }elseif($this->input->get("media") == "p"){
      $table = "playlists";
    }elseif($this->input->get("media") == "v"){
      $table = "videos";
    }else{
      die("Media Tidak Dapat Ditemukan");
    }
    
    $sql = "select * from $table where id=$_GET[id]";
    $hasil = $this->db->query($sql);
    
        
    $data["hasil"] = array(
      "data"         => $hasil->result(),
      "data_total"   => $hasil->num_rows(),
      "table"        => $table,
    );
    
    $this->load->view("vedit_admin", $data);
  }

  function clogin(){
    $this->load->view("vlogin");
  }
 } ?>
