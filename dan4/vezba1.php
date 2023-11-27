<?php

abstract class Room
{
    protected int $number;
    protected bool $hasBathroom;
    protected bool $hasBalcony;

    public function __construct(int $number)
    {
        $this->number = $number;
    }

    public function setBathroom(bool $hasBathroom): void
    {
        $this->hasBathroom = $hasBathroom;
    }

    public function setBalcony(bool $hasBalcony): void
    {
        $this->hasBalcony = $hasBalcony;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    abstract public function getBeds();
}

class SingleRoom extends Room
{
    public function getBeds()
    {
        return 1;
    }
}

class DoubleRoom extends Room
{
    public function getBeds()
    {
        return 2;
    }
}
class TripleRoom extends Room
{
    public function getBeds()
    {
        return 3;
    }
}

interface RoomBuilder
{
    public function buildRoom(int $number): Room;
}
class SingleRoomBuilder implements RoomBuilder
{
    public function buildRoom(int $number): Room
    {
        echo 'Jednokrevetna soba je kreirana';
        return new SingleRoom($number);
    }
}

class DoubleRoomBuilder implements RoomBuilder
{
    public function buildRoom(int $number): Room
    {
        echo 'Dvokrevetna soba je kreirana';
        return new DoubleRoom($number);
    }
}

class TripleRoomBuilder implements RoomBuilder
{
    public function buildRoom(int $number): Room
    {
        echo 'Trokrevetna soba je kreirana';
        return new TripleRoom($number);
    }
}

//vezba 2
interface HotelObserver
{
    public function attach(User $user, string $roomType);
    public function detach(User $user, string $roomType);
    public function notify(string $roomType);
}
class Hotel implements HotelObserver
{
    private static $instance;
    private $rooms = [];
    private $availableRooms = [SingleRoom::class => 0, DoubleRoom::class => 0, TripleRoom::class => 0];
    private $subscribers = [SingleRoom::class => [], DoubleRoom::class => [], TripleRoom::class => []];


    public static function getInstance(): Hotel
    {
        if (self::$instance == null) {
            self::$instance = new Hotel();
        }
        return self::$instance;
    }

    public function addRoom(Room $room): void
    {
        $this->rooms[] = $room;
        $this->availableRooms[$room::class]++;
    }

    public function rentRoom(string $roomType,User $user): void
    {
        if ($this->availableRooms[$roomType] > 0) {
            $this->availableRooms[$roomType]--;
            echo "Soba tipa $roomType je iznajmljena.";
        } else {
            echo "Nema slobodnih soba tipa $roomType. Dodajemo vas na listu cekanja.";
            $this->attach($user, $roomType);
        }
    }
    public function returnRoom(Room $room): void
    {
        $this->availableRooms[$room::class]++;
        echo 'Soba sa brojem' . $room->getNumber() . 'je slobodna';
    }

    public function subscribe(string $roomType): void
    {
        $this->subscribers[] = $roomType;
    }

    public function notify(string $roomType): void
    {
        foreach($this->subscribers as $user) {
            $user->notify();
        }
    }
    public function attach( User $user, string $roomType)
    {
        $this->subscribers[$roomType][] = $user;
    }
    public function detach(User $user, string $roomType)
    {
        unset($this->subscribers[$roomType][$user]);
    }


}

//vezba 3
class User
{
    private string $name;
    private string $surname;
    private string $jmbg;

    public function __construct(string $name, string $surname, string $jmbg)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->jmbg = $jmbg;
    }


    public function notify()
    {
        echo "User $this->name , $this->surname je obavesten";
    }
}

$hotel = Hotel::getInstance();

$singleRoomBuilder = new SingleRoomBuilder();
// $doubleRoomBuilder = new DoubleRoomBuilder();
// $tripleRoomBuilder = new TripleRoomBuilder();


$room1 = $singleRoomBuilder->buildRoom(101);
// $room2 = $doubleRoomBuilder->buildRoom(102);
// $room3 = $tripleRoomBuilder->buildRoom(103);


$hotel->addRoom($room1);
// $hotel->addRoom($room2);
// $hotel->addRoom($room3);

$user = new User('marko', 'markovic', '1234567890123');


$hotel->rentRoom(SingleRoom::class, $user);
$hotel->rentRoom(SingleRoom::class, $user);

$hotel->returnRoom($room1);

$user->notify();