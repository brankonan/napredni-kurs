<?php

class User{

public int $id;
public string $name;


public function __construct(int $id, string $name)
{
    $this->id = $id;
    $this->name = $name;

}
}

class Product {
    public int $id;
    public string $name;
    public string $owner;
    public int $startingPrice;


    public function __construct(int $id, string $name, string $owner, int $startingPrice)
    {
        $this->id = $id;
        $this->name = $name;
        $this->owner = $owner;
        $this->startingPrice = $startingPrice;
    }

   
}

class AuctionMarketplace {
    private static $instance = null;
    public $wishlist = [];
    public $offers = [];

    private function __construct() {}

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new AuctionMarketplace();
        }
        return self::$instance;
    }

    function addToWishlist(User $user, Product $product) {
        $this->wishlist[] = new UserProductRelation($user->id, $product->id);
    }

    public function removeFromWishlist(User $user, Product $product){
        foreach($this->wishlist as $key => $item){
            if($product->id == $item && $user->id == $key){
                unset($this->wishlist[$key]);
            }
        }
    }

    public function makeOffer( User $user, Product $product, Bidder $bid) {
        $this->offers[] = new Bidder($user->id, $product->id, $bid);
        $this->addToWishlist($user, $product);
    }

    public function withdrawOffer(User $user, Product $product, Bidder $bid) {
        unset($this->offers[$user->id][$product->id][$bid]);
    }

    public function sellProduct($userId,$productId){

    }
        
        }



class UserProductRelation {
    public $userId;
    public $productId;

    function __construct($userId, $productId) {
        $this->userId = $userId;
        $this->productId = $productId;
    }
}

class Bidder extends UserProductRelation{
    public float $bid;

    function __construct($userId, $productId, $bid) {
        parent::__construct($userId, $productId);
        $this->bid = $bid;
    }

}


$user1 = new User(123, "Djura");
$product1 = new Product(34, "hleb", "Misha", 50);


//$market = new AuctionMarketplace();
//$market->addToWishlist($user1, $product1);
//$market->removeFromWishlist
//$market->makeOffer($user1, $product1, 1000);