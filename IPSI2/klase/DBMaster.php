<?php
    class DBMaster extends Tabela{
        private $bazapodataka;
        private $UspehKonekcijeNaDBMS;
        public $ID;
        public $Atribute1;
        public $Atribute2;
        public $Atribute3;
        public $ID_F;


        public function DajKolekcijuSvihMaster(){
            $SQL = "select * from `Master` ORDER BY Atribute1 ASC";
            $this->UcitajSvePoUpitu($SQL); 

            return $this->Kolekcija; 
        }

        public function UcitajStudentaPoBrojuIndeksa($BrojIndeksaParametar){
            $SQL = "select * from `Master` where `ID`='".$BrojIndeksaParametar."'";
            $this->UcitajSvePoUpitu($SQL); 
        }

        public function DodajNovogMaster(){
            $SQL = "INSERT INTO `Master` (ID, Atribute1, Atribute2, Atribute3, ID_F) VALUES ('$this->ID','$this->Atribute1', '$this->Atribute2', '$this->Atribute3', '$this->ID_F')";
            $greska=$this->IzvrsiAktivanSQLUpit($SQL);
            
            return $greska;
        }

        public function ObrisiMaster($IdZaBrisanje){
            $SQL = "DELETE FROM `Master` WHERE ID='".$IdZaBrisanje."'";
            $greska=$this->IzvrsiAktivanSQLUpit($SQL);
            
            return $greska;
        }

        public function IzmeniMaster($StariID, $ID, $atribute1, $atribute2, $atribute3, $id_f){
            $SQL = "UPDATE `Master` SET ID='".$ID."', Atribute1='".$atribute1."', Atribute2='".$atribute2."', Atribute3='".$atribute3."', ID_F='".$id_f."' WHERE ID='".$StariID."'";
            $greska=$this->IzvrsiAktivanSQLUpit($SQL);
            
            return $greska;
        }
    }
?>