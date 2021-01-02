<?php

namespace Tests\Feature;

use App\Models\Gender;
use Tests\TestCase;

class GenderModelTest extends TestCase
{


    /**
     * @test
     * @testdox Adding Gender
     * @group ignore
     */
    public function testNewGender()
    {
        $gender = factory(Gender::class)->create();
        $this->assertDatabaseHas('genders', $gender->getAttributes());

    }


    /**
     * @test
     * @testdox Updating Gender
     * @group ignore
     */
    public function testUpdateGender()
    {

        $gender = factory(Gender::class)->create();

        $gender->is_active = false;
        $gender->description = null;

        $gender->save();

        $this->assertFalse($gender->is_active);
        $this->assertNull($gender->description);

        $this->assertDatabaseHas('genders', $gender->getAttributes());
    }

    /**
     * @test
     * @testdox Showing Gender
     * @group ignore
     */
    public function testShowGender()
    {

        $gender = factory(Gender::class)->create();
        $this->assertDatabaseHas('genders', $gender->getAttributes());
    }

    /**
     * @test
     * @testdox Removing Gender
     * @group ignore
     */
    public function testDestroyGender()
    {

        $gender = factory(Gender::class)->create();

        $gender->delete();
        $this->assertSoftDeleted('genders', $gender->getAttributes());
    }
}
