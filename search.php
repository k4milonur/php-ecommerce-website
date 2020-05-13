<?php 
	session_start();
	require('db.php');


?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="stil.css">
	<script type="text/javascript" src="js.js"></script>
	<title>Arama Paneli</title>
	<style>
	    .search-form{
	        display:grid;
	        grid-template-columns: 4fr 1fr;
	        width: 100%;
	        margin: auto;
	        max-width: 640px;
	    }
	    .search_container{
	        text-align:center;
	    }
	</style>
</head>
<body>

	<?php include('header.php') ?>

	<form method="GET" class="search-form">
	    <input type="text" name="arama">
	    <input type="submit" value="ARA">
	</form>
	
	<?php
	if (isset($_GET['arama'])) {
		$term = $_GET['arama'];
		$search_query = "SELECT * FROM urunler WHERE title LIKE '%{$term}%' or description LIKE '%$term%'";

		$results = mysqli_query($db, $search_query);

	
	?>

	<div class="search_container">
		<h3><?=$term?> için ürün sonuçları</h3>
		<?php
			if (mysqli_num_rows($results) <= 0) {
				echo "<p style='text-align:center'>Sonuç Bulunamadı...</p>";
			}
			else{ ?> 
				<div class="container">
				<?php
				while ($row = mysqli_fetch_array($results)) { ?>
				
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
			<?php } ?>
				</div>
		<?php	} mysqli_data_seek($results, 0);
	    }
		?>

	</div>

</body>
</html>