<?php
	session_start();
	require('db.php');

	if (isset($_POST['submit'])) {
		$username = $_POST['kullanici_adi'];
		$pass = $_POST['sifre'];
		$isim = $_POST['isim_soyisim'];

		$register_query = "INSERT INTO users (kullanici_adi,isim_soyisim,sifre) VALUES('$username', '$isim', '$pass')";

		$sql = mysqli_query($db, $register_query) or die(mysqli_error($db));

		if ($sql) {
			header("Refresh: 2; url=login.php");
			echo "Kayıt Başarılı, Giriş Yapabilirsin.";
		}
		else{
			echo "Hata! Tekrar Dene.";
		}


	}

?>



<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="header.css">
	<script type="text/javascript" src="js.js"></script>
	<title></title>
	<style type="text/css">
		.container{
			display: block;
			margin: auto;
			max-width: 640px;
			width: 100%;
			border: 1px solid green;
			box-sizing: border-box;
		}
		form{
			display: grid;
			grid-template-columns: 1fr 3fr;
		    padding: 8px;
		}
		input[type="submit"]{
			grid-column: 1/3;
			border-radius: 8px;
			border: 1px solid green;
			background-color: white;
			color: green;
		}
		label{
			width: 100%;
			margin-top: 16px;
			margin-bottom: 16px;
			padding-top: 8px;
			padding-bottom: 8px;
			font-weight: bold;
		}
		input{
			border-radius: 4px;
			border: 1px solid gray;
			margin-top: 16px;
			margin-bottom: 16px;
			padding-top: 8px;
			padding-bottom: 8px;
			padding-left: 8px;
		}
		input[type="submit"]:hover{
			color: white;
			background-color: green;
		}
		h3{
			grid-column: 1/3;
			text-align: center;
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
	<h3>Kayıt Ol</h3>
	<form method="POST">
		<label for="kullanici_adi">Kullanıcı Adı:</label>
		<input type="text" name="kullanici_adi">
		<label for="isim_soyisim">İsim Soyisim:</label>
		<input type="text" name="isim_soyisim">
		<label for="sifre">Şifre:</label>
		<input type="password" name="sifre">
        <input type="submit" value="Kayıt Ol" name="submit">
	</form>
</div>
</body>
</html>