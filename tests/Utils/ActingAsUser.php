<?php

namespace Tests\Utils;

use App\Models\User;

trait ActingAsUser
{
    /**
     * Acting as a user
     *
     */
    public function actingAsUser($user = null)
    {
        if ($user === null) {
            $user = User::where('is_admin', false)->first();
        }

        return $this->actingAs($user);
    }

    /**
     * Acting as an admin
     */
    public function actingAsAdmin()
    {
        $user = User::where('is_admin', true)->first();

        return $this->actingAs($user);
    }
}
