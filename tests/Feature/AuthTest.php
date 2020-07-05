<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Generator as Faker;

class AuthTest extends TestCase
{
    /** @test */
    public function user_can_register()
    {

        $this->withoutExceptionHandling();
        $response = $this->post('/api/register', [
            'name' => 'Testing name',
            'email' => 'testing_01@email.com',
            'password' => '123123123',
        ]);

        $response->assertStatus(201);
    }
}
