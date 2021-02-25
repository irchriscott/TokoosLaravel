<?php

namespace App\Http\Controllers\Api;

use App\Traits\Util;
use App\Model\Rider;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RiderController extends Controller
{
    public function authPhone(Request $request) {
        
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

        $authCode = rand(1000, 9999);
        $phoneNumber = $request->input('phone');

        $rider = Rider::where('phone_number', $phoneNumber)->first();

        if(is_null($rider)) {
            return response()->json([
                'type' => 'error',
                'message' => 'Numéro de téléphone éroné',
                'status' => 406,
                'args' => $validator->errors()->all()
            ], 406);
        }

        if($rider->is_blocked) {
            return response()->json([
                'type' => 'error',
                'message' => 'Votre compte est bloqué',
                'status' => 406,
                'args' => $validator->errors()->all()
            ], 406);
        }

        $rider->update(
            [
                'auth_code' => $authCode,
                'channel' => Util::generateRandomString(64),
                'token' => Util::generateRandomString(256)
            ]
        );

        $client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
        
        try {
            $client->messages->create($phoneNumber, [
                'from' => env('TWILIO_PHONE'),
                'body' => 'Votre code d\'activation pour Toleka Driver est ' . $authCode 
            ]);
        } catch(\Exception $ex) {}

        return response()->json($rider, 200);
    }

    public function authCode(Request $request) {
        
        $auth = $request->input('auth') != NULL ? $request->input('auth') : $request->header('Authorization');
        $rider = Rider::where('token', $auth)->first();

        if(is_null($rider)) {
            return response()->json([
                'type' => 'error',
                'message' => 'Erreur d\'Autentication',
                'status' => 406,
                'args' => []
            ], 406);
        }

        $code = $request->input('code');

        if($code != $rider->auth_code) {
            return response()->json([
                'type' => 'error',
                'message' => 'Code d\'Activation est Incorrect',
                'status' => 406,
                'args' => []
            ], 406);
        }

        $rider->is_authenticated = true;
        $rider->save();

        return response()->json($rider, 200);
    }
}
