<?php

class User {

private string $name;
private string $email;
private string $password;
static $count = 0;

function __construct(string $name, string $email, string $password)
{
    $this->name = $name;
    $this->email = $email;
    $this->password = $password;
    self::$count++;
}

public function getPassword (): string{
    return $this->password;
}

public function setPassword(string $password): void{
    $this->password =$password;
}

public function getEmail(): string{
    return $this->email;
}

public function setEmail(string $email): void{
    $this->email = $email;
}

public function getName(): string{
    return $this->name ;
}

public function setName(string $name): void{
    $this->$name = $name;
}


}

$user1 = new User("marko", "marko@marko.com", "markopassword");
$user2 = new User("petar", "petar@petar.com", "petarpassword");
$user3 = new User("sima", "sima@sima.com", "simapassword");

var_dump($user1);
var_dump($user2);
var_dump($user3);

echo User::$count;