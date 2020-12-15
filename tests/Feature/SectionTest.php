<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Section;

class SectionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserCanShowSection()
    {
        //Get Section from Database
        $section = Section::orderBy('created_at','desc')->get();

        //Try Accessing API
        $api      = $this->json('get','/api/sections');
        $response = $api;

        //Should be able to get the section
        $response->assertStatus(200);
    }

    public function testUserCanCreateSection()
    {
        //Send Section from Database
        $section = Section::factory()->create();

        //Try Accessing API
        $response = $this->postJson('/api/sections',$section->toArray());

        //Should be able to get the section with status 201 for new data
        $response->assertStatus(201);
    }

    public function testUserCanShowASection()
    {
        //Get Section from Database
        $section = Section::factory()->create();

        //Try Accessing API
        $api      = $this->json('get','/api/sections/1');
        $response = $api;

        //Should be able to get the section
        $response->assertStatus(200);
    }

    public function testUserCanUpdateASection()
    {
        //Create Section Database
        $section = Section::factory()->create();

        //Try Accessing API
        $response = $this->postJson('/api/sections/update',[
            '_method' => 'put',
            'id'      => $section->id,
            'name'    => 'ChangeSection',
        ]);

        //Should be able to get the section
        $response->assertStatus(200);
    }

    public function testUserCanDeleteASection()
    {
        //Create Section Database
        $section = Section::factory()->create();

        //Try Accessing API
        $response = $this->postJson('/api/sections/delete',[
            '_method' => 'delete',
            'id'      => $section->id,
        ]);

        //Should be able to get the section
        $response->assertStatus(200);
    }
}
