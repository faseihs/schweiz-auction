@extends('layouts.client_new')

@section('content')
    <br>
    <br>
    <div class="container">
        <div class="row justify-content-center">
            @include('includes.flash')
            <div class="col-md-12">
                    @if($auction->status==1)
                <div class="card">
                    <div class="card-header">Bid for Auction #{{$auction->id}}</div>
                    
                    <div class="card-body">
                        <form method="POST" action="/client/auction-bid/{{$auction->id}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-2">Amount</div>
                                <div class="col-md-4">
                                    <input required class="form-control" name="amount" step="any" type="number">
                                </div>

                            </div>
                            <hr>
                            <hr>
                            <div class="row">
                                <div class="col-md-2">
                                    <button class="btn btn-success">
                                        <i class="fa fa-check"></i>
                                        Bid
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                @endif
                <br>
                <div class="card">
                    <div class="card-header">All bids</div>
                    <div class="card-body">
                        <div class="row">
                            <div  class="col-md-12 table-responsive table-stats order-table ov-h">
                                <table class="table table-borderless">
                                    <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>Bid by</th>
                                        <th>Amount</th>
                                        <th>Time</th>
                                        <th>Winner</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($auction->bids()->orderBy('amount','DESC')->where('user_id',Auth::user()->id)->get() as $key=> $bid)
                                        <tr>
                                            <td class="serial">{{$key+1}}</td>
                                            <td>{{$bid->user->name}}</td>
                                            <td>${{$bid->amount}}</td>
                                            <td>{{$bid->created_at }}</td>
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
        jQuery('#auctions').addClass('active')
    </script>
@endsection
