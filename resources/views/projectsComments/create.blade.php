@extends('layouts.master')
@section('page_title', 'Comment Form')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-header header-elements-inline">
                <div class="card-title">Comment Form</div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <form id="{{ $comment && $comment->id ? 'update' : 'register'}}" class="form col-md-12 d-flex flex-wrap"
                           enctype="multipart/form-data">
                           @csrf
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Comment<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                            <textarea name="comments" ></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">RFQ No<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                            <select class="form-control label-gray-3" name="rfq_no">
                                                <option class="label-gray-3" value="">RFQ No</option>
                                                    @if(count($bidrfq) > 0)
                                                    @foreach($bidrfq as $v)
                                                <option value="{{$v->id}}">{{$v->rfq_no}}</option>
                                                    @endforeach
                                                    @endif
                                            </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12 d-flex align-items-center justify-content-center">
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
                comments: {
                    required: true
                },
                rfq_no: {
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
                // loadButton('#addRegisterButton');
               
                $.ajax({
                    type: "POST",
                    url: "{{route('projectComments.store')}}",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (data) {
                        $('#register').get(0).reset()
                        if (data.success == 1) {
                            // loadButton('#addRegisterButton');
                            flash({ msg: data.message, type: 'success' });
                            window.location = "{{route('projectsComments.index')}}";
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