<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Traits\Util;
use App\Model\Rider;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use App\Model\AuthenticationCode;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function registerPhoneNumber(Request $request) {

        set_time_limit(0);

        $validator = Validator::make($request->all(), ['phone' => 'required', 'code' => 'required']);

        if($validator->fails()){
            return response()->json([
                'type' => 'error',
                'message' => 'Erreur de validation',
                'status' => 406,
                'args' => $validator->errors()->all()
            ], 406);
        }

        $phoneNumber = $request->input('phone');

        $user = User::updateOrCreate(
            [
                'country_code' => strtolower($request->input('code')),
                'phone_number' => $phoneNumber,
            ],
            [
                'channel' => Util::generateRandomString(64),
                'token' => Util::generateRandomString(256)
            ]
        );

        $authCode = rand(1000, 9999);
        $expiryDate = time() + (24 * 60 * 60);

        $code = AuthenticationCode::updateOrCreate(
        [
            'user_id' => $user->id,
        ],
        [
            'code' => $authCode,
            'expary_date' => date('Y-m-d', $expiryDate),
            'is_authenticated' => false
        ]);

        $client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
        
        try {
            $client->messages->create($phoneNumber, [
                'from' => env('TWILIO_PHONE'),
                'body' => 'Votre code d\'activation pour Toleka Ride est ' . $authCode 
            ]);
        } catch(\Exception $ex) {}

        return response()->json($user, 200);
    }

    public function authenticatePhoneNumber(Request $request) {

        $auth = $request->input('auth') != NULL ? $request->input('auth') : $request->header('Authorization');
        $user = User::where('token', $auth)->first();

        if(is_null($user)) {
            return response()->json([
                'type' => 'error',
                'message' => 'Erreur d\'authentification',
                'status' => 406,
                'args' => []
            ], 406);
        }

        $code = $request->input('code');
        $authCode = AuthenticationCode::where('user_id', $user->id)->first();

        if($code != $authCode->code) {
            return response()->json([
                'type' => 'error',
                'message' => 'Code d\'Activation est Incorrect',
                'status' => 406,
                'args' => []
            ], 406);
        }

        $user->is_authenticated = true;
        $user->save();

        $authCode->is_authenticated = true;
        $authCode->save();

        return response()->json($user, 200);
    }

    public function saveUserIdentity(Request $request) {

        $auth = $request->input('auth') != NULL ? $request->input('auth') : $request->header('Authorization');
        $user = User::where('token', $auth)->first();

        if(is_null($user)) {
            return response()->json([
                'type' => 'error',
                'message' => 'Erreur d\'authentification',
                'status' => 406,
                'args' => []
            ], 406);
        }

        $validationRules = [
            'name' => 'required',
            'email' => 'required',
            'country' => 'required',
            'city' => 'required'
        ];

        if($request->input('email') != $user->email) {
            $validationRules['email'] = 'required|unique:users';
        }

        $validator = Validator::make($request->all(), $validationRules);

        if($validator->fails()){
            return response()->json([
                'type' => 'error',
                'message' => 'Erreur de validation',
                'status' => 406,
                'args' => $validator->errors()->all()
            ], 406);
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->country = $request->input('country');
        $user->city = $request->input('city');
        $user->is_authenticated = true;
        $user->save();

        return response()->json($user, 200);
    }

    public function authenticateRider(Request $request) {

        $validator = Validator::make($request->all(), ['email' => 'required']);

        if($validator->fails()){
            return response()->json([
                'type' => 'error',
                'message' => 'Erreur de validation',
                'status' => 406,
                'args' => $validator->errors()->all()
            ], 406);
        }

        $rider = Rider::where('email', $request->input('email'))->where('is_blocked', false)->first();

        if(is_null($rider)) {
            return response()->json([
                'type' => 'error',
                'message' => 'Erreur de validation.\nVeuillez vous renseigner à un guichet de Tokoos Ride.',
                'status' => 406,
                'args' => $validator->errors()->all()
            ], 406);
        }

        return response()->json($rider, 200);
    }
}
