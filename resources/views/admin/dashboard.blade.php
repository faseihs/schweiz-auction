@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-4">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="ti-layout-grid2 text-warning border-warning"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Active Auctions</div>
                            <div class="stat-digit">{{$activeAuctions}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-3 col-md-6 col-sm-4">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-four">
                        <div class="stat-icon dib">
                            <i class="ti-server text-muted"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-heading">All Auctions</div>
                                <div class="stat-text">Total: {{$allAuctions}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-4">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-4">
                            <i class="pe-7s-users"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text">{{$allUsers}}</div>
                                <div class="stat-heading">All Users</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-4">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="ti-user text-primary border-primary"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">New Users</div>
                            <div class="stat-digit">{{$newUsers}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-4">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-four">
                        <div class="stat-icon dib">
                            <i class="ti-user text-muted"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-heading">Active Users</div>
                                <div class="stat-text">{{$activeUsers}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-4">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="ti-money text-success border-success"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Bids Today</div>
                            <div class="stat-digit">{{$bidsToday}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-4">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-four">
                        <div class="stat-icon dib">
                            <i class="ti-stats-up text-muted"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-heading">All Bids</div>
                                <div class="stat-text">{{$allBids}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('title')
    | Dashboard
@endsection

@section('scripts')
    <script>
        //jQuery('body').addClass('open');
    </script>

@endsection
