<?php

$server   = 'localhost';
$username = 'root';
$password = '';
$database = 'kolekcija';

$db_connect = mysql_connect ($server, $username, $password);

if ($db_connect)
	{
		//echo 'Uspješno ste spojeni na bazu podataka';
	}
else
	{
		echo 'Došlo je do pogreške prilikom spajanja';
	}
if (mysql_select_db ($database, $db_connect))
{
	echo '</br>';
	//echo 'Uspješno ste odabrali bazu';
	mysql_query("set names utf8");

}
else
{
	echo 'Došlo je do pogreške priliko odabira';
}

?>