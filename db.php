<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'id13531857_kamilonur');
   define('DB_PASSWORD', '-~GHCfiYX[my|0m/');
   define('DB_DATABASE', 'id13531857_ceng');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   
   if ($db == false) {

   	die("Veritabanına Bağlanamadı.... " . mysqli_connect_error());

   }
?>