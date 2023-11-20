<?php

class BankAccount{
    protected float $stanjeNaRacunu = 0;
    protected  bool $blokiran = false;

  
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
    public SimpleBankAccount $simpleRacun;
    public SecuredBankAccount $securedRacun;

    function __construct(string $firstName, string $lastName)
    {
        $this->firstName=$firstName;
        $this->lastName=$lastName;
        $this->simpleRacun=  new SimpleBankAccount();
        $this->securedRacun= new SecuredBankAccount();
    }
    public function getFirstName(): string{
        return $this->firstName;
    }

    public function setfirstName($firstName): void{
        $this->firstName ;
    }

    public function getLastName(): string{
        return $this->lastName;
    }

    public function setPrezime($lastName): void {
        $this->lastName;
    }

}



class SimpleBankAccount extends BankAccount{

}

class SecuredBankAccount extends BankAccount {
    public function podigniNovac($iznos) {
        $provizija = $iznos * 0.025; 
        $ukupno = $iznos + $provizija; 
        if ($this->blokiran) {
            echo "Račun je blokiran. Ne možete podići novac.";
        } else if ($this->stanjeNaRacunu - $ukupno < -1000) {
            echo "Ne možete podići novac jer bi stanje na računu bilo manje od -1000.";
        } else {
            $this->stanjeNaRacunu -= $ukupno;
            echo "Podigli ste $iznos. Provizija je $provizija. Trenutno stanje na računu je $this->stanjeNaRacunu.";
        }

        if($this->stanjeNaRacunu <= -1000){
            $this->blokiran = true;
            echo "Vaš račun je sada blokiran jer je stanje manje od -1000.";
        }
    }

    
}

$noviUser = new User("Marko", "Markovic");

$noviUser->securedRacun->podigniNovac(100);