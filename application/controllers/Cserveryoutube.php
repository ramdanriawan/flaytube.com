<?php 
/**
 * 
 */
 class Cserveryoutube extends CI_Controller
 {
 	
 	function cserveryoutubef()
 	{
 		//result yang di dapat dari model mselctdb
 		$result = $this->db->query("select * from chanel");

 		//openr melalui variabel hasil
 		$data["hasil"] = array(
 							"data"       => $result->result(),
 							"total_data" => $result->num_rows()
 						);

 		//load dan oper datanya;
 		$this->load->view("vserveryoutube", $data);
 	}

 }
 ?>