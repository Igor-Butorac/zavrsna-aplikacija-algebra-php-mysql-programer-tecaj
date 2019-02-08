<?php

include ("db_connection.php");
error_reporting(E_ALL ^ E_NOTICE);

$folder      = 'spremljene_slike/';

if(isset($_GET["brisi"]) && $_GET["brisi"] == 1)
{
	$naslov = $_GET["naslov"];
	
	$query = "DELETE FROM filmovi WHERE naslov='$naslov ' LIMIT 1";
	$result = mysql_query($query);
	
	if($result)
	{
		//echo '<p>Film je obrisan </p>';
	}
	else
	{
		echo '<p>Pogreška kod brisanja</p>';
	}
}


if(isset($_POST["btn_save"]))

	{
	
	$naslov      = $_POST ["naslov"];
	$zanr	 	 = $_POST ["naziv"];
	$godina   	 = (int)$_POST ["godina"];
	$trajanje 	 = (int)$_POST ["vrijeme_traj"];
	
	$slika    	 = $_FILES ["slika"];
	$slika_ime 	 = $slika['name'];
	
	$query  = "INSERT INTO filmovi
			  (naslov, id_zanr, godina, trajanje, slika)
			  VALUES 
			  ('$naslov', '$zanr', '$godina', '$trajanje', '$slika_ime')";
			  
	
	$path   = $folder.$slika_ime;
	
if (!empty($slika['tmp_name']) && !empty($naslov) && $trajanje && $zanr && $godina)

		{
		move_uploaded_file($slika['tmp_name'], $path) ;
		
		$result = mysql_query($query);
		
			echo 'Film je uspješno spremljen u bazu!';
		}
		else
		{
			echo 'Došlo je do pogreške pri spremanju. Pokušajte ponovo!';
		}	
	}

	echo '
	<form method="POST" action="unos.php" enctype="multipart/form-data">
	<table border="1">
	
		<tbody>
		<tr>
			<th>Naslov:</th>
			<td><input type= "text", name="naslov" value=""/></td>
		</tr>
		<tr>
			<th>Žanr:</th>
			<td><select name="naziv">
			<option value="">Odaberite žanr:</option>';
			
			$query  = "SELECT id, naziv
					   FROM zanr
					   ORDER BY naziv ASC";
					   
			$result = mysql_query($query) or die(mysql_error());
			while($row = mysql_fetch_array($result))
		{
			$id_zanra  = $row["id"];
			$naziv_zanra = $row ["naziv"];
			echo '<option value="'.$id_zanra.'">'.$naziv_zanra.'</option>';
		}			
		
	echo'	
		<tr>
			<th>Godina:</th>
			<td><select name="godina">
			<option value="">Odaberite godinu:</option>';
		
	     for($i=1900; $i<=date("Y"); $i++) 
		 {
			echo '<option value="'.$i.'">'.$i.'</option>';
		 }

			
	echo'
		<tr>
			<th>Trajanje:</th>
			<td><input type= "text", name="vrijeme_traj" value=""/></td>
	    </tr>';
	
	echo'
		<tr>
		<th>Slika:</th>
		 <td>
	    
	    <input type="file" name="slika" value="" />
	</td>
	</tr>
		</tbody>
		</table>';
	echo'
		
	<input type="submit" name="btn_save" value="Spremi" />

	</form>';
	
	$query = "SELECT
			naslov, godina, trajanje, slika
			FROM filmovi
			ORDER BY naslov ASC";
	
	$result = mysql_query($query) or die (mysql_error()); 

	echo'
	<table border="1">

		<tr>
			<th>Slika</th>
			<th>Naslov filma</th>
			<th>Godina</th>
			<th>Trajanje</th>
			<th>Akcija</th>
		</tr>';
	
	while($row = mysql_fetch_array($result))
	{
	
		$slika    	= $folder.$row["slika"];
		$naslov     = $row["naslov"];
		$godina     = $row["godina"];
		$trajanje   = $row["trajanje"];
		
	echo'
	
		<tr>
			<td><img src = '.$slika.' alt="" width="100"></td>
			<td>'.$naslov.'</td>
			<td>'.$godina.'</td>
			<td>'.$trajanje.'</td>
			<td>
			<a href="?naslov='.$naslov.'&brisi=1" onclick="return confirm(\'Da li ste sigurni?\')">Obriši</a>
			</td>
		</tr>';
		
		}
		
	echo'
	
</table>';	
		
?>

