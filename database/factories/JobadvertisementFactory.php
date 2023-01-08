<?php

namespace Database\Factories;

use App\Models\Jobadvertisement;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jobadvertisement>
 */
class JobadvertisementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Jobadvertisement::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create(['role' => 'employer'])->id,
            'title' => 'Teszt Álláshirdetés',
            'location' => fake()->city(),
            'description' => fake()->paragraph(),
        ];
    }
}
