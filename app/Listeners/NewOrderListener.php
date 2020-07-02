<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;
use App\User;

class NewOrderListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
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
        $temp = json_decode($event->order, true);
        $temp['email'] = $admin->email;

        Mail::send('mail.sendmail', $temp, function($msg) use ($temp){
          $msg->to($temp['email']);
          $msg->subject('New Order');
        });
    }
}
