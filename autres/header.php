<!--
 Auteur : Houimli, Safa
Date de création : 12 septembre 2018
Description : Fichier header.php qui contient le header de toutes les pages du tp1
-->

<!DOCTYPE html>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Travail pratique #1</title>
<link rel="stylesheet" href="autres/style.css" type="text/css">
</head>

<body>
<header>
<nav>
	<h1 id="title">Informations m&#233;t&#233;orologiques</h1>
	<h2 id="current_date">
		<script langage="JavaScript"> 
			var now = new Date();
			var options={weekday:'long', year:'numeric', month:'long', day:'numeric'};
			var seconds = now.getSeconds();
			var minutes = now.getMinutes();
			if(seconds < 10) {
				seconds = '0'+seconds;
			}
			if(minutes<10) {
				minutes = '0'+minutes
			} 
			document.write("Le " + now.toLocaleDateString("fr-US", options));
			document.write(" - " + now.getHours() + ":"+minutes+":"+seconds);
		</script>
	</h2>
</nav>
</header>

<div class="container">
