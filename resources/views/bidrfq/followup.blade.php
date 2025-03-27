@extends('layouts.master')
<style>
    a.ml-2.btn.btn-primary {
    float: right;
}
.main-panel {
    background-color: #f8f8f8;
   }
.card {
   margin: 40px 0 20px 0;
    border:1px solid;
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
    background-color: #6329a1;
    border-color: #6329a1;
}
input#search {
    border: 1px solid #0b5dbb!important;
}
.card-header.header-elements-inline {
 background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
    color: #fff;
}
.sub-text {
    color: #fff;
}


    </style>

@section('page_title', 'RFQ List')
@section('content')

{{-- <script type="text/javascript">
    $(document).ready(function(){
        $('.editCompany').on('click', function() {
            var y = $(this).text();
            $('.status').html(' Lost');
        });
    });
</script> --}}
<script>
       $(document).ready(function(){
           $('#addRegisterButton').click(function(e){
               e.preventDefault();
               $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
               });
               $.ajax({
                   url: "{{ route('bidrfq.Followupdate') }}",
                   method: 'post',
                   data: {

                       follow_up_date: $('#follow_up_date').val(),
                       comments: $('#comments').val(),
                       id: $('.editCompany').attr("data-id"),

                    },
                   success: function(result){
                       
                        if(result.success == 1)
                       {
                        swal({
                            title:'Lost Updated Successfully',
                            icon:'success',
                            button:false
                        })
                       window.location = "{{route('bidrfq.lostproject')}}";
                       }else{
                           swal({
                            title: "Please Fill All Fields",
                            type: "warning",
                             dangerMode: true,
                         
                        })
                       
                       }
                    //   swal({
                    //         title:'Lost Updated Successfully',
                    //         icon:'success',
                    //         buttons:false
                    //     })
                    //     window.location = "{{route('bidrfq.lostproject')}}";
                    //   if(result.errors)
                    //  {
                    //     $('.alert-danger').html('');
                    //     window.location = "{{route('bidrfq.lostproject')}}";
                    //     $.each(result.errors, function(key, value){
                    //         $('.alert-danger').show();
                    //         $('.alert-danger').append('<li>'+value+'</li>');
                    //     });
                    //  }
                     
                    //  else{
                     
                    //     $('.alert-danger').hide();
                    //     $('#exampleModal').modal('hide');
                    //   }
                   }
               });
           });
        });
</script>
<script>
    $(document).ready(function(){
        $('#addRegisterButton1').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
             headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
            });
            $.ajax({
                url: "{{ route('bidrfq.nextFollowupdate') }}",
                method: 'post',
                data: {

                    follow_up_date: $('#follow_up_date1').val(),
                    comments: $('#comments1').val(),
                    id: $('.editNext').attr("data-id"),

                 },
                success: function(result){
                    if(result.success == 1)
                       {
                        swal({
                            title:'Updated Successfully',
                            icon:'success',
                            button:false
                        })
                       window.location = "{{route('bidrfq.followup')}}";
                       }
                       else{
                           swal({
                            title: "Please Fill All Fields",
                            type: "warning",
                             dangerMode: true,
                         
                        })
                       }
                    // if(result.errors)
                    // {
                    //     $('.alert-danger').html('');
                    //     // window.location = "{{route('bidrfq.lostproject')}}";
                    //     $.each(result.errors, function(key, value){
                    //         $('.alert-danger').show();
                    //         $('.alert-danger').append('<li>'+value+'</li>');
                    //     });
                    // }
                    // else
                    // {
                    //     $('.alert-danger').hide();
                    //     $('#exampleNext').modal('hide');
                    //     setTimeout(function(){
                            
                    //     window.location.reload();
                    //     },1000);
                    // }
                }
            });
        });
     });
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-title">vendor List</div> -->
                <div class="card-header header-elements-inline">
                    <a class="ml-2 card-title">RFQ Follow Up List</a>
                    <!--<a href="{{route('bidrfq.create')}}" class="ml-2 btn btn-gradient-info btn-fw">Add</a>-->
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <div class="input-group" >
                                    <div>
                                        <!--<input class="form-control border-end-0 border rounded-pill" id="search" type="search" name="search" placeholder="search" id="example-search-input">-->
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <!-- <div>
                                <a href="{{route('vendor.export')}}" class="ml-4 btn btn-secondary">Import</a>
                                </div> -->

                            <table class="table datatable-button-html5-columns table1 table-hover">
                                <thead>
                                    <tr>
                                        <th>RFQ No </th>
                                        <th>Follow Up Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($bidrfq) > 0)
                                    @foreach($bidrfq as $value)
                                    <tr>
                                        <td> {{$value->rfq_no;}} </td>
                                        <td> {{$value->follow_up_date}} </td>
                                       <td class="status">
                                           {{$value->type}}
                                        </td>
                                        <td>
                                            <div class="tab">
                                                <a href="{{ route('wonproject.createwon') }}" class="tablinks btn btn-success btn-rounded btn-fw">Project Won</a>
                                                <a type="button" id="editCompany" class="tablinks btn btn-danger btn-rounded btn-fw editCompany"
                                                data-id="{{ $value->id }}" data-toggle="modal" data-target="#exampleModal">
                                                   Project Lost 
                                                    {{-- dd({{$value->id}});  --}}
                                                </a>
                                                <a type="button" id="editNext" class="tablinks btn btn-info btn-rounded btn-fw editNext"
                                                    data-id="{{ $value->id }}" data-toggle="modal" data-target="#exampleNext">
                                                    Next Follow Up Date
                                                    {{-- dd({{$value->id}});  --}}
                                                </a>
                                            </div>
                                        </td>

                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lost Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <form id="lostupdate" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="id" name="bidrfqCount">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Follow Up Date<span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input name="follow_up_date" id="follow_up_date" value="{{$follow && $follow->follow_up_date ? $follow->follow_up_date : ''}}"
                                        type="date" class="form-control" placeholder="Follow Up date" required="date">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Comments<span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <textarea name="comments" id="comments" value="{{$follow && $follow->comments ? $follow->comments : ''}}"
                                    class="form-control" placeholder="Comments here..." required="comments"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" id="addRegisterButton" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleNext" tabindex="-1" role="dialog" aria-labelledby="exampleNextLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleNextLabel">Next Follow Up Date</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <form id="update"  >
                        @csrf
                        <input type="hidden" value="id" name="bidrfqCount">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Next Follow Up Date<span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input name="follow_up_date" id="follow_up_date1" value="{{$follow && $follow->follow_up_date ? $follow->follow_up_date : ''}}"
                                        type="date" class="form-control" placeholder="Follow Up date" required=""/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Comments<span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <textarea name="comments" id="comments1" value="{{$follow && $follow->comments ? $follow->comments : ''}}"
                                    class="form-control" placeholder="Comments here..." required=""/></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" id="addRegisterButton1" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
<style>

    /* Style the buttons inside the tab */
    .tab button {
      background-color: inherit;
      float: left;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 14px 16px;
      transition: 0.3s;
      font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
      background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
      background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
      display: none;
      padding: 6px 12px;
      border: 1px solid #ccc;
      border-top: none;
    }

    /* Style the close button */
    .topright {
      float: right;
      cursor: pointer;
      font-size: 28px;
    }

    .topright:hover {color: red;}
    </style>
    <style>

    .input-group
    {
        width:auto !important;
    }
    .card{
        border: none !important;
    }
</style>
@endpush
@section('script')

<script>
$(document).ready(function() {

    var table = $('.table1').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('bidrfq.search') }}",
          data: function (d) {
                d.rfq_no = $('#search').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'rfq_no', name: 'rfq_no'},
            {data: 'setup_cost', name: 'setup_cost'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $("#search").keyup(function(){
        table.draw();
    });

});
</script>

@endsection
