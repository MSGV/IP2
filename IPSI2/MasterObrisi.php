 <?php
        
		session_start();  
	   $korisnik=$_SESSION["korisnik"];

			if (!isset($korisnik))
				{
					header ('Location:index.php');
				}	
	   
	   // preuzimanje vrednosti sa forme
	   $IdZaBrisanje=$_POST['ID']; //ID mastera
	   
	require "klase/BaznaKonekcija.php";
	require "klase/BaznaTabela.php";
	$KonekcijaObject = new Konekcija('klase/BaznaParametriKonekcije.xml');
	$KonekcijaObject->connect();
	
		if ($KonekcijaObject->konekcijaDB)
			{	
				require "klase/DBMaster.php";
				$MasterObject = new DBMaster($KonekcijaObject, 'master');
				$greska=$MasterObject->ObrisiMaster($IdZaBrisanje);
			}
		
    $KonekcijaObject->disconnect();	
	header ('Location:MasterLista.php');	
		
	  
      ?>

