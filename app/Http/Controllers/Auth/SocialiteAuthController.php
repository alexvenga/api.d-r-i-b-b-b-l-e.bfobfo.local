<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialiteAuthController extends Controller
{


    public function callback()
    {

        try {
            $userSocial = Socialite::driver('dribbble')->user();
            $user = User::find($userSocial->getId());
            if ($user) {
                $user->update([
                    'nickname' => $userSocial->getNickname(),
                    'name'     => $userSocial->getName(),
                    'avatar'    => $userSocial->getAvatar(),
                ]);
            } else {
                $user = User::create([
                    'id'                => $userSocial->getId(),
                    'nickname'          => $userSocial->getNickname(),
                    'name'              => $userSocial->getName(),
                    'avatar'             => $userSocial->getAvatar(),
                ]);
            }
            Auth::login($user, true);
            return redirect()->intended('/');
        } catch (\Throwable $error) {

            dd($error);
            //return redirect()->back();
        }
    }
}
