<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
    <div class="nano">
        <div class="nano-content">
            <ul>
                <li class="label">Main</li>
                <li><a href="{{ route('admin.index') }}"><i class="ti-home"></i> Home Page</a></li>

                <li class="label">Rides</li>
                <li><a class="sidebar-sub-toggle"><i class="ti-pencil-alt"></i>Management <span class="badge badge-primary">28</span><span class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{ route('ride_type.index') }}">Ride Types</a></li>
                        <li><a href="{{ route('riders.index') }}">Ride & Vehicles</a></li>
                    </ul>
                </li>
                <li><a><i class="ti-close"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- /# sidebar -->
