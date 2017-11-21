<?php
/**
*
*/
class Msavedb extends CI_Model
{
	//fungsi untuk mencek duplicate data
	function mcheckduplicaterowf($sql)
	{
		//query untuk save ke database
		$query = $this->db->query($sql);

		//statement if untuk cek jumlah baris output
		if($query->num_rows() == 0){
			return true;
		}else {
			return false;
		}
	}

	//fungsi untuk save ke database
	function msavedbf($file)
	{
		$sql   = "select link from videos where link ='$file[link]'";
		$nilai = $this->mcheckduplicaterowf($sql);

		if($nilai){
			return $this->db->insert("videos", $file);
		}else {
			return false;
		}
	}

	//fungsi untuk
}
 ?>
