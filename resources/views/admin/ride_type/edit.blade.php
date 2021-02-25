@extends('admin.layouts.app')

@section('data-head')

<title>Edit Ride Type :: Tokoos Ride</title>

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
                                    <li class="active">Edit Ride Type</li>
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
                                <h4>Edit Ride Type</h4>
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
                            <form method="post" action="{{ route('ride_type.update', $ridetype->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" class="form-control border-none input-flat bg-ash" value="{{ $ridetype->name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Size</label>
                                            <select name="size" class="form-control bg-ash border-none">
												<option>Select a size</option>
												<option value="1" @if($ridetype->size == "1" ) selected @endif>1</option>
												<option value="2" @if($ridetype->size == "2" ) selected @endif>2</option>
												<option value="3" @if($ridetype->size == "3" ) selected @endif>3</option>
												<option value="4" @if($ridetype->size == "4" ) selected @endif>4</option>
                                                <option value="5" @if($ridetype->size == "5" ) selected @endif>5</option>
                                                <option value="6" @if($ridetype->size == "6" ) selected @endif>6</option>
											</select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <h4>Ride Type Fares (In Fc)</h4>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Base Fare</label>
                                            <input type="number" name="base_fare" class="form-control border-none input-flat bg-ash" value="{{ $ridetype->fare->base_fare }}">
                                        </div>
                                    </div>
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Distance Fare</label>
                                            <input type="number" name="distance" class="form-control border-none input-flat bg-ash" value="{{ $ridetype->fare->distance }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Time Fare</label>
                                            <input type="number" name="time" class="form-control border-none input-flat bg-ash" value="{{ $ridetype->fare->time }}">
                                        </div>
                                    </div>
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Waiting Time Fare / Minute</label>
                                            <input type="number" name="wait_per_minute" class="form-control border-none input-flat bg-ash" value="{{ $ridetype->fare->wait_per_minute }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <h4>Delivery Fares (In Fc)</h4>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Delivere Fare</label>
                                            <input type="number" name="delivery_fare" class="form-control border-none input-flat bg-ash" value="{{ $ridetype->fare->delivery_fare }}">
                                        </div>
                                    </div>
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Weight</label>
                                            <input type="number" name="weight" class="form-control border-none input-flat bg-ash" value="{{ $ridetype->fare->weight }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Size</label>
                                            <input type="number" name="size_package" class="form-control border-none input-flat bg-ash" value="{{ $ridetype->fare->size }}">
                                        </div>
                                    </div>
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>Value</label>
                                            <input type="number" name="value" class="form-control border-none input-flat bg-ash" value="{{ $ridetype->fare->value }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-default btn-lg m-b-10 bg-warning border-none m-r-5 sbmt-btn" type="submit">Save</button>
                            <a class="btn btn-default btn-lg m-b-10 m-l-5 sbmt-btn" href="{{ route('ride_type.index') }}">Cancel</a>
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
