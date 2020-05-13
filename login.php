<?php  //Start the Session
session_start();
require('db.php');

if (isset($_POST['username']) and isset($_POST['password'])){

	$username = $_POST['username'];
	$password = $_POST['password'];

	$query = "SELECT * FROM `users` WHERE kullanici_adi='$username' and sifre='$password'";
	 
	$result = mysqli_query($db, $query) or die(mysqli_error($db));
	$count = mysqli_num_rows($result);

	if ($count == 1){
		$_SESSION['username'] = $username;
	}
	else{
		echo "Hatalı Giriş Yaptınız !";
	}
}

if (isset($_SESSION['username'])){
	$username = $_SESSION['username'];
	header("Refresh: 3; url=index.php");
	echo "<h1 style='text-align:center'>Giriş Başarılı... Hoşgeldin '$username'! Anasayfaya Yönlendiriliyorsunuz.</h1>";

}else{

?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="header.css">
	<script type="text/javascript" src="js.js"></script>
	<title>Giriş Ekranı</title>
	<style type="text/css">
		.container{
			display: block;
			margin: auto;
			max-width: 640;
			width: 100%;
			border: 1px solid green;
		}
		label{
			width: 100%;
			font-weight: bold;
		}
		input{
			width: 100%;
			border-radius: 4px;
			border: 1px solid gray;
			overflow: auto;
			margin-top: 8px;
			margin-bottom: 8px;
			padding-left: 8px;
		}
		input[type="submit"]{
			border-radius: 8px;
			padding-top: 8px;
			padding-bottom: 8px;
			border: 1px solid green;
			background-color: white;
			color: green;
		}
		input[type="submit"]:hover{
			color: white;
			background-color: green;
		}
		h2{
			text-align: center;
		}
		form{
		    padding: 8px;
		}
		@media only screen and (max-width: 640px){
			.container{
				width: 100%;
				margin: auto;
			}
		}
	</style>
</head>
<body>

	<?php include('header.php') ?>
	
<div class="container">
      <form method="POST">
        <h2>Kullanıcı Girişi</h2>
        <label for="username">Kullanıcı Adı</label>
  		<input type="text" name="username" placeholder="Kullanıcı Adınızı Girin ..." required>
        <label for="inputPassword">Password</label>
        <input type="password" name="password" placeholder="Şifrenizi Girin ..." required>
        <input type="submit" value="Giriş">
      </form>
</div>

</body>

</html>
<?php } ?>