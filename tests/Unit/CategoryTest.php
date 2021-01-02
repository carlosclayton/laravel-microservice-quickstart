<?php

namespace Tests\Unit;

use App\Models\Category;
use Tests\TestCase;

//use PHPUnit\Framework\TestCase;
class CategoryTest extends TestCase
{

    public function testClassExist()
    {
        $gender = new Category();
        $this->assertInstanceOf(Category::class, $gender);
    }

    public function testFillable()
    {
        $category = new Category();
        $array = ['name', 'description', 'is_active'];
        $this->assertEquals($array, $category->getFillable());
    }

    public function testNewInstance(){
        $attr = [
            'name' => $this->faker->name
        ];

        $category = new Category($attr);
        self::assertEquals($attr, $category->getAttributes());
    }
}
