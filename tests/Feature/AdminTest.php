<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\HelpTrait;

class AdminTest extends TestCase
{
    use WithFaker;
    use HelpTrait;

    /** @test */
    public function admin_can_see_list_of_couriers()
    {
        $this->withoutExceptionHandling();
        $admin = $this->find_admin();
        // dump($admin->email);

        $token = $this->post('/api/login', [
            'email' => $admin->email,
            'password' => '123123123',
        ])->getOriginalContent()->token;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/admin/couriers');

        $response->assertStatus(200);
    }    

}
