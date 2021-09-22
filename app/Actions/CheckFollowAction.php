<?php

namespace App\Actions;

use App\Models\User;

class CheckFollowAction
{

    public static function checkFollow(User $user)
    {

        dd('https://api.dribbble.com/v1/users/%d/following',
            ['access_token' => $user->token],
            $user->token, $user->id);

        return true;
    }

}

