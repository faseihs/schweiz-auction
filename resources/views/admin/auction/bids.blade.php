@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Bids
                        </div>

                    <div class="card-body">
                        <div class="row">
                            @include('includes.flash')
                            @if(sizeof($bids)>0)
                                <div  class="col-md-12 table-responsive">

                                    <table class="table table-borderless table-striped">
                                        <thead>
                                        <tr>
                                            <th class="serial">#</th>
                                            <th>User</th>
                                            <th>Amount</th>
                                            <th>Bid Time</th>
                                            <th>Winner</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($bids as $key=> $bid)
                                            <tr>
                                                <td class="serial">{{$key+1}}</td>
                                                <td>{{$bid->user->name}}</td>
                                                <td>{{$bid->amount}}</td>
                                                <td>{{$bid->created_at}}</td>
                                                <td>@if($bid->winner==1)
                                                        Yes
                                                        @else
                                                        No
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($bid->auction->status==0)
                                                    <a href="/admin/auction-bid/{{$bid->id}}" class="btn btn-success btn-labeled fa fa-check" > Choose Winner</a>
                                                    @endif
                                                </td>
                                            </tr>

                                        @endforeach
                                        </tbody>
                                    </table>
                                    <a class="btn btn-sn btn-dark" href="/admin/auction-bid-remove/{{$auction->id}}">Remove Winner</a>

                                </div>
                            @else
                                <div class="alert alert-warning">No Bids</div>
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
        jQuery('#bids').addClass('active');
        jQuery('body').addClass('open');
        /*jQuery(document).ready(function () {
            jQuery('#type').change(function () {
                if(jQuery(this).val()==1)
                    window.location='/admin/bid';
                else if(jQuery(this).val()==2)
                    window.location='/admin/bid?type=new';
                else if(jQuery(this).val()==3)
                    window.location='/admin/bid?type=closed';
            }) ;

        });
        function clicked(id){

            if(confirm("Are You Sure ?")){
                document.getElementById('del'+id).submit();
            }
            else{
            }
        }*/

    </script>
@endsection
