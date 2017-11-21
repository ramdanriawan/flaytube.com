<?php 

/**
 * 
 */
 class Ctest extends CI_Controller
 {
 	
 	function index()
 	{
 		$array1 = "data1";
 		$array2 = "data2";

 		$data["array1"] = $array1;
 		$data["array2"] = $array2;

 		$this->load->view("vtest", $data);
 	}
 } ?>