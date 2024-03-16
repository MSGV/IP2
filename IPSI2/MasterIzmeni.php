 <?php
        
	session_start();  
	$korisnik=$_SESSION["korisnik"];
      
		if (!isset($korisnik))
			{
				header ('Location:index.php');
			}	

		if (isset($_FILES["ID_F"]["name"]))
		{
			$name = $_FILES["ID_F"]["name"];
			$tmp_name = $_FILES['ID_F']['tmp_name'];
			$error = $_FILES['ID_F']['error'];
	
			if (isset ($name)) {
				if (!empty($name)) {
							$location = 'SlikeStudenata/'; //Ne znam sta je ovo
							if  (move_uploaded_file($tmp_name, $location.$name)){
										//echo 'Uploaded';    
							}
						}

				else {
	
					}
						} 
			$ID_F=$name;
		}
		else 
		{
			$ID_F=$_POST['StariID_F'];
			$nazivID_F=$StariID_F;
		}

	   // preuzimanje vrednosti sa forme
		$ID=$_POST['ID']; //ID mastera
		$StariID=$_POST['StariID'];
		$Atribute1=$_POST['Atribute1'];
		$Atribute2=$_POST['Atribute2'];

		if (isset($_POST['ID_F'])) //Sve je ID secondary
			{
				$ID=$_POST['ID']; //ID Secondary
			}

		else 
			{
				$StariID=$_POST['StariID'];
				$ID=$StaraID;
			}
		
			require "klase/BaznaKonekcija.php";
			require "klase/BaznaTabela.php";
			$KonekcijaObject = new Konekcija('klase/BaznaParametriKonekcije.xml');
			$KonekcijaObject->connect();

		if ($KonekcijaObject->konekcijaDB) // uspesno realizovana konekcija ka DBMS i bazi podataka
			{	
				require "klase/DBMaster.php";
				$MasterObject = new DBMaster($KonekcijaObject, 'master');
				$greska=$MasterObject->IzmeniMaster($StariID, $ID, $Atribute1, $Atribute2, $Atribute3, $ID_F);
			}
		else
			{
				echo "Nije uspostavljena konekcija ka bazi podataka!";
			}
		
    $KonekcijaObject->disconnect();
	   

	header ('Location:MasterLista.php');	
		
	  
      ?>

