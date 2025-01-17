@extends('layouts.master')
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
.error {
        color: red;
        font-size: 11px;
        padding: 10px;
        
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




</style>
@section('page_title')
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('validationErrors'))
    <div class="alert alert-danger">
        <ul>
            @foreach (session('validationErrors') as $validationError)
                <li>{{ $validationError }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


<script>
    $(document).ready(function(){
        $("#register").validate({
            rules:{
                supplier_company:{
                    required:true
                },
                supplier_manager:{
                    required:true
                },
                supplier_email:{
                    required:true,
                    email:true
                },
                supplier_phone:{
                    required:true,
                    number:true,
                    minlength:9,
                    maxlength:15
                },
                supplier_whatsapp:{
                    required:true,
                    number:true,
                    minlength:9,
                    maxlength:15
                },
                supplier_country:{
                required:true
                },
                other_detail:{
                    required:true
                }
                
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
                url:"{{route('Supplier.store')}}",
                data:data,
                // headers: {
                // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                // },
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (data) {
                    if(data.success == 1 ){
                    swal({
                    title:'success',
                    text:'Supplier Added Successfully',
                    icon:'success',
                    buttons:false
                })

                $('#register').get(0).reset();
                window.location = "{{route('Supplier.index')}}";

                    }
                    if (data.success == 0) {
                            $.each(data.error, function(index, error){  
                                        $(form).find( "[name='"+index+"']" ).addClass("error").after( "<label class='error'>"+error+"</label>" ); 
                                }); 
                       }
                    else{
                  console.log('data');

                    }
                },   
            });
         }
        });
             
         })

         $('#exampleModal').on('hidden.bs.modal', function () {
    $(this).find('form')[0].reset();
    $('.alert').remove(); // Remove any alert messages
});

$('#importForm').on('submit', function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: "{{ route('supplier.import') }}",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            Swal.fire({
                title: 'Success',
                text: response.message,
                icon: 'success',
                timer: 3000,
                showConfirmButton: false,
            });
            setTimeout(() => location.reload(), 3000);
        },
        error: function (xhr) {
            if (xhr.status === 422) {
                // Clear previous errors
                $('.validation-errors').remove();

                const errors = xhr.responseJSON.errors;
                let errorMessage = '<div class="validation-errors alert alert-danger"><ul>';

                for (const error of errors.validationErrors) {
                    errorMessage += `<li>${error}</li>`;
                }

                errorMessage += '</ul></div>';

                $('#importForm').before(errorMessage); // Add errors above the form
            } else {
                Swal.fire({
                    title: 'Error',
                    text: xhr.responseJSON.error || 'Something went wrong!',
                    icon: 'error',
                    confirmButtonText: 'OK',
                });
            }
        },
    });
});

document.querySelector('form').addEventListener('submit', function (e) {
    const fileInput = document.querySelector('input[name="file"]');
    const file = fileInput.files[0];

    // Validate file type
    const validTypes = ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'text/csv'];
    if (!validTypes.includes(file.type)) {
        e.preventDefault();
        alert('Invalid file type. Please upload a CSV, XLSX, or XLS file.');
        return;
    }

    // Validate file size (optional)
    const maxSize = 2 * 1024 * 1024; // 2MB
    if (file.size > maxSize) {
        e.preventDefault();
        alert('File size exceeds the 2MB limit.');
        return;
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('#importForm');
    const submitButton = document.querySelector('#importSubmit');

    if (form && submitButton) {
        form.addEventListener('submit', function () {
            // Disable the button and add spinner
            submitButton.disabled = true;
            submitButton.innerHTML = `
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Importing...`;
        });
    }
});

</script>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-light">

                <div class="card-header header-elements-inline">
                <div class="card-title">
                    <div class="sub-text">Add Suppliers
                     </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form  class="form col-md-12 d-flex flex-wrap"
                           enctype="multipart/form-data" id="register" >
                           @csrf




                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold ">Supplier Company Name <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-9">

                                        <input name="supplier_company" 
                                             type="text" class="form-control" style="font-family: FontAwesome;" placeholder='&#xf007  Supplier Company Name' />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold ">Supplier Manager Name <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-9">

                                        <input name="supplier_manager" 
                                            type="text" class="form-control" style="font-family: FontAwesome;" placeholder='&#xf234  Supplier Manager Name   '>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold ">Supplier Email <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-9">
                                        <input name="supplier_email" type="text" class="form-control" style="font-family: FontAwesome;" placeholder='&#xf199 Supplier Email' required pattern="[^@]+@[^@]+\.[com]{3,6}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold ">Supplier<br> Phone No<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-9">
                                        <input name="supplier_phone" 
                                            type="number" class="form-control" style="font-family: FontAwesome;" placeholder='&#xf10b Supplier Phone No   '>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Supplier Whatsapp<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-9">
                                        <input name="supplier_whatsapp" 
                                            type="number" class="form-control"  style="font-family: FontAwesome;" placeholder='&#xf232 Supplier Whatsapp   '>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold  ">  Country<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-9">
                                        <select class="form-control label-gray-3" name="supplier_country">
                                            <option class="label-gray-3" value="">Select Country<i class="fas fa-globe-asia"></i></option>
                                                @if(isset ($country) && count($country) > 0)
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
                                    <label class="col-lg-3 col-form-label font-weight-semibold  ">Other Details<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-9">
                                       <input type="text" name="other_detail" class="form-control" placeholder="Enter Other Detail">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group row" >
                                    <label class="col-lg-3 col-form-label">Import Files</label>
                                    <div class="col-lg-9">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                            Import Data
                                          </button>
                                          
        
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


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Import</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            
            

           
            <form id="importForm" action="{{ route('supplier.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control" required>
                <small class="form-text text-muted">
                    Accepted formats: CSV,XLSX.
                    <a href="{{ route('downloadSupplierSample') }}">Download Sample File</a>
                </small>
                <button class="btn btn-success mt-2" id="importSubmit">Import Supplier Data</button>
            </form>
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
