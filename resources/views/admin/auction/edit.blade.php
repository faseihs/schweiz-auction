@extends('layouts.admin')

@section('content')
    @include('includes.errors')
    <form id="formId"   method="POST" action="/admin/auction/{{$auction->id}}" enctype="multipart/form-data">
        @csrf
        <input name="_method" value="PATCH" type="hidden">

        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h5>Auction Details</h5></div>
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col-md-1"><label  for="text-input" class=" form-control-label">Title</label></div>
                            <div class="col-md-3"><input value="{{$auction->title}}" required type="text" id="text-input" name="title" placeholder="Title" class="form-control"></div>
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Vehicle</label></div>
                            <div class="col-md-3">
                                {!! Form::select('vehicle',['car'=>'Car','bike'=>'Bike'],$auction->vehicle,['class'=>'form-control','placeholder'=>'Select','required']) !!}
                            </div>



                        </div>
                        <div class="row form-group">
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Start Date</label></div>
                            <div class="col-md-3"><input value="{{Carbon::parse($auction->start)->format('Y-m-d')}}" required type="date" id="text-input" name="start_date"  class="form-control"></div>
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Start Time</label></div>
                            <div class="col-md-3"><input value="{{Carbon::parse($auction->start)->format('H:i')}}" required type="time" id="text-input" name="start_time"  class="form-control"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">End Date</label></div>
                            <div class="col-md-3"><input value="{{Carbon::parse($auction->end)->format('Y-m-d')}}" required type="date" id="text-input" name="end_date"  class="form-control"></div>
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">End Time</label></div>
                            <div class="col-md-3"><input value="{{Carbon::parse($auction->end)->format('H:i')}}"  required type="time" id="text-input" name="end_time"  class="form-control"></div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header"><h5>Vehicle Details</h5></div>
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col-md-1"><label  for="text-input" class=" form-control-label">Mileage</label></div>
                            <div class="col-md-3"><input value="{{$auction->Vehicle->mileage}}" placeholder="In text" required type="text" id="text-input" name="mileage"  class="form-control"></div>
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">1st Reg</label></div>
                            <div class="col-md-3">
                                {!! Form::date('registration',Carbon::parse($auction->Vehicle->registration)->format('Y-m-d'),['class'=>'form-control','required']) !!}
                            </div>

                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Gear</label></div>
                            <div class="col-md-3">
                                {!! Form::text('gear',$auction->Vehicle->gear,['class'=>'form-control','required','placeholder'=>'In text']) !!}
                            </div>





                        </div>
                        <div class="row form-group">
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Fuel</label></div>
                            <div class="col-md-3"><input value="{{$auction->Vehicle->fuel}}" placeholder="In text" required type="text" id="text-input" name="fuel"  class="form-control"></div>
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Disp</label></div>
                            <div class="col-md-3"><input value="{{$auction->Vehicle->displacement}}" placeholder="In Numeric" required type="number" id="text-input" name="displacement"  class="form-control"></div>
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Body</label></div>
                            <div class="col-md-3"><input value="{{$auction->Vehicle->body}}" placeholder="In text" required type="text" id="text-input" name="body"  class="form-control"></div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Interior</label></div>
                            <div class="col-md-3"><input value="{{$auction->Vehicle->interior}}" placeholder="In text" required type="text" id="text-input" name="interior"  class="form-control"></div>
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Exterior Color</label></div>
                            <div class="col-md-3"><input value="{{$auction->Vehicle->exterior_color}}" placeholder="In text" required type="text" id="text-input" name="exterior_color"  class="form-control"></div>
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Seats</label></div>
                            <div class="col-md-3"><input value="{{$auction->Vehicle->seats}}" placeholder="In Numerics" required type="number" id="text-input" name="seats"  class="form-control"></div>
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Transported By</label></div>
                            <div class="col-md-3"><input value="{{$auction->Vehicle->transported_by}}" placeholder="In text" required type="text" id="text-input" name="transported_by"  class="form-control"></div>
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Wheeldrive</label></div>
                            <div class="col-md-3"><input value="{{$auction->Vehicle->wheeldrive}}" placeholder="In text" required type="text" id="text-input" name="wheeldrive"  class="form-control"></div>

                        </div>
                        <hr>
                        <div class="row form-group">
                            <div class="col-md-2">Special Equipment</div>
                            <div class="col-md-10">
                                <textarea  name="special_equipment" class="form-control">{{$auction->Vehicle->special_equipment}}</textarea>
                            </div>
                        </div>

                        <hr>
                        <div class="row form-group">
                            <div class="col-md-2">Serial Equipment</div>
                            <div class="col-md-10">
                                <textarea name="serial_equipment" class="form-control">{{$auction->Vehicle->serial_equipment}}</textarea>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-2">Financial Services</div>
                            <div class="col-md-10">
                                <textarea name="financial_services" class="form-control">{{$auction->Vehicle->financial_services}}</textarea>
                            </div>
                        </div>

                        <hr>

                        <hr>
                        <div class="row form-group">
                            <div class="col-md-2">Vehicle Description</div>
                            <div class="col-md-2"><button type="button" class="btn btn-success btn-sm addVehicleDescription"><i class="fa fa-plus"></i> Add Attribute</button></div>
                            <hr>
                            <div class="col-md-12 vehicle-description">
                                @php
                                $obj=$auction->Vehicle->getDescriptions();
                                $keys=$obj->keys;
                                $values=$obj->values;

                                @endphp
                                @foreach($keys as $key=>$k)
                                <div class="row vehicle-description-item">
                                    <div class="col-md-2">
                                        <input value="{{$k}}" class="form-control" required placeholder="Eg :Model No" name="vehicle_description_attributes[]" type="text">
                                    </div>
                                    <div class="col-md-4">
                                        <input value="{{$values[$key]}}" class="form-control" required placeholder="12344" name="vehicle_description_values[]" type="text">
                                    </div>
                                    @if($key!=0)
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-danger btn-sm removeVehicleDescription"><i class="fa fa-trash"></i> Remove</button>
                                        </div>
                                    @endif

                                </div>
                                @endforeach
                            </div>
                        </div>

                        <hr>
                        <div class="row form-group">
                            <div class="col-md-2">Condition</div>
                            <div class="col-md-2"><button type="button" class="btn btn-success btn-sm addConditions"><i class="fa fa-plus"></i> Add Attribute</button></div>
                            <hr>

                            <div class="col-md-12 conditions">
                                @foreach(explode('-',$auction->Vehicle->condition) as $key=>$item)
                                <div class="row conditions-item">
                                    <div class="col-md-2">
                                        <input value="{{$item}}" class="form-control" required placeholder="Eg : Perfect" name="conditions[]" type="text">
                                    </div>
                                    @if($key!=0)
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-danger btn-sm removeImages"><i class="fa fa-trash"></i> Remove</button>
                                        </div>
                                    @endif

                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-2">Images</div>
                            <div class="col-md-2"><button type="button" class="btn btn-success btn-sm addImages"><i class="fa fa-plus"></i> Add Image</button></div>
                            <hr>

                            <div class="col-md-12 images">
                                <div class="row images-item">
                                    <div class="col-md-4">
                                        <input class="form-control"  name="images[]" type="file" accept="image/*">
                                    </div>


                                </div>
                            </div>

                        </div>

                        @foreach($auction->files as $key=>$file)
                        <div id="img-row-{{$file->id}}" class="row">

                            <div class="col-md-4">
                                <img src="{{$file->getImage()}}" alt="">
                            </div>

                            <div class="col-md-2">
                                <button onclick="addDel({{$file->id}})" class="btn btn-dark btn-sm" type="button"><i class="fa fa-cut"></i></button>
                            </div>

                        </div>
                        @endforeach

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
            //Event Binding
            jQuery('.removeConditions').bind('click',function () {
                jQuery(this).parent().parent().remove();
            });
            jQuery('.removeVehicleDescription').bind('click',function () {
                jQuery(this).parent().parent().remove();
            });



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

        function addDel(id){
            jQuery('#formId').append(
                `<input name="deletes[]"  value="`+id+`" type="hidden" />`
            )
            var t='#img-row-'+id;
            jQuery(t).remove();
            console.log("Clicked");
        }
    </script>
@endsection