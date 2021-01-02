<?php

namespace Tests\Unit;

use App\Models\Gender;
use Tests\TestCase;


class GenderTest extends TestCase
{
    public function testClassExist()
    {
        $gender = new Gender();
        $this->assertInstanceOf(Gender::class, $gender);
    }

    public function testFillable()
    {
        $gender = new Gender();
        $array = ['name', 'description', 'is_active'];
        $this->assertEquals($array, $gender->getFillable());
    }

    public function testNewInstance(){
        $attr = [
            'name' => $this->faker->name
        ];

        $gender = new Gender($attr);
        self::assertEquals($attr, $gender->getAttributes());
    }
}
