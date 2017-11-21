<?php include 'header_admin.php'; ?>

<div class="container"  id="container-body">
	<div class="row">
		<div class="col-xs-6">
			<span><h1>List Videos</h1></span>
		</div>
	</div>
	
	<div class="row">
		<div class='table-responsive'>
		  <table class='table table-striped table-bordered table-hover table-condensed'>
		    <thead>
		      <tr>
		        <th>#ID</th>
		        <th>Chanel</th>
		        <th>Name</th>
		        <th>Gambar</th>
		        <th>Judul</th>
		        <th>Link</th>
		        <th>Time</th>
		        <th>Actions</th>
		      </tr>
		    </thead>
		    <tbody>
					<?php 
						$a = 0;
						foreach ($hasil["data"] as $key => $value) if($a <= $hasil["limit"]) {
							print "<tr><td>$value->id</td><td>$value->chanel</td> <td>$value->name</td> <td>$value->gambar</td><td>$value->judul</td><td>$value->link</td><td>$value->time</td>  <td><a href='{$base_url}index.php/Cadmin/cedit_admin?media=c&action=edit&id=$value->id'>Edit</a> | <a href='{$base_url}index.php/Cadmin/cadmin_edit?media=v&action=delete&id=$value->id'>Delete</a></td></tr>";
						}
					?>
		      <tr>
		        <td></td>
		      </tr>
		    </tbody>
		  </table>
		</div>
	</div>
	
	    
    <!-- row paging -->
    <div class="row">
      <nav>
        <ul class="pager">
          <!-- script untuk membuat paging -->
          <?php 
            for ($i=1; $i <= $hasil["page_total"]; $i++) { 
              print "<li><a href=?page=$i&limit=$hasil[limit]>$i</a></li>";
            }
          ?>
        </ul>
      </nav>
    </div>
</div>

<?php include 'footer_admin.php'; ?>