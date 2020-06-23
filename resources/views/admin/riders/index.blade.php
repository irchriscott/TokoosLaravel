@extends('admin.layouts.app')

@section('data-head')

<title>Create Ride Type :: Tokoos Ride</title>

@endsection

@section('main-content')

<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <!-- /# row -->
            <section id="main-content">
                <!-- /# row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card alert">
                            <div class="card-header pr">
                                <h4>All Exam Resutl</h4>
                                <div class="search-action">
                                    <div class="search-type dib">
                                        <input class="form-control input-rounded" placeholder="Search by exam" type="text">
                                    </div>
                                    <div class="search-type dib">
                                        <input class="form-control input-rounded" placeholder="Search by date..." type="text">
                                    </div>
                                    <div class="search-type dib">
                                        <input class="form-control input-rounded" placeholder="search" type="text">
                                    </div>
                                </div>
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
                            <a class="btn btn-default btn-lg m-b-10 bg-warning border-none m-r-5 sbmt-btn" href="{{ route('riders.create') }}">Add New Ride</a>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table student-data-table m-t-20">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Ride Number</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Phone Number</th>
                                                <th>Country/Town</th>
                                                <th>Image</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($riders as $rider)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $rider->ride_number }}</td>
                                                    <td>{{ $rider->full_name }}</td>
                                                    <td>{{ $rider->email }}</td>
                                                    <td>{{ $rider->phone_number }}</td>
                                                    <td>{{ $rider->city }}, {{ $rider->country }}</td>
                                                    <td><img src="{{ asset('uploads/riders/' . $rider->image) }}" width="50" /></td>
                                                    <td><a href="{{ route('riders.edit', $rider->id) }}"><span style="font-size: 15px" class="glyphicon glyphicon-edit"></span> </a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="card bg-primary">
                            <div class="stat-widget-nine">
                                <div class="stat-icon"><i class="ti-facebook color-white"></i></div>
                                <div class="fb-card horizontal">
                                    <div class="stat-content m-t-13 dib">
                                        <div class="stat-text">Like us</div>
                                        <div class="stat-digit">on facebook</div>
                                    </div>
                                    <div class="all-like dib">
                                        <span class="like-count m-t-18">3000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning">
                            <div class="stat-widget-nine">
                                <div class="stat-icon"><i class="ti-twitter-alt color-white"></i></div>
                                <div class="twitter-card horizontal">
                                    <div class="stat-content m-t-13 dib">
                                        <div class="stat-text">Like us</div>
                                        <div class="stat-digit">on twitter</div>
                                    </div>
                                    <div class="all-like dib">
                                        <span class="like-count m-t-18">3000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info">
                            <div class="stat-widget-nine">
                                <div class="stat-icon"><i class="ti-google color-white"></i></div>
                                <div class="google-plus-card horizontal">
                                    <div class="stat-content m-t-13 dib">
                                        <div class="stat-text">Like us</div>
                                        <div class="stat-digit">on google</div>
                                    </div>
                                    <div class="all-like dib">
                                        <span class="like-count m-t-18">3000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-danger">
                            <div class="stat-widget-nine">
                                <div class="stat-icon"><i class="ti-linkedin color-white"></i></div>
                                <div class="linkedin-card horizontal">
                                    <div class="stat-content m-t-13 dib">
                                        <div class="stat-text">Like us</div>
                                        <div class="stat-digit">on linkedin</div>
                                    </div>
                                    <div class="all-like dib">
                                        <span class="like-count m-t-18">3000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
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
