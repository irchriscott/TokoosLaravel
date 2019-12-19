<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\RideType;
use App\Model\RideFare;

class RideTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $ridetypes = RideType::orderBy('created_at','DESC')->paginate(20);
        return view('admin.ride_type.index', compact('ridetypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ride_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ridetype = RideType::where('id',$id)->first();
        return view('admin.ride_type.edit', compact('ridetype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RideType::where('id',$id)->delete();
        return redirect()->back();
    }
}
