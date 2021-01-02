<?php

namespace Tests\Feature;

use App\Models\Gender;
use Tests\TestCase;

class GenderControllerTest extends TestCase
{
    public function testIndex()
    {
        $attr = [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'is_active' => $this->faker->boolean
        ];

        Gender::create($attr);
        $response = $this->get('api/genders');
        $response->assertStatus(200);
        $this->assertEquals($response->json('total'), 1);

    }

    public function testStore()
    {
        $attr = [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'is_active' => $this->faker->boolean
        ];


        $response = $this->json('POST', route('api.genders.store'), $attr);
        $response->assertStatus(201);
        $response->assertSeeText($attr['name']);
        $this->assertEquals($response->json('name'), $attr['name']);
    }
    public function testStoreNameNotNull()
    {

        $response = $this->json('POST', route('api.genders.store'),[
            'name' => ''
        ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name']);


    }

    public function testStoreValidationNameMax()
    {

        $response = $this->json('POST', route('api.genders.store'),[
            'name' => $this->faker->sentence(258)
        ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name']);

    }
    public function testStoreValidationActive()
    {

        $response = $this->json('POST', route('api.genders.store'),[
            'name' => $this->faker->name,
            'is_active' => 'false'
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['is_active']);
    }


    public function testShow()
    {
        $attr = [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'is_active' => $this->faker->boolean
        ];

        $gender = Gender::create($attr);
        $response = $this->json('GET', route('api.genders.show', $gender->id) );
        $response->assertStatus(200);
        $this->assertEquals($response->json('name'), $attr['name']);

    }

    public function testUpdate()
    {
        $attr = [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'is_active' => $this->faker->boolean
        ];

        $gender = Gender::create($attr);
        $response = $this->json('PUT', route('api.genders.show', $gender->id), [
            'name' => $attr['name']
        ]);

        $response->assertStatus(200);
        $this->assertEquals($response->json('name'), $attr['name']);

    }

    public function testUpdateNameNotNull()
    {
        $attr = [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'is_active' => $this->faker->boolean
        ];

        $gender = Gender::create($attr);
        $response = $this->json('PUT', route('api.genders.show', $gender->id), [
            'name' => ''
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name']);

    }

    public function testUpdateDescriptionNull()
    {
        $attr = [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'is_active' => $this->faker->boolean
        ];

        $gender = Gender::create($attr);
        $response = $this->json('PUT', route('api.genders.show', $gender->id), [
            'name' => $attr['name'],
            'description' => null
        ]);

        $response->assertStatus(200);
        $this->assertNull($response->json('description'));

    }

    public function testDestroy()
    {
        $attr = [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'is_active' => $this->faker->boolean
        ];

        $gender = Gender::create($attr);
        $response = $this->json('DELETE', route('api.genders.destroy', $gender->id));

        $response->assertStatus(204);
        $response->assertNoContent();

    }
}
