<?php
	session_start();
	require('db.php');

	if (isset($_POST['bosalt'])) {
		unset($_SESSION['sepet']);
		echo '<meta http-equiv="refresh" content="0">';
	}
	if (isset($_POST['sepettencikar'])) {
		$id = $_GET['cikar'];
		foreach ($_SESSION['sepet'] as $keys => $value) {
			if ($value['id'] == $id) {
				unset($_SESSION['sepet'][$keys]);
                echo '<script>alert("Ürün Sepetten Çıkartıldı.")</script>';
                echo '<script>window.location="sepet.php"</script>';

			}
		}
	}
	if (isset($_POST['tamamla'])){
	    if (isset($_SESSION['username'])){
	        $uname = $_SESSION['username'];
            echo '<script>alert("Sevgili ' . $uname . ' Siparişiniz Alındı. Teşekkürler")</script>';
            unset($_SESSION['sepet']);
	    }
	    else{
            echo '<script>alert("Lütfen Giriş Yapın.")</script>';
            echo '<script>window.location="login.php"</script>';
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
			display: grid;
			grid-template-columns: auto;
			width: 100%;
			max-width: 640px;
			margin: auto;
			border: 1px solid #333;
			border-radius: 8px;
			text-align: center;
			box-sizing: border-box;
			padding: 8px;
		}
		.container > span{
			text-align: right;
			padding: 8px;
		}
		.sepeturun{
			display: grid;
			grid-template-columns: 6fr 3fr 1fr;
			border-bottom: double;
			border-color: gray;
			border-style: 1px;
			grid-gap: 1px; 
			vertical-align: middle;
		}
		.sepeturun > *{
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.sepeturun > h4{
			margin: auto;
			overflow: auto;
		}
		.sepeturun > span{
			margin: auto;
		}
		.sepeturun > form > input[type="submit"]{
			color: white;
			background-color: red;
			border: 2px solid red;
			border-radius: 5px;
			text-align: center;
			margin: 4px;
		}
		form{
			display: grid;
			grid-template-columns: auto auto;
			grid-gap: 4px;
			margin: 8px;
		}
		form > input[type="submit"]{
			width: 100%;
			padding: 8px;
			color: white;
			border: 1px solid;
			border-radius: 4px;
		}
		form > input[name="tamamla"]{
			border-color: green;
			background-color: green;
		}
		form > input[name="bosalt"]{
			border-color: red;
			background-color: red;
		}
	</style>
</head>
<body>

	<?php include('header.php') ?>
	<div class="container">
		<h3>Alışveriş Sepeti</h3>

		<?php

			if (!empty($_SESSION['sepet'])) {

				$toplam = 0;
				
				foreach ($_SESSION['sepet'] as $key => $value){ ?>

					<div class="sepeturun">
						<h4><?=$value['name']?></h4>
						<span><?=$value['price']?> TL</span>
						<form method="POST" action="sepet.php?cikar=<?=$value['id']?>">						
							<input type="submit" name="sepettencikar" value="X">
						</form>
					</div>

			<?php 
					$toplam = $toplam + $value['price']; 
				} 
			?>
				<span><b>Sepet Toplamı:</b> <?=$toplam?> TL</span>
				<div class="tamamla">
					<form method="POST">
						<input type="submit" name="tamamla" value="Alışverişi Tamamla">
						<input type="submit" name="bosalt" value="Sepeti Boşalt">
					</form>
				</div>
		
		<?php } 
			else{
				echo '<h2 style="text-align:center">Sepetiniz Boş</h2>';
			}
		?>
</body>
</html>