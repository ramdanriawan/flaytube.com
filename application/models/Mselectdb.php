<?php 

/**
 * 
 */
 class Mselectdb extends CI_Model
 {
 	
 	function mselectdbf($table)
 	{
 		$sql = "select * from $table";
 		$query = $this->db->query($sql);

 		if ($query) {
 			return $query;
 		}else{
 			return "$table tidak dapat ditemukan, periksa kembali nama table!";
 		}
 	}


 } ?>