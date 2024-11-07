@extends('layouts.master')
@section('page_title', 'Client List')
@section('content')

<style>
    .header {
        background: linear-gradient(43deg, #0b5dbb, #0b5dbb);

    }

    .error {
        color: red;
        margin-top: 3px;
    }

</style>
<div class="col-md-12">
    <div class="card " id="header-title">

        <div class="card-header header-elements-inline header">
            <div class="card-title " style="color:whitesmoke;">Gen Pop Invite</div>

        </div>

        <div class="card-body" id="cardbody">
            <div class="row mb-2" id="wondiv">
                <div class="col-lg-6 col-md-12 ">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label  mt-1">Email<span class="text-danger">*</span></label>
                        <div class="col-lg-9 form-group">
                           
                            <input type="email" class="form-control" name="email" id="email" pattern="[a-z0-9._]+@[a-z]+\.[com]{3,6}">
                        </div>
                    </div>
                    <button class="btn btn-success ml-5" id='submit'> Submit</button>
                </div>
            </div>

        
                        
</div>
</div>
<script>
    $(document).on('click','#submit',function(){
        var html =$("#email").val();
        
        if(html!=''){
        $.ajax({
            url: "{{ route('popinvite1') }}",
            type: "post",
            data: {
                email: html
            },
            success: function (data) {
                if(data.success ==1){
                     swal({
                        title: 'Sent Successfully',
                        icon: 'success',
                        button: false
                    })
                }
               
            }
        })
        }
        else{
            swal({
                    title: 'Please Fill Email',
                    icon: 'success',
                    button: false
                })
        }
        
    })
</script>


@endsection
