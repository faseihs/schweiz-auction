@extends('layouts.admin')

@section('content')
    @include('includes.errors')
        <form method="POST" action="/admin/auction">
            @csrf

            <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h5>Auction Details</h5></div>
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Title</label></div>
                            <div class="col-md-3"><input type="text" id="text-input" name="text-input" placeholder="Text" class="form-control"></div>
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Vehicle</label></div>
                            <div class="col-md-3">
                                {!! Form::select('type',['car'=>'Car','bike'=>'Bike'],null,['class'=>'form-control','placeholder'=>'Select','required']) !!}
                            </div>



                        </div>
                        <div class="row form-group">
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">End Date</label></div>
                            <div class="col-md-3"><input type="date" id="text-input" name="text-input" placeholder="Text" class="form-control"></div>
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">End Time</label></div>
                            <div class="col-md-3"><input type="time" id="text-input" name="text-input" placeholder="Text" class="form-control"></div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header"><h5>Vehicle Details</h5></div>
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Mileage</label></div>
                            <div class="col-md-3"><input type="text" id="text-input" name="mileage" placeholder="Text" class="form-control"></div>
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">1st Reg</label></div>
                            <div class="col-md-3">
                                {!! Form::date('registration',null,['class'=>'form-control','placeholder'=>'Select','required']) !!}
                            </div>

                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Gear</label></div>
                            <div class="col-md-3">
                                {!! Form::text('gear',null,['class'=>'form-control','required']) !!}
                            </div>





                        </div>
                        <div class="row form-group">
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Fuel</label></div>
                            <div class="col-md-3"><input type="text" id="text-input" name="fuel" placeholder="Text" class="form-control"></div>
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Disp</label></div>
                            <div class="col-md-3"><input type="text" id="text-input" name="text-input" placeholder="Displacement" class="form-control"></div>
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Body</label></div>
                            <div class="col-md-3"><input type="text" id="text-input" name="body" placeholder="Text" class="form-control"></div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Interior</label></div>
                            <div class="col-md-3"><input type="text" id="text-input" name="interior" placeholder="Text" class="form-control"></div>
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Exterior Color</label></div>
                            <div class="col-md-3"><input type="text" id="text-input" name="exterior_color" placeholder="Displacement" class="form-control"></div>
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Seats</label></div>
                            <div class="col-md-3"><input type="number" id="text-input" name="body" placeholder="Seats" class="form-control"></div>
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Transported By</label></div>
                            <div class="col-md-3"><input type="text" id="text-input" name="transported_by" placeholder="" class="form-control"></div>
                        </div>
                        <hr>
                        <div class="row form-group">
                            <div class="col-md-2">Special Equipment</div>
                            <div class="col-md-10">
                                <textarea name="special_equipment" class="form-control"></textarea>
                            </div>
                        </div>

                        <hr>
                        <div class="row form-group">
                            <div class="col-md-2">Serial Equipment</div>
                            <div class="col-md-10">
                                <textarea name="serial_equipment" class="form-control"></textarea>
                            </div>
                        </div>

                        <hr>
                        <div class="row form-group">
                            <div class="col-md-2">Vehicle Description</div>
                            <div class="col-md-2"><button type="button" class="btn btn-success btn-sm addVehicleDescription"><i class="fa fa-plus"></i> Add Attribute</button></div>
                            <hr>
                            <div class="col-md-12 vehicle-description">
                                <div class="row vehicle-description-item">
                                    <div class="col-md-2">
                                        <input class="form-control" placeholder="Eg :Model No" name="vehicle_description_attributes[]" type="text">
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" placeholder="12344" name="vehicle_description_values[]" type="text">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row form-group">
                            <div class="col-md-2">Condition</div>
                            <div class="col-md-2"><button type="button" class="btn btn-success btn-sm addConditions"><i class="fa fa-plus"></i> Add Attribute</button></div>
                            <hr>
                            <div class="col-md-12 conditions">
                                <div class="row conditions-item">
                                    <div class="col-md-2">
                                        <input class="form-control" placeholder="Eg :Model No" name="conditions[]" type="text">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            </div>
        </form>


@endsection


@section('title')
    | Create Auction
@endsection


@section('scripts')
    <script>
        jQuery('body').addClass('open');
        jQuery(document).ready(function () {

            //Vehicle Description Attributes Binding
           jQuery('.addVehicleDescription').click(function () {
               jQuery('.vehicle-description').append(`<div class="row vehicle-description-item">
                                    <div class="col-md-2">
                                        <input class="form-control" placeholder="Eg :Model No" name="vehicle_description_attributes[]" type="text">
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" placeholder="12344" name="vehicle_description_values[]" type="text">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger btn-sm removeVehicleDescription"><i class="fa fa-trash"></i> Remove</button>
                                    </div>
                                </div>`);
               jQuery('.removeVehicleDescription').bind('click',function () {
                   jQuery(this).parent().parent().remove();
               });

           }) ;


            jQuery('.removeVehicleDescription').click(function () {
               jQuery(this).parent().parent().remove();
            });


            //Condition Attribute Description

            jQuery('.addConditions').click(function () {
                jQuery('.conditions').append(`<div class="row conditions-item">
                                    <div class="col-md-2">
                                        <input class="form-control" placeholder="Body Finish" name="conditions[]" type="text">
                                    </div>

                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger btn-sm removeConditions"><i class="fa fa-trash"></i> Remove</button>
                                    </div>
                                </div>`);
                jQuery('.removeConditions').bind('click',function () {
                    jQuery(this).parent().parent().remove();
                });

            }) ;
        });
    </script>
@endsection
