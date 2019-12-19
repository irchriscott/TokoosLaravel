@extends('admin.layouts.app')

@section('data-head')

<title>Edit Ride :: Tokoos Ride</title>

@endsection

@section('main-content')

<div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Dashboard</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">Edit Ride</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">
                    <div class="card alert">
                        <div class="card-body">
                            <div class="card-header m-b-20">
                                <h4>Edit Ride</h4>
                                <div class="card-header-right-icon">
                                    <ul>
                                        <li class="card-close" data-dismiss="alert"><i class="ti-close"></i></li>
                                        <li class="card-option drop-menu"><i class="ti-settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="link"></i>
                                            <ul class="card-option-dropdown dropdown-menu">
                                                <li><a href="#"><i class="ti-loop"></i> Update data</a></li>
                                                <li><a href="#"><i class="ti-menu-alt"></i> Detail log</a></li>
                                                <li><a href="#"><i class="ti-pulse"></i> Statistics</a></li>
                                                <li><a href="#"><i class="ti-power-off"></i> Clear ist</a></li>
                                            </ul>
                                        </li>
                                        <li class="doc-link"><a href="#"><i class="ti-link"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            @include('includes.messages')
                            <form method="post" action="{{ route('riders.update', $ride->id) }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Ride Details</h4>
                                <div class="col-md-6">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" name="full_name" class="form-control border-none input-flat bg-ash" value="{{ $ride->full_name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="email" class="form-control border-none input-flat bg-ash" value="{{ $ride->email }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="text" name="phone_number" class="form-control border-none input-flat bg-ash" value="{{ $ride->phone_number }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Addres</label>
                                            <input type="text" name="address" class="form-control border-none input-flat bg-ash" value="{{ $ride->address }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <input type="text" name="country" class="form-control border-none input-flat bg-ash" value="{{ $ride->country }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" name="city" class="form-control border-none input-flat bg-ash" value="{{ $ride->city }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="image" class="form-control border-none input-flat bg-ash">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>Vehicle Details</h4>
                                <div class="col-md-6">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Select Ride Type</label>
                                            <select name="ride_type_id" class="form-control bg-ash border-none">
                                                @foreach($ridetypes as $type)
												<option value="{{ $type->id }}" @if($type->id == $ride->vehicle->type->id) selected @endif>{{ $type->name }}</option>
                                                @endforeach
											</select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Brand</label>
                                            <input type="text" name="brand" class="form-control border-none input-flat bg-ash" value="{{ $vehicle->brand }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" class="form-control border-none input-flat bg-ash" value="{{ $vehicle->name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Number Plate</label>
                                            <input type="text" name="number_plate" class="form-control border-none input-flat bg-ash" value="{{ $vehicle->number_plate }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Production Year</label>
                                            <input type="text" name="production_year" class="form-control border-none input-flat bg-ash" value="{{ $vehicle->production_year }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Mileage</label>
                                            <input type="text" name="mileage" class="form-control border-none input-flat bg-ash" value="{{ $vehicle->mileage }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Power<small style="color:red">(optional)</small></label>
                                            <input type="text" name="power" class="form-control border-none input-flat bg-ash" value="{{ $vehicle->power }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Max People</label>
                                            <input type="text" name="max_people" class="form-control border-none input-flat bg-ash" value="{{ $vehicle->max_people }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <button class="btn btn-default btn-lg m-b-10 bg-warning border-none m-r-5 sbmt-btn" type="submit">Save</button>
                            <a class="btn btn-default btn-lg m-b-10 m-l-5 sbmt-btn" href="{{ route('riders.index') }}">Cancel</a>
                        </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer">
                                <p>This dashboard was generated on <span id="date-time"></span> <a href="#" class="page-refresh">Refresh Dashboard</a></p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

@endsection

@section('data-footer')

@endsection
