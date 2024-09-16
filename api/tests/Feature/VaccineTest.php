<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Vaccine;
use Illuminate\Support\Facades\Cache;
use Mockery;

class VaccineTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();        
    }

    /**
     * Test creating a vaccine with valid data.
     *
     * @return void
     */
    public function test_it_can_create_a_vaccine_with_valid_data()
    {
        $data = [
            'name' => 'Hepatitis B',
            'batch_number' => '123',
            'expiration_date' => now()->addYear()->toDateString(),
        ];

        $response = $this->postJson('/api/vaccines', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment([
                     'name' => 'Hepatitis B',
                     'batch_number' => '123',
                     'expiration_date' => $data['expiration_date'],
                 ]);

        $this->assertDatabaseHas('vaccines', [
            'name' => 'Hepatitis B',
            'batch_number' => '123',
            'expiration_date' => $data['expiration_date'],
        ]);
    }

    /**
     * Test creating a vaccine with invalid data.
     *
     * @return void
     */
    public function test_it_fails_to_create_a_vaccine_with_invalid_data()
    {
        $data = [
            'name' => '',
            'batch_number' => '1', // Invalid batch number
            'expiration_date' => 'invalid-date',
        ];

        $response = $this->postJson('/api/vaccines', $data);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name', 'batch_number', 'expiration_date']);
    }

    /**
     * Test creating a vaccine with a duplicate name.
     *
     * @return void
     */
    public function test_it_fails_to_create_a_vaccine_with_duplicate_name()
    {
        $existingVaccine = Vaccine::factory()->create([
            'name' => 'Flu Vaccine',
        ]); 

        $data = [
            'name' => 'Flu Vaccine', // name duplicado
            'batch_number' => '456',
            'expiration_date' => now()->addYear()->toDateString(),
        ];

        $response = $this->postJson('/api/vaccines', $data);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
