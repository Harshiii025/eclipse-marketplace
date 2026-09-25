<?php

require_once __DIR__ . '/../Models/Product.php';

class ProductController
{
    private Product $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    public function index(): array
    {
        $products = $this->product->getAll();

        foreach ($products as &$product) {
            $product['category'] =
                $product['category_name'] ?? '';
        }

        return $products;
    }

    public function show(int $id): ?array
    {
        $product = $this->product->findById($id);

        if ($product) {
            $product['category'] =
                $product['category_name'] ?? '';
        }

        return $product;
    }

    public function showBySlug(string $slug): ?array
    {
        $product = $this->product->findBySlug($slug);

        if ($product) {
            $product['category'] =
                $product['category_name'] ?? '';
        }

        return $product;
    }
}