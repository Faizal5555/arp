@extends('layouts.master')

<!-- SweetAlert2 JavaScript -->

<style>
    .main-panel {
    background-color: #f8f8f8;
   }
.card {
   margin: 40px 0 20px 0;
    border:none;
 }

.card-header.header-elements-inline {
    background-color: #fff;
}
     button#addRegisterButton {
    background-color: #6329a1;
    border-color: #6329a1;
}
label.col-lg-3.col-form-label.font-weight-semibold {
    font-family: "ubuntu-medium", sans-serif;
    font-weight: 500;
}
a.btn.btn-outline-secondary:hover {
    color: #fff;
}
button#addRegisterButton {
    background-color: #0b5dbb;
    border-color: #0b5dbb;
}
button#addRegisterButton:hover {
    background-color: #0b5dbb;
    border-color: #0b5dbb;

}
.card-header.header-elements-inline {
  background: linear-gradient(43deg,#0b5dbb,#0b5dbb);
    color: #fff;
}
.sub-text {
    color: #fff;
}
.error{
    color:red;
     margin-top:8px;
}
.form-control.error,.form-control.label-gray-3.error{
    border:1px solid red !important;
}

/*.form-group{
  padding:10px;
  border:2px solid;
  margin:10px;
}
.form-group>label{
  position:absolute;
  top:-1px;
  left:20px;
  background-color:#aaa;
}

.form-group>input{
  border:none;
}*/
select.form-control {
    
    color: #2a2a2a;
}
select.form-control.label-gray-3 {
    color: #6e6868;
}



</style>
@section('page_title', 'Client Form')
@section('content')


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {

        $("#register").validate({
            rules: {
                client_name: {
                    required: true
                },
                client_country: {
                    required: true
                },
                client_email: {
                    required: true,
                     email:true
                },
                client_manager: {
                    required: true
                },
                client_phoneno: {
                    required: true,
                    number: true,
		            minlength: 9,
		            maxlength: 15
                },
                client_whatsapp: {
                    required: true,
                    number: true,
		            minlength: 9,
		            maxlength: 15
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
                    url: "{{route('client.store')}}",
                    data: data,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.success === 1) {
                            swal.fire({
                                title: 'Success',
                                text: 'Client Added Successfully',
                                icon: 'success',
                                buttons: false
                            });
                            $('#register').get(0).reset();
                            window.location = "{{ route('client.index') }}";
                        } else if (data.success === 0) {
                            swal.fire({
                                title: 'Error',
                                text: data.message, // Display the specific error message
                                icon: 'error'
                            });

                            // If detailed errors exist
                            if (data.error) {
                                $.each(data.error, function (index, error) {
                                    $("[name='" + index + "']").addClass("error").after("<label class='error'>" + error + "</label>");
                                });
                            }
                        }
                    }
                });
            }
        });
    });
</script>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-light">

                <div class="card-header header-elements-inline">
                <div class="card-title">
                    <div class="sub-text">Client Form
                     </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form id="register" class="flex-wrap form col-md-12 d-flex">
                            @csrf
                        
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">
                                        Client  
                                        Name<span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input
                                            id="client_name"
                                            name="client_name"
                                            value="{{ $client && $client->client_name ? $client->client_name : '' }}"
                                            type="text"
                                            class="form-control"
                                            style="font-family: FontAwesome;"
                                            placeholder="&#xf007 Client Name"
                                        />
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="client_country" class="col-lg-3 col-form-label font-weight-semibold">
                                        Client Country <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <select id="client_country" class="form-control label-gray-3" name="client_country">
                                            <option class="label-gray-3" value="">Select Country</option>
                                            @if (count($country) > 0)
                                                @foreach ($country as $v)
                                                    <option value="{{ $v->name }}" {{ $client && $client->client_country == $v->name ? 'selected' : '' }}>
                                                        {{ $v->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="client_manager" class="col-lg-3 col-form-label font-weight-semibold">
                                        Client Manager <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input
                                            id="client_manager"
                                            name="client_manager"
                                            value="{{ $client && $client->client_manager ? $client->client_manager : '' }}"
                                            type="text"
                                            class="form-control"
                                            style="font-family: FontAwesome;"
                                            placeholder="&#xf234 Client Manager"
                                        />
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">
                                        Client Email <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input
                                            id="client_email"
                                            name="client_email"
                                            value="{{ $client && $client->client_email ? $client->client_email : '' }}"
                                            type="email"
                                            class="form-control"
                                            style="font-family: FontAwesome;"
                                            placeholder="&#xf199 Client Email"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">
                                        Client Phone No <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input
                                            id="client_phoneno"
                                            name="client_phoneno"
                                            value="{{ $client && $client->client_phoneno ? $client->client_phoneno : '' }}"
                                            type="number"
                                            minlength="9"
                                            maxlength="15"
                                            class="form-control"
                                            style="font-family: FontAwesome;"
                                            placeholder="&#xf10b Client Phone No"
                                        />
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">
                                        Client WhatsApp <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input
                                            id="client_whatsapp"
                                            name="client_whatsapp"
                                            value="{{ $client && $client->client_whatsapp ? $client->client_whatsapp : '' }}"
                                            type="number"
                                            minlength="9"
                                            maxlength="15"
                                            class="form-control"
                                            style="font-family: FontAwesome;"
                                            placeholder="&#xf232 Client WhatsApp No"
                                        />
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-md-12 d-flex align-items-center justify-content-center">
                                <a href="{{ route('client.index') }}" class="btn btn-outline-secondary">Back</a>
                                <button value="submit" id="addRegisterButton" class="ml-2 btn btn-success">Submit</button>
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

@endsection
