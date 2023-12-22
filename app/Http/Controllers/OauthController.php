<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Date;
use App\Models\Candidate;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Laravel\Socialite\Facades\Socialite;
use Namshi\JOSE\JWT;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class OauthController extends Controller
{
    //
    use AuthenticatesUsers;

    public function __construct()
    {
        config([
            'services.google.redirect' => route('google.callback'),
        ]);
    }

    public function googleRedirect()
    {
        return response()->json([
            "url" => Socialite::driver('google')->stateless()->redirect()->getTargetUrl(),
        ]);
    }

    public function googleCallback()
    {
        $google_candidate = Socialite::driver('google')->stateless()->user();

        $candidate = Candidate::where("candidate_email", $google_candidate->email)->first();

        if ($candidate) {
            $candidate->update([
                "candidate_name" => $google_candidate->name,
                "candidate_profile_picture" => $google_candidate->avatar,
                "email_verified_at" => Date::now(),
                "candidate_last_login" => Date::now(),
            ]);
            
            $token = JWTAuth::fromUser($candidate);
        } else {
            $candidate = Candidate::firstOrCreate(
                [
                    "candidate_slug" => Str::uuid(),
                ],
                [
                    "candidate_email" => $google_candidate->email,
                ],

            );

            $candidate->candidate_name = $google_candidate->name;
            $candidate->candidate_profile_picture = $google_candidate->avatar;
            $candidate->email_verified_at = Date::now();
            $candidate->candidate_last_login = Date::now();
            $candidate->candidate_username = str_replace(" ", "_", strtolower($google_candidate->name) . "_" . rand(1000, 9999));

            $candidate->save();

            $token = JWTAuth::fromUser($candidate);
        }
        
        $day = 60 * 24 * 30;

        $route = '/onboarding' . '?token=' . $token . '&candidate=' . $candidate->candidate_slug;

        return redirect($route);
    }
}
