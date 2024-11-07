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
                    title: 'Please Fill PNo Number',
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
              <div class="card-title " style="color:whitesmoke;">Bulk Send Money
              </div>
          </div>

        <div class="card-body"  id="cardbody">
          
        <div class="col-md-12">
            <div class="row">
               
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
                            <button class="btn btn-success float-right" id='Next'>Next</button>
                        </div>
                </div>
                 <div class="col-md-6">
                  
                </div>
                
            </div>
            <div class="col-md-12 d-none" id="supplier-table1">
                <div class="d-flex d-none table-responsive" id="supplier-table">
                    </div>
                    <div class="row bulk_money_send">
                        
                        <div class="col-md-2">
                            
                        </div>
                        <div class="col-md-8 mt-4 d-flex justify-content-center align-items-center">
                            <div class="card">
                                <div class="card-header header-elements-inline header">
                                  <div class="card-title text-center " style="color:whitesmoke;">Bulk Send Money 
                                   </div>
                                </div>
                                <div class="card-body"  id="cardbody">
                                    <input type="hidden" name="username" id="username" value="{{Auth::user()->name}}">
                                    <div class="form-group">
                                        <label for="message">Send Money</label>
                                        <input type="text" name="sendmoney" id="sendmoney" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <!--<textrea type="text" name="message" id="message" class="form-control">-->
                                            <textarea name="comment" id="comment" class="form-control" form="usrform" placeholder="Enter text here..." required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            
                        </div>
                    </div>
                <button type="submit" class="btn btn-success float-right" id="mail_send_key" style="margin-top:40px ;" >Money Send</button>
            </div>
          </div>
                 </div>
</div>
                 
            </div>
        </div>
    </div>
    <div class="loading_gif d-none">
     <img src="{{ asset('global_assets/giphy.gif') }}" alt="Gamil load gif" style="width:300px;height:300px; border-radius:50px;  position:fixed;top: 31%;left: 42%;">
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
             
              if(data.success == 0){
                  swal({
                        title: "Please Select the Speciality",
                        icon: 'success',
                        buttons: false
                     })
                    
                    $('.bulk_money_send,#mail_send_key').addClass('d-none'); 
              }else{
                  $('.bulk_money_send,#mail_send_key').removeClass('d-none');
              }
              
              if (data.doctor.length ===0){
                  $('#mail_send_key').addClass('d-none');
                      swal({
                        title: "This Speciality Doesn't Have Any Doctor",
                        icon: 'success',
                        buttons: false
                     })
                      $('.bulk_money_send').addClass('d-none'); 
                     $(".arif").addClass('d-none');
                     $("#mail_send_key").addClass('d-none');
                 }
                 else{
                      $(".form-submit").removeClass('d-none');
                 }
             
              html = '';
         html += ` `;
$.each(data.doctor,function(i,v){
         html +=`<table class="table"><thead><tr><th><input type="checkbox" name="country_Check" id="country_Check" data-check="${v[0].id}">${v[0].docterspeciality}</th>`;
html+=`    </tr></thead><tbody>`
  
console.log(v);
    if(v.length != 0)
    {
        console.log(v.id);
        $.each(v,function(i,v1) { 
            html += `<tr>`;
                         html +=` <td> <input type="checkbox"  name="check[${v[0].id}]" class="vendor_id selectall_${v[0].id}" value="${v1.id}" data-id='${v[0].id}' data-user_id='${v1.user_id}'><label>${v1.firstname}</label>  </td>`;
           
            html += `</tr>`;
        });
    }
    html+=`</tbody></table>`;
});
$('#supplier-table').html(html);
        }
    })
});



$(document).on('click', '#mail_send_key', function () {


var e = document.querySelectorAll('.vendor_id:checked')
   let sendmoney =$("#sendmoney").val();
      let message =$("#comment").val();
          if(sendmoney == "" || message == "") { return swal({
                  title: 'Please Fill Money And Comments',
                  icon: 'success',
                  buttons: false
              });
              
          }
$(".loading_gif").removeClass('d-none');
$('.show_hide,.sidebar-offcanvas,#header-title').css('opacity','0.1');
//   console.log(e);
 let data = [];
 
  $.each(e, function (i, v) {
      let user_id=$(v).data('user_id');
      let value = $(v).val();
      let username=$('#username').val();
      
  
      
    //   console.log(value,sendmoney,message);
      data.push({
          'user_id':user_id,
          'doctor_id':value,
          'sendmoney':sendmoney,
          'message':message,
          "username":username
      })
  })
  console.log('data', data);
 
  
   $.ajax({
       url: "{{route('bulk.moneySend')}}",
       type: "post",
       data:({data:data}),
       success: function (data) {
        if(data.success == 1){
              $(".loading_gif").addClass('d-none');
              $('.show_hide,.sidebar-offcanvas,#header-title').css('opacity','1');
              swal({
                  title: 'Money Sent Successfully',
                  icon: 'success',
                  buttons: false
              });
            }
            
        if(data.success == 4){
              $(".loading_gif").addClass('d-none');
              $('.show_hide,.sidebar-offcanvas,#header-title').css('opacity','1');
              swal({
                  title: 'Please Select The Doctor',
                  icon: 'success',
                  buttons: false
              });
            }
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

   
  


