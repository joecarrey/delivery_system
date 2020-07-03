<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\User;
use Mail;

class NewOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $order;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // sleep(10);
        // whereHas DOES NOT work
        $admin = User::all()->map(function ($doc) {
                $x = $doc->roles;
                $role = $doc->roles;
                if($role[0]->name == 'admin')
                    return $doc;
            });
        foreach ($admin as $a){
            if($a != null)
                $admin = $a;
        }
        $temp = json_decode($this->order, true);
        $temp['email'] = $admin->email;

        Mail::send('mail.sendmail', $temp, function($msg) use ($temp){
          $msg->to($temp['email']);
          $msg->subject('New Order');
        });
    }
}
