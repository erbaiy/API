<?php

namespace Tests\Feature;

use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_getAllUsers(): void
    {
        $response = $this->getJson('/api/users');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'users' => [
                    '*' => [
                        'id',
                        'name',
                        'email',
                        'created_at',
                        'updated_at'
                    ]
                ]
            ]);
    }


    public function testCreateUser()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password'
        ];

        $response = $this->json('POST', '/api/users', $userData);

        $response->assertStatus(201)
            ->assertJson([
                'user' => [
                    'name' => $userData['name'],
                    'email' => $userData['email']
                ]
            ]);
    }

    // public function testEstimatePrix()
    // {

    //     $car1 = new Car([
    //         'marque' => 'Toyota',
    //         'modele' => 'Corolla',
    //         'annee' => 2018,
    //         'prix' => 10000,
    //     ]);
    //     $car1->save();

    //     $car2 = new Car([
    //         'marque' => 'Toyota',
    //         'modele' => 'Corolla',
    //         'annee' => 2018,
    //         'prix' => 12000,
    //     ]);
    //     $car2->save();

    //     $response = $this->post('/api/estimateprix', [
    //         'marque' => 'Toyota',
    //         'modele' => 'Corolla',
    //         'annee' => 2018,
    //     ]);

    //     $response->assertStatus(200)
    //         ->assertJson([
    //             'the price pur' => 11000,
    //         ]);
    // }
}
