
<meta charset="UTF-8">
<!--==================================== SADRZAJ STRANICE DESNO pocinje ovde ------------------------------>
<img src="images/sredinagore.jpg" width="100%" height="3" alt="" class="flt1 rp_topcornn" /> 

<table style="width:100%;style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0"  bgcolor="#D8E7F4">
<tr>
<td style="width:5%;">
</td>

<td align="left">
<br/>
<font face="Trebuchet MS" color="darkblue" size="4px">
<b>ВОЗИЛА</br>
<?php

//KONEKCIJA KA SERVERU
// koristimo klasu za poziv procedure za konekciju
	require "klase/BaznaKonekcija.php";
	require "klase/BaznaTabela.php";
	$KonekcijaObject = new Konekcija('klase/BaznaParametriKonekcije.xml');
	$KonekcijaObject->connect();
	if ($KonekcijaObject->konekcijaDB) // uspesno realizovana konekcija ka DBMS i bazi podataka
    {	
		require "klase/DBVozilo.php";
		$VoziloObject = new DBVozilo($KonekcijaObject, 'vozilo');
		
		// prikaz svih 
			$KolekcijaZapisa = $VoziloObject->DajKolekcijuSvihVozila();
			$UkupanBrojZapisa = $VoziloObject->DajUkupanBrojSvihVozila($KolekcijaZapisa);
			
	    if ($UkupanBrojZapisa>0) {
			//$rbvesti=0;
			// ------------ zaglavlje ----------------
			echo "<table style=\"width:90%; padding:0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" border=\"1\"  bgcolor=\"#D8E7F4\">";
				echo "<tr>";
				echo "<td style=\"width:12%;\">";
				echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">REG.BROJ</font><br/>";
				echo "</td>";
				echo "<td style=\"width:62%;\">";
				echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">KILOMETRAZA</font><br/>";
				echo "</td>";
				echo "<td style=\"width:62%;\">";
				echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">MODEL</font><br/>";
				echo "</td>";
				echo "<td style=\"width:62%;\">";
				echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">PROIZVODJAC</font><br/>";
				echo "</td>";
				echo "<td>";
				echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">IZMENA</font><br/>";
				echo "</td>";
				echo "<td>";
				echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"3px\">BRISANJE</font><br/>";
				echo "</td>";
				echo "</tr>";
			
			for ($RBZapisa = 0; $RBZapisa < $UkupanBrojZapisa; $RBZapisa++) 
			{
			        				
				// CITANJE VREDNOSTI IZ MEMORIJSKE KOLEKCIJE $RESULT I DODELJIVANJE PROMENLJIVIM
				$Id=$VoziloObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 0);//mysql_result($result,$row,"REGISTARSKIBROJ");
				$RegistarskiBroj=$VoziloObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 1);//mysql_result($result,$row,"REGISTARSKIBROJ");
				$BrojPredjenihKilometara=$VoziloObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 2);
				$NazivModela=$VoziloObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 3);
				$NazivProizvodjaca=$VoziloObject->DajVrednostPoRednomBrojuZapisaPoRBPolja ($KolekcijaZapisa, $RBZapisa, 4);
				
				
				// CRTANJE REDA TABELE SA PODACIMA
				echo "<tr>";
				echo "<td>";
				echo "<font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">$RegistarskiBroj</font><br/>";
				echo "</td>";
				echo "<td>";
				echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">$BrojPredjenihKilometara</font><br/>";
				echo "</td>";
				echo "<td>";
				echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">$NazivModela</font><br/>";
				echo "</td>";
				echo "<td>";
				echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\">$NazivProizvodjaca</font><br/>";
				echo "</td>";
				echo "<td>";
				echo "<form ACTION=\"voziloizmeniform.php\" METHOD=\"POST\">";
				echo "<input type=\"hidden\" name=\"IdVozila\" value=\"$Id\">";
				echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\"><input TYPE=\"submit\" name=\"izmenivozilo\" value=\"IZMENI\" /></font></b>";
				echo "</form>";
				echo "</td>";
				echo "<td>";
				echo "<form ACTION=\"voziloobrisi.php\" METHOD=\"POST\">";
				echo "<input type=\"hidden\" name=\"IdVozila\" value=\"$Id\">";
				echo "<b><font face=\"Trebuchet MS\" color:#3F4534 size=\"2px\"><input TYPE=\"submit\" name=\"obrisivozilo\" value=\"OBRISI\"  onclick=\"return confirm('Da li ste sigurni da zelite da obrisete zapis?')\"/></font></b>";
				echo "</form>";
				echo "</td>";
				echo "</tr>";

				
				
			}  //za for 
				echo "</table>";
				echo "<br/>";
				echo "<br/>";
							}   else {
                                      echo "НЕМА ПОДАТАКА";
                                   } // ZA ELSE
           } // ZA IF DB SELECTED
          
		  //mysql_close($db_handle);
		   $KonekcijaObject->disconnect();

?>



</td>

<td style="width:5%;">
</td>

</tr>
</table>

    