<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $client = new Client();
        // $response = $client->request('GET', 'delivery.test/api/orders', [
        //     'headers' => [
        //         'Accept' => 'application/json',
        //     ],
        // ]);
        // return $response;
        return view('home');

    }
}
