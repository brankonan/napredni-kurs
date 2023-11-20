<?php

class BankAccount{
    private float $stanjeNaRacunu = 0;
    private  bool $blokiran = false;
  
    public function getStanjeNaRacunu(): string{
        return $this->stanjeNaRacunu;
    }

    public function setStanjeNaRacunu($stanjeNaRacunu): void {
        $this->stanjeNaRacunu ;
    }

    public function getBlokiran(): bool {
        return $this->blokiran;
    }

    public function setBlokiran($blokiran): void{
        $this->blokiran ;
    }

    public function podigniNovac($iznos) {
        if ($this->blokiran) {
            echo "Račun je blokiran. Ne možete podići novac.";
        }  else {
            $this->stanjeNaRacunu -= $iznos;
            echo "Podigli ste $iznos. Trenutno stanje na računu je $this->stanjeNaRacunu.";
        }
        if($this->stanjeNaRacunu <= -200){
            $this->blokiran = true;
            echo "Vaš račun je sada blokiran jer je stanje manje od -200.";
        }
    }

    public function uplatiNovac($iznos) {
        $this->stanjeNaRacunu += $iznos;
        echo "Uplatili ste $iznos. Trenutno stanje na računu je $this->stanjeNaRacunu.";
        if ($this->stanjeNaRacunu >= 0) {
            $this->blokiran = false;
            echo "Vaš račun je sada odblokiran jer je stanje na računu 0 ili veće.";
        }
    }
    
}

class User{
    public string $firstName;
    public string $lastName;
    public string $racun;

    function __construct(string $firstName, string $lastName, string $racun)
    {
        $this->firstName=$firstName;
        $this->lastName=$lastName;
        $this->racun=$racun;
    }
    public function getFirstName(): string{
        return $this->firstName;
    }

    public function setfirstName($ime): void{
        $this->firstName ;
    }

    public function getLastName(): string{
        return $this->lastName;
    }

    public function setPrezime($prezime): void {
        $this->lastName;
    }

}

$objekat = new BankAccount();
$objekat->podigniNovac(2000);
$objekat->podigniNovac(2000);

$objekat->uplatiNovac(4000);
$objekat->podigniNovac(2000);