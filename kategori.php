<?php 
	session_start();
	require('db.php');

	$cat_query = "SELECT * FROM kategoriler";
	$cat_list = mysqli_query($db,$cat_query);

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="stil.css">
	<script type="text/javascript" src="js.js"></script>
	<title></title>
	<style type="text/css">
		.kategori{
        	margin: auto;
        	padding: 8px;
        	max-width: 1100px;
        	display: grid;
        	grid-template-columns: repeat(auto-fit,minmax(200px,2fr));
        	grid-gap: 8px;
        	box-sizing: border-box;

		}
		.kategori > a{
		    margin: auto;
		    padding: 8px;
		    background-color: #555;
		    color: white;
		    text-align:center;
		    border-radius: 4px;
		    box-sizing: border-box;
		    text-decoration: none;
		    box-shadow: 0px 2px 2px 0px #333;
		    
		}
		.kategori > a:hover{
		    background-color: green;
		}
	</style>
</head>
<body>
	<?php include('header.php') ?>
	<div class="kategori_container">
	    <div class="kategori">
	<?php while ($row = mysqli_fetch_array($cat_list)) { ?>
		
			<a href="kategori.php?id=<?=$row['id']?>"><?=$row['kategori']?> Ürünleri Listele</a>
		
	<?php } ?>
	</div>
        <div class="container">
	<?php
		if (isset($_GET['id'])) {
			$list_id = $_GET['id'];
			$query = "SELECT * FROM urunler WHERE kategori = '$list_id'";
			$product_list = mysqli_query($db, $query);

			while ($row = mysqli_fetch_array($product_list)) { ?>
				
				<div class="urun">
					<img src="images/<?=$row['image']?>" alt="Image">
					<h3><?=$row['title']?></h3>
					<p> <?=$row['description']?></p>
					<span> <?=$row['price']?> TL</span>
					<form method="POST" action="index.php?add=<?=$row['id']?>">
						<input type="hidden" name="hidden_name" value="<?=$row['title']?>">
						<input type="hidden" name="hidden_price" value="<?=$row['price']?>">
						<input type="submit" name="sepete_ekle" value="SEPETE EKLE">
					</form>
				</div>
			<?php }

		}
	?>
		</div>
	</div>
</body>
</html>