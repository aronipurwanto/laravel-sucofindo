<?php

namespace Tests\Feature;

use App\Models\Category;
use Database\Seeders\CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;

class CategoryTest extends TestCase
{
    public function testInsertMany()
    {
        $categories = [];
        for ($i = 1; $i <= 10; $i++) {
            $categories[] = [
                "id" => uniqid(),
                "name" => "Category Name ${i}",
                "description" => "Category Desc ${i}"
            ];
        }

        $result = Category::query()->insert($categories);
        self::assertTrue($result);

        $total = Category::query()->count();
        assertEquals(10, $total);
    }

    public function testFind()
    {
        $this->seed(CategorySeeder::class);

        $category = Category::query()->find("FOOD");
        self::assertNotNull($category);
        assertEquals("Food", $category->name);
    }

    public function testUpdate()
    {
        $this->seed(CategorySeeder::class);

        $category = Category::query()->find("FOOD");
        self::assertNotNull($category);

        $category->name ="Food Update";
        $category->description = "Description Update";
        $category->update();

        self::assertEquals("Food Update", $category->name);
        self::assertEquals("Description Update", $category->description);
        self::assertEquals("FOOD", $category->id);
    }

    public function testWhereNull()
    {
        $categories = [];
        for ($i = 1; $i <= 10; $i++) {
            $categories[] = [
                "id" => uniqid(),
                "name" => "Category Name ${i}"
            ];
        }

        $result = Category::query()->insert($categories);
        self::assertTrue($result);

        $total = Category::query()->whereNull('description')->get();
        assertEquals(10, $total->count());

        foreach ($total as $item){
            $item->description = "Description Update";
            $item->save();
            assertNotNull($item);
        }
    }


}
