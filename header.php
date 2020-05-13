<header class="desktop-header">
	<h1>TechnoShop</h1>
	<ul>
		<?php if (isset($_SESSION['username'])) { ?>
			<li><a href="logout.php">Çıkış</a></li>
			<li><a href="profil.php"><?php echo $_SESSION['username']; ?></a></li>
		<?php } else { ?>
			<li><a href="login.php">Giriş</a></li>
			<li><a href="register.php">Üye Ol</a></li>
		<?php } ?>
		<li><a href="search.php">Arama</a></li>
		<li><a href="sepet.php">Sepet</a></li>
		<li><a href="kategori.php">Kategoriler</a></li>
		<li><a href="index.php">Anasayfa</a></li>
	</ul>
</header>

<header class="mobile-header">
	<h1>TechnoShop</h1>
	<a href="javascript:void(0)" onclick="toggleMobileNav()"><i class="fa fa-bars"></i></a>
	<nav class="mobile-navbar" id="mobile-navbar">
		<a href="index.php">Anasayfa</a>
		<a href="kategori.php">Kategoriler</a>
		<a href="sepet.php">Sepet</a>
		<a href="search.php">Arama</a>
		<?php if (isset($_SESSION['username'])) { ?>
			<a href="profil.php"><?php echo $_SESSION['username']; ?></a>
			<a href="logout.php">Çıkış</a>
		<?php } else { ?>
			<a href="login.php">Giriş</a>
			<a href="register.php">Üye Ol</a>
		<?php } ?>
	</nav>
</header>