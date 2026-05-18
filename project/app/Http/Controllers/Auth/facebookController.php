<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\user_profile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;


class facebookController extends Controller
{
    public function facebookLogin(){

        return Socialite::driver('google')->redirect();

    }
/*



@param NA
*@return void
**/


    public function facebookAuthentication(){


        $googleUser = Socialite::driver('google')->stateless()->user();

        $uuid = Str::uuid()->toString();


        $email = $googleUser->getEmail();
        $name = $googleUser->getName();
        $googleId = $googleUser->getId();
        $locale = $googleUser->user['locale'] ?? null;

        $otp = rand(100000,999999);


        $user = User::firstOrCreate(
            [
                'email' => $email
            ],
            [
                'otp_code' => $otp,
                'uuid' => $uuid,
                'phone_number' => 'null',
                'name' => $name,
                'google_id' => $googleId,
                'password' => bcrypt('google_login'), // optional
                'country' => $locale
            ]
        );

        if ($user->wasRecentlyCreated) {
            user_profile::create([
                'user_id' => $user->id,
                'profile_picture' =>$googleUser->getAvatar()
            ]);
        }


        $userId = $user->id;
        $useruuid = $user->uuid;

        session(['phone_number' => $user->phone_number]);
        session(['name' => $user->name]);
        session(['user_id' =>$userId]);
        session(['user_uuid' =>$useruuid]);
        session(['user_email' =>$user->email]);


        return redirect('/');


    }
}
