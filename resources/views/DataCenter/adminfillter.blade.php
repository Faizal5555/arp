@extends('layouts.master')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">  
<style>
 .header{
     background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
     
 }
  .error{
     color:red;
     margin-top:3px;
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
 button.multiselect.dropdown-toggle.btn.btn-default {
    border: 1px solid #0b5dbb;
 }
 span.multiselect-selected-text {
    overflow-x: auto;
 }
 .multiselect.dropdown-toggle.btn.btn-default{
     max-width:400px;
     
 }
</style>

<script>
   

    $(document).on('click','#pno-next',function(){

        var id=$('#pno').val();

        $.ajax({
            type:"get",
            url:"{{route('account.sending')}}",
            data:{
                pno:id
            },
            dataType:"json",
            success:function(data){
                if(data.success==1){
                $('.pno-table').removeClass('d-none');
                $('#table-pno').val(data.datacenter.pno);
                $('#table-name').val(data.datacenter.firstname);
                $('#table-speciality').val(data.datacenter.docterSpeciality);
                $('#email').val(data.datacenter.email);
                }
                if(data.success==0){
                     swal({
                    title: 'Please Fill RNOD Number',
                    icon: 'success',
                    buttons: false
                 })
                }
            }
        })
       
    });
    $(document).on('click','#pno-btn',function(){
      var email=$('#email').val();
      var content=$('#content').val();
      $.ajax({
          type:"get",
          url:"{{route('account.content')}}",
          data:{
              email:email,
              content:content
          },
          datatype:"json",
          success:function(data){
              if(data.success ==2){
                    swal({
                        title:'Mail Sent Successfully',
                        icon:'success',
                        buttons:false
                    }) 
                }
                
                if(data.success ==4){
                    swal({
                        title: 'Please Fill The Message',
                        icon: 'success',
                        buttons: false
                    })
                }
            },
          error:function(data){
        swal({
                    title: 'Please Fill Message',
                    icon: 'success',
                    buttons: false
                 })
    }
      })
    });

   
</script>



<div class="col-md-12">
    <div class="card " id="header-title">  

          <div class="card-header header-elements-inline header">
              <div class="card-title " style="color:whitesmoke;">inbox
              </div>
          </div>

        <div class="card-body"  id="cardbody">
          
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                  <h5>RNOD NO</h5>
                  <input type="text" name="Practice"  class="form-control" id="pno" style="width:100%; outline:1px solid #0b5dbb !important;" required> 
                  <!-- <select  name="Practice"  class="form-control" id="pno" style="width:100%; outline:1px solid #0b5dbb !important;">
                    
                  @if(count($pno)>0)
                  @foreach($pno as $v)
                    <option value="{{$v->pno}}">{{$v->pno}}</option>
                    @endforeach
                  @endif
                  </select> -->
                  <button class="btn btn-success mt-5"  id="pno-next">Next</button>
                </div>
                <div class="col-md-6 col-sm-8 form-group">
                <h5>Speciality</h5>  
                <select class="form-control border border-secondary label-gray-3 " name="speciality[]" id="multiple-checkboxes" multiple="multiple"  placeholder="Select Speciality">
                              @if(count($speciality)>0)
                              @foreach($speciality as $ss)
                              <option value="{{$ss->speciality}}">{{$ss->speciality}}</option>
                              @endforeach
                              @endif
                            </select>
                        <div class="btn-speciality mt-5 ml-5" id="btn-speciality1">
                            <button class="btn btn-success" id='Next'>Next</button>
                        </div>
                </div>
                
            </div>
            <div class="col-md-12 d-none" id="supplier-table1">
                <div class="d-flex d-none table-responsive" id="supplier-table">
                    </div>
                <button type="submit" class="btn btn-success" id="mail_send_key" style="margin-top:40px ;" >Send Mail</button>
            </div>

            <div class="pno-table d-none mt-5">
                <div class="row">
                    <div class="col-md-3">
                    </div>

                <div class="col-md-9">
               
                <div class="col-md-9">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label font-weight-semibold">RNOD No<span
                                                class="text-danger"></span></label>
                                        <div class="col-lg-6">

                                            <input type="text" name="pno_no"  id="table-pno" readonly="readonly"  class="form-control">
                                        </div>
                                    </div>
                                </div>
                 <div class="col-md-9">
                 <div class="form-group row">
                                        <label class="col-lg-3 col-form-label font-weight-semibold">Name<span
                                                class="text-danger"></span></label>
                                        <div class="col-lg-6">

                                            <input type="text" name="pno_no"  id="table-name" readonly="readonly"  class="form-control">
                                        </div>
                                    </div>
                                </div>
                 
                 <div class="col-md-9">
                 <div class="form-group row">
                                        <label class="col-lg-3 col-form-label font-weight-semibold">Speciality<span
                                                class="text-danger"></span></label>
                                        <div class="col-lg-6">
                          
                                            <input type="text" name="pno_no"  id="table-speciality" readonly="readonly"  class="form-control">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                         <label class=" col-form-label font-weight-semibold">Message<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-12 mt-4">
                                          <textarea name="content" id="content" rows="4" cols="50" maxlength="200"></textarea>
                                        </div>
                                    
                                </div>
                             
                                <input type="hidden" name="email" id="email" value="">
                                <button class="btn btn-success  ml-5" style="margin-top:40px important;" id="pno-btn">Send Mail</button>
                  
                 </div>  
                 </div>
</div>
                 
            </div>
        </div>
    </div>
    <div class="loading_gif d-none">
     <img src="{{ asset('/adminapp/public/global_assets/giphy.gif') }}" alt="Gamil load gif" style="width:300px;height:300px; border-radius:50px;  position:fixed;top: 31%;left: 42%;">
    </div>
    <script type="text/javascript">  
    $(document).ready(function() {  
        $('#multiple-checkboxes').multiselect({ includeSelectAllOption: true,});  
    });  
   

    $('#Next').click(function(){
      var speciality = $('#multiple-checkboxes').val();
      $.ajax({
          type: "get",
          url: "{{route('fillter')}}",
          data: {
           speciality:speciality,
          },
          dataType: "json",
          success: function (data) {
             $('#supplier-table1').removeClass('d-none');
              console.log(data.doctor);
              
              if(data.success == 0){
                  swal({
                        title: "Please Select the Speciality",
                        icon: 'success',
                        buttons: false
                     })
                     $("#mail_send_key").addClass('d-none');
              }
              if (data.doctor.length ===0){
                  $('#mail_send_key').addClass('d-none');
                      swal({
                        title: "This Speciality Doesn't Have Any Doctor",
                        icon: 'success',
                        buttons: false
                     })
                 }
                 else{
                      $(".form-submit").removeClass('d-none');
                 }
             
              html = '';
         html += ` `;
$.each(data.doctor,function(i,v){
         html +=`  <table class="table">
                      <thead>
                        <tr><th>  <input type="checkbox" name="country_Check" id="country_Check" data-check="${v[0].id}">${v[0].docterspeciality}</th>
                                    `;
html+=`    </tr></thead><tbody>`

console.log(v);
    if(v.length != 0)
    {
    $.each(v,function(i,v1) { 
    html += `<tr>`;
   
                 html +=`  <td> <input type="checkbox"  name="check[${v[0].id}]" class="vendor_id selectall_${v[0].id}" value="${v1.id}" data-id='${v[0].id}'><label>${v1.firstname}</label>  </td>
         `;
   
    html += `</tr>
    `;
     });
    }
     html+=`<tr><td> <textarea class="email_content_${v[0].id}" rows="4" cols="50" maxlength="200" ></textarea> <br>  <label class="mr-3">Upload File </label><input type="file" class="mt-3" name="file" id="file_${v[0].id}" style="border:1px solid black" ></td></tr></tbody></table> `
});
html += ``


$('#supplier-table').html(html);
        }
    })
});



$(document).on('click', '#mail_send_key', function () {

$(".loading_gif").removeClass('d-none');
$('.show_hide,.sidebar-offcanvas,#header-title').css('opacity','0.1');
   var e = document.querySelectorAll('.vendor_id:checked')

   let data = [];
   $.each(e, function (i, v) {
       console.log($(v).attr('data-id'))
       let id = $(v).attr('data-id');
       let value = $(v).val();
       data.push({
           'id': value,
           'content': $('.email_content_' + id).val(),
           'file':$("#file_"+id)[0].files[0] ? $("#file_"+id)[0].files[0]: '',
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
       url: "{{ route('doctorMail') }}",
       type: "post",
       data: formData,
       processData: false,
       cache: false,
       contentType: false,
       success: function (data) {
            if(data.success == 2){
                 $(".loading_gif").addClass('d-none');
                 $('.show_hide,.sidebar-offcanvas ,#header-title').css('opacity','1');
                 
                 swal({
                    title: 'Check All The Feilds ',
                    icon: 'success',
                    buttons: false
                 })
            }else if(data.success == 1){
              $(".loading_gif").addClass('d-none');
              $('.show_hide,.sidebar-offcanvas,#header-title').css('opacity','1');
              swal({
                  title: 'Mail Sent Successfully',
                  icon: 'success',
                  buttons: false
              });
            }
           // window.location = "{{ route('supplier.costRequestView') }}";
       },
       error: function (data) {
           alert('Mail sent failed');
       }
   })
});
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

   
  


