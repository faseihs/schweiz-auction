@extends('layouts.client')

@section('content')
    <div class="container">
        @include('includes.errors')
        @include('includes.flash')
        <div class="row justify-content-center">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Account Settings</div>

                    <div class="card-body">
                        <form enctype="multipart/form-data" method="POST" action="/common/profile-settings">
                            @csrf
                            <div class="row form-group">
                                <div class="col-md-2">Date of Birth</div>
                                <div class="col-md-4">
                                    <input value="{{$profile->dob?Carbon::parse($profile->dob)->format('Y-m-d'):''}}" required class="form-control" name="dob"  type="date">
                                </div>

                            </div>
                            <div class="row form-group">
                                <div class="col-md-2">Zipcode</div>
                                <div class="col-md-4">
                                    <input value="{{$profile->zip_code}}"  class="form-control" name="zip_code"  type="text">
                                </div>

                            </div>
                            <div class="row form-group">
                                <div class="col-md-2">Contact</div>
                                <div class="col-md-4">
                                    <input value="{{$profile->contact}}"  class="form-control" name="contact"  type="number">
                                </div>

                            </div>

                            <div class="row form-group">
                                <div class="col-md-2">Country</div>
                                <div class="col-md-4">
                                    {!! Form::select('country',$countries,$profile->country,['class'=>'form-control','placeholder'=>'Select','required']) !!}
                                </div>

                            </div>
                            @if($profile->dp)
                            <div class="row form-group">
                                <img style="height: 250px; width: 250px;" src="{{$profile->getDp()}}" alt="User DP">
                            </div>
                            @endif

                            <div class="row form-group">
                                <div class="col-md-2">Picture</div>
                                <div class="col-md-4">
                                    <input name="dp" accept="image/*" type="file">
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
