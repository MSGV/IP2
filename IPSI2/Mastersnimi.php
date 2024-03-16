 <?php
        

	   $korisnik=$_SESSION["korisnik"];
      
				if (!isset($korisnik))
				{
					header ('Location:index.php');
				}	

		$name = $_FILES["ID_F"]["name"]; //nazivFajlaFotografije  nama je ID_F
		$tmp_name = $_FILES['ID_F']['tmp_name']; //Nisam siguran sta su vrednosti ali neka ih.
		$error = $_FILES['ID_F']['error'];

		if (isset ($name)) {
			if (!empty($name)) {
						$location = 'SlikeStudenata/'; // Ne znam sta je ovo
						if  (move_uploaded_file($tmp_name, $location.$name)){
									//echo 'Uploaded';    
						}
					} else {

							}
					}
	   
	   $ID=$_POST['ID']; //ID master
	   $Atribute1=$_POST['Atribute1'];
	   $Atribute2=$_POST['Atribute2'];
	   $Atribute3=$_POST['Atribute3'];
	   $ID_F=$_POST['ID_F'];

	require "klase/BaznaKonekcija.php";
	require "klase/BaznaTabela.php";
	$KonekcijaObject = new Konekcija('klase/BaznaParametriKonekcije.xml');
	$KonekcijaObject->connect();
	if ($KonekcijaObject->konekcijaDB) 
    {	
		require "klase/Upis.php";
		$UnosObject = new Upis($KonekcijaObject, 'master');
		$dozvoljenUpis=$UnosObject->DaLiImaMestaZaUpis($OznakaSmera);
			
		if ($dozvoljenUpis=="DA")
			{
				require "klase/BaznaTransakcija.php";
				$TransakcijaObject = new Transakcija($KonekcijaObject);
				$TransakcijaObject->ZapocniTransakciju();
				
				require "klase/DBMaster.php";
				$MasterObject = new DBMaster($KonekcijaObject, 'master');
				$MasterObject->BrojIndeksa=$BrojIndeksa;
				$MasterObject->Prezime=$Prezime;
				$MasterObject->Ime=$Ime;
				$MasterObject->OznakaSmera=$OznakaSmera;
				$MasterObject->NazivFajlaFotografije=$NazivFajlaFotografije;
				$greska1=$MasterObject->DodajNovogMaster();
				
				require "klase/DBSecondary.php";
				$SecondaryObject = new DBSecondary($KonekcijaObject, 'Sondary');
				$greska2=$SecondaryObject->InkrementirajBrojMaster($OznakaSmera);
				
				$UtvrdjenaGreska=$greska1.$greska2;
				$TransakcijaObject->ZavrsiTransakciju($UtvrdjenaGreska);
			}
			else
			{
				$UtvrdjenaGreska="Ne mozete uneti jos 1 Master jer nema mesta po akreditaciji";
			}
        	
		}

	  $KonekcijaObject->disconnect();
	
	if ($UtvrdjenaGreska!=null) {
	echo "Greska: $UtvrdjenaGreska";	
     }	
	 else
	 {	
		header ('Location:MasterLista.php');	
	 }
		
	  
      ?>

