<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $ptBrFaker = \Faker\Factory::create('pt_BR');
        return [
            'name' => $this->faker->name,
            'cpf' => preg_replace('/[^0-9]/', '', $ptBrFaker->cpf),
            'date_of_birth' => $this->faker->date('Y-m-d', '2000-01-01'),
            'comorbidities' => $this->faker->boolean,
        ];
    }
}
