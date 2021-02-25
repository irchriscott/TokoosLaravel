<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Model\Ride;
use App\Model\Rider;
use App\Traits\Util;
use App\Model\Vehicle;
use App\Model\Location;
use App\Model\RideType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RideController extends Controller
{
    public function requestRideFares(Request $request) {
        return response()->json(RideType::orderBy('id', 'ASC')->get());
    }

    public function requestRiders(Request $request) {

        $auth = $request->input('auth') != NULL ? $request->input('auth') : $request->header('Authorization');
        $user = User::where('token', $auth)->first();

        if(is_null($user)) {
            return response()->json([
                'type' => 'error',
                'message' => 'Erreur d\'Autentication',
                'status' => 406,
                'args' => []
            ], 406);
        }

        $validator = Validator::make($request->all(), [
            'city' => 'required',
            'type' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'type' => 'error',
                'message' => 'Erreur de validation',
                'status' => 406,
                'args' => $validator->errors()->all()
            ], 406);
        }

        $city = $request->input('city');
        $type = RideType::find($request->input('type'));

        $vehicles = Vehicle::whereHas('rider', function($query) use ($city) {
            $query->where('is_available', true)
                    ->where('is_blocked', false)
                    ->where('city', $city);
        })->where('ride_type_id', $type->id)->get();

        $riders = Rider::whereHas('vehicle', function($query) use ($type) {
                            $query->where('ride_type_id', $type->id);
                        })->where('city', $request->input('city'))
                            ->where('is_blocked', false)
                            ->where('is_available', true)->get();


        return response()->json($riders, 200);
    }

    public function initiateRide(Request $request) {

        $auth = $request->input('auth') != NULL ? $request->input('auth') : $request->header('Authorization');
        $user = User::where('token', $auth)->first();

        if(is_null($user)) {
            return response()->json([
                'type' => 'error',
                'message' => 'Erreur d\'Autentication',
                'status' => 406,
                'args' => []
            ], 406);
        }

        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'rider_id' => 'required',
            'distance' => 'required',
            'duration' => 'required',
            'price_range' => 'required',
            'origin_address' => 'required',
            'origin_latitude' => 'required',
            'origin_longitude' => 'required',
            'destination_address' => 'required',
            'destination_latitude' => 'required',
            'destination_longitude' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'type' => 'error',
                'message' => 'Erreur de validation',
                'status' => 406,
                'args' => $validator->errors()->all()
            ], 406);
        }

        $origin = Location::create([
            'address' => $request->input('origin_address'),
            'latitude' => $request->input('origin_latitude'),
            'longitude' => $request->input('origin_longitude')
        ]);

        $destination = Location::create([
            'address' => $request->input('destination_address'),
            'latitude' => $request->input('destination_latitude'),
            'longitude' => $request->input('destination_longitude')
        ]);

        $code = strtoupper('TR-' . date('mY') . '-' . Util::generateRandomString(6));

        $ride = Ride::create([
            'code' => $code,
            'rider_id' => $request->input('rider_id'),
            'user_id' => $user->id,
            'type' => $request->input('type'),
            'origine' => $origin->id,
            'destination' => $destination->id,
            'status' => 1,
            'price_range' => $request->input('price_range'),
            'distance' => $request->input('distance'),
            'duration' => $request->input('duration')
        ]);

        return response()->json($ride, 200);
    }
}