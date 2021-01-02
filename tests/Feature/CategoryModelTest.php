<?php

namespace Tests\Feature;

use App\Models\Category;
use Tests\TestCase;

class CategoryModelTest extends TestCase
{
    /**
     * @test
     * @testdox Adding Category
     */
    public function testNewCategory()
    {
        $attr = [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'is_active' => $this->faker->boolean
        ];

        $category = Category::create($attr);

        self::assertDatabaseHas('categories', $attr);

    }

    /**
     * @test
     * @testdox Updating Category
     */
    public function testUpdateCategory()
    {

        $attr = [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'is_active' => $this->faker->boolean
        ];


        $category = Category::create($attr);
        $category->is_active = false;
        $category->description = null;

        $category->save();

        $this->assertFalse($category->is_active);
        $this->assertNull($category->description);
        self::assertDatabaseHas('categories', $category->getAttributes());
    }

    /**
     * @test
     * @testdox Showing Category
     */
    public function testShowCategory()
    {

        $attr = [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'is_active' => $this->faker->boolean
        ];

        $user = Category::create($attr);
        $last = Category::latest()->first();
        self::assertDatabaseHas('categories', $last->getAttributes());
    }

    /**
     * @test
     * @testdox Removing Category
     */
    public function testDestroyCategory()
    {

        $attr = [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'is_active' => $this->faker->boolean
        ];

        $category = Category::create($attr);

        $category->delete();
        self::assertSoftDeleted('categories', $category->getAttributes());
    }
}
