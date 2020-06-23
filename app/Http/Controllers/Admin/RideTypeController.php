<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\RideType;
use App\Model\RideFare;

class RideTypeController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $ridetypes = RideType::orderBy('created_at', 'DESC')->paginate(20);
        return view('admin.ride_type.index', compact('ridetypes'));
    }

    public function create(Request $request) {
        return view('admin.ride_type.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'size' => 'required'
        ]);

        $ridetype = new RideType();
        $ridetype->name = $request->name;
        $ridetype->size = $request->size;
        $ridetype->save();

        RideFare::create(['ride_type_id' => $ridetype->id]);

        return redirect(route('ride_type.index'));
    }

    public function show(Request $request, $id) {
        
    }

    public function edit(Request $request, $id) {
        $ridetype = RideType::where('id',$id)->first();
        return view('admin.ride_type.edit', compact('ridetype'));
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required',
            'size' => 'required',
            'base_fare' => 'required',
            'distance' => 'required',
            'time' => 'required',
            'wait_per_minute' => 'required',
            'delivery_fare' => 'required',
            'weight' => 'required',
            'size' => 'required',
            'value' => 'required'
        ]);

        $ridetype = RideType::find($id);
        $ridetype->name = $request->name;
        $ridetype->size = $request->size;
        $ridetype->save();

        $rideFare = RideFare::where('ride_type_id', $ridetype->id)->first();
        $rideFare->base_fare = $request->base_fare;
        $rideFare->distance = $request->distance;
        $rideFare->time = $request->time;
        $rideFare->wait_per_minute = $request->wait_per_minute;
        $rideFare->delivery_fare = $request->delivery_fare;
        $rideFare->weight = $request->weight;
        $rideFare->size = $requet->size;
        $rideFare->value = $request->value;
        $rideFare->save();

        return redirect(route('ride_type.index'));
    }

    public function destroy(Request $request, $id) {
        //RideType::where('id', $id)->delete();
        return redirect()->back();
    }
}
