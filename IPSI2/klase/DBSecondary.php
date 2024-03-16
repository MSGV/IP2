<?php
	class DBSecondary extends Tabela {
		private $bazapodataka;
		private $UspehKonekcijeNaDBMS;
		public $ID;
		public $UkupanBrojMaster;


		public function UcitajKolekcijuSvihSmerova()
		{
			$SQL = "select * from `Secondary` ORDER BY S_Atribute1 ASC";
			$this->UcitajSvePoUpitu($SQL); 
		}

		public function InkrementirajBrojMaster($S_ID)
		{
			$KriterijumFiltriranja="ID='".$S_ID."'";
			$StaraVrednostUkBrStudenata=$this->DajVrednostJednogPoljaPrvogZapisa ('UkupanBrojMaster', $KriterijumFiltriranja, 'UkupanBrojMaster'); 
			

			$NovaVrednostUkBrStudenata=$StaraVrednostUkBrStudenata + 1;
			

			$SQL = "UPDATE `".$this->NazivBazePodataka."`.`Secondary` SET UkupanBrojMaster=".$NovaVrednostUkBrStudenata." WHERE ID='".$S_ID."'";
			$greska= $this->IzvrsiAktivanSQLUpit($SQL);

			return $greska;
		
		}
	}
?>