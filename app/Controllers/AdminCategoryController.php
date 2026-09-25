<?php

require_once __DIR__ . '/../Models/Category.php';

class AdminCategoryController
{
    private Category $category;

    public function __construct()
    {
        $this->category = new Category();
    }

    public function index(): array
    {
        return $this->category->getAllForAdmin();
    }

    public function show(int $id): ?array
    {
        return $this->category->findById($id);
    }

    public function create(array $data): int
    {
        return $this->category->create(
            trim($data['name'] ?? ''),
            trim($data['slug'] ?? ''),
            !empty($data['description'])
                ? trim($data['description'])
                : null
        );
    }

    public function update(
        int $id,
        array $data
    ): bool {
        return $this->category->update(
            $id,
            trim($data['name'] ?? ''),
            trim($data['slug'] ?? ''),
            !empty($data['description'])
                ? trim($data['description'])
                : null,
            $data['status'] ?? 'active'
        );
    }

    public function updateStatus(
        int $id,
        string $status
    ): bool {
        return $this->category->updateStatus(
            $id,
            $status
        );
    }

    public function delete(int $id): bool
    {
        return $this->category->delete($id);
    }
}