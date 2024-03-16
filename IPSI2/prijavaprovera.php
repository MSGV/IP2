<?php
	session_start();
       $loginUserName=$_POST['korisnickoIme'];
       $loginPassword=$_POST['sifra'];

		require 'klase/BaznaKonekcija.php';
		require 'klase/BaznaTabela.php';
		require 'klase/DBKorisnik.php';

		$korisnik='NEPOZNAT KORISNIK';
		$objKonekcija = new Konekcija('klase/BaznaParametriKonekcije.xml');
		$objKonekcija->connect();

	if ($objKonekcija->konekcijaDB)
		{	
			$objKorisnik = new DBKorisnik($objKonekcija, 'korisnik');
			$postojiKorisnik=$objKorisnik->DaLiPostojiKorisnik($loginUserName,$loginPassword);

			if ($postojiKorisnik=="DA")
				{
					$_SESSION["prez"] = $objKorisnik->DajPrezimePrijavljenogKorisnika($loginUserName,$loginPassword);
					$_SESSION["ime"] = $objKorisnik->DajImePrijavljenogKorisnika($loginUserName,$loginPassword);
					$_SESSION["idkorisnika"] = $objKorisnik->DajIDPrijavljenogKorisnika($loginUserName,$loginPassword);
					$_SESSION["korisnik"] = $objKorisnik->DajImePrezimePrijavljenogKorisnika($loginUserName,$loginPassword);
					header ('Location:Welcome.php');	
				}
				
			else
				{
					
					header ('Location:prijava.php');	
				}
		}
	else
		{
			echo "Neuspeh konekcije na bazu podataka!";
		}
	
?>
