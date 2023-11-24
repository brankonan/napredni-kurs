<?php

class Student{
    private string $ime;
    private string $prezime;
    private int $index;

    public function __construct(string $ime, string $prezime, int $index)
    {
        $this->ime = $ime;
        $this->prezime =$prezime;
        $this->index = $index;
    }
}

class Predmet {
    private string $naziv;
    private string $infoProfesor;

    public function __construct(string $naziv, string $infoProfesor) {
        $this->naziv = $naziv;
        $this->infoProfesor = $infoProfesor;
    }
}

class Ocenjivanje {
    public int $ocena;
    public int $datum;
    public string $student;
    public string $predmet;
    
    public function __construct(int $ocena, int $datum, string $student, string $predmet) {
        $this->ocena = $ocena;
        $this->datum = $datum;
        $this->student = $student;
        $this->predmet = $predmet;
    }
}

class StudentskaSluzba {
    private static $instance = null;
    private $studenti;
    private function __construct() {
        $this->studenti = [];
    }
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new StudentskaSluzba();
        }
        return self::$instance;
    }

    public function dodajStudenta($student){
        array_push($this->studenti, $student);
    }

    public function getStudenti() {
        return $this->studenti;
    }
}

interface Ispit{
public function getDetalji();
}

class PismeniIspit implements Ispit {
    public int $trajanje;
    public function __construct(int $trajanje) {
        $this->trajanje = $trajanje;
    }

    public function getDetalji(){
        return "Pismeni ispit, trajanje: " . $this->trajanje;
    }

}

class UsmeniIspit implements Ispit{
    public string $infoVerbalnogOdgovora;
    public function __construct(string $infoVerbalnogOdgovora)
    {
        $this->infoVerbalnogOdgovora = $infoVerbalnogOdgovora;
    }

    public function getDetalji()
    {
        return "Informacije usmenog odgovora:" . $this->infoVerbalnogOdgovora;
    }
}


interface IspitFactory {
    public function kreirajIspit($detalji);
}

class PismeniIspitFactory implements IspitFactory{
    public function kreirajIspit($trajanje){
        return new PismeniIspit($trajanje);
    }
}

class UsmeniIspitFactory implements IspitFactory{
    public function kreirajIspit($infoVerbalnogOdgovora){
        return new UsmeniIspit($infoVerbalnogOdgovora);
    }
}