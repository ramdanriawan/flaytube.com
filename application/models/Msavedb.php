<?php

class Msavedb extends CI_Model
{
	//fungsi untuk mencek duplicate data
	function mcheckduplicaterowf($sql)
	{
		//query untuk save ke database
		$query = $this->db->query($sql);

		//==========================//
		if($query->num_rows() == 0){
			return true;
		}else {
			return false;
		}
		//========================//
	}

	//fungsi untuk save ke database
	function msavedbf($file, $table)
	{
		$sql   = "select link from $table where link ='$file[link]'";
		$nilai = $this->mcheckduplicaterowf($sql);

		//=========//
		if($nilai){
			return $this->db->insert("$table", $file);
		}else {
			return false;
		}
		//=======//
	}

	//fungsi untuk update data di database
	function msavedbupdate($file, $table, $cond_column, $cond_data){
		$query = $this->db->where($cond_column, $cond_data)->update($table, $file);

		if ($query) {
			return true;
		}else{
			return false;
		}
	}

	//fungsi untuk
	function msavedbcolumn($file, $table, $column){
		$sql = "select link from $table where link ='$file'";
		$query = $this->db->query($sql);
		
		if ($this->mcheckduplicaterowf($sql)) {
			$sql = "INSERT INTO $table ($column) VALUES('$file')";
			$query = $this->db->query($sql);
			return $query;
		}else {
			return false;
		}
	}
}
 ?>
