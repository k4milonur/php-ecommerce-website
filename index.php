<?php
	session_start();
	require('db.php');
	if(isset($_GET['id'])){
	    unset($_GET['id']);
	}

	if (isset($_POST['sepete_ekle'])) {
		if (isset($_SESSION['sepet'])) {
			$item_array_id = array_column($_SESSION['sepet'], "id");
			if (!in_array($_GET["add"],$item_array_id)) {
				$count = count($_SESSION["sepet"]);
                $item_array = array(
					'id' => $_GET['add'],
					'name' => $_POST['hidden_name'],
					'price' => $_POST['hidden_price']
                );
                $_SESSION["sepet"][$count] = $item_array;
				echo '<script>alert("Ürün Eklendi")</script>';
			}
			else{
				echo '<script>alert("Ürün Zaten Eklendi")</script>';
			}
		}
		else{
			$item_array = array(
				'id' => $_GET['add'],
				'name' => $_POST['hidden_name'],
				'price' => $_POST['hidden_price'] );

			$_SESSION['sepet'][0] = $item_array;
			echo '<script>alert("Ürün Eklendi")</script>';
		}
	}

	

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="stil.css">
	<script type="text/javascript" src="js.js"></script>

	<title>Dynamic Web Programming Homework2</title>
</head>

<body>
	<?php include('header.php') ?>


	<div class="container">

		<?php 
			$product_query = "SELECT * FROM urunler ORDER BY id DESC";
			$products_list = mysqli_query($db, $product_query);
			while ($row = mysqli_fetch_array($products_list)) {
				?>
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
		<?php	}		?>
		
	</div>

	<footer></footer>
</body>
</html>