<?php
	class DBMaster extends Tabela{

		public function DajSvePodatkeOMaster($filterParametar){
			if (isset($filterParametar))
			{
				// nad pogledom se moze dodati filter, jer se pogled koristi kao da je tabela
				$upit="select * from `".$this->NazivBazePodataka."`.`SviPodaciMaster` where `ID`='".$filterParametar."'";
			}
			else
			{
				$upit="select * from `".$this->NazivBazePodataka."`.`SviPodaciMaster`";
			}
			$this->UcitajSvePoUpitu($upit);

		}

	}
?>