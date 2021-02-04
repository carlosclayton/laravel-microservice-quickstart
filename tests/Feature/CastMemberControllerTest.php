<?php

namespace Tests\Feature;

use App\Models\CastMember;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class CastMemberControllerTest extends TestCase
{
    private $attr;
    private $castmember;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->attr = [
            'name' => $this->faker->name,
            'type' => array_rand([CastMember::TYPE_ACTOR, CastMember::TYPE_DIRECTOR]),
            'description' => $this->faker->sentence
        ];

        $this->castmember = CastMember::create($this->attr);
    }

    public function testIndex()
    {

        $response = $this->get('api/castmembers');
        $response->assertStatus(200);
        $this->assertEquals($response->json('total'), 1);

    }

    public function testStore()
    {


        $response = $this->json('POST', route('api.castmembers.store'), $this->attr);
        $response->assertStatus(201);

        $this->assertEquals($response->json('name'), $this->attr['name']);
        $this->assertEquals($response->json('type'), $this->attr['type']);
        $this->assertEquals($response->json('description'), $this->attr['description']);
    }


    public function testStoreUuidValidation(){

        $response = $this->json('POST', route('api.castmembers.store'), $this->attr);
        $response->assertStatus(201);
        $this->assertTrue(Uuid::isValid($response->json('id')));

    }

    public function testStoreNameNotNull()
    {

        $response = $this->json('POST', route('api.castmembers.store'),[
            'name' => ''
        ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name']);

    }

    public function testStoreValidationNameMax()
    {

        $response = $this->json('POST', route('api.castmembers.store'),[
            'name' => $this->faker->sentence(258)
        ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name']);

    }



    public function testShow()
    {

        $response = $this->json('GET', route('api.castmembers.show', $this->castmember->id) );
        $response->assertStatus(200);
        $this->assertEquals($response->json('name'), $this->castmember->name);

    }

    public function testUpdate()
    {

        $response = $this->json('PUT', route('api.castmembers.show', $this->castmember->id), [
            'name' => $this->faker->name
        ]);

        $response->assertStatus(200);
        $this->assertEquals($response->json('name'), $this->castmember->name);

    }

    public function testUpdateNameNotNull()
    {

        $response = $this->json('PUT', route('api.castmembers.show', $this->castmember->id), [
            'name' => ''
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name']);

    }

    public function testUpdateDescriptionNull()
    {

        $response = $this->json('PUT', route('api.castmembers.show', $this->castmember->id), [
            'name' => $this->faker->name,
            'description' => null
        ]);

        $response->assertStatus(200);
        $this->assertNull($response->json('description'));

    }

    public function testDestroy()
    {

        $response = $this->json('DELETE', route('api.castmembers.destroy', $this->castmember->id));

        $response->assertStatus(204);
        $response->assertNoContent();

    }
}
