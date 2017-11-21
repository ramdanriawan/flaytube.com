<?php

 class Csavedb extends CI_Controller
 {

 	//fungsi untuk save ke database
 	function csavedbf()
 	{

    // load model untuk save ke database
    $this->load->model("Msavedb");

    //===============================================//
    if($this->input->get("media") == "v"){
      $table = "videos";

      //list data yang akan disimpan ke database
      $file = array(
        "chanel"      => $this->input->get("chanel"),
        "name"        => $this->input->get("name"),
        "gambar"      => $this->input->get("gambar"),
        "judul"       => $this->input->get("judul"),
        "link"        => $this->input->get("link"),
        "time"        => $this->input->get("time")
      );

    //simpan boolean ke variable $nilai
    $nilai = $this->Msavedb->msavedbf($file, $table);

    } else if($this->input->get("media") == "p"){
      $table = "playlists";

      //list data yang akan disimpan ke database
      $file = array(
        "chanel"       => $this->input->get("chanel"),
        "name"         => $this->input->get("name"),
        "gambar"       => $this->input->get("gambar"),
        "judul"        => $this->input->get("judul"),
        "link"         => $this->input->get("link"),
        "total_videos" => $this->input->get("total_videos")
      );

    //simpan boolean ke variable $nilai
    $nilai = $this->Msavedb->msavedbf($file, $table);

    } else if($this->input->get("media") == "c"){
      $table = "chanel";

      //list data yang akan disimpan ke database
      $file = array(
        "link"       => $this->input->get("link"),
        "logo"       => $this->input->get("logo"),
        "name"       => $this->input->get("name"),
        "subscriber" => $this->input->get("subscriber"),
        "videos"     => $this->input->get("videos"),
        "playlists"  => $this->input->get("playlists")
      );

      $cond_column = "link";
      $cond_data   = $this->input->get("link");
      $nilai = $this->Msavedb->msavedbupdate($file, $table, $cond_column, $cond_data);
    }
    //===============================================//

    //=================================================//
    if ($nilai) {
      $data["status"] = "Success";
      $this->load->view("vsavedb", $data);
    }else{
      $data["status"] = "Duplicate Entry!";
      $this->load->view("vsavedb", $data);
    }
    //=================================================//
  }

  //fungsi untuk save hanya satu kolom table
  function csavedbcolumn(){
    $file     = $this->input->get("file");
    $table    = $this->input->get("table");
    $column   = $this->input->get("column");
    $kategory = $this->input->get("kategory");

    $array = array(
      "link"     => $file,
      "kategory" => $kategory
    );

  	$nilai = $this->db->insert("chanel", $array);

  	if($nilai){
  		$data["status"] = "success";
  	}else{
  		$data["status"] = "false";
  	}

  	$this->load->view("vsavedb", $data);
  }
 }
