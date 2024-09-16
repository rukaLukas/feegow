<?php

namespace Database\Factories;

use App\Models\Vaccine;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class VaccineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vaccine::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word . ' Vaccine',
            'batch_number' => $this->faker->numberBetween(100, 999),
            'expiration_date' => $this->faker->dateTimeBetween('now', '+2 years')->format('Y-m-d'),
        ];
    }
}
