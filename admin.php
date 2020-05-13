<?php
	session_start();
	require('db.php');
	if (isset($_SESSION['username'])) {
		$username = $_SESSION['username'];
		$admin_check = "SELECT admin FROM users WHERE kullanici_adi='$username'";
		$result = mysqli_query($db,$admin_check);
		$ifadmin = mysqli_fetch_assoc($result);

		if ($ifadmin['admin']==1) {
			header("Refresh: 3; url=index.php");
			echo "Yönetici Değilsiniz !";
			exit();
		}
		else{
			$urunliste_query = "SELECT id,title FROM urunler";
			$urunliste = mysqli_query($db, $urunliste_query);
			$kategori_query = "SELECT * FROM kategoriler";
			$kategoriliste = mysqli_query($db, $kategori_query);
			$user_query = "SELECT * FROM users";
			$userliste = mysqli_query($db, $user_query);
		}
	}
	else {
		header("Refresh: 3; url=login.php");
		echo "Lütfen Giriş Yapın !";
		exit();
	}
	if (isset($_POST['submit_urunekle'])) {
		$title = $_POST['title'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		$cat = $_POST['kategori'];

		$image = $_FILES['image']['name'];
		$image_dir = "images/";
		$target = $image_dir . basename($image);

		if (!empty($image)) {
			move_uploaded_file($_FILES['image']['tmp_name'], $target);
			$add_product_query = "INSERT INTO urunler (title,description,price,image,kategori) VALUES('$title','$description','$price','$image','$cat')";
			$sql = mysqli_query($db, $add_product_query) or die(mysqli_error($db));
		}
		else{
			$add_product_query = "INSERT INTO urunler (title,description,price,kategori) VALUES('$title','$description','$price','$cat')";
			$sql = mysqli_query($db, $add_product_query) or die(mysqli_error($db));
		}

		if ($sql) {
			echo "<script>alert('BAŞARILI ! Yeni Ürün Eklendi !')</script>";
			echo '<meta http-equiv="refresh" content="0">';
		}
		else{
			header("Refresh: 2; url=admin.php");
			echo "<script>alert('HATA ! Ürün Eklenemedi !')</script>";
		}
	}
	if (isset($_POST['submit_urunsil'])) {
		$id = $_POST['to_remove'];
		$remove_query = "DELETE FROM urunler WHERE id='$id'";
		$sql = mysqli_query($db, $remove_query) or die(mysqli_error($db));
		if ($sql) {
			echo "<script>alert('BAŞARILI ! Seçilen Ürün SİLİNDİ !')</script>";
			echo '<meta http-equiv="refresh" content="0">';
		}
		else{
			echo "<script>alert('HATA ! Seçilen Ürün Silinemedi')</script>";
		}
	}
	if (isset($_POST['kategori_ekle'])) {
		$cat = $_POST['cat'];
		$cat_descp = $_POST['cat_aciklama'];
		$cat_query = "INSERT INTO kategoriler (kategori, aciklama) VALUES('$cat', '$cat_descp')";
		$sql = mysqli_query($db, $cat_query);
		if ($sql) {
			echo "<script>alert('BAŞARILI ! Yeni Kategori Eklendi...')</script>";
			echo '<meta http-equiv="refresh" content="0">';
		}
		else{
			echo "<script>alert('HATA ! Kategori EKLENEMEDİ !')</script>";
		}
	}
	if (isset($_POST['submit_kategorisil'])) {
		$id = $_POST['to_remove_cat'];
		$remove_query = "DELETE FROM kategoriler WHERE id='$id'";
		$sql = mysqli_query($db, $remove_query) or die(mysqli_error($db));
		if ($sql) {
			echo "Kategori Silindi.";
			echo '<meta http-equiv="refresh" content="0">';
		}
		else{
			echo "HATA. Kategori Silinemedi.";
		}
	}
	if (isset($_POST['submit_uyesil'])) {
		$id = $_POST['uye_sec'];
		
		$uyesil_query = "DELETE FROM users WHERE id='$id'";
		$sql = mysqli_query($db, $uyesil_query) or die(mysqli_error($db));
		if ($sql) {
			echo "<script>alert('BAŞARILI ! Seçilen Üye SİLİNDİ !')</script>";
			echo '<meta http-equiv="refresh" content="0">';
		}
		else{
			echo "<script>alert('HATA ! Seçilen Üye Silinemedi...')</script>";
		}
	}
	if (isset($_POST['submit_mod_change'])) {
		$id = $_POST['uye_sec'];
		$check = "SELECT admin FROM users WHERE id='$id'";
		$result = mysqli_query($db, $check) or die(mysqli_error($db));
		$ifadmin = mysqli_fetch_assoc($result);
		if ($ifadmin['admin']==1) {
			$mod_query = "UPDATE users SET admin=0 WHERE id='$id'";
			$sql = mysqli_query($db, $mod_query);
			if ($sql) {
				echo "<script>alert('Üye Modu ADMIN olarak Değiştirildi..')</script>";
				echo '<meta http-equiv="refresh" content="0">';
			}
			else{
				echo "<script>alert('Hata ! Üye Modu Değiştirilemedi ...')</script>";
			}
		}
		elseif($ifadmin['admin']==0){
			$mod_query = "UPDATE users SET admin=1 WHERE id='$id'";
			$sql = mysqli_query($db, $mod_query);
			if ($sql) {
			    echo "<script>alert('Üye Normal Kullanıcı Yapıldı ...')</script>";
				echo '<meta http-equiv="refresh" content="0">';
			}
			else{
			    echo "<script>alert('Hata ! Üye Modu Değiştirilemedi ...')</script>";
			}
		}
		else{
		    echo "<script>alert('Kullanıcı modu alınamadı')</script>";
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
	<title>Admin Paneli</title>
	<style type="text/css">
		.container{
			width: 100%;
			margin: auto;
			display: grid;
			grid-template-columns: 1fr 1fr;
			box-sizing: border-box;
			max-width: 800px;

		}
		.yonetim{
			border: 1px solid #333;
		}
		form{
			display: grid;
			grid-gap: 8px;
			grid-template-columns: 1fr 3fr;
			padding: 8px;
		}
		.urunsil > form{
			grid-template-columns: 1fr 2fr;
		}
		h2,h4{
			text-align: center;
		}
		label,input,select{
			width: 100%;
			padding: 8px;
		}
		input{
			border-radius: 4px;
			border-color: green;
			border: 1px solid #333;
			box-sizing: border-box;
		}
		input[type="submit"]{
			grid-column: 1/3;
			border-radius: 4px;
			border: 1px solid;
		}
		.inputekle{
		    background-color: white;
		    border-color: green;
		    color: green;
		}
		.inputekle:hover{
		    background-color: green;
		    color:white;
		}
		.inputsil{
		    background-color: white;
		    border-color: red;
		    color: red;
		}
		.inputsil:hover{
		    background-color: red;
		    color:white;
		}
		@media only screen and (max-width: 640px){
			.container{
				display: grid;
				grid-template-columns: auto;
				width: 100%;
				margin: auto;
			}
		}
	</style>
</head>
<body>
	<?php include('header.php') ?>

	<div class="container">
		<div class="yonetim">
			<h2>Ürün Yönetimi</h2>
			<h4>Ürün Ekle</h4>
			<div class="urunekle">
				<form method="POST" enctype="multipart/form-data">
					<label for="title">Ürün Başlığı</label>
					<input type="text" name="title" size="25" required="">
					<label for="description">Ürün Açıklaması</label>
					<input type="text" name="description" size="99" required="">
					<label for="price">Ürün Fiyatı</label>
					<input type="number" name="price" required="">
					<label for="image">Ürün Görseli Seçin</label>
					<input type="file" name="image">
					<label for="kategori">Kategori Seç</label>
					<select name="kategori">
						<?php
							while ($row = mysqli_fetch_array($kategoriliste)) {
						?>
								<option value="<?=$row['id']?>"><?=$row['kategori']?></option>
						<?php } 
							mysqli_data_seek($kategoriliste, 0);

						?>
					</select>

					<input type="submit" name="submit_urunekle" value="Ürün Ekle" class="inputekle">
				</form>
			</div>
			<h4>Ürün Sil</h4>
			<div class="urunsil">
				<form method="POST">
					<label for="to_remove">Silinecek Ürünü Seçin</label>
					<select name="to_remove" id="to_remove">
						<?php
							while ($row = mysqli_fetch_array($urunliste)) {
						?>
								<option value="<?=$row['id']?>"><?=$row['id']?> - <?=$row['title']?></option>
						<?php } ?>
					</select>
					<input type="submit" name="submit_urunsil" value="Seçilen Ürünü Sil" class="inputsil">
				</form>
			</div>
		</div>
		<div class="yonetim">
			<h2>Kategori Yönetimi</h2>
			<h4>Kategori Ekle</h4>
			<div class="kategoriekle">
				<form method="POST">
					<label for="cat">Kategori İsmi</label>
					<input type="text" name="cat" size="25" required>
					<label for="cat_aciklama">Kategori Açıklaması</label>
					<input type="text" name="cat_aciklama" size="25" required>
					<input type="submit" name="kategori_ekle" value="Kategori Ekle" class="inputekle">
				</form>
				
			</div>
			<h4>Kategori Sil</h4>
			<div class="kategorisil">
				<form method="POST">
					<label for="to_remove_cat">Kategori Seçin</label>
					<select name="to_remove_cat" id="to_remove_cat">
						<?php
							while ($row = mysqli_fetch_array($kategoriliste)) {
						?>
								<option value="<?=$row['id']?>"><?=$row['id']?> - <?=$row['kategori']?></option>
						<?php } ?>
					</select>
					<input type="submit" name="submit_kategorisil" value="Seçilen Kategoriyi Sil" class="inputsil">
				</form>
				
			</div>
		</div>
		<div class="yonetim">
			<h2>Üye Yönetimi</h2>
			<form method="POST" class="user_form">
				<label>Üye Seçin</label>
				<select name="uye_sec">
						<?php
							while ($row = mysqli_fetch_array($userliste)) {
								if ($row['admin']==0) {
									$mod = "Admin";
								}
								else{
									$mod = "Normal";
								}
								if ($row['kullanici_adi'] != $_SESSION['username']) { ?>
									<option value="<?=$row['id']?>"><?=$row['id']?> - <?=$row['kullanici_adi']?> - <?=$mod?></option>
						<?php	}
							}
						?>		
				</select>
				<input type="submit" name="submit_uyesil" value="Kullanıcıyı Sil" class="inputsil">
				<input type="submit" name="submit_mod_change" value="Admin/Normal Yap" class="inputekle">
			</form>
		</div>
	</div>

</body>
</html>