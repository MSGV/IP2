﻿<?php
// OVO JE SUSTINSKO ODJAVLJIVANJE KORISNIKA
session_start();
// remove all session variables
session_unset(); 
// destroy the session 
session_destroy(); 

// REALIZACIJA CITANJA SVIH I FILTRIRANIH PODATAKA

//KONEKCIJA KA SERVERU
	
// koristimo klasu za poziv procedure za konekciju
	require "delovi/klase/Konekcija.php";
	$objKonekcija = new Konekcija();
	$objKonekcija->KonektujSe();
	$db_handle = $objKonekcija->UspehKonekcijeNaMYSQL;
	$bazapodataka=$objKonekcija->bazapodataka;
    $UspehKonekcijeNaBazu=$objKonekcija->UspehKonekcijeNaBazuPodataka;
	
// NASTAVAK
       if ($UspehKonekcijeNaBazu)
           {
            // dodatak da moze da radi sa UTF8
	    mysql_query('SET NAMES "utf8"',$db_handle);
	    
		if (isset($_POST["filtriraj"]))
			{
			// filtrirano
			$FilterVrednost=$_POST["filter"];
            $SQL = "select * from `".$bazapodataka."`.`VOZILO` WHERE NAZIVPROIZVODJACA like '%".$FilterVrednost."%' ORDER BY BROJPREDJENIHKILOMETARA DESC";
			}
			else
			{
			// prikaz svih - PRVO UCITAVANJE INDEX.PHP, dugme "SVI"
			$SQL = "select * from `".$bazapodataka."`.`VOZILO` ORDER BY BROJPREDJENIHKILOMETARA DESC";
			}
        

			$result = mysql_query($SQL);
            $num_rows = mysql_num_rows($result);

            }

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="sr-RS" xml:lang="sr-RS">
<meta charset="UTF-8">
<head>
<title>Општина Зрењанин</title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
</head>
<body>

<!-----VELIKA TABELA KOJA SADRZI SVE---->
<!-----10% SADRZAJ 10%---->
<table class="no-spacing" style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0" style="border-spacing: 0;">

<!-------------------------- ZAGLAVLJE ------->
<?php include 'delovi/zaglavljestampa.php';?>


<!-------------------------- DONJI DEO  ------->
<tr style="padding:0px;">

<!-----LEVO PRAZNINA---->
<td style="width:10%;">
</td>

<!------------------------------------------------------------------------------------------->
<!---------------------- SREDINA DONJEG DELA SA SADRZAJEM pocinje ovde ---------------------->
<td align="center" valign="middle" style="width:80%; padding:0" > 

<table style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF">

<tr>
<td style="width:1%;">
</td>

<td style="width:80%;padding:0" cellspacing="0" cellpadding="0" border="0" valign="top">
<!------- GLAVNI SADRZAJ desno ----------->  
<?php include 'delovi/desnostampa.php';?>
</td>

<td style="width:1%;">
</td>

</tr>
</table>

</td>
<!---------------------- SADRZAJ zavrsava ovde ---------------------->

<!-----DESNO PRAZNINA---->
<td style="width:10%;">
</td>

</tr>
<!---------------------- DONJI DEO zavrsava ovde ---------------------->


<tr style="padding:0px;">
<td style="width:10%;"></td>
<td align="center" valign="middle"></td>
<td style="width:10%;"></td>
</tr>
<!--- DONJI DEO sa donjom ivicom zavrsava ovde  ------->
<!-- footer panel starts here -->
<?php include 'delovi/footerstampa.php';?>

</table>

</body>
</html>