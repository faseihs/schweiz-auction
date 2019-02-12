@extends('layouts.admin')

@section('content')
    <div class="row">
        @include('includes.flash')
        @include('includes.errors')
        <div class="col-md-12">
           <div class="card">
               <div class="card-header">
                   Users
                   <select onchange="window.location='/admin/users?type='+this.value" class="form-control-sm" name="type" id="type">
                       <option {{$type==1?'selected':''}} value="1">All</option>
                       <option  {{$type==2?'selected':''}} value="2">Approved</option>
                       <option {{$type==3?'selected':''}} value="3">Not Approved</option>
                   </select>
               </div>

               <div class="card-body">
                   <div class="row">
                       <div class="col-md-12 table-responsive">
                           @if(sizeof($users)<1)
                               <div class="alert alert-warning">No Users</div>
                           @else
                               <table class="table table-striped table-borderless">
                                   <thead>
                                   <tr>
                                       <th>#</th>
                                       <th>Name</th>
                                       <th>Email</th>
                                       <th>Status</th>
                                       <th>Action</th>
                                   </tr>
                                   </thead>
                                   <tbody>
                                   @foreach($users as $key=>$user)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td><span class="{{$user->approved==1?'alert-success':'alert-warning'}}">{{$user->approved==1?'Approved':'Not Approved'}}</span></td>
                                            <td>
                                                <a class="btn-link" href="/admin/user-toggle/{{$user->id}}">
                                                    {{$user->approved==1?'Disapprove':'Approve'}}
                                                </a>
                                            </td>
                                        </tr>


                                   @endforeach
                                   </tbody>
                               </table>

                           @endif
                       </div>
                   </div>
               </div>
           </div>
        </div>
    </div>
@endsection


@section('title')
    | Users
@endsection



@section('scripts')
    <script>
        jQuery(document).ready(function () {
            jQuery('#users').addClass('active');
        });

    </script>
    @@endsection