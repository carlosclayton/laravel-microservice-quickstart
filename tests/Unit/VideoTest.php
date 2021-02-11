<?php

namespace Tests\Unit;

use App\Models\Video;
use Tests\TestCase;


class VideoTest extends TestCase
{
    /**
     * @test
     * @testdox Test Model
     */
    public function testModel()
    {
        $model = new Video();
        $fillable = ['title', 'description', 'year_launched', 'opened', 'duration', 'rating'];
        $attr = [
            'title' => $this->faker->title,
            'description' => $this->faker->sentence ,
            'year_launched' => $this->faker->year,
            'opened' => $this->faker->boolean,
            'duration' => rand(0,240),
            'rating' => Video::RATING_LIST[array_rand(Video::RATING_LIST)]
        ];

        // Model exist
        $this->assertModelExist($model);

        // Fillable Model exist
        $this->assertModelFillable($model, $fillable);

        // New Instance
        $this->assertModelNewInstance(new Video($attr), $attr);
    }


}
