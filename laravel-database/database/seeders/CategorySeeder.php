<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $category = new Category();
        $category->id = "FOOD";
        $category->name = "Food";
        $category->description = "Food Category";
        $category->save();

        $category = new Category();
        $category->id = "DRINK";
        $category->name = "Drink";
        $category->description = "Drink Category";
        $category->save();

        $category = new Category();
        $category->id = "ELECTRONIK";
        $category->name = "Elektronik";
        $category->description = "Elektronik Category";
        $category->save();

        $category = new Category();
        $category->id = "SMARTPHONE";
        $category->name = "Smart Phone";
        $category->description = "Smart Phone Category";
        $category->save();
    }
}
