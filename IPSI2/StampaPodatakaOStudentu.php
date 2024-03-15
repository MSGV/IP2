﻿<?php
session_start();

$BrojIndeksaZaStampu=$_POST['BrojIndeksaFilter'];

// KONEKTOVANJE NA BAZU
	require "klase/BaznaKonekcija.php";
	$KonekcijaObject = new Konekcija("klase/BaznaParametriKonekcije.xml");
	$KonekcijaObject->connect();
	
	// PREUZIMANJE STARIH VREDNOSTI ZA IZABRANOG STUDENTA
	require "klase/BaznaTabela.php";
	require "klase/DBStudentV.php";
	$StudentObject = new DBStudent($KonekcijaObject, 'student');
	$StudentObject->DajSvePodatkeOStudentima($BrojIndeksaZaStampu);
	$KolekcijaZapisaStudenata= $StudentObject->Kolekcija;
	$UkupanBrojZapisaStudenata = $StudentObject->BrojZapisa;
	
	if ($UkupanBrojZapisaStudenata>0) 
	{
		$row=0;  // prvi i jedini red ima taj id
		$BrojIndeksa=$StudentObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaStudenata, $row, 0);//mysql_result($result,$row,"REGISTARSKIBROJ");
		$Prezime=$StudentObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaStudenata, $row, 1);
		$Ime=$StudentObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaStudenata, $row, 2);
		$NazivSmera=$StudentObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaStudenata, $row, 3);
		$NazivFajlaFotografije=$StudentObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisaStudenata, $row, 4);
	}         

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="sr-RS" xml:lang="sr-RS">
<meta charset="UTF-8">
<head>
<title>ТФ М Пупин</title>
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
<?php include 'delovi/desnostampaostudentu.php';?>
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