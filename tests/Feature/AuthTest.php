<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{   
    use WithFaker;

    /** @test */
    public function user_can_register()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/register', [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => '123123123',
        ]);

        $res = $response->getOriginalContent(); 

        $response->assertStatus(201)->assertJsonFragment([
            'token' => $res->token,
        ]);
    }

    /** @test */
    public function courier_can_register()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/register_courier', [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => '123123123',
        ]);

        $res = $response->getOriginalContent(); 

        $response->assertStatus(201)->assertJsonFragment([
            'token' => $res->token,
        ]);
    }

    /** @test */
    public function user_can_login()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/register', [
            'name' => $name = $this->faker->name,
            'email' => $email = $this->faker->email,
            'password' => $password = '123123123',
        ]);

        $response = $this->post('/api/login', [
            'email' => $email,
            'password' => $password,
        ]);

        $res = $response->getOriginalContent(); 

        $response->assertStatus(200)->assertJsonFragment([
            'token' => $res->token,
        ]);
    }

    /** @test */
    public function courier_can_login()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/register_courier', [
            'name' => $name = $this->faker->name,
            'email' => $email = $this->faker->email,
            'password' => $password = '123123123',
        ]);

        $response = $this->post('/api/login_courier', [
            'email' => $email,
            'password' => $password,
        ]);

        $res = $response->getOriginalContent(); 

        $response->assertStatus(200)->assertJsonFragment([
            'token' => $res->token,
        ]);
    }
}
