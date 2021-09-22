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
            $user = User::withTrashed()->find($userSocial->getId());
            if ($user) {
                $user->update([
                    'nickname' => $userSocial->getNickname(),
                    'name'     => $userSocial->getName(),
                    'token'    => $userSocial->token,
                    'avatar'   => $userSocial->getAvatar(),
                ]);
            } else {
                $user = User::create([
                    'id'       => $userSocial->getId(),
                    'nickname' => $userSocial->getNickname(),
                    'name'     => $userSocial->getName(),
                    'token'    => $userSocial->token,
                    'avatar'   => $userSocial->getAvatar(),
                ]);
            }
            if ($user->deleted_at) {
                abort('403');
            }
            Auth::login($user);
            return redirect()->intended('/');
        } catch (\Throwable $error) {
            return redirect(route('home'));
        }
    }
}
