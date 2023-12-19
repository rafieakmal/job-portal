<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\CandidateVerification;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Date;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Tymon\JWTAuth\Facades\JWTAuth;

class CandidateController extends Controller
{
    public function registration(Request $request) {
        $request->validate([
            'email' => 'required|string|email|max:225',
            'password' => 'required|string|confirmed|min:8',
            'full_name' => 'required|string',
            'phone' => 'required|string|max:15',
        ]);

        $user = Candidate::create(
            [
                'candidate_email' => $request->email,
                'password' => Hash::make($request->password),
                'candidate_name' => $request->full_name,
                'candidate_phone' => $request->phone,
                'candidate_slug' => Str::uuid(),
                'candidate_role' => 'user',
                'candidate_username' => str_replace(" ", "_", strtolower($request->full_name) . "_" . rand(1000, 9999)),
                'password_verified_at' => Date::now(),
                'candidate_last_login' => Date::now(),
            ]
        );

        if ($user) {
            $jwt_token = JWTAuth::fromUser($user);

            $responseBuilder = [
                'status' => 200,
                'message' => 'User created successfully.',
                'user_id' => $user->candidate_slug,
                'token' => $jwt_token,
            ];
        } else {
            $responseBuilder = [
                'status' => 400,
                'message' => 'Failed to create user.',
                'error' => 'Duplicate entry',
            ];
        }

        return response()->json($responseBuilder);
    }

    public function validateUser(Request $request) {
        $request->validate([
            'id' => 'required|string',
        ]);

        $user = Candidate::where('candidate_slug', '=', $request->id)->first();
        if ($user) {
            $responseBuilder = [
                'status' => 200,
                'message' => 'User is valid.',
                'data' => $user,
            ];
            return response()->json($responseBuilder);
        } else {
            return response()->json(['message' => 'User is not valid.'], 400);
        }
    }

    public function checkEmail($email) {
        $userExists = Candidate::where('email', '=', $email)->exists();
        return response()->json($userExists);
    }

    public function login(Request $request) {
        $credential = $request->validate([
            'email' => 'required|string|email|max:225',
            'password' => 'required|string|min:8',
        ]);

        $credential_builder = [
            'candidate_email' => $request->email,
            'password' => $request->password,
        ];

        $attempt = Auth::attempt($credential_builder);

        if ($attempt) {
            $user = Auth::user();
            $jwt_token = JWTAuth::fromUser($user);

            $user->update([
                'candidate_last_login' => Date::now(),
            ]);

            $responseBuilder = [
                'status' => 200,
                'message' => 'User logged in successfully.',
                'user_id' => $user->candidate_slug,
                'token' => $jwt_token,
            ];
        } else {
            $responseBuilder = [
                'status' => 401,
                'message' => 'Failed to login.',
                'error' => 'The email or password is incorrect.',
            ];
        }

        return response()->json($responseBuilder);
    }

    protected function generateCode($type, $receiver)
    {
        $code = rand(100000, 999999);
        $token = Str::random(60);
        $key = Str::random(60);

        $codeExists = CandidateVerification::where('verification_token', $token)->exists();

        if ($codeExists) {
            return false;
        } else {
            $verification = CandidateVerification::create([
                'verification_slug' => Str::uuid(),
                'verification_token' => $token,
                'verification_key' => $key,
                'verification_code' => $code,
                'verification_type' => $type,
                'verification_receiver' => $receiver,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if ($verification) {
                $data = [
                    'code' => $code,
                    'token' => $token,
                    'key' => $key,
                ];

                return $data;
            } else {
                return false;
            }
        }
    }

    private function sendMessage($receiver, $message, $type, $receiver_name = null) {
        if ($type == 'email') {
            $email_url = config('constants.email_api.url');
            $email_token = config('constants.email_api.token');

            $response = Http::asForm()->post(
                $email_url,
                [
                    'receiver' => $receiver,
                    'receiver_name' => $receiver_name,
                    'from_name' => 'MRI noreply',
                    'subject' => 'Your Verification Code',
                    'message' => $message,
                    'api_key' => $email_token,
                    'body' => '<p>hi</p>',
                    'code' => $message,
                ]
            );
        } else {
            $whatsapp_url = config('constants.whatsapp_api.url');
            $whatsapp_token = config('constants.whatsapp_api.token');

            $response = Http::asForm()->post(
                $whatsapp_url,
                [
                    'receiver' => $receiver,
                    'message' => $message,
                    'room' => 'chat',
                    'api_key' => $whatsapp_token,
                ]
            );
        }

        return $response;
    }

    public function generateNewCode(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'key' => 'required|string',
            'type' => 'required|string',
            'receiver' => 'required|string',
        ]);

        $code = rand(100000, 999999);

        $verification = CandidateVerification::where([
            ['verification_token', $request->token],
            ['verification_key', $request->key],
            ['verification_receiver', $request->receiver]
        ])->first();

        if ($verification) {
            $verification->update([
                'verification_code' => $code,
                'updated_at' => now(),
            ]);

            if ($request->type == 'email') {
                $receiver_name = Candidate::where('candidate_email', $request->receiver)->first()->candidate_name;
                $message = $code;
            } else {
                $receiver_name = null;
                $message = 'Kode verifikasi anda adalah *' . $code . '*';
                $message .= "\n\n" . "Jangan berikan kode verifikasi kepada siapapun termasuk pihak yang mengatasnamakan kami.";
            }

            $response = $this->sendMessage($request->receiver, $message, $verification->verification_type, $receiver_name);

            if ($response->successful()) {
                $responseBuilder = [
                    'status' => 200,
                    'message' => 'Message sent successfully.',
                    'data' => $message,
                    'detail' => $message,
                ];
            } else {
                $responseBuilder = [
                    'status' => 400,
                    'message' => 'Failed to send message.',
                    'error' => $response->json(),
                ];
            }
        } else {
            $responseBuilder = [
                'status' => 400,
                'message' => 'Failed to generate code.',
                'error' => 'Code not found.',
            ];
        }

        return response()->json($responseBuilder);
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'key' => 'required|string',
            'otp' => 'required|string',
            'slug' => 'required|string',
            'type' => 'required|string',
        ]);

        $codeExists = CandidateVerification::where([
            ['verification_token', $request->token],
            ['verification_key', $request->key],
            ['verification_code', $request->otp],
        ])->exists();

        if ($codeExists) {
            
            if ($request->type == 'email') {
                $updateUser = Candidate::where('candidate_slug', $request->slug)->update([
                    'email_verified_at' => now(),
                ]);
            } else {
                $updateUser = Candidate::where('candidate_slug', $request->slug)->update([
                    'phone_verified_at' => now(),
                ]);
            }

            if ($updateUser) {
                $deleteCode = CandidateVerification::where([
                    ['verification_token', $request->token],
                    ['verification_key', $request->key],
                    ['verification_code', $request->otp],
                ])->delete();

                if ($deleteCode) {
                    $response = [
                        'status' => 200,
                        'message' => 'User verified successfully.',
                    ];
                } else {
                    $response = [
                        'status' => 400,
                        'message' => 'Failed to verify user.',
                    ];
                }
            } else {
                $response = [
                    'status' => 400,
                    'message' => 'Failed to verify user.',
                ];
            }
        } else {
            $response = [
                'status' => 400,
                'message' => 'Failed to verify code.',
                'error' => 'Code not found.',
            ];
        }

        return response()->json($response);
    }




    public function getCode(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'key' => 'required|string',
            'receiver' => 'required|string',
        ]);

        $verification = CandidateVerification::where([
            ['verification_token', $request->token],
            ['verification_key', $request->key],
            ['verification_receiver', $request->receiver],
        ])->first();

        if ($verification) {
            $verification->update(['updated_at' => now()]);

            $response = [
                'status' => 200,
                'code' => $verification->verification_code,
                'message' => 'Code verified successfully.',
            ];
        } else {
            $response = [
                'status' => 400,
                'message' => 'Failed to verify code.',
                'error' => $verification ? 'Failed to update code.' : 'Code not found.',
            ];
        }

        return response()->json($response);
    }

    public function sendCode(Request $request)
    {
        $request->validate([
            'receiver' => 'required|string',
            'type' => 'required|string',
        ]);

        if ($request->type == 'email') {
            $responseGeneratedCode = $this->generateCode($request->type, $request->receiver);
        } else {
            $responseGeneratedCode = $this->generateCode($request->type, $request->receiver);
        }


        if ($request->type == 'email') {
            $receiver_name = Candidate::where('candidate_email', $request->receiver)->first()->candidate_name;
            $message = $responseGeneratedCode['code'];
        } else {
            $receiver_name = null;
            $message = 'Kode verifikasi anda adalah *' . $responseGeneratedCode['code'] . '*';
            $message .= "\n\n" . "Jangan berikan kode verifikasi kepada siapapun termasuk pihak yang mengatasnamakan kami.";
        }

        $response = $this->sendMessage($request->receiver, $message, $request->type, $receiver_name);

        if ($response->successful()) {
            $responseBuilder = [
                'status' => 200,
                'message' => 'Message sent successfully.',
                'data' => $responseGeneratedCode,
                'detail' => $responseGeneratedCode,
            ];
        } else {
            $responseBuilder = [
                'status' => 400,
                'message' => 'Failed to send message.',
                'error' => $response->json(),
            ];
        }

        return response()->json($responseBuilder);
    }

    public function upload(Request $request) {
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png',
            'name' => 'required',
        ]);
        $file_name = $request->name.'.jpg';
        $file_path = $request->file('file')->move(public_path('assets/img/user'), $file_name);
        return response()->json($file_path);
    }

    public function redirectResetPassword(Request $request) {
        $request->validate([
            'token' => 'required|string',
            'email' => 'required|string',
        ]);

        $token = $request->token;
        $email = $request->email;

        $route = '/reset-password' . '?token=' . $token . '&email=' . $email;
        return redirect($route);
    }

    public function sendPasswordResetLink(Request $request) {
        $request->validate(['candidate_email' => 'required|email']);

        $response = Password::sendResetLink($request->only('candidate_email'));
        if ($response == Password::RESET_LINK_SENT) {
            return response()->json(['message' => 'Reset link sent to your email.']);
        }

        return response()->json(['error' => 'Failed to send reset link.'], 400);
    }

    protected function broker() {
        return Password::broker();
    }

    public function reset(Request $request) {
        $request->validate([
            'token' => 'required',
            'candidate_email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $response = $this->broker()->reset(
            $request->only('candidate_email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->password_verified_at = Date::now();
                $user->save();
            }
        );

        if ($response == Password::PASSWORD_RESET) {
            return response()->json(['message' => 'Password has been reset.']);
        } else {
            return response()->json(['error' => 'Failed to reset password, because your link is expired or error'], 400);
        }
    }
}
