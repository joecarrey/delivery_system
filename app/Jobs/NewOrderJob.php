<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\User;
use App\HelpTrait;
use Mail;

class NewOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, HelpTrait;

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
        $admin = $this->find_admin();
        $temp = json_decode($this->order, true);
        $temp['email'] = $admin->email;

        Mail::send('mail.sendmail', $temp, function($msg) use ($temp){
          $msg->to($temp['email']);
          $msg->subject('New Order');
        });
    }
}
