<?php
session_start();
include 'dbconnect.php';

if(isset($_SESSION['role'])){
	header("location:stock");
}

if(isset($_GET['pesan'])){
		if($_GET['pesan'] == "gagal"){
			echo "Wrong Username or Password!";
		}else if($_GET['pesan'] == "logout"){
			echo "You have successfully logged out of the system";
		}else if($_GET['pesan'] == "belum_login"){
			echo "You must Login";
		}else if($_GET['pesan'] == "noaccess"){
			echo "Access Closed";
	}
}


if(isset($_POST['btn-login']))
{
 $uname = mysqli_real_escape_string($conn,$_POST['username']);
 $upass = mysqli_real_escape_string($conn,md5($_POST['password']));

 // menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($conn,"select * from slogin where username='$uname' and password='$upass';");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
 
// cek apakah username dan password di temukan pada database
if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);
 
 if($data['role']=="stock"){
		// buat session login dan username
		$_SESSION['user'] = $data['nickname'];
		$_SESSION['user_login'] = $data['username'];
		$_SESSION['id'] = $data['id'];
		$_SESSION['role'] = "stock";
		header("location:stock");

 }
 else
 {
  header("location:index.php?pesan=gagal");

 }
 
}

}


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>System Login</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-144808195-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-144808195-1');
	</script>
    <script src="jquery.min.js"></script>
	<style>body{background-image:url("bg.jpg");}
	@media screen and (max-width: 600px) {
h4{font-size:85%;}
}
	</style>
	<link rel="icon" 
      type="image/png" 
      href="favicon.png">
  </head>
  <body>
  
  <div align="center">
  
  <img src="logo2.png" width="6%" style="margin-top:11%" \>

	<br \><br \>
			<div class="container" style=width:25%>
					<div style="color:white">
					<label>Login information for Demo :</label><br \>
					<label>Username & Password : guest</label><br \>
					</div>
                <form method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Username" name="username" autofocus>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary" name="btn-login">Login</button>
			
                </form>
			
			<br \>
        </div></div>
       
     
	
	
  </body>
</html>
