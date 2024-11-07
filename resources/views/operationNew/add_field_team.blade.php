@extends('layouts.master')
<style>
.card {
   margin: 40px 0 20px 0;
    border:1px solid;
 }

.card-header.header-elements-inline {
    background-color: #fff;
}
label.col-form-label.font-weight-semibold {
    font-family: "ubuntu-medium", sans-serif;
    font-weight: 500;
}
button#addFieldTeam {
    background-color: #0b5dbb;
    border-color: #0b5dbb;
}
button#addFieldTeam:hover {
    background-color: #0b5dbb;
    border-color: #0b5dbb;

}
.card-header.header-elements-inline {
 background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
    color: #fff;
}
.sub-text {
    color: #fff;
}
.error{
    color:red;
    padding:10px;
}
</style>
@section('page_title', 'add_field_team')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
    
                    <div class="card-header header-elements-inline">
                      <div class="card-title">
                          <div class="sub-text">
                            Add Field Team
                         </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form  class="form col-md-12 d-flex flex-wrap" enctype="multipart/form-data" id="add_field">
                            @csrf
                            <div  id="main_div" class="col-md-9 ">
                               <div class="form-group row">
                                    <label class="col-lg-4 col-form-label font-weight-semibold">Assign Team Leader <span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input name="team_leader" id="team_leader" value="" type="text" class="form-control" placeholder="Enter Assign Team Leader">
                                    </div>
                                    <br>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label font-weight-semibold">Project Manager Name <span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input name="project_manager_name" id="project_manager_name" value="" type="text" class="form-control" placeholder="Enter Project Manager Name">
                                    </div>
                                    <br>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label font-weight-semibold">Quality Analyst Name <span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input name="quality_analyst_name" id="quality_analyst_name" value="" type="text" class="form-control" placeholder="Enter Quality Analyst Name">
                                    </div>
                                </div>
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary" id="addFieldTeam" >Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



<script>
    $(document).ready(function () {
        $("#add_field").validate({
            rules: {
                team_leader: {
                    required: true
                },
                project_manager_name: {
                    required: true
                },
                quality_analyst_name: {
                    required: true
                },
              
            },
            errorPlacement: function (error, element) {
                if (element.hasClass("select2-hidden-accessible")) {
                    error.insertAfter(element.siblings('span.select2'));
                } 
                else if (element.hasClass("floating-input")) {
                    element.closest('.form-floating-label').addClass("error-cont").append(error);
                } 
                else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                var data = $( "#add_field" ).serialize();
                 $.ajax({
                    type: "POST",
                    url: "{{route('operationNew.addFieldTeam')}}",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function () {
                      swal({
                            title:'Form Created Successfully',
                            text:'Client Created Successfully',
                            icon:'success',
                            buttons:false
                        })  
                        $('#add_field')[0].reset();
                    },
                    error:function(){
                        swal({
                             title: "Please Fill All Fields",
                             type: "warning",
                             dangerMode: true,
                         
                        })
                    }
                });
                                    
            }
        });
    });
</script>
    
    
    
    @endsection