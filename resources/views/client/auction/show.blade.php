@extends('layouts.client_new')

@section('content')
    @include('includes.errors')
    @include('includes.flash')
    <hr>
    <hr>
    <div class="container-fluid">


        <div class="row">

            <div class="col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-body">
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
                        <div id="carousel" class="flexslider">
                            <ul class="slides">
                                @foreach($auction->files as $file)
                                    <li>
                                        <img style="width:100px;height:100px;" src="{{$file->getImage()}}" />
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>




            </div>
            <div class="col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Auction Details <br><a class="btn btn-info btn-labled fa fa-info" href="/admin/auction-bids/{{$auction->id}}"> See Bids</a></div>

                        <div class="row">
                            <div style="font-size: 13px;" class="col-md-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <th></th>
                                    <th></th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Title</td>
                                        <td>{{$auction->title}}</td>
                                    </tr>
                                    <tr>
                                        <td>Vehicle</td>
                                        <td>{{ucfirst($auction->vehicle)}}</td>
                                    </tr>
                                    <tr>
                                        <td>Start</td>
                                        <td>{{$auction->start}}</td>
                                    </tr>
                                    <tr>
                                        <td>End</td>
                                        <td>{{$auction->end}}</td>
                                    </tr>
                                    <tr>
                                        <td>Created</td>
                                        <td>{{$auction->created_at}}</td>
                                    </tr>
                                    <tr>
                                        <td>Bids</td>
                                        <td>{{sizeof($auction->bids)}}</td>
                                    </tr>
                                    <tr >
                                        <td>Starts in</td>
                                        <td >{{$auction->start}}</td>
                                    </tr>
                                    <tr >
                                        <td>Ends in</td>
                                        <td >{{$auction->end}}</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>{{$auction->status==1?'Open':'Closed'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Mileage</td>
                                        <td>{{$auction->Vehicle->mileage}}</td>
                                    </tr>
                                    <tr>
                                        <td>1st Reg</td>
                                        <td>{{$auction->Vehicle->registration}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">Timeline</div>
                                <div class="row">
                                    <div class="col-md-2">
                                        Starts in :
                                    </div>
                                    <div class="col-md-10">
                                        <div class='countdown' data-date="{{Carbon::parse($auction->start)->format('Y-m-d')}}" data-time="{{Carbon::parse($auction->start)->format('H:i')}}"></div>
                                    </div>

                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-2">
                                        Ends in :
                                    </div>
                                    <div class="col-md-10">
                                        <div class='countdown' data-date="{{Carbon::parse($auction->end)->format('Y-m-d')}}" data-time="{{Carbon::parse($auction->end)->format('H:i')}}"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">

                            <div class="card">

                                <div class="card-body">
                                    <dic class="card-title">Further Descriptions</dic>
                                    <div class="row">
                                        <h6 class="col-md-12 font-weight-bold">Vehicle Description</h6>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach(explode('_',$auction->Vehicle->vehicle_description) as $v)
                                                    <tr>
                                                        <td>{{explode('-',$v)[0]}}</td>
                                                        <td>{{explode('-',$v)[1]}}</td>
                                                    </tr>

                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    <hr>
                                    <hr>

                                    <div class="row">

                                        <h5 class="col-md-12 font-weight-bold">Conditions</h5>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul class="list-group">
                                                @foreach(explode('-',$auction->Vehicle->condition) as $c)
                                                    <li class="list-group-item"> {{$c}}</li>

                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
                </div>

            </div>


        </div>
        <div style="margin-top: 24px;" class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Description Of Damage</div>
                        <div class="row">
                            <div class="col-md-12">

                                <div class="table-responsive">
                                    <table class="table table-noborder table-nobackground">
                                        <tbody>
                                        <tr>
                                            <td style="width:30px;"><input type="checkbox"  disabled name="damagezone[]" id="damagezone_12" readonly {{is_int(array_search('1',$damages))?'checked':''}} value="1" title="Avant à droite" ></td>
                                            <td class="text-center" style="width:170px;"><input disabled type="checkbox" name="damagezone[]" id="damagezone_22" {{is_int(array_search('2',$damages))?'checked':''}} value="2" title="à droite" ></td>
                                            <td style="width:30px;"><input disabled type="checkbox" name="damagezone[]" id="damagezone_32" value="3" title="Arrière à droite" ></td>
                                            <td class="text-center" style="min-width:180px;"><input disabled type="checkbox" name="damagezone[]" id="damagezone_50" {{is_int(array_search('9',$damages))?'checked':''}} value="9" title="haut" ></td>
                                        </tr>
                                        <tr>
                                            <td><input disabled type="checkbox" name="damagezone[]" id="damagezone_11" {{is_int(array_search('4',$damages))?'checked':''}} value="4" title="Avant" ></td>
                                            <td class="text-center"><img src="https://www.restwertboerse.ch/assets/images/graphics/car-top.png" width="140" alt=""></td>
                                            <td><input disabled type="checkbox" name="damagezone[]" id="damagezone_31" {{is_int(array_search('5',$damages))?'checked':''}} value="5" title="Arrière" ></td>
                                            <td class="text-center"><img src="https://www.restwertboerse.ch/assets/images/graphics/car-side.png" width="140" alt=""></td>
                                        </tr>
                                        <tr>
                                            <td><input disabled type="checkbox" name="damagezone[]" id="damagezone_10" {{is_int(array_search('6',$damages))?'checked':''}} value="6" title="Avant à gauche" ></td>
                                            <td class="text-center"><input disabled type="checkbox" name="damagezone[]"  id="damagezone_20" {{is_int(array_search('7',$damages))?'checked':''}} value="7" title="à gauche" ></td>
                                            <td><input disabled type="checkbox" name="damagezone[]" id="damagezone_30" {{is_int(array_search('8',$damages))?'checked':''}} value="8" title="Arrière à gauche" ></td>
                                            <td class="text-center"><input disabled type="checkbox" name="damagezone[]" id="damagezone_40" {{is_int(array_search('10',$damages))?'checked':''}} value="10" title="dessous" ></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        @if(sizeof($defects)>0)

                            <div class="row">

                                <h5 class="col-md-12 font-weight-bold">Defects</h5>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="list-group">
                                        @foreach(explode(',',$auction->Vehicle->defects) as $c)
                                            <li style="font-size: 13px;" class="list-group-item"> {{ucfirst($c)}}</li>

                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        @if($auction->Vehicle->notes)
                            <hr>

                            <div class="row">
                                <div class="col-md-3 font-weight-bold">Notes :</div>
                                <div class="col-md-9">{{$auction->Vehicle->notes?$auction->Vehicle->notes:'-'}}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div style="font-size: 13px" class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        <div class="card-title">All bids</div>
                        <div class="row">
                            <div  class="col-md-12 table-responsive table-stats order-table ov-h">
                                @if(sizeof($auction->bids)>0)
                                <table class="table table-striped table-borderless">
                                    <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>Bid by</th>
                                        <th>Amount</th>
                                        <th>Won</th>
                                        <th>Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($auction->bids()->orderBy('amount','DESC')->get() as $key=> $bid)
                                        <tr>
                                            <td class="serial">{{$key+1}}</td>
                                            <td>{{$bid->user->name}}</td>
                                            <td>${{$bid->amount}}</td>
                                            <td>{{$bid->winner==1?'Yes':'No'}}</td>
                                            <td>{{$bid->created_at}}</td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                                    @else
                                <div class="alert alert-warning">No Bids</div>
                                    @endif
                            </div>
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
    {{--<script src="{{asset('js/jquery.countdown.min.js')}}"></script>--}}
    <script src="{{asset('js/countdown.js')}}"></script>
    <script>
        jQuery(document).ready(function () {
            jQuery('auctions').addClass('active');
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
             controlNav: false,
             animationLoop: false,
             slideshow: false,
             itemWidth: 210,
             itemMargin: 5,
             asNavFor: '#slider'
        });

        jQuery('#slider').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            sync: "#carousel"
        });

        function flipTo(digit, n){
            var current = digit.attr('data-num');
            digit.attr('data-num', n);
            digit.find('.front').attr('data-content', current);
            digit.find('.back, .under').attr('data-content', n);
            digit.find('.flap').css('display', 'block');
            setTimeout(function(){
                digit.find('.base').text(n);
                digit.find('.flap').css('display', 'none');
            }, 350);
        }

        function jumpTo(digit, n){
            digit.attr('data-num', n);
            digit.find('.base').text(n);
        }

        function updateGroup(group, n, flip){
            var digit1 = $('.ten'+group);
            var digit2 = $('.'+group);
            n = String(n);
            if(n.length == 1) n = '0'+n;
            var num1 = n.substr(0, 1);
            var num2 = n.substr(1, 1);
            if(digit1.attr('data-num') != num1){
                if(flip) flipTo(digit1, num1);
                else jumpTo(digit1, num1);
            }
            if(digit2.attr('data-num') != num2){
                if(flip) flipTo(digit2, num2);
                else jumpTo(digit2, num2);
            }
        }

        function setTime(flip){
            var t = new Date();
            updateGroup('hour', t.getHours(), flip);
            updateGroup('min', t.getMinutes(), flip);
            updateGroup('sec', t.getSeconds(), flip);
        }

        $(document).ready(function(){

            setTime(false);
            setInterval(function(){
                setTime(true);
            }, 1000);

        });
    </script>
@endsection

@section('stylesheets')
    <link rel="stylesheet" href="{{asset('css/flexslider.css')}}">
    <link rel="stylesheet" href="{{asset('css/countdown.css')}}">
    <style>
        @font-face {
            font-family: 'flexslider-icon';
            src: url('{{asset("fonts/flexslider-icon.eot")}}');
            src: url('{{asset("fonts/flexslider-icon.eot?#iefix")}}') format('embedded-opentype'), url('{{asset("fonts/flexslider-icon.woff")}}') format('woff'), url('{{asset("fonts/flexslider-icon.ttf")}}') format('truetype'), url('{{asset("fonts/flexslider-icon.svg#flexslider-icon")}}') format('svg');
            font-weight: normal;
            font-style: normal;
        }
        #slider{
            margin-bottom: 4px;
        }

        #carousel li img{
            box-shadow: 3px 3px 1px #ccc;
            -webkit-box-shadow: 3px 3px 1px #ccc;
            -moz-box-shadow: 3px 3px 1px #ccc;
        }
    </style>


@endsection