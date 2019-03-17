@extends('layouts.client_new')

@section('content')
    <section class="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    {{$vehicle?$vehicle:'Auctions'}}
                    <input id="view" value="{{$grid}}" name="view" type="hidden">
                    <i class="btn btn-link  {{$grid==2?'fas fa-grip-horizontal':'fa fa-list'}}" onclick="changeGrid({{$grid==1?2:1}})"></i>

                </div>
                {{--<div class="col-sm-4 col-md-2 col-xl-1">
                    <select class="form-control-sm" name="type" id="type">
                        <option {{$type==1?'selected':''}} value="1">All</option>
                        <option  {{$type==2?'selected':''}} value="2">New</option>
                        <option {{$type==3?'selected':''}} value="3">Closed</option>
                    </select>
                </div>--}}
                {{--<div class="col-sm-4 col-md-2 col-xl-1">
                    --}}{{--<select class="form-control-sm" name="view" id="view">
                        <option {{$grid==1?'selected':''}} value="1">Grid View</option>
                        <option  {{$grid==2?'selected':''}} value="2">List View</option>
                    </select>--}}{{--
                    <input id="view" value="{{$grid}}" name="view" type="hidden">
                    <i class="btn btn-link  {{$grid==2?'fas fa-grip-horizontal':'fa fa-list'}}" onclick="changeGrid({{$grid==1?2:1}})"></i>
                </div>--}}


            </div>
            <br>
            <form id="filterForm" method="POST" action="/client/{{lcfirst($vehicle)}}">
                @csrf
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="row">
                        <label class="col-md-3">Reg Year </label>
                        <div class="col-md-4"><input name="reg_from" pattern="[0-9]{4}" placeholder="From" class="form-control form-control-sm" type="text"></div>
                        <div class="col-md-4"><input  name="reg_to" pattern="[0-9]{4}" placeholder="To" class="form-control form-control-sm" type="text"></div>

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="row">
                        <label class="col-md-4">Displacement </label>
                        <div class="col-md-4"><input name="disp_from" placeholder="From" class="form-control form-control-sm" type="number"></div>
                        <div class="col-md-4"><input name="disp_to" placeholder="To" class="form-control form-control-sm" type="number"></div>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <label class="col-md-3">Search</label>
                        <div class="col-md-9"><input name="search" placeholder="Search.." class="form-control form-control-sm" type="text"></div>
                    </div>
                </div>
                <div class="col-md-1">
                    <a onclick="document.getElementById('filterForm').submit();" class="btn btn-dark btn-sm text-white">Go !</a>
                </div>
            </div>
            </form>
        </div>
        <hr>
        <div class="container">
            <div class="row">
                @if(sizeof($auctions)<1)
                    <div class="alert alert-danger col-md-12 text-center">No Auctions</div>
                @endif
                @if($grid==1)
                    @foreach($auctions as $auction)

                        <div class="col-md-4 col-sm-12 col-xl-3">
                            <div class="card" >
                                <img style="width: 100%;height: 200px;" class="card-img-top" src="{{$auction->getThumbnail()}}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{$auction->title}}</h5>
                                    <p class="card-text">{{ucfirst($auction->vehicle)}}</p>
                                    <div class="text-center">
                                        <a href="/client/auction-bid/{{$auction->id}}" class="btn btn-dark">
                                            <i class="fa fa-check"></i> Bid</a>
                                        <a href="/client/auction/{{$auction->id}}" class="btn btn-info">
                                            <i class="fa fa-info"></i> View</a>

                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                @endif
                    @if($grid==2)
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
                                    <a href="/client/auction-bid/{{$auction->id}}" class="btn btn-dark">
                                        <i class="fa fa-check"></i> Bid</a>
                                    <a href="/client/auction/{{$auction->id}}" class="btn btn-info">
                                        <i class="fa fa-info"></i> View</a>
                                </td>
                            </tr>

                        @endforeach

                        </tbody>

                    </table>
                </div>
                @endif
            </div>

        </div>
    </section>

@endsection


@section('title')
    | Auctions
@endsection

@section('scripts')

    <script>
        $('#auctions').addClass('active')
        $(document).ready(function () {
            $('#type').change(function () {
                if($('#view').val()==1) {
                    if ($('#type').val() == 1) {
                        window.location = '/client/{{lcfirst($vehicle)}}?view=1';
                    }
                    else if ($('#type').val() == 2) {
                        window.location = '/client/{{lcfirst($vehicle)}}?type=new&grid=1';
                    }
                    else if ($('#type').val() == 3) {
                        window.location = '/client/{{lcfirst($vehicle)}}?type=closed&grid=1';
                    }
                }
                else {
                    if ($('#type').val() == 1) {
                        window.location = '/client/{{lcfirst($vehicle)}}?grid=2';
                    }
                    else if ($('#type').val() == 2) {
                        window.location = '/client/{{lcfirst($vehicle)}}?type=new&grid=2';
                    }
                    else if ($('#type').val() == 3) {
                        window.location = '/client/{{lcfirst($vehicle)}}?type=closed&grid=2';
                    }
                }
            }) ;
            $('#view').change(function () {
                if($(this).val()==1) {
                    if ($('#type').val() == 1) {
                        window.location = '/client/{{lcfirst($vehicle)}}?view=1';
                    }
                    else if ($('#type').val() == 2) {
                        window.location = '/client/{{lcfirst($vehicle)}}?type=new&grid=1';
                    }
                    else if ($('#type').val() == 3) {
                        window.location = '/client/{{lcfirst($vehicle)}}?type=closed&grid=1';
                    }
                }
                else {
                    if ($('#type').val() == 1) {
                        window.location = '/client/{{lcfirst($vehicle)}}?grid=2';
                    }
                    else if ($('#type').val() == 2) {
                        window.location = '/client/{{lcfirst($vehicle)}}?type=new&grid=2';
                    }
                    else if ($('#type').val() == 3) {
                        window.location = '/client/{{lcfirst($vehicle)}}?type=closed&grid=2';
                    }
                }
            }) ;
        });

        function changeGrid(type){
            if(type==1) {
                if ($('#type').val() == 1) {
                    window.location = '/client/{{lcfirst($vehicle)}}?view=1';
                }
                else if ($('#type').val() == 2) {
                    window.location = '/client/{{lcfirst($vehicle)}}?type=new&grid=1';
                }
                else if ($('#type').val() == 3) {
                    window.location = '/client/{{lcfirst($vehicle)}}?type=closed&grid=1';
                }
            }
            else {
                if ($('#type').val() == 1) {
                    window.location = '/client/{{lcfirst($vehicle)}}?grid=2';
                }
                else if ($('#type').val() == 2) {
                    window.location = '/client/{{lcfirst($vehicle)}}?type=new&grid=2';
                }
                else if ($('#type').val() == 3) {
                    window.location = '/client/{{lcfirst($vehicle)}}?type=closed&grid=2';
                }
            }
        }
    </script>
@endsection
