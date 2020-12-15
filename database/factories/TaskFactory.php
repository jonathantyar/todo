<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->realText(25,2),
            'state' => $this->faker->randomElement(['done','todo']),
            'section_id' => Section::factory()->create(),
        ];
    }
}
