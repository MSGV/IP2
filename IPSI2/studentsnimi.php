﻿ <?php
        
		//session_start();  
	   // citanje vrednosti iz sesije - da bismo uvek proverili da li je to prijavljeni korisnik
	   // citanje vrednosti iz sesije - da bismo uvek proverili da li je to prijavljeni korisnik
	   $korisnik=$_SESSION["korisnik"];
      
	  // ako nije prijavljen korisnik, vraca ga na pocetnu stranicu
				if (!isset($korisnik))
				{
					header ('Location:index.php');
				}	
	   
	   
	      // -------------------------------------
		// UPLOAD FAJLA SLIKE

		$name = $_FILES["nazivFajlaFotografije"]["name"];
		//$size = $_FILES['nazivFajlaFotografije']['size']
		//$type = $_FILES['nazivFajlaFotografije']['type']
		$tmp_name = $_FILES['nazivFajlaFotografije']['tmp_name'];
		$error = $_FILES['nazivFajlaFotografije']['error'];

		if (isset ($name)) {
			if (!empty($name)) {
						$location = 'SlikeStudenata/';
						if  (move_uploaded_file($tmp_name, $location.$name)){
									//echo 'Uploaded';    
						}
					} else {
							//echo 'please choose a file';
							}
					}
	   
	   // preuzimanje vrednosti sa forme
	   $BrojIndeksa=$_POST['brojIndeksa'];
	   $Prezime=$_POST['prezime'];
	   $Ime=$_POST['ime'];
	   $OznakaSmera=$_POST['oznakaSmera'];
	   $NazivFajlaFotografije=$name;
	   
	   //KONEKCIJA KA SERVERU
	
// koristimo klasu za poziv procedure za konekciju
	require "klase/BaznaKonekcija.php";
	require "klase/BaznaTabela.php";
	$KonekcijaObject = new Konekcija('klase/BaznaParametriKonekcije.xml');
	$KonekcijaObject->connect();
	if ($KonekcijaObject->konekcijaDB) // uspesno realizovana konekcija ka DBMS i bazi podataka
    {	
		// provera poslovne logike
		require "klase/Upis.php";
		$UnosObject = new Upis($KonekcijaObject, 'student');
		$dozvoljenUpis=$UnosObject->DaLiImaMestaZaUpis($OznakaSmera);
			
		if ($dozvoljenUpis=="DA")
			{
				//echo "USPESNA KONEKCIJA";
				require "klase/BaznaTransakcija.php";
				$TransakcijaObject = new Transakcija($KonekcijaObject);
				$TransakcijaObject->ZapocniTransakciju();
				
				require "klase/DBStudent.php";
				$StudentObject = new DBStudent($KonekcijaObject, 'student');
				$StudentObject->BrojIndeksa=$BrojIndeksa;
				$StudentObject->Prezime=$Prezime;
				$StudentObject->Ime=$Ime;
				$StudentObject->OznakaSmera=$OznakaSmera;
				$StudentObject->NazivFajlaFotografije=$NazivFajlaFotografije;
				$greska1=$StudentObject->DodajNovogStudenta();
				
				// inkrement broja studenata kroz klasu DBSmer
				require "klase/DBSmer.php";
				$SmerObject = new DBSmer($KonekcijaObject, 'smer');
				$greska2=$SmerObject->InkrementirajBrojStudenata($OznakaSmera);
				
				// zatvaranje transakcije
				//$UtvrdjenaGreska=$greska1 or $greska2;
				$UtvrdjenaGreska=$greska1.$greska2;
				$TransakcijaObject->ZavrsiTransakciju($UtvrdjenaGreska);
			}
			else
			{
				$UtvrdjenaGreska="Ne mozete uneti jos 1 studenta jer nema mesta po akreditaciji";
			}
        	
		} // od if db selected

      // ZATVARANJE KONEKCIJE KA DBMS
	  $KonekcijaObject->disconnect();
	
	// prikaz uspeha aktivnosti	
	
	if ($UtvrdjenaGreska!=null) {
	echo "Greska: $UtvrdjenaGreska";	
     }	
	 else
	 {
		//echo "Snimljeno!";	
		header ('Location:StudentiLista.php');	
	 }
		
	  
      ?>

