<?php
	session_start();
	require('db.php');
	$session = $_SESSION['username'];
	$query = "SELECT * FROM `users` WHERE kullanici_adi='$session'";
	$result = mysqli_query($db, $query) or die(mysqli_error($db));
	$row = mysqli_fetch_assoc($result);
	$kullaniciMod = "";
	$userid = $row['id'];
	$username = $row['kullanici_adi'];
	$pass = $row['sifre'];
	$isim = $row['isim_soyisim'];
	$email = $row['email'];
	$phone = $row['telefon'];
	$adres = $row['adres'];
	$facebook = $row['facebook'];
	$twitter = $row['twitter'];
	$instagram = $row['instagram'];
	$website = $row['website'];

	if (isset($_POST['submit'])) {
		$new_name = $_POST['isim_soyisim'];
		$new_pass = $_POST['sifre'];
		$new_email = $_POST['email'];
		$new_phone = $_POST['telefon'];
		$new_adres = $_POST['adres'];
		$new_facebook = $_POST['facebook'];
		$new_twitter = $_POST['twitter'];
		$new_instagram = $_POST['instagram'];
		$new_website = $_POST['website'];

		$add_query = "UPDATE users SET sifre='$new_pass' , isim_soyisim='$new_name', telefon='$new_phone', adres='$new_adres', email='$new_email', facebook='$new_facebook' , twitter='$new_twitter' , instagram='$new_instagram' , website='$new_website' WHERE id='$userid'";

		$sql = mysqli_query($db, $add_query) or die(mysqli_error($db));
		if ($sql) {
			header("Refresh: 2; url=index.php");
			echo "Bilgileriniz Güncellendi.";
		}
		else{
			echo "HATA";
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
	<title>Profil Düzenle</title>
	<style type="text/css">
		.container{
			margin: auto;
			width: 100%;
			max-width: 720px;
			border: 1px solid #333;
			border-radius: 8px;
			box-sizing: border-box;
		}
		form{
			display: grid;
			padding: 8px;
			grid-template-columns: 1fr 3fr;
			grid-gap: 8px;
		}
		input[type="submit"]{
			grid-column: 1/3;
			border-radius: 8px;
			border: 1px solid green;
			background-color: white;
			color: green;
			padding: 8px;
		}
		label{
		    display:flex;
		    align-items: center;
			width: 100%;
			font-weight: bold;
		}
		input{
			width: 100%;
			border-radius: 4px;
			border: 1px solid gray;
			overflow: auto;
			padding-left: 8px;
			box-sizing : border-box;
		}
		input[type="submit"]:hover{
			color: white;
			background-color: green;
			width: 100%;
		}
		h3{
			grid-column: 1/3;
			text-align: center;
		}
	</style>
</head>
<body>
<?php include('header.php') ?>

<div class="container">
	<h3>Profili Düzenle: <?=$username?></h3>
	<form method="POST">
		<label for="isim_soyisim">İsim Soyisim:</label>
		<input type="text" name="isim_soyisim" value="<?=$isim?>">
		<label for="email">Email Adresi:</label>
		<input type="text" name="email" value="<?=$email?>">
		<label for="sifre">Şifre:</label>
		<input type="password" name="sifre" value="<?=$pass?>">
		<label for="telefon">Telefon Numarası:</label>
		<input type="text" name="telefon" value="<?=$phone?>">
		<label for="adres">Adres:</label>
		<input type="text" name="adres" value="<?=$adres?>">
		<label for="facebook">Facebook Profili:</label>
		<input type="text" name="facebook" value="<?=$facebook?>">
		<label for="twitter">Twitter Profili:</label>
		<input type="text" name="twitter" value="<?=$twitter?>">
		<label for="instagram">Instagram Profili:</label>
		<input type="text" name="instagram" value="<?=$instagram?>">
		<label for="website">Website URL:</label>
		<input type="text" name="website" value="<?=$website?>">
        <input type="submit" value="Bilgileri Kaydet" name="submit">
	</form>
</div>
</body>
</html>