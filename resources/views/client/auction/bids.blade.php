@extends('layouts.client_new')

@section('content')
    <hr>
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('includes.flash')
                <div class="card">
                    <div class="card-header">My Bids
                        <select class="form-control-sm" name="type" id="type">
                            <option {{$type==1?'selected':''}} value="1">All</option>
                            <option  {{$type==2?'selected':''}} value="2">Won</option>
                            <option {{$type==3?'selected':''}} value="3">Lost</option>
                        </select>
                    </div>

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
                                        {{--<th></th>--}}
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
                                            {{--<td>
                                                @if($bid->auction->status==1)
                                                <a href="#" onclick="clicked({{$bid->id}})" class="btn btn-sm btn-danger btn-labeled fa fa-trash"> Delete</a>



                                                <form style="display: none;" id="del{{$bid->id}}" action="/client/bid/{{$bid->id}}" method="POST">
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    @csrf
                                                </form>
                                                @endif
                                            </td>--}}
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
        $(document).ready(function () {
            $('#type').change(function () {
                if($(this).val()==1)
                    window.location='/client/bid';
                else if($(this).val()==2)
                    window.location='/client/bid?type=won';
                else if($(this).val()==3)
                    window.location='/client/bid?type=lost';
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
