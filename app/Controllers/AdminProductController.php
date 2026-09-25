<?php

require_once __DIR__ . '/../Models/Product.php';
require_once __DIR__ . '/../Models/Category.php';

class AdminProductController
{
    private Product $product;
    private Category $category;

    public function __construct()
    {
        $this->product = new Product();
        $this->category = new Category();
    }

    public function index(): array
    {
        return $this->product->getAllForAdmin();
    }

    public function show(int $id): ?array
    {
        return $this->product->findByIdForAdmin($id);
    }

    public function categories(): array
    {
        return $this->category->getAllForAdmin();
    }

    public function create(array $data): int
    {
        return $this->product->create(
            trim($data['name'] ?? ''),
            trim($data['slug'] ?? ''),
            !empty($data['description'])
                ? trim($data['description'])
                : null,
            (float) ($data['price'] ?? 0),
            !empty($data['compare_price'])
                ? (float) $data['compare_price']
                : null,
            !empty($data['image'])
                ? trim($data['image'])
                : null,
            (int) ($data['category_id'] ?? 0),
            (int) ($data['stock'] ?? 0),
            $data['status'] ?? 'active'
        );
    }

    public function update(
        int $id,
        array $data
    ): bool {
        return $this->product->update(
            $id,
            trim($data['name'] ?? ''),
            trim($data['slug'] ?? ''),
            !empty($data['description'])
                ? trim($data['description'])
                : null,
            (float) ($data['price'] ?? 0),
            !empty($data['compare_price'])
                ? (float) $data['compare_price']
                : null,
            !empty($data['image'])
                ? trim($data['image'])
                : null,
            (int) ($data['category_id'] ?? 0),
            (int) ($data['stock'] ?? 0),
            $data['status'] ?? 'active'
        );
    }

    public function updateStock(
        int $id,
        int $stock
    ): bool {
        return $this->product->updateStock(
            $id,
            $stock
        );
    }

    public function updateStatus(
        int $id,
        string $status
    ): bool {
        return $this->product->updateStatus(
            $id,
            $status
        );
    }

    public function delete(int $id): bool
    {
        return $this->product->delete($id);
    }
}