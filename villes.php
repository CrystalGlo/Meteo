<?php 
/* 
Auteur : Houimli, Safa
Date de cr�ation : 12 septembre 2018
Description : villes.php est la deuxi�me page du tp1. Elle prend la ville s�lectionn�e dans le formulaire
de la page tp1.php, ouvre son fichier m�t�orologique et affiche les donn�es qu'il contient dans un tableau 
*/
include 'autres/header.php';

function getMeteo() {
	// obtenir le num�ro de la ville s�lectionn�e du formulaire de la page tp1.php
	$select_vil=$_GET["ville"];
	// ouvrir le fichier villes.txt pour avoir le nom du fichier de la ville s�lectionn�e
	$ficVil="http://www.iro.umontreal.ca/~dift1147/pages/TPS/tp1/villes.txt";
	$lignes=file($ficVil);
	// afficher un message d'erreur si la lecture du fichier est impossible
	if ($ficVil==false) {
		echo "Impossible de lire le fichier villes.txt";
		exit;
	}
	
	// lire la ligne sp�cifique � la ville s�lectionn�e dans le fichier villes.txt
	$select_ligne=$lignes[$select_vil];
	$str1=strtok($select_ligne,":");
	$ville=strtok(";");
	// si le nom de la ville contient plus qu'un ';' alors concat�ner la suite de la chaine de caract�re
	// avec la premi�re
	$carSpec=substr_count($select_ligne,';');
	while($carSpec > 1) {
		$ville_suite=strtok(";");
		$ville.=$ville_suite;
		$carSpec--;
	}
	$str2=strtok(":");
	// supprimer les espaces � la fin du nom du fichier
	$fichier=rtrim(strtok(""));	
	// lire le fichier m�t�o sp�cifique � la ville s�lectionn�e
	$ficMet=file("http://www.iro.umontreal.ca/~dift1147/pages/TPS/tp1/".$fichier);
	// afficher un message d'erreur si la lecture du fichier est impossible
	if ($ficMet==false){
		echo "Impossible de lire le fichier " .$fichier;
		exit;
	}

	$meteo="<hr align='center' width='50%'>";
	$meteo.="<table id='tbl_meteo' border=1><caption><h3 id='nom_vil'>Ville: ".$ville."<h3/></caption>";
	// si humidite ou vent ou temp�rature n'existent pas alors leurs valeurs seront �gales � "&nbsp"
	$humid="&nbsp";
	$vent="&nbsp";
	$temp="&nbsp";
	// chercher les informations m�t�orologiques de la ville 
	foreach($ficMet as $ligne) { 
		$type=strtok($ligne,": ");
		if($type == "information") {
			$info=strtok("");
		}
		else if($type == "temperature") {
			$temp=strtok("");
		}
		else if($type == "humidite") {
			$humid=strtok("");
		}
		else if($type == "vent") {
			$vent=strtok("");
		}
		else if($type == "desc") {
			$desc=strtok("");
		}	
	}
	// l'image a comme nom le param�tre imformation de la ville avec ".gif" comme extension
	$image='autres/images/'.str_replace(" ", "", rtrim($info)).'.gif';
	$meteo.="<tr id='info'><td colspan='3'><img src=".$image."><p>".$info."</p></td></tr>";
	$meteo.="<tr>
				<td id='temp'>Temp&#233;rature: ".$temp."</td>
				<td id='humid'>Humidit&#233;: ".$humid."</td>
				<td id='vent'>Vent: ".$vent."</td>
			</tr>";
	$meteo.="<tr id='desc'><td colspan='3'>".$desc."</td></tr></table>";
	echo $meteo;
}

getMeteo();
include 'autres/footer.php';
?>