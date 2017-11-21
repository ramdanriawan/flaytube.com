<?php 



class Ctesturl extends CI_Controller
{
  
  function Ctesturlf()
  {
    $data["file"] = $this->input->get("file");
    $this->load->view("vtesturl", $data);
  }
}
 ?>