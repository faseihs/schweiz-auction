@extends('layouts.client')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Auctions</div>

                    <div class="card-body">
                        <div class="row">
                            <div  class="col-md-12 table-responsive table-stats order-table ov-h">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th class="serial">#</th>
                                            <th></th>
                                            <th>Title</th>
                                            <th>Vehicle</th>
                                            <th>Start</th>
                                            <th>End</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($auctions as $key=> $auction)
                                        <tr>
                                            <td class="serial">{{$key+1}}</td>
                                            <td><img  style="width: 100px; height: 50px;" src="{{$auction->getThumbnail()}}"></td>
                                            <td><a class="btn-link" href="/client/auction/{{$auction->id}}">{{$auction->title}}</a></td>
                                            <td>{{$auction->vehicle}}</td>
                                            <td>{{$auction->start}}</td>
                                            <td>{{$auction->end}}</td>
                                            <td><a class="btn btn-success btn-sm" href="/auction-apply/{{$auction->id}}">
                                                    <i class="fa fa-check"></i>
                                                    Bid
                                                </a></td>
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
        jQuery('#auctions').addClass('active')
    </script>
@endsection
