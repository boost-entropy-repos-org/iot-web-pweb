<?php
namespace App\Classes;

class ShoppingCartItem {

    var $name, $description, $price, $quantity;

    public function __construct($name, $description, $price, $quantity)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function getTotalPrice() {
        return $this->quantity * $this->price;
    }
}
?>
