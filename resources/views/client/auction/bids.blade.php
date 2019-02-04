@extends('layouts.client')

@section('content')
    <div class="container">
        @include('includes.flash')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">My Bids</div>

                    <div class="card-body">
                        <div class="row">
                            <div  class="col-md-12 table-responsive table-stats order-table ov-h">
                                <table class="table table-borderless">
                                    <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>Title</th>
                                        <th>Vehicle</th>
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>Amount</th>
                                        <th>Won</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($bids as $key=> $bid)
                                        <tr>
                                            <td class="serial">{{$key+1}}</td>
                                            <td><a class="btn-link" href="/client/auction/{{$bid->auction->id}}">{{$bid->auction->title}}</a></td>
                                            <td>{{$bid->auction->vehicle}}</td>
                                            <td>{{$bid->auction->start}}</td>
                                            <td>{{$bid->auction->end}}</td>
                                            <td>${{$bid->amount}}</td>
                                            <td>{{$bid->winner==1?'Yes':'No'}}</td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('title')
    | Auctions
@endsection

@section('scripts')

    <script>
        jQuery('#bids').addClass('active')
    </script>
@endsection
