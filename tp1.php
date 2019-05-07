<?php 
/* 
Auteur : Houimli, Safa
Date de création : 12 septembre 2018
Description : tp1.php est la page principale du TP1. Elle contient la liste des villes du fichier villes.txt
et les affiche dans une liste pour que l'utilisateur puisse sélectionner une. La ville sélectionnée est envoyée 
à la page 'villes.php' par la méthode 'GET' pour traiter ses informations météorologiques. 
*/
include 'autres/header.php';

function getVilles() {
	// ouvrir le fichier villes.txt pour le lire et afficher un message d'erreur s'il y a une erreur
	if (!$ficVil=fopen("http://www.iro.umontreal.ca/~dift1147/pages/TPS/tp1/villes.txt","r")){
		echo "Impossible de lire le fichier des villes";
		exit;
	}
	// créer un formulaire 'formVil' avec la methode GET
	$liste_villes="<br><form id='formVil' name='formVil' action='villes.php' method='GET'>					
					<span>Choix de la ville: </span>";
	// mettre les noms des villes dans une liste de sélection
	$liste_villes.="<select size='3' name='ville'>";
	$ligne=fgets($ficVil);
	$i=0;
	while(!feof($ficVil)) {
		// afficher les noms des villes écrites dans le fichier
		$str1=strtok($ligne,":");
		$ville=strtok(";");
		// si le nom de la ville contient plus qu'un ';' alors concaténer la suite de la chaine de caractère
		// avec la première
		$carSpec=substr_count($ligne,';');
		while($carSpec > 1) {
			$ville_suite=strtok(";");
			$ville.=$ville_suite;
			$carSpec--;
		}
		// l'option a comme value le numéro de la ville sélectionnée
		$liste_villes.="<option value='".$i."'>".$ville."</option>";
		$ligne=fgets($ficVil);
		$i++;
	}
	$liste_villes.="</select><br><br>
		<input type='submit' name='submit' id='submit' value='Afficher la m&#233;t&#233;o' />
					</form>";
	fclose($ficVil);
	echo $liste_villes;
}
getVilles();

include 'autres/footer.php';
?>