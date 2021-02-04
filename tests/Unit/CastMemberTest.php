<?php

namespace Tests\Unit;

use App\Models\CastMember;
use Tests\TestCase;


class CastMemberTest extends TestCase
{
    public function testModel()
    {
        $model = new CastMember();
        $array = ['name', 'description', 'type', 'description'];
        $attr = [
            'name' => $this->faker->name
        ];

        // Model exist
        $this->assertModelExist($model);

        // Fillable Model exist
        $this->assertModelFillable($model, $array);

        // New instance of Model
        $model = new CastMember($attr);
        $this->assertModelNewInstance($model, $attr);
    }
}
