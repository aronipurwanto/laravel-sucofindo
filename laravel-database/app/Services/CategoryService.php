<?php

namespace App\Services;

interface CategoryService
{
    public function saveCategory(string $id, string $name, string $desc): void;
    public function getCategoryList(): array;
    public function removeCategory($id): void;
}
