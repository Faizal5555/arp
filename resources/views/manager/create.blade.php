@extends('layouts.master')
@section('page_title', 'Manager Form')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-header header-elements-inline">
                <div class="card-title">Manager Form</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form id="{{ $manager && $manager->id ? 'update' : 'register'}}" class="form col-md-12 d-flex flex-wrap"
                           enctype="multipart/form-data">
                           @csrf
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Manager Name <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="name" value="{{$manager && $manager->name ? $manager->name : ''}}"
                                             type="text" class="form-control" placeholder="Manager Name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Manager Address <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="address" value="{{$manager && $manager->address ? $manager->address : ''}}"
                                             type="text" class="form-control" placeholder="Manager Address">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Manager Photo <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input  name="photo" value="{{$manager && $manager->photo ? $manager->photo : ''}}"
                                             type="file" class="form-control" placeholder="Manager Photo">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Other Document <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input  name="other_document" value="{{$manager && $manager->other_document ? $manager->other_document : ''}}"
                                             type="file" class="form-control" placeholder="Other Document">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Experiance <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="experiance" value="{{$manager && $manager->experiance ? $manager->experiance : ''}}"
                                             type="text" class="form-control" placeholder="Experiance">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Others <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="others" value="{{$manager && $manager->others ? $manager->others : ''}}"
                                             type="text" class="form-control" placeholder="Others">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Qualification <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="qualification" value="{{$manager && $manager->qualification ? $manager->qualification : ''}}"
                                             type="text" class="form-control" placeholder="Qualification">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Manager Country<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select class="form-control label-gray-3" name="country">
                                            <option class="label-gray-3" value="">Select Country</option>
                                                @if(count($country) > 0)
                                                @foreach($country as $v)
                                            <option value="{{$v->name}}">{{$v->name}}</option>
                                                @endforeach
                                                @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Manager Email<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="email"
                                            value="{{$manager && $manager->email ? $manager->email : ''}}"
                                            type="text" class="form-control" placeholder="Manager Email">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Manager Phoneno<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="phone_no" value="{{$manager && $manager->phone_no ? $manager->phone_no : ''}}" 
                                            type="text" class="form-control" placeholder="Manager Phoneno">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Manager WhatsApp<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="whatsapp_no" value="{{$manager && $manager->whatsapp_no ? $manager->whatsapp_no : ''}}"
                                            type="text" class="form-control" placeholder="Manager Whatsapp">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex align-items-center justify-content-center">
                                <a href="{{route('manager.index')}}" class=" btn btn-primary">Back</a>
                                <button type="submit" id="addRegisterButton"
                                    class="btn btn-success ml-2">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    .error {
        color: red;
        font-size: 11px;
        font-weight: bold;
    }
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $("#register").validate({
            rules: {
                name: {
                    required: true
                },
                country: {
                    required: true
                },
                email: {
                    required: true
                },
                address: {
                    required: true
                },
                phone_no: {
                    required: true
                },
                whatsapp_no: {
                    required: true
                },
                photo: {
                    required: true
                },
                other_document: {
                    required: true
                },
                experiance: {
                    required: true
                },
                others: {
                    required: true
                },
                qualification: {
                    required: true
                },
            },
            errorPlacement: function (error, element) {
                if (element.hasClass("select2-hidden-accessible")) {
                    error.insertAfter(element.siblings('span.select2'));
                } else if (element.hasClass("floating-input")) {
                    element.closest('.form-floating-label').addClass("error-cont").append(error);
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                 // console.log('xxx');
                // debugg();
                var data = new FormData(form);
                // alert(data);
                // die();
                // loadButton('#addRegisterButton');
                $.ajax({
                    type: "POST",
                    url: "{{route('manager.store')}}",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (data) {
                        // console.log('sss');
                        $('#register').get(0).reset()
                        if (data.success == 1) {
                            // loadButton('#addRegisterButton');
                            flash({ msg: data.message, type: 'success' });
                        }
                        else {
                            flash({ msg: data.message, type: 'info' });
                        }
                        
                    }

                });
                
            }
        });

        $("#update").validate({
            rules: {
                name: {
                    required: true
                },
                country: {
                    required: true
                },
                email: {
                    required: true
                },
                address: {
                    required: true
                },
                phone_no: {
                    required: true
                },
                whatsapp_no: {
                    required: true
                },
                photo: {
                    required: true
                },
                other_document: {
                    required: true
                },
                experiance: {
                    required: true
                },
                others: {
                    required: true
                },
                qualification: {
                    required: true
                },
                country: {
                    required: true
                },
            },
            errorPlacement: function (error, element) {
                if (element.hasClass("select2-hidden-accessible")) {
                    error.insertAfter(element.siblings('span.select2'));
                } else if (element.hasClass("floating-input")) {
                    element.closest('.form-floating-label').addClass("error-cont").append(error);
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                var data = new FormData(form);
                $.ajax({
                    type: "POST",
                    url: "{{route('manager.update')}}",
                    data: data,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (data) {
                        $('#update').get(0).reset()
                        if (data.success == 1) {
                            flash({ msg: data.message, type: 'success' });
                            window.location = "{{route('manager.index')}}";
                        }
                        else {
                            flash({ msg: data.message, type: 'info' });
                        }
                    }

                });
            }
        });
    })
</script>
@endsection