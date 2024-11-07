@extends('layouts.master')
@section('page_title', 'Client List')
@section('content')

<style>
 
    .header{
        background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
        
    }
   </style>
   <div class="col-md-12">
        <div class="card " id="header-title">  
            <div class="card-header header-elements-inline header">
            <div class="card-title " style="color:whitesmoke;">Receive Money</div>
            </div>
        </div>
        <div class="card-body"  id="cardbody">
        <div class="row">
            <div class="col-md-2 col-sm-0">

            </div>
            <div class="col-md-8 col-sm-12">
                <table class="table table-responsive">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Admin Name</th>
                        <th scope="col">Voucher Code</th>
                        <th scope="col">Receive Money</th>
                        <th scope="col">Send date</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($receiveMoney as $receive)
                        <tr>
                            <td>{{$receive->user_name}}</td>
                            <td>{{$receive->voucher_code}}</td>
                            <td>{{$receive->money}}</td>
                            <td>{{$receive->created_at}}</td>
                            <td><button class="btn btn-primary redeem_id"  value="{{$receive->id}}">redeem</button></td>
                        </tr>
                     @endforeach
                    </tbody>
                  </table>
                  
            </div>
            <div class="col-md-2 col-sm-12" ></div>
        </div>
        </div>
   </div>
 
 <script>
     $(document).ready(function () {
      $(".redeem_id").click(function(){
          var redeemvalue =$(this).attr('value');
          alert(redeemvalue);
         $.ajax({
             type: "post",
             url: "{{route('redeemValue')}}",
             data: {id:redeemvalue},
             dataType: "json",
             success: function (data) {
                if(data.success == 1){
                    swal({
                            title:'Redeem Successfully',
                            icon:'success',
                            button:false
                           }) 
                           location.reload();
                 }
             }
         });
      })   
     });
 </script>
@endsection