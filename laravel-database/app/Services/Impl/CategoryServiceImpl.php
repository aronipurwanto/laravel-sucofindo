<?php

namespace App\Services\Impl;

use App\Models\Category;
use App\Services\CategoryService;

class CategoryServiceImpl implements CategoryService
{

    public function saveCategory(string $id, string $name, string $desc): void
    {
        $category = new Category();
        $category->id = $id;
        $category->name = $name;
        $category->description = $desc;
        $category->save();
    }

    public function getCategoryList(): array
    {
        return Category::query()->get()->toArray();
    }

    public function removeCategory($id): void
    {
        $category = Category::query()->where("id","=", $id);
        $category->delete();
    }
}
