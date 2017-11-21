<?php error_reporting(0);
if($_GET["authentication"] == "false" && !isset($_COOKIE["username"])){
		echo "<script>alert('Harap Login Dulu!');</script>";
	}elseif($_GET["authentication"] == "false" && isset($_COOKIE["username"])){
		setcookie("username", "", time() -1, "/");
		header("Location: {$base_url}index.php/Cadmin/clogin");
	}else if(!isset($_GET["authentication"]) && isset($_COOKIE["username"])){
		header("Location: {$base_url}index.php/Cadmin/cadminf");
	}
?>
<?php include "header.php"; ?>

<div class="container" id="container-body">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<form class="form-horizontal" action="" method="post">

				<div class="form-group input-group">
					<h3>Login Admin</h3>
				</div>

				<div class="input-group form-group">
					<span class="input-group-addon">
						<i class="glyphicon glyphicon-user"></i>
					</span>
					<input class="form-control" type="text" name="username" placeholder="Username">
				</div>

				<div class="input-group form-group">
					<span class="input-group-addon">
						<i class="glyphicon glyphicon-lock"></i>
					</span>
					<input class="form-control" type="password" name="password" placeholder="Password">
				</div>

				<div class="form-group col-xs-6">
					<input class="form-control btn btn-primary col-xs-5" type="submit" name="submit" value="Login">
				</div>

				<div class="form-group col-xs-6">
					<input class="form-control btn btn-danger col-xs-5" type="reset" name="submit" value="Reset">
				</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php include 'footer_admin.php'; ?>

<?php 
	if (isset($_POST["username"]) && isset($_POST["password"])) {
		$username = preg_replace("/\W/", "", $_POST["username"]);
		$password = preg_replace("/\W/", "", $_POST["password"]);

		$result = $this->db->query("select * from admin where username = '$username' AND password = '$password'");

		if($result->num_rows() > 0){
			setcookie("username", $_POST["username"], time()+10000000, "/");
			header("Location: {$base_url}index.php/Cadmin/cadminf");
		}else{
			echo "<script>alert('Kombinasi username dan password salah!');</script>";
		}
	}
?>
