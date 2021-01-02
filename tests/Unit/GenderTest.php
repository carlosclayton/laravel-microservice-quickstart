<?php

namespace Tests\Unit;

use App\Models\Gender;
use Tests\TestCase;


class GenderTest extends TestCase
{

    public function testModel()
    {
        $model = new Gender();
        $array = ['name', 'description', 'is_active'];
        $attr = [
            'name' => $this->faker->name
        ];

        // Model exist
        $this->assertModelExist($model);

        // Fillable Model exist
        $this->assertModelFillable($model, $array);

        // New instance of Model
        $model = new Gender($attr);
        $this->assertModelNewInstance($model, $attr);
    }


}
