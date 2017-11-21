<?php

/**
 *
 */
 class Csavedb extends CI_Controller
 {

 	//fungsi untuk save ke database
 	function csavedbf()
 	{

   // load model untuk save ke database
 		$this->load->model("Msavedb");

 		$file = [
  		"gambar"      => $this->input->get("gambar"),
  		"judul"       => $this->input->get("judul"),
  		"link"        => $this->input->get("link"),
  		"time"        => $this->input->get("time"),
		];

	$nilai = $this->Msavedb->msavedbf($file);

		if ($nilai) {
			$data["status"] = "Success";
			$this->load->view("vsavedb", $data);
		}else{
			$data["status"] = "Duplicate Entry!";
			$this->load->view("vsavedb", $data);
 		 }
 	}


 }

 }
