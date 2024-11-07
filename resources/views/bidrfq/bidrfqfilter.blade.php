@extends('layouts.master')
@section('page_title', 'Fillter')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-title">vendor List</div> -->
                <div class="card-header header-elements-inline">
                    <a class="ml-2 card-title">Fillter</a>
                    <a href="{{route('bidrfq.create')}}" class="ml-2 btn btn-primary">Add</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="rfq_no" id="rfq_no" class="form-control custom-control">
                                            <option value="">Select RFQ No</option>
                                            @if (count($bidrfq) > 0)
                                            @foreach($bidrfq as $value)
                                            <option value="{{$value->rfq_no}}">{{$value->rfq_no}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="client_name" id="client_name" class="form-control custom-control">
                                            <option value="">Select Client</option>
                                            @if (count($bidrfq) > 0)
                                            @foreach($bidrfq as $value)
                                            <option value="{{$value->client_name}}">{{$value->client_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                       Start Date: <input type="date" name="date" class="date" placeholder="Select Start Date" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                       End Date: <input type="date" name="follow_up_date" placeholder="Select End date" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    Industry: <input type="text" name="industry" placeholder="Industry" >
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                
                            <table class="table table-hover table1">
                                <thead>
                                    <tr>
                                        <th>RFQ No </th>
                                        <th>Vendor Name</th>
                                        <th>Client Name</th>
                                        <th>Start Date</th>  
                                        <th>End Date</th>  
                                        <th>Industry</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($bidrfq) > 0)
                                    @foreach($bidrfq as $value)
                                    <tr>
                                        <td> {{$value->rfq_no;}} </td>
                                        <td>
                                        <ul class="list-group">
                                            @if(!empty($value['vendor_id']))
                                            @foreach(explode(",",$value['vendor_id']) as $t)
                                            <li class="list-group-item border-0" id="vendor-color">
                                            {{ $t }} 
                                            </li>
                                            @endforeach
                                            @endif
                                        </ul>
                                        </td>
                                        <td>
                                            <ul class="list-group">
                                                @if(!empty($value['client_id']))
                                                @foreach(explode(",",$value['client_id']) as $t)
                                                <li class="list-group-item border-0">
                                                {{ $t }} 
                                                </li>
                                                @endforeach
                                                @endif
                                            </ul>
                                        </td>
                                        <td> {{$value->date;}} </td>
                                        <td> {{$value->follow_up_date;}} </td>
                                        <td> {{$value->industry;}} </td>
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

@endsection
@push('css')
    <style>
    
    .input-group
    {
        width:auto !important;
    }
    .card{
        border: none !important;
    }
    .list-group-item:first-child{
        background-color: #ffdae2;
        border-color: #ffdae2;
        text-align: center;
        border-radius: 10px;
    }
    .list-group-item:last-child {
    margin-bottom: 0;
    border-bottom-right-radius: .25rem;
    border-bottom-left-radius: .25rem;
    background-color: #bff2ea;
    border: #bff2ea;
    border-radius: 10px;
    text-align: center;
    margin-top: 10px;
    }
    #vendor-color{
    background-color: #ffdae2;
    border-color: #ffdae2;
    }
    .table td, .table th {
    padding: .75rem;
    vertical-align: middle !important;
    border-top: 1px solid #dee2e6;
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
<script>
            
    $(document).ready(function(){

        $(document).on('click', '.relative', function(event){

            let rfq_no = $('#rfq_no').children("option:selected").val();

            if(rfq_no === undefined){
                rfq_no = "";
            }

            event.preventDefault(); 
            let page = $(this).attr('href').split('page=')[1];
            history.pushState(null,null,'?page=' + page + '&rfq_no=' + rfq_no );
            fetch_data(page);
        });

        function fetch_data(page)
        {
            let _token = $("input[name=_token]").val();
            let rfq_no = $('#rfq_no').children("option:selected").val();

            if(rfq_no === undefined){
                rfq_no = "";
            }

            $.ajax({
                url:"search=" + page + '&rfq_no=' + rfq_no,
                method:"GET",
                data:{_token:_token, page:page},
                success:function(data){
                    $('.data').html(data);
                }
            });
        }

        $(document).on('change','#rfq_no',function(){
            let rfq_no = $(this).val();
            let page = 1;
            history.pushState(null,null,'?page=' + page + '&rfq_no=' + rfq_no );
            $.ajax({
                url:"search=" + page + '&rfq_no=' + rfq_no,
                method:"GET",
                data:{rfq_no:rfq_no},
                success:function(data){
                    $('.data').html(data);
                }
            });
        });

    });
    
</script>
@endsection