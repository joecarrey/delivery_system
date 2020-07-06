<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\HelpTrait;
use App\Order;
use App\Courier;

class AdminTest extends TestCase
{
    use WithFaker;
    use HelpTrait;

    /** @test */
    public function admin_can_see_list_of_couriers()
    {
        $this->withoutExceptionHandling();

        $token = $this->post('/api/login', [
            'email' => 'joecarrey90@gmail.com',
            'password' => '123123123',
        ])->getOriginalContent()->token;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/admin/couriers');

        $response->assertStatus(200);
    }

    /** @test */
    public function admin_can_see_list_of_orders()
    {
        $this->withoutExceptionHandling();

        $token = $this->post('/api/login', [
            'email' => 'joecarrey90@gmail.com',
            'password' => '123123123',
        ])->getOriginalContent()->token;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/admin/orders');

        $response->assertStatus(200);
    }

    /** @test */
    public function admin_can_see_order_info_by_id()
    {
        $this->withoutExceptionHandling();

        $token = $this->post('/api/login', [
            'email' => 'joecarrey90@gmail.com',
            'password' => '123123123',
        ])->getOriginalContent()->token;

        $order_id = Order::first()->_id;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/admin/order/' . $order_id);

        $response->assertStatus(200);
    }

    /** @test */
    public function admin_can_assign_order_to_courier()
    {
        $this->withoutExceptionHandling();

        $token = $this->post('/api/login', [
            'email' => 'joecarrey90@gmail.com',
            'password' => '123123123',
        ])->getOriginalContent()->token;

        $order_id = Order::first()->_id;
        $courier_id =  Courier::first()->_id;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->patch('/api/admin/assign_order/' . $courier_id . '/' . $order_id);

        $response->assertStatus(200);
    }

    /** @test */
    public function admin_can_activate_courier()
    {
        $this->withoutExceptionHandling();

        $token = $this->post('/api/login', [
            'email' => 'joecarrey90@gmail.com',
            'password' => '123123123',
        ])->getOriginalContent()->token;

        $courier_id =  Courier::first()->_id;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->patch('/api/admin/activate_courier/' . $courier_id);

        $response->assertStatus(200);
    }

    /** @test */
    public function admin_can_update_order_status()
    {
        $this->withoutExceptionHandling();

        $token = $this->post('/api/login', [
            'email' => 'joecarrey90@gmail.com',
            'password' => '123123123',
        ])->getOriginalContent()->token;

        $order_id = Order::first()->_id;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->patch('/api/admin/update_status/' . $order_id, [
                'status' => 2,  
            ]);

        $response->assertStatus(200);
    }

    public function admin_can_delete_courier_profile()
    {
        $this->withoutExceptionHandling();

        $token = $this->post('/api/login', [
            'email' => 'joecarrey90@gmail.com',
            'password' => '123123123',
        ])->getOriginalContent()->token;

        $courier = Courier::first();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->delete('/api/admin/del_courier/' . $courier->_id);

        if (!empty(get_object_vars($courier->orders)))           
            $courier->orders[0]->unset('courier_id');

        $response->assertStatus(200);
    }
}
