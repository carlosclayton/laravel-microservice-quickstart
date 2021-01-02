<?php

namespace Tests\Feature;

use App\Models\Gender;
use Tests\TestCase;

class GenderModelTest extends TestCase
{
    /**
     * @test
     * @testdox Adding Gender
     */
    public function testNewGender()
    {
        $attr = [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'is_active' => $this->faker->boolean
        ];

        $category = Gender::create($attr);

        self::assertDatabaseHas('genders', $attr);

    }

    /**
     * @test
     * @testdox Updating Gender
     */
    public function testUpdateGender()
    {

        $attr = [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'is_active' => $this->faker->boolean
        ];


        $category = Gender::create($attr);
        $category->is_active = false;
        $category->description = null;

        $category->save();

        $this->assertFalse($category->is_active);
        $this->assertNull($category->description);
        self::assertDatabaseHas('genders', $category->getAttributes());
    }

    /**
     * @test
     * @testdox Showing Gender
     */
    public function testShowGender()
    {

        $attr = [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'is_active' => $this->faker->boolean
        ];

        $user = Gender::create($attr);
        $last = Gender::latest()->first();
        self::assertDatabaseHas('genders', $last->getAttributes());
    }

    /**
     * @test
     * @testdox Removing Gender
     */
    public function testDestroyGender()
    {

        $attr = [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'is_active' => $this->faker->boolean
        ];

        $category = Gender::create($attr);

        $category->delete();
        self::assertSoftDeleted('genders', $category->getAttributes());
    }
}
