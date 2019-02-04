@extends('layouts.admin')

@section('content')
    <div class="container">
        @include('includes.errors')
        @include('includes.flash')
        <div class="row justify-content-center">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Account Settings</div>

                    <div class="card-body">
                        <form method="POST" action="/common/account-settings">
                            @csrf
                            <div class="row form-group">
                                <div class="col-md-2">Name</div>
                                <div class="col-md-4">
                                    <input value="{{$user->name}}" required class="form-control" name="name"  type="text">
                                </div>

                            </div>
                            <div class="row form-group">
                                <div class="col-md-2">Email</div>
                                <div class="col-md-4">
                                    <input value="{{$user->email}}" required class="form-control" name="email"  type="email">
                                </div>

                            </div>
                            <hr>
                            <hr>

                            <div class="row form-group">
                                <div class="col-md-2">Old Password</div>
                                <div class="col-md-4">
                                    <input  class="form-control" name="old_password"  type="password">
                                </div>

                            </div>
                            <div class="row form-group">
                                <div class="col-md-2">New Password</div>
                                <div class="col-md-4">
                                    <input  class="form-control" name="password"  type="password">
                                </div>

                            </div>
                            <div class="row form-group">
                                <div class="col-md-2">Confirm Password</div>
                                <div class="col-md-4">
                                    <input  class="form-control" name="password_confirmation"  type="password">
                                </div>

                            </div>


                            <hr>
                            <hr>
                            <div class="row">
                                <div class="col-md-2">
                                    <button class="btn btn-success">
                                        <i class="fa fa-check"></i>
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


@section('title')
    | Account Settings
@endsection

@section('scripts')

    <script>

    </script>
@endsection
