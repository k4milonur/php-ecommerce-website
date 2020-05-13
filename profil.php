<?php
	session_start();
	require('db.php');
	$session = $_SESSION['username'];
	$query = "SELECT * FROM `users` WHERE kullanici_adi='$session'";
	$result = mysqli_query($db, $query) or die(mysqli_error($db));
	$row = mysqli_fetch_assoc($result);
	$kullaniciMod = "";
	$adminpanel = "";
	$userid = $row['id'];
	$username = $row['kullanici_adi'];
	$isim = $row['isim_soyisim'];
	$email = $row['email'];
	$phone = $row['telefon'];
	$adres = $row['adres'];
	$facebook = $row['facebook'];
	$twitter = $row['twitter'];
	$instagram = $row['instagram'];
	$website = $row['website'];

	if ($row['admin'] == 0) {
		$kullaniciMod = "Admin";
		$adminpanel = "<a href='admin.php' style='float:right'> Admin Paneline Git </a>";
	}
	else {
		$kullaniciMod = "Normal";
		$adminpanel = "";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="header.css">
	<script type="text/javascript" src="js.js"></script>
	<title><?=$row['kullanici_adi']?> Profil Sayfası</title>
	<style type="text/css">
		h3{
			text-align: center;
		}
		.container{
			display: grid;
			grid-template-columns: auto auto;
			grid-gap: 8px;
			text-align: left;
			max-width: 600px;
			margin: auto;
			border: 1px solid #333;
			border-radius: 8px;
			box-sizing: border-box;
		}
		.item{
			margin: 8px;
			font-weight: bold;
			border-bottom: 1px solid gray;
		}
		.value{
			margin: 8px;
			border-bottom: 1px dashed gray;
			overflow: auto;
		}
		.value > a{
		    text-decoration: none;
		    color: green;
		}
		.container > a{
			margin: 8px;
			padding: 8px;
			border: 1px solid #333;
			border-radius: 4px;
			background-color: #333;
			color: white;
			font-weight: bold;
			text-decoration: none;
			text-align: center;
		}
		.baslik{
			grid-column: 1/3;
			padding-left: 8px;
			margin-left: 4px;
			margin-right: 4px;
			border-bottom: double;
			font-size: 20px;
			font-weight: bold;
		}
	</style>
</head>
<body>
	<?php include('header.php') ?>

	<h3>Kullanıcı Kontrol Paneli</h3>
	<div class="container">
		<p class="baslik">Kullanıcı Bilgileri</p>
		<p class="item">User ID:</p><p class="value"><?=$userid?></p>
		<p class="item">Kullanıcı Adı:</p><p class="value"><?=$username?></p>
		<p class="item">İsim Soyisim:</p><p class="value"><?=$isim?></p>
		<p class="item">Kullanıcı Modu:</p><p class="value"><?=$kullaniciMod?> <?=$adminpanel?></p>
		<p class="baslik">İletişim Bilgileri</p>
		<p class="item">Email:</p><p class="value"><?=$email?></p>
		<p class="item">Telefon:</p><p class="value"><?=$phone?></p>
		<p class="item">Adres:</p><p class="value"><?=$adres?></p>
		<p class="baslik">Sosyal Medya</p>
		<p class="item">Facebook:</p><p class="value"><a href='https://facebook.com/<?=$facebook?>'><?=$facebook?></a></p>
		<p class="item">Twitter:</p><p class="value"><a href='https://twitter.com/<?=$twitter?>'><?=$twitter?></a></p>
		<p class="item">Instagram:</p><p class="value"><a href='https://instagram.com/<?=$instagram?>'><?=$instagram?></a></p>
		<p class="item">Website:</p><p class="value"><a href='<?=$website?>'><?=$website?></a></p>
		<a href="index.php">Anasayfa</a><a href="update.php">Bilgileri Düzenle</a>
	</div>
</body>
</html>