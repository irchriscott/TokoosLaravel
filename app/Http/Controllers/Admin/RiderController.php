<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Rider;
use App\Model\Vehicle;
use App\Model\RideType;
use Carbon\Carbon;
use App\Traits\Util;

class RiderController extends Controller
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
        $riders = Rider::orderBy('created_at','DESC')->paginate(20);
        return view('admin.riders.index', compact('riders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ridetypes = RideType::orderBy('name','ASC')->get();
        return view('admin.riders.create', compact('ridetypes'));
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
            'full_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'country' => 'required',
            'city' => 'required',
            'brand' => 'required',
            'name' => 'required',
            'number_plate' => 'required',
            'production_year' => 'required',
            'mileage' => 'required',
            'max_people' => 'required'
        ]);

        $slug = str_slug($request->full_name);

        if ($request->hasFile('image'))
        {
            $image = $request->file('image');
            $currentData = Carbon::now()->toDateString();
            $imagename = $slug .'-'. $currentData .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
            if(!file_exists('uploads/ride_image'))
            {
                mkdir('uploads/ride_image', 0777 , true);
            }
            $image->move('uploads/ride_image',$imagename);
        } else {
            $imagename = 'default.jpg';
        }

        $ride = new Rider();
        $ride->full_name = $request->full_name;
        $ride->email = $request->email;
        $ride->phone_number = $request->phone_number;
        $ride->address = $request->address;
        $ride->country = $request->country;
        $ride->city = $request->city;
        $ride->ride_number = "TR";
        $ride->token = Util::generateRandomString(256);
        $ride->channel = Util::generateRandomString(64);
        $ride->image = $imagename;
        $ride->save();

        //Vehicle data
        $vehicle = new Vehicle();
        $vehicle->ride_type_id = $request->ride_type_id;
        $vehicle->rider_id = $ride->id;
        $vehicle->brand = $request->brand;
        $vehicle->name = $request->name;
        $vehicle->number_plate = $request->number_plate;
        $vehicle->production_year = $request->production_year;
        $vehicle->mileage = $request->mileage;
        $vehicle->power = $request->power;
        $vehicle->max_people = $request->max_people;
        $vehicle->save();

        $ride->ride_number = "TR00" . $ride->id;
        $ride->save();

        return redirect(route('riders.index'));

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
        $ride = Rider::find($id);
        $vehicle = Vehicle::where('rider_id', $id)->first();
        $ridetypes = RideType::orderBy('name','ASC')->get();
        $riders = Rider::orderBy('full_name','ASC')->get();
        return view('admin.riders.edit', compact('ride','vehicle','ridetypes','riders'));
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
            'full_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'country' => 'required',
            'city' => 'required',
            'brand' => 'required',
            'name' => 'required',
            'number_plate' => 'required',
            'production_year' => 'required',
            'mileage' => 'required',
            'max_people' => 'required'
        ]);


        $slug = str_slug($request->full_name);

        $slider = Rider::find($id);

        if ($request->hasFile('image'))
        {
            $image = $request->file('image');
            $currentData = Carbon::now()->toDateString();
            $imagename = $slug .'-'. $currentData .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
            if(!file_exists('uploads/ride_image'))
            {
                mkdir('uploads/ride_image', 0777 , true);
            }
            $image->move('uploads/ride_image', $imagename);
        } else {
            $imagename = $slider->image;
        }

        $ride = Rider::find($id);
        $ride->full_name = $request->full_name;
        $ride->email = $request->email;
        $ride->phone_number = $request->phone_number;
        $ride->address = $request->address;
        $ride->country = $request->country;
        $ride->city = $request->city;
        $ride->image = $imagename;
        $ride->save();

        //Vehicle data
        $vehicle = Vehicle::where("rider_id", $ride->id)->first();
        $vehicle->ride_type_id = $request->ride_type_id;
        $vehicle->rider_id = $ride->id;
        $vehicle->brand = $request->brand;
        $vehicle->name = $request->name;
        $vehicle->number_plate = $request->number_plate;
        $vehicle->production_year = $request->production_year;
        $vehicle->mileage = $request->mileage;
        $vehicle->power = $request->power;
        $vehicle->max_people = $request->max_people;
        $vehicle->save();

        return redirect(route('riders.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Rider::where('id',$id)->delete();
        //Vehicle::where('id',$id)->delete();
        return redirect()->back();
    }
}
