<?php

abstract class Artikli{
    protected int $serijskiBroj;
    protected string $proizvodjac;
    protected string $model;
    protected float $cena;
    protected int $lager;


    public function __construct(int $serijskiBroj, string $proizvodjac, string $model, float $cena, int $lager)
{
    $this->serijskiBroj = $serijskiBroj;
    $this->proizvodjac = $proizvodjac;
    $this->model = $model;
    $this->cena = $cena;
    $this->lager = $lager;
}
    public function prikaziInfo(){
        echo "Serijski broj:|" . $this->serijskiBroj . " Proizvodjac:" . $this->proizvodjac  . "Model:" . $this->model . "Cena:" . $this->cena . "Lager:" . $this->lager;
    }


    public function stanje(){
        return $this->lager;
    }


    public function setStanje($lager){
        $this->lager = $lager;
    }

    public function smanjiStanje(){
        return $this->lager--;
    }    

    public function povecajStanje(){
        return $this->lager++;
    }


    public function getCena(): float{
        return $this->cena ;
    }
}
   



class Ram extends Artikli {
    public int $kapacitet;
    public int $frekvencija;

    public function __construct(int $serijskiBroj, string $proizvodjac, string $model, float $cena, int $lager, int $kapacitet, int $frekvencija)
    {
            parent::__construct( $serijskiBroj, $proizvodjac,  $model, $cena, $lager);
            $this->kapacitet = $kapacitet;
            $this->frekvencija = $frekvencija;       
    }

    public function prikaziInfo()
    {
     parent::prikaziInfo();
     echo "Kapacitet:" . $this->kapacitet . "Frekvencija" . $this->frekvencija ;   
    }
}




class Cpu extends Artikli{
    public int $jezgra;
    public int $frekvencija;

    public function __construct(int $serijskiBroj, string $proizvodjac, string $model, float $cena, int $lager, int $jezgra, int $frekvencija)
    {
            parent::__construct( $serijskiBroj, $proizvodjac,  $model, $cena, $lager);
            $this->jezgra = $jezgra;
            $this->frekvencija = $frekvencija;       
    }

    public function prikaziInfo()
    {
     parent::prikaziInfo();
     echo "Jezgra:" . $this->jezgra . "Frekvencija" . $this->frekvencija ;   
    }
}


class Hdd extends Artikli{
    public int $kapacitet;

    public function __construct(int $serijskiBroj, string $proizvodjac, string $model, float $cena, int $lager, int $kapacitet){
        parent::__construct( $serijskiBroj, $proizvodjac,  $model, $cena, $lager);
        $this->kapacitet = $kapacitet;
    } 

    public function prikaziInfo()
    {
     parent::prikaziInfo();
     echo "Kapacitet:" . $this->kapacitet;
    }
}



class Gpu extends Artikli{

    public int $frekvencija;

    public function __construct(int $serijskiBroj, string $proizvodjac, string $model, float $cena, int $lager, int $frekvencija){
        parent::__construct( $serijskiBroj, $proizvodjac,  $model, $cena, $lager);
        $this->frekvencija = $frekvencija;        

    }

    public function prikaziInfo()
    {
     parent::prikaziInfo();
     echo "Frekvencija:" . $this->frekvencija;
    }
}



class Prodavnica{
    private $artikliProdavnica = [];
    public $balans = 0;

    public function dodajArtikle($artikliProdavnica){
    $this->artikliProdavnica = $artikliProdavnica;
}

    public function listInfo(){
    foreach($this->artikliProdavnica as $artikal){
        $artikal->prikaziInfo();
    }
}

    public function dodajZaradu($iznos){
    $this->balans += $iznos;
}

    public function prikaziBalans(){
    return $this->balans;
}

    public function sellArticle(Artikli $artikal) {
    if(in_array($artikal, $this->artikliProdavnica) && $artikal->stanje() >= 1) {
        $artikal->smanjiStanje(); 
        echo "Uspesno ste prodali" . $artikal;
        $this->dodajZaradu($artikal->getCena());
    } else {
        echo "Nije moguce prodati" . $artikal;
        }
}

    public function pozajmiArtikal(Artikli $artikal){
        if(in_array($artikal, $this->artikliProdavnica) && $artikal->stanje() > 0){
            $artikal->smanjiStanje();
            $this->balans += $artikal->getCena() /4;
            echo "Artikal je pozajmljen";
        }else {
            echo "Artikal nije moguce pozajmiti";
        }
    }

    public function vratiArtikal(Artikli $artikal){
        if(in_array($artikal, $this->artikliProdavnica)){
            $artikal->povecajStanje();
            echo "Artikal je vracen sa pozajmice";
        }else{
            echo "Artikal nije vracen";
        }
    }


    
}


interface Loan{
    public function pozajmiArtikal();
    public function vratiArtikal();
}






$ram = new Ram(3, "Kingston", "Novi Model", 9999, 100, 8, 3200);
$ram->prikaziInfo();

$cpu = new Cpu(4, "Intel", "i5", 20000, 50, 8, 3200);
$cpu->prikaziInfo();

$hdd = new Hdd(6, "Toshiba", "G16P62", 18000, 78, 1024);
$hdd->prikaziInfo();








?>