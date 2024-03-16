<?php
    class DBMaster extends Tabela{
        private $bazapodataka;
        private $UspehKonekcijeNaDBMS;
        public $ID;
        public $Atribute1;
        public $Atribute2;
        public $Atribute3;
        public $ID_F;


        public function DodajNovogMaster(){
            $GreskarezultatPar1 = $this->IzvrsiAktivanSQLUpit ("SET @ID='".$this->ID."'");
            $GreskarezultatPar2 = $this->IzvrsiAktivanSQLUpit ("SET @Atribute1='".$this->Atribute1."'");
            $GreskarezultatPar3 = $this->IzvrsiAktivanSQLUpit ("SET @Atribute2='".$this->Atribute2."'");
            $GreskarezultatPar4 = $this->IzvrsiAktivanSQLUpit ("SET @Atribute3='".$this->Atribute3."'");
            $GreskarezultatPar5 = $this->IzvrsiAktivanSQLUpit ("SET @ID_F='".$this->ID_F."'");

            $GreskarezultatCall = $this->IzvrsiAktivanSQLUpit ("CALL `DodajMastera`(@ID,@Atribute1,@Atribute2,@Atribute3,@ID_F);");
            
            $greska=$GreskarezultatPar1.$GreskarezultatPar2.$GreskarezultatPar3.$GreskarezultatPar4.$GreskarezultatPar5.$GreskarezultatCall;
            return $greska;
        }
    }
?>