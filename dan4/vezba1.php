<?php

abstract class Room {
    protected int $number;
    protected bool $hasBathroom;
    protected bool $hasBalcony;
    

    public function __construct(int $number, ) {
        $this->number = $number;
       
    }

    public function setBathroom(bool $hasBathroom): void{
        $this->hasBathroom = $hasBathroom;
    }

    public function setBalcony(bool $hasBalcony) : void {
        $this->hasBalcony = $hasBalcony;
    }

    abstract public function getBeds();
}

class SingleRoom extends Room{
    public function getBeds(){
        return 1;
    }
}

class DoubleRoom extends Room{
    public function getBeds(){
        return 2;
}
}
class TripleRoom extends Room{
    public function getBeds(){
        return 3;
    }
}

interface RoomBuilder{
public function buildRoom(int $number): Room ;

}
class SingleRoomBuilder implements RoomBuilder{
    public function buildRoom(int $number): Room{
        echo "Jednokrevetna soba je kreirana";
        return new SingleRoom($number);
    }
}

class DoubleRoomBuilder implements RoomBuilder{
    public function buildRoom(int $number): Room{
        echo "Dvokrevetna soba je kreirana";
        return new DoubleRoom($number);
    }
}

class TripleRoomBuilder implements RoomBuilder{
    public function buildRoom(int $number): Room{
        echo "Trokrevetna soba je kreirana";
        return new TripleRoom($number);
    }
}







$builder = new SingleRoomBuilder();
$room = $builder->buildRoom(101);