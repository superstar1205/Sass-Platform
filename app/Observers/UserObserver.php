<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  User  $user
     * @return void
     */
    public function created(User $user)
    {
        $user->integration()->create([
            'name' => "Email notifications",
            'desc' =>  "Receive an email every time there's a new submission of your form.",
        ]);
    }

}
