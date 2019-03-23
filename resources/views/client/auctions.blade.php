@extends('layouts.client_new')

@section('content')
    <div style="margin-top: 24px;" class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a  href="/client/auctions" class="nav-link {{$type=='all'?'active':''}}" id="home-tab"  >All</a>
            </li>
            <li class="nav-item">
                <a href="/client/auctions?type=car" class="nav-link {{$type=='car'?'active':''}}" id="profile-tab" >Car</a>
            </li>
            <li class="nav-item">
                <a href="/client/auctions?type=bike" class="nav-link {{$type=='bike'?'active':''}}" id="contact-tab">Bike</a>
            </li>
            <li class="nav-item">
                <a href="/client/auctions?type=bus" class="nav-link {{$type=='bus'?'active':''}}" id="contact-tab">Bus</a>
            </li>
            <li class="nav-item">
                <a href="/client/auctions?type=others" class="nav-link {{$type=='Others'?'active':''}}" id="contact-tab">Others</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="home-tab">

                @if(sizeof($auctions)>0)
                    <div class="col-md-12 col-12 table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($auctions as $auction)
                                <tr>
                                    <td><img style="height: 50px; width: 75px;" src="{{$auction->getThumbnail()}}"></td>
                                    <td>{{$auction->title}}</td>
                                    <td>{{$auction->start}}</td>
                                    <td>{{$auction->end}}</td>
                                    <td>
                                        <a href="/client/auction-bid/{{$auction->id}}" class="btn btn-dark btn-sm">
                                            <i class="fa fa-check"></i> Bid</a>
                                        <a href="/client/auction/{{$auction->id}}" class="btn btn-info btn-sm">
                                            <i class="fa fa-info"></i> View</a>
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>

                        </table>
                    </div>
                @else
                    <div class="alert alert-warning">No Auctions</div>
                @endif
            </div>

        </div>
    </div>

@endsection


@section('title')
    | Auctions
@endsection