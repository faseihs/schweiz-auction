@extends('layouts.admin')

@section('content')
    @include('includes.errors')
        <form id="formId"   method="POST" action="/admin/auction" enctype="multipart/form-data">
            @csrf

            <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h5>Auction Details</h5></div>
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col-md-1"><label  for="text-input" class=" form-control-label">Title</label></div>
                            <div class="col-md-3"><input required type="text" id="text-input" name="title" placeholder="Title" class="form-control"></div>
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Vehicle</label></div>
                            <div class="col-md-3">
                                {!! Form::select('vehicle',['car'=>'Car','bike'=>'Bike','bus'=>'Bus','others'=>'Others'],null,['class'=>'form-control','placeholder'=>'Select','required']) !!}
                            </div>



                        </div>
                        <div class="row form-group">
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Start Date</label></div>
                            <div class="col-md-3"><input required type="date" id="text-input" name="start_date"  class="form-control"></div>
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Start Time</label></div>
                            <div class="col-md-3"><input value="00:00" required type="time" id="text-input" name="start_time"  class="form-control"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">End Date</label></div>
                            <div class="col-md-3"><input required type="date" id="text-input" name="end_date"  class="form-control"></div>
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">End Time</label></div>
                            <div class="col-md-3"><input value="00:00" required type="time" id="text-input" name="end_time"  class="form-control"></div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header"><h5>Vehicle Details</h5></div>
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col-md-1"><label  for="text-input" class=" form-control-label">Mileage</label></div>
                            <div class="col-md-3"><input placeholder="In text" required type="text" id="text-input" name="mileage"  class="form-control"></div>
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">1st Reg</label></div>
                            <div class="col-md-3">
                                {!! Form::month('registration',null,['class'=>'form-control','required']) !!}
                            </div>
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Disp</label></div>
                            <div class="col-md-3"><input placeholder="In Numeric" required type="number" id="text-input" name="displacement"  class="form-control"></div>


                            {{--<div class="col-md-1"><label for="text-input" class=" form-control-label">Gear</label></div>
                            <div class="col-md-3">
                                {!! Form::text('gear',null,['class'=>'form-control','required','placeholder'=>'In text']) !!}
                            </div>--}}





                        </div>

                        <div class="row form-group">
                            <label class="col-md-1 control-label">Defects</label>
                            <div class="col-md-7">
                                <div class="checkbox-list">
                                    <label><input type="checkbox" name="defects[]" id="defects_10" value="engine" > Engine</label>
                                    <label><input type="checkbox" name="defects[]" id="defects_12" value="transmission" > Transmission</label>
                                    <label><input type="checkbox" name="defects[]" id="defects_20" value="f-axle" > Front Axle</label>
                                    <label><input type="checkbox" name="defects[]" id="defects_22" value="r-axle" > Rear Axle</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        <div class="col-md-12">
                            <h5>Description Of Damage</h5>
                        </div>
                        <div class="col-md-12">

                            <div class="table-responsive">
                                <table class="table table-noborder table-nobackground">
                                    <tbody>
                                    <tr>
                                        <td style="width:30px;"><input type="checkbox" name="damagezone[]" id="damagezone_12" value="1" title="Avant à droite" ></td>
                                        <td class="text-center" style="width:170px;"><input type="checkbox" name="damagezone[]" id="damagezone_22" value="2" title="à droite" ></td>
                                        <td style="width:30px;"><input type="checkbox" name="damagezone[]" id="damagezone_32" value="3" title="Arrière à droite" ></td>
                                        <td class="text-center" style="min-width:180px;"><input type="checkbox" name="damagezone[]" id="damagezone_50" value="9" title="haut" ></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="damagezone[]" id="damagezone_11" value="4" title="Avant" ></td>
                                        <td class="text-center"><img src="https://www.restwertboerse.ch/assets/images/graphics/car-top.png" width="140" alt=""></td>
                                        <td><input type="checkbox" name="damagezone[]" id="damagezone_31" value="5" title="Arrière" ></td>
                                        <td class="text-center"><img src="https://www.restwertboerse.ch/assets/images/graphics/car-side.png" width="140" alt=""></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="damagezone[]" id="damagezone_10" value="7" title="Avant à gauche" ></td>
                                        <td class="text-center"><input type="checkbox" name="damagezone[]" id="damagezone_20" value="7" title="à gauche" ></td>
                                        <td><input type="checkbox" name="damagezone[]" id="damagezone_30" value="8" title="Arrière à gauche" ></td>
                                        <td class="text-center"><input type="checkbox" name="damagezone[]" id="damagezone_40" value="10" title="dessous" ></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                        <div class="row form-group">
                            <div class="col-md-2">Notes</div>
                            <div class="col-md-10">
                                <textarea  name="notes" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row form-group">
                           {{-- <div class="col-md-1"><label for="text-input" class=" form-control-label">Fuel</label></div>
                            <div class="col-md-3"><input placeholder="In text" required type="text" id="text-input" name="fuel"  class="form-control"></div>
                            --}}{{--<div class="col-md-1"><label for="text-input" class=" form-control-label">Body</label></div>
                            <div class="col-md-3"><input placeholder="In text" required type="text" id="text-input" name="body"  class="form-control"></div>
                        --}}</div>

                       {{-- <div class="row form-group">
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Interior</label></div>
                            <div class="col-md-3"><input placeholder="In text" required type="text" id="text-input" name="interior"  class="form-control"></div>
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Exterior Color</label></div>
                            <div class="col-md-3"><input placeholder="In text" required type="text" id="text-input" name="exterior_color"  class="form-control"></div>
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Seats</label></div>
                            <div class="col-md-3"><input placeholder="In Numerics" required type="number" id="text-input" name="seats"  class="form-control"></div>
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Transported By</label></div>
                            <div class="col-md-3"><input placeholder="In text" required type="text" id="text-input" name="transported_by"  class="form-control"></div>
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Wheeldrive</label></div>
                            <div class="col-md-3"><input placeholder="In text" required type="text" id="text-input" name="wheeldrive"  class="form-control"></div>

                        </div>
                        <hr>--}}
                        {{--<div class="row form-group">
                            <div class="col-md-2">Special Equipment</div>
                            <div class="col-md-10">
                                <textarea  name="special_equipment" class="form-control"></textarea>
                            </div>
                        </div>

                        <hr>--}}
                        {{--<div class="row form-group">
                            <div class="col-md-2">Serial Equipment</div>
                            <div class="col-md-10">
                                <textarea name="serial_equipment" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-2">Financial Services</div>
                            <div class="col-md-10">
                                <textarea name="financial_services" class="form-control"></textarea>
                            </div>
                        </div>--}}

                        <hr>

                        <hr>
                        <div class="row form-group">
                            <div class="col-md-2">Vehicle Description</div>
                            <div class="col-md-2"><button type="button" class="btn btn-success btn-sm addVehicleDescription"><i class="fa fa-plus"></i> Add Attribute</button></div>
                            <hr>
                            <div class="col-md-12 vehicle-description">
                                <div class="row vehicle-description-item">
                                    <div class="col-md-2">
                                        <input class="form-control" required placeholder="Eg :Model No" name="vehicle_description_attributes[]" type="text">
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" required placeholder="12344" name="vehicle_description_values[]" type="text">
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
                                        <input class="form-control" required placeholder="Eg : Perfect" name="conditions[]" type="text">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-2">Images</div>
                            <div class="col-md-2"><button type="button" class="btn btn-success btn-sm addImages"><i class="fa fa-plus"></i> Add Image</button></div>
                            <hr>
                            <div class="col-md-12 images">
                                <div class="row images-item">
                                    <div class="col-md-4">
                                        <input class="form-control" required  name="images[]" type="file" accept="image/*">
                                    </div>

                                </div>
                            </div>
                        </div>


                        {{--End of Dropzone Preview Template--}}

                        <hr>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <button class="btn btn-dark" type="submit"><i class="fa fa-check"></i> Save</button>
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
    <script src="{{asset('js/jquery.form.min.js')}}"></script>
    <script src="{{asset('js/notify.min.js')}}"></script>
    <script src="{{asset('js/dropzone.js')}}"></script>
    <script>
        jQuery('body').addClass('open');
        jQuery(document).ready(function () {



            var loading
            jQuery('#formId').ajaxForm({
                beforeSubmit:function() {
                    loading = jQuery.notify('Loading....', {className: 'info', autoHide: false});
                },
                success:function (responseText) {
                    jQuery('.notifyjs-wrapper').trigger('notify-hide');
                    jQuery.notify('Saved', 'success');
                    console.log(responseText);
                    window.location='/admin/auction/'+responseText;
                },
                error:function (responseText) {
                    jQuery('.notifyjs-wrapper').trigger('notify-hide');

                    if(responseText.status===401){
                        for(var index in responseText.responseJSON.error){
                            jQuery.notify(responseText.responseJSON.error[index][0], 'error');
                        }
                    }
                    else {
                        jQuery.notify('Error', 'error');
                    }

                }

            });


            //Vehicle Description Attributes Binding
           jQuery('.addVehicleDescription').click(function () {
               jQuery('.vehicle-description').append(`<div class="row vehicle-description-item">
                                    <div class="col-md-2">
                                        <input class="form-control" required placeholder="Eg :Model No" name="vehicle_description_attributes[]" type="text">
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" required placeholder="12344" name="vehicle_description_values[]" type="text">
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
                                        <input class="form-control" required placeholder="Body Finish" name="conditions[]" type="text">
                                    </div>

                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger btn-sm removeConditions"><i class="fa fa-trash"></i> Remove</button>
                                    </div>
                                </div>`);
                jQuery('.removeConditions').bind('click',function () {
                    jQuery(this).parent().parent().remove();
                });

            }) ;


            //Images Add and Remove

            jQuery('.addImages').click(function () {
                jQuery('.images').append(` <div class="row images-item">
                                    <div class="col-md-4">
                                        <input class="form-control" required name="images[]" type="file" accept="image/*">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger btn-sm removeImages"><i class="fa fa-trash"></i> Remove</button>
                                    </div>
                                </div>`);
                jQuery('.removeImages').bind('click',function () {
                    jQuery(this).parent().parent().remove();
                });

            }) ;
        });
    </script>
@endsection
