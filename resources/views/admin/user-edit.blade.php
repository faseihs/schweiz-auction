@extends('layouts.admin')

@section('content')
    <div style="font-size: 13px;" class="row">

        <div class="col-md-12">

            <div class="card">
                <div class="card-header">{{$user->name}}</div>
                <div class="card-body">
                    @include('includes.flash')
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless">
                            <thead>
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td>{{$user->name}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{$user->email}}</td>
                                </tr>
                                <tr>
                                    <td>Contact</td>
                                    <td>{{$user->profile->contact?$user->profile->contact:'-'}}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>{{$user->profile->address?$user->profile->address:'-'}}</td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td>{{$user->profile->country?$user->profile->country:'-'}}</td>
                                </tr>
                                <tr>
                                    <td>Picture</td>
                                    <td><img style="height: 150px;width: 225px;" src="{{$user->profile->getDp()}}"</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div style="font-size: 13px;" class="col-md-12">
            <div class="card">
                <div class="card-header">Change Password</div>
                <div class="card-body">
                    <form method="POST" action="/admin/user/{{$user->id}}">
                        @csrf
                        <div class="form-group">
                            <label>Password</label>
                            <input required name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input required name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Update</button>
                    </form>
                </div>
            </div>
    </div>

        <div style="font-size: 13px;" class="col-md-12">
            <div class="card">
                <div class="card-header">All bids</div>
                <div class="card-body">
                    <div class="row">
                        <div  class="col-md-12 table-responsive">
                            <table class="table table-striped table-borderless">
                                <thead>
                                <tr>
                                    <th class="serial">#</th>
                                    <th>Auction</th>
                                    <th>Amount</th>
                                    <th>Won</th>
                                    <th>Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($user->bids()->orderBy('amount','DESC')->get() as $key=> $bid)
                                    <tr>
                                        <td class="serial">{{$key+1}}</td>
                                        <td><a class="btn btn-sm btn-link" href="/admin/auction/{{$bid->auction->id}}">{{$bid->auction->title}}</a></td>
                                        <td>${{$bid->amount}}</td>
                                        <td>{{$bid->winner==1?'Yes':'No'}}</td>
                                        <td>{{$bid->created_at}}</td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection


@section('title')
    | Dashboard
@endsection

@section('scripts')
            <script>
                jQuery('body').addClass('open');
            </script>

@endsection
