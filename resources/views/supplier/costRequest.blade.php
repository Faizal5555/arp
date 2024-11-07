@extends('layouts.master')
@section('page_title')
@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.14/js/bootstrap-multiselect.min.js" ></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.14/css/bootstrap-multiselect.css" />
<style>
 .header{
     background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
     
 }
span div.btn-group{
    border: 1px solid gray;
    border-radius: 5px;
 }
 .multiselect.dropdown-toggle {
    justify-content: space-between;
    display: flex;
    width: 390px;
    align-items: center;
 }
 .multiselect-container.dropdown-menu{
    width: 390px;
    padding-top: 10px;
    height: 300px;
    overflow: auto;
 }
 div.dataTables_wrapper div.dataTables_length select {
    width: 58px !important;
    display: inline-block;
}
</style>
<div class="col-md-12 show_hide">
    <div class="card " id="header-title"> 
        <div class="card-header header-elements-inline header">
            <div class="card-title " style="color:whitesmoke;">Cost Request</div>
        </div>
        <div class="card-body"  id="cardbody">
            <div class="row mb-2 " id="wondiv">
                <div class="col-lg-6 col-md-12 " >
                    <div class="form-group row" >
                        <label class="col-lg-3 col-form-label  mt-1">Country<span class="text-danger">*</span></label>
                        <div class="col-lg-9 form-group">
                            <select class="form-control border border-secondary label-gray-3" name="country[]" id="country" multiple="multiple"> 
                                @if(isset ($country) && count($country) > 0)
                                @foreach($country as $v)
                            <option value="{{$v->name}}">{{$v->name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-success float-right" id='Next'>Next</button>
                </div>
            </div>
            <div class="col-lg-12 mb-2" style="overflow-x: auto;">
              <div class="d-flex  d-none" id="supplier-table">
                  
              </div>
            </div>
            <div class="col-md-12">
                    <button class="btn btn-info col-md-12 form-submit d-none"> Send Email</button>
                </div>
        </div>
    </div>
</div>

<div class="loading_gif d-none">
    <img src="{{ asset('adminapp/public/global_assets/giphy.gif') }}" alt="Gamil load gif" style="width:300px;height:300px; border-radius:50px;  position:fixed;top: 31%;left: 42%;">
</div>

<script>
    $('#country').multiselect({
        includeSelectAllOption: true,
    });

    var supplier_details = [];

    $(document).ready(function () {
        $("#Next").click(function () {});
    });

    $("#Next").click(function () {

        var supplierdata = $("#country").val();
        $.ajax({
            url: "{{ route('supplierCountry') }}",
            type: "get",
            data: {
                supplierdata: supplierdata,
            },
            success: function (data) {
                supplier_details = data.supplier_details;
                console.log(data);
                $("#supplier-table").removeClass('d-none');
               
                 if (data.supplierManagement.length ===0){
                      swal({
                        title: "This Country Doesn't Have Any Suppliers",
                        icon: 'success',
                        buttons: false
                     })
                 }
                 else{
                      $(".form-submit").removeClass('d-none');
                 }
                html = '';
                html += `<div class="d-flex align-items-center justify-content-between">`;
                $.each(data.supplierManagement, function (i, v) {
                    html += `  <table class="table" >
                      <thead>
                        <tr><th> <input type="checkbox" name="country_Check" id="country_Check" data-check="${v[0].id}">${v[0].supplier_country}</th>
                                    `;

                    html += `    </tr></thead><tbody>`
                    // console.log(html)
                    // console.log(v);
                    if (v.length != 0) {
                        $.each(v, function (i, v1) {
                            html += `<tr>`;

                            html += `  <td><input type="checkbox" name="check[${v[0].id}]" class="vendor_id selectall_${v[0].id}" value="${v1.id}" data-id='${v[0].id}'>
                               <lable>${v1.supplier_company}</label></td>
                                    `;

                            html += `</tr>
    `;
                        });
                    }
                    html += `<tr><td> 
     <textarea name="email_content[${v[0].id}]" class="email_content_${v[0].id}" id="email_content" data-id="${v[0].id}" rows="4" cols="50" style="width:100%;height: 200px;"></textarea><br>
     <label class="mr-3">Upload File </label><input type="file" class="mt-3" name="file" id="file_${v[0].id}" style="border:1px solid black" >
      </td></tr></tbody></table>`

                });
                html += ` </div>`

                // console.log(html)


                $('#supplier-table').html(html);

            }
        })
    });

    // $("#mail_send_key").validate({
    //             rules:{


    //             },
    //             errorPlacement: function (error, element) {
    //         if (element.hasClass("select2-hidden-accessible")) {
    //             error.insertAfter(element.siblings('span.select2'));
    //         } else if (element.hasClass("floating-input")) {
    //             element.closest('.form-floating-label').addClass("error-cont").append(error);
    //         } else {
    //             error.insertAfter(element);
    //         }
    //     },

    //     submitHandler: function (form) {

    $(document).on('click', '.form-submit', function () {

     $(".loading_gif").removeClass('d-none');
     $('.show_hide,.sidebar-offcanvas').css('opacity','0.1');
        var e = document.querySelectorAll('.vendor_id:checked')

        let data = [];
        $.each(e, function (i, v) {
            console.log($(v).attr('data-id'))
            let id = $(v).attr('data-id');
            let value = $(v).val();
            data.push({
                'id': value,
                'content': $('.email_content_' + id).val(),
                'file':$("#file_"+id)[0].files[0] ? $("#file_"+id)[0].files[0]: '' ,
            })

        });

        console.log('data', data);
        
        var formData = new FormData;

for (var i = 0; i < data.length; i++) {
    formData.append(`data[${i}][id]`, data[i]['id']);
    formData.append(`data[${i}][content]`, data[i]['content']);
    formData.append(`data[${i}][file]`, data[i]['file']);
}
 
        $.ajax({
            url: "{{ route('supplierMail') }}",
            type: "post",
            data: formData,
            processData: false,
            cache: false,
           contentType: false,
            success: function (data) {
                    if(data.success ==1){
                    $(".loading_gif").addClass('d-none');
                    $('.show_hide,.sidebar-offcanvas').css('opacity','1');
                    swal({
                        title: 'Mail Sent Successfully',
                        icon: 'success',
                        buttons: false
                    })
                    window.location = "{{ route('supplier.costRequestView') }}";
                    }
                
                    if(data.success == 2){
                         $(".loading_gif").addClass('d-none');
                         $('.show_hide,.sidebar-offcanvas').css('opacity','1');
                         swal({
                            title: 'Check All The Fields',
                            icon: 'success',
                            buttons: false
                         })
                    }
                },
        
            error: function (data) {
                // alert('Mail sent failed');
                
            }
        })
    });

    //     }
    // });

    // $("#mail_send_key").click(function(){




    // var email = [];
    // i=0;
    // $(".email_content").each(function() {
    //    console.log($(this).data('id')); 
    //     email[$( this ).data('id')] = $( this ).val();
    // });

    // var supplier_details =[];
    // j=0;
    // $('input[name="check"]:checked').each(function(){

    //       supplier_details[$(this).data('id')] = $( this ).val();

    // });




    // $().css('opacity','0.1')
    //     // });
$(document).on('change','#country_Check',function(){
     var check =$(this).attr('data-check');
   if (this.checked) {
    $(".selectall_"+check).prop('checked',true);
       
   }
   else{
        $(".selectall_"+check).prop('checked',false);
   }
})
</script>
@endsection