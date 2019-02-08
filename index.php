<?php

include ("db_connection.php");
include ("unos.php");

$slova = "abcdefghijlkmnoprstuvz";


echo '

	<p>'; 

		for($i=0; $i < strlen($slova); $i++)
	{
		$slovo = $slova[$i];
	
		echo ' <a href="index.php?slovo='.$slovo.'">'.strtoupper($slovo).'</a> |';
	} 
	
if(isset($_GET["slovo"]) && $_GET["slovo"] != "")
   {
	$slovo = $_GET["slovo"];

	$query = "SELECT slika, naslov, godina, trajanje
			  FROM filmovi
			  WHERE naslov LIKE '$slovo%'
			  ORDER BY naslov ASC";
			  
	$result = mysql_query($query)or die (mysql_error()); 
	$folder      = 'spremljene_slike/';
	
	while($_POST = mysql_fetch_array($result))
	{
	$slika    = $_POST ["slika"];
	$naslov   = $_POST ["naslov"];
	$godina   = $_POST ["godina"];
	$trajanje = $_POST ["trajanje"];

	$query_slika = "SELECT slika
					 FROM filmovi
					 WHERE slika = '$slika'";
	$result_slika = mysql_query ($query_slika);
	
			  
	$query_naslov = "SELECT naslov
					 FROM filmovi
					 WHERE naslov = '$naslov'";
					 
	$result_naslov = mysql_query ($query_naslov);
	$naslov_row = mysql_fetch_array ($result_naslov);
	$naziv = $naslov_row ["naslov"];
	
	$query_godina = "SELECT godina
					 FROM filmovi
					 WHERE godina ='$godina'";
					 
	$result_godina = mysql_query ($query_godina);
	$godina_row = mysql_fetch_array ($result_godina);
	$godina_filma = $godina_row ["godina"];
	
	$query_traj = "SELECT trajanje
				   FROM filmovi
				   WHERE trajanje ='$trajanje'";
	
	$result_traj = mysql_query($query_traj);
	$traj_row = mysql_fetch_array ($result_traj);
	$traj_filma = $traj_row ["trajanje"];
	
	echo '
		<p>
			<i><img src ='.$folder.$slika.' width = "100"></i><br />
			<i>'.$naziv.' ('.$godina_filma.')</i><br />
			<i>Trajanje:'.$traj_filma.'</i>
		</p>';
	}		
}

?>