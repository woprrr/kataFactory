<?php

class ShoppingCart {
    private $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function addItem($product, $quantity)
    {
        $this->items[] = [
            'product' => $product,
            'quantity' => $quantity,
        ];
    }

    public function calculateTotalPrice()
    {
        $totalPrice = 0;

        foreach ($this->items as $item) {
            $product = $item['product'];
            $quantity = $item['quantity'];
            $totalPrice += $product->getPrice() * $quantity;
        }

        return $totalPrice;
    }
}




























# Dans cet exemple, la classe ShoppingCart gère une liste d'articles (items) et permet d'ajouter des articles au panier (addItem) et de calculer le prix total (calculateTotalPrice). Cependant, la collection d'articles ($items) est simplement un tableau associatif sans comportement propre.

# Selon le principe de "First class collection", les collections devraient être des objets de première classe avec leurs propres comportements et opérations. Elles ne devraient pas simplement être représentées par des tableaux associatifs ou des tableaux simples.
