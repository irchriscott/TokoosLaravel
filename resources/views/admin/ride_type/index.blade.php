@extends('admin.layouts.app')

@section('data-head')

<title>All Ride Type :: Tokoos Ride</title>

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
                            <a class="btn btn-default btn-lg m-b-10 bg-warning border-none m-r-5 sbmt-btn" href="{{ route('ride_type.create') }}">Add New Ride Type</a>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table student-data-table m-t-20">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Size</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($ridetypes as $type)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $type->name }}</td>
                                                <td>{{ $type->size }}</td>
                                                <td>
                                                    <a href="{{ route('ride_type.edit', $type->id) }}"><span style="font-size: 15px" class="glyphicon glyphicon-edit"></span> Edit </a>
                                                </td>
                                                <td>
                                                    <form id="delete-form-{{ $type->id }}" method="post" action="{{ route('ride_type.destroy',$type->id) }}"
                                                          style="display: none">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                </form>
                                                <a href="" onclick="
                                                    if(confirm('Are you sure that you want to delete this ?'))
                                                    {
                                                        event.preventDefault();document.getElementById('delete-form-{{ $type->id }}').submit();
                                                    }
                                                    else
                                                    {
                                                        event.preventDefault();}">
                                                        <span style="font-size: 15px" class="glyphicon glyphicon-trash"></span> Delete
                                                </a>
                                                </td>
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
