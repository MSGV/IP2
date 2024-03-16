<?php
	   session_start();
     	   
	   $korisnik=$_SESSION["korisnik"];
      
			if (!isset($korisnik))
				{
					header ('Location:index.php');
				}	

	require "klase/BaznaKonekcija.php";
	$KonekcijaObject = new Konekcija("klase/BaznaParametriKonekcije.xml");
	$KonekcijaObject->connect();
	$db_handle = $KonekcijaObject->konekcijaMYSQL;
	$bazapodataka=$KonekcijaObject->KompletanNazivBazePodataka;
	$UspehKonekcijeNaBazu=$KonekcijaObject->konekcijaDB;
	
	require "klase/BaznaTabela.php";
	require "klase/DBSecondary.php";
	$SecondaryObject = new DBSecondary($KonekcijaObject, "Secondary");
	$SecondaryObject->UcitajKolekcijuSvihSmerova();
	$KolekcijaZapisa= $SecondaryObject->Kolekcija;
	$UkupanBrojZapisa= $SecondaryObject->BrojZapisa;

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="sr-RS" xml:lang="sr-RS">
<meta charset="UTF-8">
<head>
<title>ТФ М Пупин Зрењанин</title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
<script src="JavaScript/provera.js"> </script>
</head>
<body>

<!-----VELIKA TABELA KOJA SADRZI SVE---->
<!-----10% SADRZAJ 10%---->
<table class="no-spacing" style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0" style="border-spacing: 0;">

<!-------------------------- ZAGLAVLJE ------->
<?php include 'delovi/zaglavljewelcome.php';?>


<!-------------------------- DONJI DEO  ------->
<tr style="padding:0px;">

<!-----LEVO PRAZNINA---->
<td style="width:10%;">
</td>

<!------------------------------------------------------------------------------------------->
<!---------------------- SREDINA DONJEG DELA SA SADRZAJEM pocinje ovde ---------------------->
<td align="center" valign="middle" style="width:80%; padding:0" > 

<table style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0" bgcolor="#003366">

<tr>
<td style="width:1%;">
</td>

<td style="width:15%;padding:0" cellspacing="0" cellpadding="0" border="0" valign="top">
<?php include 'delovi/menilevoadmin.php';?>
</td>

<td style="width:1%;">
</td>

<td style="width:80%;padding:0" cellspacing="0" cellpadding="0" border="0" valign="top">
<!------- GLAVNI SADRZAJ desno ----------->  
<?php include 'delovi/desnounosSP.php';?>
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
<?php include 'delovi/footer.php';?>

</table>

</body>
</html>