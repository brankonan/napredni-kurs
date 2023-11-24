<?php

interface Vehicle {
    public function inspect();
}

class Car implements Vehicle{
    public function inspect(){
        return "Car inspection complete";
    }
}
class Bike implements Vehicle{
    public function inspect(){
        return "Bike inspecton complete";
    }
}


interface VehicleFactory{
    public function createVehicle();
}

class CarFactory implements VehicleFactory{
    public function createVehicle(){
        return new Car();
    }
}

class BikeFactory implements VehicleFactory{
    public function createVehicle(){
        return new Bike();
    }
}

class InspectionService{
    private static $instance;
    private $vehicleCount;


    private function __construct()
    {
        $this->vehicleCount = 0;
    }

    static function getInstance(){
        if(self::$instance == NULL){
            self::$instance = new InspectionService();
    }

    return self::$instance;
    }

    public function inspectVehicle(Vehicle $vehicle){
        echo $vehicle->inspect(); 
        $this->vehicleCount++;
    }

    public function getInspectedVehicleCount(){
        return $this->vehicleCount;
    }

}

$carFactory = new CarFactory();
$bikeFactory = new BikeFactory();

InspectionService::getInstance()->getInspectedVehicleCount();

$car = $carFactory->createVehicle();
$bike = $bikeFactory->createVehicle();

InspectionService::getInstance()->inspectVehicle($car);
InspectionService::getInstance()->inspectVehicle($bike);


