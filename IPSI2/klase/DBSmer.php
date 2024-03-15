<?php
class DBSmer extends Tabela 
{
// ATRIBUTI
private $bazapodataka;
private $UspehKonekcijeNaDBMS;
//
public $Oznaka;
public $Naziv; 
public $UkupanBrojStudenata;

// METODE

// konstruktor

public function UcitajKolekcijuSvihSmerova()
{
$SQL = "select * from `Smer` ORDER BY Naziv ASC";
$this->UcitajSvePoUpitu($SQL); // puni atribut bazne klase Kolekcija
//return $this->Kolekcija; // uzima iz baznek klase vrednost atributa
}

public function InkrementirajBrojStudenata($IDSmer)
{
	// izdvajanje stare vrednosti broja vozila za taj tip
	//$SQL = "select UkupanBrojStudenata from `".$this->bazapodataka."`.`smer` WHERE Oznaka=".$IDSmer;
	$KriterijumFiltriranja="Oznaka='".$IDSmer."'";
	$StaraVrednostUkBrStudenata=$this->DajVrednostJednogPoljaPrvogZapisa ('UkupanBrojStudenata', $KriterijumFiltriranja, 'UkupanBrojStudenata'); 
	
	// izracunavanje nove vrednosti
	$NovaVrednostUkBrStudenata=$StaraVrednostUkBrStudenata + 1;
	
	// izvrsavanje izmene
    $SQL = "UPDATE `".$this->NazivBazePodataka."`.`smer` SET UkupanBrojStudenata=".$NovaVrednostUkBrStudenata." WHERE Oznaka='".$IDSmer."'";
	$greska= $this->IzvrsiAktivanSQLUpit($SQL);

	return $greska;
	
	}

// ########### TO DO

public function DajKolekcijuVozilaFiltrirano($filterPolje, $filterVrednost, $nacinFiltriranja, $Sortiranje)
{
if ($nacinFiltriranja=="like")
{
$SQL = "select * from `VOZILO` WHERE $filterPolje like '%".$filterVrednost."%' ORDER BY $Sortiranje";
}
else
{
$SQL = "select * from `VOZILO` WHERE $filterPolje ='".$filterVrednost."' ORDER BY $Sortiranje";
}
$this->UcitajSvePoUpitu($SQL);
return $this->Kolekcija; // uzima iz baznek klase vrednost atributa
}


public function DajUkupanBrojSvihVozila($KolekcijaZapisa)
{
return $this->BrojZapisa;
}

public function DodajNovoVozilo()
{
	$SQL = "INSERT INTO `VOZILO` (REGISTARSKIBROJ, BROJPREDJENIHKILOMETARA, NAZIVMODELA, NAZIVPROIZVODJACA) VALUES ('$this->REGISTARSKIBROJ',$this->BROJPREDJENIHKILOMETARA, '$this->NAZIVMODELA', '$this->NAZIVPROIZVODJACA')";
	$greska=$this->IzvrsiAktivanSQLUpit($SQL);
	
	return $greska;
}

public function ObrisiVozilo($IdZaBrisanje)
{
	$SQL = "DELETE FROM `VOZILO` WHERE ID=".$IdZaBrisanje;
	$greska=$this->IzvrsiAktivanSQLUpit($SQL);
	
	return $greska;
}

public function IzmeniVozilo($IdZaIzmenu, $NoviRegistarskiBroj, $NovaKilometraza, $NoviModel, $NoviProizvodjac)
{
	$SQL = "UPDATE `VOZILO` SET REGISTARSKIBROJ='".$NoviRegistarskiBroj."', BROJPREDJENIHKILOMETARA=".$NovaKilometraza.", NAZIVMODELA='".$NoviModel."', NAZIVPROIZVODJACA='".$NoviProizvodjac."' WHERE ID=".$IdZaIzmenu;
	$greska=$this->IzvrsiAktivanSQLUpit($SQL);
	
	return $greska;
}

// ostale metode 




}
?>