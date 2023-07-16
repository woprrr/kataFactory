<?php

class Product {
  public function __construct(
    private string $name,
    private string $description,
    private int $price,
  ) {}
}

class ProductCatalog {
  public function __construct(
    private ProductVO $product
  ) {}

  public function displayOnCatalog() {
      // Affiche le produit sur la page du catalogue
  }
}

class ProductStock {
  public function __construct(
    private StockVO $stock,
    private ProductVO $product
  ) {}

  public function updateStock(int $quantity) {
      // Met à jour la quantité en stock pour un produit donné
  }

  public function getStock() {
      // Récupère la quantité en stock pour un produit donné
  }
}

class OrderManagement {
  public function __construct(
    private ProductDTO $product,
    private OrderVO $order
  ) {}

  public function processOrder() {
      // Traite une commande liée à un produit donné
  }
}
