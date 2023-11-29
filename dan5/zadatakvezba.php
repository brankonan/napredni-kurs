<?php


//1. PRE POCETKA JE READY
//2. KADA SE UNESE KARTICA ONDA JE VALIDIRANO
//3. UNOS KOLICINE NOVCA
//
abstract class State{
abstract function insertCarAndPin();
abstract function inputAmountAndConfirm();
abstract function demandCheck();

}

class Ready extends State {
    public function insertCarAndPin()
    {
        return true;
        echo "kartica i pin se mogu ineti samo kad je bankomat spreman.";
    }

    public function inputAmountAndConfirm()
    {
        return false;
        echo "Ne mozete uneti vrednost i potvrditi dok stanje nije validirano!";
    }

    public function demandCheck()
    {
        return false;
        echo "Ne mozete dobiti zahtev za potvrdu!";
    }

}
class Validated extends State {
    public function insertCarAndPin()
    {
        return false;
    }

    public function inputAmountAndConfirm()
    {
        return true;
        echo "Iznos se moze uneti samo kad je bankomat validan.";
    }

    public function demandCheck()
    {
        return false;
    }

}

class Paid extends State {
    public function insertCarAndPin()
    {
        return false;
    }

    public function inputAmountAndConfirm()
    {
        return false;
    }

    public function demandCheck()
    {
        return true;
        echo "Potvrda se moze zahtevati samo kad je iznos isplacen.";
    }

}

class Bankomat{
   
    private State $state;

    public function __construct(State $state){
        $this->state = new Ready();
    }
  
        public function insertCardAndPin() {
            if ($this->state->insertCardAndPin()) {
                $this->state = new Validated();
            }
    }
    
        public function inputAmountAndConfirm(){
            if($this->state->inputAmountAndConfirm()){
                $this->state = new Paid();
            }
        }
    
        public function demandCheck(){
            if($this->state->demandCheck()){
                $this->state = new Ready();
            }
        }
    
    }
$bankomat = new Bankomat();
    