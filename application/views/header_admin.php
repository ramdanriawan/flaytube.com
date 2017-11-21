<?php include "cookie.php"; error_reporting(0); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <!--  include library js -->
    <script src="../../node_modules/jquery/dist/jquery.min.js" charset="utf-8"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js" charset="utf-8"></script>
    <script src="../../node_modules/gspinner/dist/js/g-spinner.min.js"></script>

    <!-- include library css -->
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../node_modules/gspinner/dist/css/gspinner.min.css">

    <!--  include file js sendiri -->
    <script src="../../script/script_admin.php" charset="utf-8"></script>

    <!--  include file css sendiri -->
    <link rel="stylesheet" href="../../css/style.css">
  </head>
  <body>

  <div class="container-fluid" id="container-fluid-header">
    <div class="container" id="container-header">

    <!-- row header -->
      <div class="row" id="row-header">
        <!-- untuk judul website -->
        <div class="col-md-4 col-xs-12">
          <span><a href="<?php echo base_url();?>" id="logo">Grabyoutube</a></span>
        </div>

        <!-- untuk link  -->
        <div class="col-md-8 col-xs-12" id="menu_header">
          <ul class="nav nav-tabs nav-justified">
            <li class="<?php print $this->input->get('cchanel_admin');?>"><a href="cadminf?media=c&cchanel_admin=active" >Chanel</a></li>
            <li class="<?php print $this->input->get('cvideos_admin');?>"><a href="cadminf?media=v&cvideos_admin=active">Videos</a></li>
            <li class="<?php print $this->input->get('cplaylists_admin');?>"><a href="cadminf?media=p&cplaylists_admin=active">Playlists</a></li>
            <li><button type="button" class="btn btn-success" id="btn-get-data" style="margin: 0 10px;">Get Data</button></li>
            <li><a href="<?php echo "http://{$base_url}index.php/Cadmin/clogin?authentication=false";?>"><span class="glyphicon glyphicon-user" id="admin_login"> Logout</span></a></li>
          </ul>
        </div>
      </div>

    </div>
  </div>

  <div id="modal-get-data">
    <div id="loader-get-data">
      
    </div>

    <div class="col-md-8 col-md-offset-2" style="color: white;">
      <h1>Harap Tunggu Sampai Request Selesai Mengupdate Data!</h1>
    </div>
  </div>