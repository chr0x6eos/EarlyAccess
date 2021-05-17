<?php

namespace App\Actions\Jetstream;

use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {
        // Don't allow deletion of admin
        if($user->email !== "admin@earlyaccess.htb")
        {
            $user->sent->each->delete();
            $user->received->each->delete();
            $user->score->each->delete();
            $user->delete();
        }
    }
}
