<?php

class Product {
  public function __construct(
    private string $name,
    private string $description,
    private int $price,
    private int $stock
  ) {}

  public function displayOnCatalog() {
      // Affiche le produit sur la page du catalogue
  }

  public function updateStock(int $quantity) {
      // Met à jour la quantité en stock
  }

  public function processOrder(OrderVO $order) {
      // Traite une commande liée au produit
  }
}
