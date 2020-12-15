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
}
