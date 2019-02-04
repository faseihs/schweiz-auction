@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('includes.flash')
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Auctions
                        <select class="form-control-sm" name="type" id="type">
                            <option {{$type==1?'selected':''}} value="1">All</option>
                            <option  {{$type==2?'selected':''}} value="2">New</option>
                            <option {{$type==3?'selected':''}} value="3">Closed</option>
                        </select>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @if(sizeof($auctions)>0)
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
                                                <td><a class="btn-link" href="/admin/auction/{{$auction->id}}">{{$auction->title}}</a></td>
                                                <td>{{$auction->vehicle}}</td>
                                                <td>{{$auction->start}}</td>
                                                <td>{{$auction->end}}</td>
                                                <td>@if($auction->status==1)
                                                        <a href="#" onclick="clicked('{{$auction->id}}')" class="btn btn-danger btn-labeled fa fa-trash"> Delete</a>
                                                        <form style="display: none;" id="del{{$auction->id}}" action="/admin/auction/{{$auction->id}}" method="POST">
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            @csrf
                                                        </form>
                                                    @endif
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
        jQuery(document).ready(function () {
            jQuery('#type').change(function () {
                if(jQuery(this).val()==1)
                    window.location='/admin/auction';
                else if(jQuery(this).val()==2)
                    window.location='/admin/auction?type=new';
                else if(jQuery(this).val()==3)
                    window.location='/admin/auction?type=closed';
            }) ;

        });
        function clicked(id){

            if(confirm("Are You Sure ?")){
                document.getElementById('del'+id).submit();
            }
            else{
            }
        }

    </script>
@endsection
