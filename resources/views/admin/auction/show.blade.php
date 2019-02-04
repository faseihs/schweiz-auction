@extends('layouts.client')

@section('content')
    @include('includes.errors')
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header">Auction Details</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 font-weight-bold">Title :</div>
                        <div class="col-md-9">{{$auction->title}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 font-weight-bold">Vehicle :</div>
                        <div class="col-md-9">{{ucfirst($auction->vehicle)}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 font-weight-bold">Start :</div>
                        <div class="col-md-9">{{$auction->start}}</div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 font-weight-bold">End :</div>
                        <div class="col-md-9">{{$auction->end}}</div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 font-weight-bold">Created :</div>
                        <div class="col-md-9">{{$auction->created_at}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 font-weight-bold">Bids :</div>
                        <div class="col-md-9">{{sizeof($auction->bids)}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 font-weight-bold">Starts in :</div>
                        <div class="col-md-9 list-group-item-light" id="start"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 font-weight-bold">Ends in :</div>
                        <div class="col-md-9 list-group-item-light" id="end"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div id="slider" class="flexslider">
                <ul class="slides">
                    @foreach($auction->files as $file)
                    <li>
                        <img style="max-height: 400px" class="img-responsive" src="{{$file->getImage()}}" />
                    </li>
                    @endforeach
                    <!-- items mirrored twice, total of 12 -->
                </ul>
            </div>
           {{-- <div id="carousel" class="flexslider">
                <ul class="slides">
                    @foreach($auction->files as $file)
                        <li>
                            <img style="max-height: 100px; max-width: 100px;" class="img-thumbnail" src="{{$file->getImage()}}" />
                        </li>
                    @endforeach
                    <!-- items mirrored twice, total of 12 -->
                </ul>
            </div>--}}


        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Vehicle Details</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 font-weight-bold">Mileage :</div>
                        <div class="col-md-2">{{$auction->Vehicle->mileage}}</div>
                        <div class="col-md-2 font-weight-bold">1st Reg :</div>
                        <div class="col-md-2">{{$auction->Vehicle->registration}}</div>
                        <div class="col-md-2 font-weight-bold">Gear :</div>
                        <div class="col-md-2">{{$auction->Vehicle->gear}}</div>
                        <div class="col-md-2 font-weight-bold">Wheeldrive :</div>
                        <div class="col-md-2">{{$auction->Vehicle->wheeldrive}}</div>
                        <div class="col-md-2 font-weight-bold">Fuel :</div>
                        <div class="col-md-2">{{$auction->Vehicle->fuel}}</div>
                        <div class="col-md-2 font-weight-bold">Displacement :</div>
                        <div class="col-md-2">{{$auction->Vehicle->displacement}}</div>
                        <div class="col-md-2 font-weight-bold">Body :</div>
                        <div class="col-md-2">{{$auction->Vehicle->body}}</div>
                        <div class="col-md-2 font-weight-bold">Interior :</div>
                        <div class="col-md-2">{{$auction->Vehicle->interior}}</div>
                        <div class="col-md-2 font-weight-bold">Exterior Color :</div>
                        <div class="col-md-2">{{$auction->Vehicle->exterior_color}}</div>
                        <div class="col-md-2 font-weight-bold">Transported By :</div>
                        <div class="col-md-2">{{$auction->Vehicle->transported_by}}</div>
                        <div class="col-md-2 font-weight-bold">Seats :</div>
                        <div class="col-md-2">{{$auction->Vehicle->seats}}</div>
                    </div>
                    <hr>
                    <hr>

                    <div class="row">
                        <div class="col-md-3 font-weight-bold">Serial Equipment</div>
                        <div class="col-md-9">{{$auction->Vehicle->serial_equipment}}</div>
                    </div>
                    <hr>
                    <hr>
                    <div class="row">
                        <div class="col-md-3 font-weight-bold">Special Equipment</div>
                        <div class="col-md-9">{{$auction->Vehicle->special_equipment}}</div>
                    </div>
                    <hr>
                    <hr>
                    <div class="row">
                        <div class="col-md-3 font-weight-bold">Financial Services</div>
                        <div class="col-md-9">{{$auction->Vehicle->financial_services}}</div>
                    </div>
                    <hr>
                    <hr>
                    <div class="row">

                        <h5 class="col-md-12 font-weight-bold">Vehicle Description</h5>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                        <ul class="list-group">
                            @foreach(explode('_',$auction->Vehicle->vehicle_description) as $v)
                                <li class="list-group-item"><span class="font-weight-bold">{{explode('-',$v)[0]}} : </span> {{explode('-',$v)[1]}}</li>

                            @endforeach
                        </ul>
                        </div>
                    </div>
                    <hr>
                    <hr>

                    <div class="row">

                        <h5 class="col-md-12 font-weight-bold">Conditions</h5>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <ul class="list-group">
                                @foreach(explode('-',$auction->Vehicle->condition) as $c)
                                    <li class="list-group-item"> {{$c}}</li>

                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
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
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($auction->bids()->orderBy('amount','DESC')->get() as $key=> $bid)
                                    <tr>
                                        <td class="serial">{{$key+1}}</td>
                                        <td>{{$bid->user->name}}</td>
                                        <td>${{$bid->amount}}</td>
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


@endsection

@section('title')
    | Auction : {{$auction->id}}
@endsection


@section('scripts')
    <script src="{{asset('js/jquery.flexslider-min.js')}}"></script>
    <script src="{{asset('js/jquery.countdown.min.js')}}"></script>
    <script>
        jQuery(document).ready(function () {
            jQuery('body').addClass('open');
            jQuery("#start")
                .countdown("{{$auction->start}}", function(event) {
                    jQuery(this).text(
                        event.strftime('%D days %H:%M:%S')
                    );
                });
            jQuery("#end")
                .countdown("{{$auction->end}}", function(event) {
                    jQuery(this).text(
                        event.strftime('%D days %H:%M:%S')
                    );
                });
        });

        jQuery('#carousel').flexslider({
            animation: "slide",
           /* controlNav: false,
            animationLoop: false,
            slideshow: false,
            itemWidth: 210,
            itemMargin: 5,
            asNavFor: '#slider'*/
        });

        jQuery('#slider').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            sync: "#carousel"
        });
    </script>
@endsection

@section('stylesheets')
    <link rel="stylesheet" href="{{asset('css/flexslider.css')}}">
    <style>
        @font-face {
            font-family: 'flexslider-icon';
            src: url('{{asset("fonts/flexslider-icon.eot")}}');
            src: url('{{asset("fonts/flexslider-icon.eot?#iefix")}}') format('embedded-opentype'), url('{{asset("fonts/flexslider-icon.woff")}}') format('woff'), url('{{asset("fonts/flexslider-icon.ttf")}}') format('truetype'), url('{{asset("fonts/flexslider-icon.svg#flexslider-icon")}}') format('svg');
            font-weight: normal;
            font-style: normal;
        }
    </style>


@endsection