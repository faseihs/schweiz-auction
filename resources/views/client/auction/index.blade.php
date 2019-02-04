@extends('layouts.client_new')

@section('content')
    <section class="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-2">
                    {{$vehicle?$vehicle:'Auctions'}}

                </div>
                <div class="col-sm-12 col-4">
                    <select class="form-control-sm" name="type" id="type">
                        <option {{$type==1?'selected':''}} value="1">All</option>
                        <option  {{$type==2?'selected':''}} value="2">New</option>
                        <option {{$type==3?'selected':''}} value="3">Closed</option>
                    </select>
                </div>
            </div>
        </div>
        <hr>
        <div class="container-fluid">
            <div class="row">
                @if(sizeof($auctions)<1)
                    <div class="alert alert-danger col-md-12 text-center">No Auctions</div>
                @endif
                @foreach($auctions as $auction)

                    <div class="col-md-3">
                        <div class="card" style="width: 18rem;">
                            <img style="width: 275px;height: 275px;" class="card-img-top" src="{{$auction->getThumbnail()}}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{$auction->title}}</h5>
                                <p class="card-text">{{ucfirst($auction->vehicle)}}</p>
                                <div class="text-center">
                                    <a href="/client/auction/{{$auction->id}}" class="btn btn-success">View</a>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
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
               if($(this).val()==1)
                   window.location='/client/{{lcfirst($vehicle?$vehicle:'Auctions')}}';
               else if($(this).val()==2)
                   window.location='/client/{{lcfirst($vehicle?$vehicle:'Auctions')}}?type=new';
               else if($(this).val()==3)
                   window.location='/client/{{lcfirst($vehicle?$vehicle:'Auctions')}}?type=closed';
           }) ;
        });
    </script>
@endsection
