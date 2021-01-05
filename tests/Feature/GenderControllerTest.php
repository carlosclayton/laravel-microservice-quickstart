<?php

namespace Tests\Feature;

use App\Models\Gender;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class GenderControllerTest extends TestCase
{
    /**
     * @test
     * @testdox Index controller
     * @group ignore
     */
    public function testIndex()
    {
        $gender = factory(Gender::class)->create();
        $response = $this->get('api/genders');
        $response->assertStatus(200);
        $this->assertEquals($response->json('total'), 1);

    }

    /**
     * @test
     * @testdox Store Controller
     * @group ignore
     */
    public function testStore()
    {
        $attr = [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'is_active' => $this->faker->boolean
        ];


        $response = $this->json('POST', route('api.genders.store'), $attr);
        $response->assertStatus(201)
                 ->assertSeeText($attr['name']);
        $this->assertEquals($response->json('name'), $attr['name']);
    }

    /**
     * @test
     * @testdox Store Controller Uuid Validation
     * @group ignore
     */
    public function testStoreUuidValidation(){

        $attr = [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'is_active' => $this->faker->boolean
        ];

        $response = $this->json('POST', route('api.genders.store'), $attr);
        $response->assertStatus(201);
        $response->assertSeeText($attr['name']);

        $this->assertTrue(Uuid::isValid($response->json('id')));

    }

    /**
     * @test
     * @testdox Store Controller with name Null
     * @group ignore
     */
    public function testStoreNameNotNull()
    {

        $response = $this->json('POST', route('api.genders.store'),[
            'name' => ''
        ]);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);


    }
    /**
     * @test
     * @testdox Store Controller with name max
     * @group ignore
     */
    public function testStoreValidationNameMax()
    {

        $response = $this->json('POST', route('api.genders.store'),[
            'name' => $this->faker->sentence(258)
        ]);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);

    }

    /**
     * @test
     * @testdox Store Controller is active
     * @group ignore
     */
    public function testStoreValidationActive()
    {

        $response = $this->json('POST', route('api.genders.store'),[
            'name' => $this->faker->name,
            'is_active' => 'false'
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['is_active']);
    }

    /**
     * @test
     * @testdox Show Controller
     * @group ignore
     */
    public function testShow()
    {
        $gender = factory(Gender::class)->create();
        $response = $this->json('GET', route('api.genders.show', $gender->id) );
        $response->assertStatus(200)
                 ->assertJson($gender->getAttributes());

    }

    /**
     * @test
     * @testdox Update Controller
     * @group ignore
     */
    public function testUpdate()
    {
        $gender = factory(Gender::class)->create();
        $response = $this->json('PUT', route('api.genders.show', $gender->id), [
            'name' => 'Series'
        ]);

        $response->assertStatus(200);
        $this->assertEquals($response->json('name'), 'Series');

    }

    /**
     * @test
     * @testdox Update Controller  with name null
     * @group ignore
     */
    public function testUpdateNameNotNull()
    {
        $gender = factory(Gender::class)->create();
        $response = $this->json('PUT', route('api.genders.show', $gender->id), [
            'name' => ''
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name']);

    }
    /**
     * @test
     * @testdox Update Controller  with description null
     * @group ignore
     */
    public function testUpdateDescriptionNull()
    {
        $gender = factory(Gender::class)->create();
        $response = $this->json('PUT', route('api.genders.show', $gender->id), [
            'name' => $this->faker->name,
            'description' => null
        ]);

        $response->assertStatus(200);
        $this->assertNull($response->json('description'));
    }

    /**
     * @test
     * @testdox Destroy Controller
     * @group ignore
     */
    public function testDestroy()
    {
        $gender = factory(Gender::class)->create();
        $response = $this->json('DELETE', route('api.genders.destroy', $gender->id));

        $response->assertStatus(204)
                 ->assertNoContent();

    }
}
