<?php

class CartItem {
    private $product;
    private $quantity;

    public function __construct($product, $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getTotalPrice()
    {
        return $this->product->getPrice() * $this->quantity;
    }
}

class ShoppingCart {
    private $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function addItem($product, $quantity)
    {
        $cartItem = new CartItem($product, $quantity);
        $this->items[] = $cartItem;
    }

    public function calculateTotalPrice()
    {
        $totalPrice = 0;

        foreach ($this->items as $item) {
            $totalPrice += $item->getTotalPrice();
        }

        return $totalPrice;
    }
}




























# La classe CartItem représente chaque article individuel dans le panier. Elle possède des méthodes pour récupérer le produit, la quantité et calculer le prix total.

#La classe ShoppingCart utilise maintenant une collection d'objets CartItem au lieu d'un simple tableau associatif. Cela permet d'ajouter des comportements spécifiques à la collection, tels que la méthode calculateTotalPrice(), qui itère sur les CartItem et calcule le prix total en utilisant la méthode getTotalPrice() de chaque objet CartItem.
