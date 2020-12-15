<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Section;
use App\Models\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserCanCreateTask()
    {
        //Send Section from Database
        $section = Section::factory()->create();

        //Try Accessing API
        $response = $this->postJson('/api/tasks',[
            'section_id' => $section->id,
            'name'       => $this->faker->realText(25,2),
            'state'      => $this->faker->randomElement(['done','todo']),
        ]);

        //Should be able to get the section with status 201 for new data
        $response->assertStatus(201);
    }
}
