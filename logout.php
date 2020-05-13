<?php
	session_start();
	session_destroy();
	header("Refresh: 1; url=index.php");
	echo "<h1 style='text-align:center'>Başarı ile Çıkış Yapıldı ...</h1>";
?>