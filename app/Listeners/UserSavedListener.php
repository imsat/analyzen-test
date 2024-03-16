<?php

namespace App\Listeners;

use App\Events\UserSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserSavedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserSaved $event): void
    {
        $user = $event->user;
        $addresses = $event->addresses;

        // Delete all existing addresses.
        $user->addresses()->delete();

        // Addresses data set make.
        $data = [];
        foreach ($addresses as $key => $address) {
            $data[$key]['name'] = $address;
        }

        // Create user addresses
        $user->addresses()->createMany($data);
    }
}
