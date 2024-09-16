<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase; // Resets the database between tests

    /** @test */
    public function it_can_list_employees()
    {
        // Arrange
        Employee::factory()->count(3)->create();

        // Act
        $response = $this->getJson('/api/employees');

        // Assert
        $response->assertStatus(200);
        $response->assertJsonCount(13, 'data');
    }

    /** @test */
    public function it_creates_an_employee_with_valid_data()
    {
        $cpf = preg_replace('/[^0-9]/', '', $this->ptBrFaker->cpf);
        // Arrange: prepara os dados
        $validData = [
            'name' => 'John Doe',
            'cpf' => $cpf,
            'date_of_birth' => '1990-01-01',
            'comorbidities' => true,
        ];

        // Act: envia requisição
        $response = $this->postJson(route('employees.store'), $validData);

        // Assert: verifica resposta esta correta
        $response->assertStatus(201)
        ->assertJsonPath('data.response.name', 'John Doe')
        ->assertJsonPath('data.response.cpf', $cpf)
        ->assertJsonPath('data.response.date_of_birth', '1990-01-01')
        ->assertJsonPath('data.response.comorbidities', true);

        // verifica se foi creado registro no banco
        $this->assertDatabaseHas('employees', [
            'name' => 'John Doe',
            'cpf' => $cpf,
            'date_of_birth' => '1990-01-01',
            'comorbidities' => true,
        ]);
    }

    /** @test */
    public function it_fails_to_create_an_employee_with_invalid_data()
    {
         // Arrange: prepara os dados
        $invalidData = [
            'name' => 'Jo', 
            'cpf' => '123.456.789-01',
            'date_of_birth' => '2025-01-01', 
            'comorbidities' => 'invalid'
        ];
    
        // Act: envia requisição
        $response = $this->postJson('/api/employees', $invalidData);
    
         // Assert: verifica resposta esta com os erros de validação
        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'name',
                'cpf',
                'date_of_birth',
                'comorbidities'
            ]);
    }

    /** @test */
    public function it_fails_to_create_an_employee_with_duplicate_cpf()
    {
        // Arrange: prepara os dados        
        // Cria um employee válido
        $existingEmployee = Employee::factory()->create([
            'cpf' => '12345678909'
        ]);

        // tenta criar outro employee com mesmo CPF
        $duplicateData = [
            'name' => 'Duplicate Employee',
            'cpf' => $existingEmployee->cpf, // CPF duplicado
            'date_of_birth' => '1990-01-01',
            'comorbidities' => true
        ];

        // Act: Envia Requisição
        $response = $this->postJson('/api/employees', $duplicateData);

        // Assert: erro de CPF duplicado
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['cpf']);
    }


    /** @test */
    public function it_can_create_an_employee()
    {
        // Arrange
        $cpf = preg_replace('/[^0-9]/', '', $this->ptBrFaker->cpf);
        $employeeData = [
            'name' => 'John Doe',
            'cpf' =>  $cpf,
            'date_of_birth' => '1990-01-01',
            'comorbidities' => false,
        ];

        // Act
        $response = $this->postJson('/api/employees', $employeeData);

        // Assert
        $response->assertStatus(201);
        $this->assertDatabaseHas('employees', ['cpf' => $cpf]);
    }

    /** @test */
    public function it_can_show_an_employee()
    {
        // Arrange
        $employee = Employee::factory()->create();

        // Act
        $response = $this->getJson("/api/employees/{$employee->id}");

        // Assert
        $response->assertStatus(200);
        $response->assertJsonPath('data.id', $employee->id);
    }

    /** @test */
    public function it_can_update_an_employee()
    {
        // Arrange
        $employee = Employee::factory()->create();
        $updatedData = ['name' => 'Updated Name'];

        // Act
        $response = $this->putJson("/api/employees/{$employee->id}", $updatedData);

        // Assert
        $response->assertStatus(200);
        $this->assertDatabaseHas('employees', ['id' => $employee->id, 'name' => 'Updated Name']);
    }

    /** @test */
    public function it_can_delete_an_employee()
    {
        // Arrange
        $employee = Employee::factory()->create();

        // Act
        $response = $this->deleteJson("/api/employees/{$employee->id}");

        // Assert
        $response->assertStatus(204);
        $this->assertDatabaseMissing('employees', ['id' => $employee->id]);
    }
}