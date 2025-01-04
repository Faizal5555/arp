@extends('layouts.master')
<style>
    a.ml-2.card-title {
    color: #fff;
    }
    .card-header.header-elements-inline {
    background-color: #0b5dbb;
    }
    .awite-row{
        background-color: #0b5dbb;  
    }
    
   input#daterange {
   outline: 1px solid #0a51a4;
   border-radius: 21px;
   }
    select#supplier_country {
   outline: 1px solid #0a51a4;
   border-radius: 21px;
   }
   input#supplier_company {
   outline: 1px solid #0a51a4;
   border-radius: 21px;
   }
   input#supplier_manager {
   outline: 1px solid #0a51a4;
   border-radius: 21px;
}
   
   div.dataTables_wrapper div.dataTables_length select {
    width: 58px !important;
    display: inline-block;
}
.dataTables_wrapper .dataTables_length{
    margin-top:8px;
}
div.dataTables_wrapper div.dataTables_filter{
    margin-top:8px;
    margin-right:8px;
}
select.form-control {
    outline: 1px solid #0b5dbb!important;
    border-radius: 21px;
    color: #c9c8c8;
}
</style>
@section('content')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript">
    var startdate = ''; // Initialize with empty value for the first load
    var enddate = '';   // Initialize with empty value for the first load

    $(function() {
        // Set up CSRF token for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Initialize DataTable
        var table = $('.data-table').DataTable({
            scrollX: true, // Enable horizontal scrolling
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('supplier.costRequestView1') }}", // Route to fetch data
                data: function(data) {
                    data.supplier_company = $('#supplier_company').val(); // Supplier company filter
                    data.supplier_country = $('#supplier_country').val(); // Supplier country filter
                    data.supplier_manager = $('#supplier_manager').val(); // Supplier manager filter
                    data.startdate = startdate; // Start date for filtering
                    data.enddate = enddate;     // End date for filtering
                }
            },
            columns: [
                { data: 'rfq_no', name: 'rfq_no' },
                { data: 'supplier_company', name: 'supplier_company' },
                { data: 'supplier_manager', name: 'supplier_manager' },
                { data: 'supplier_email', name: 'supplier_email' },
                { data: 'supplier_phone', name: 'supplier_phone' },
                { data: 'supplier_country', name: 'supplier_country' },
                {
                    data: '',
                    render: (data, type, row) => {
                        return `
                            <div class="text-center">
                                <div class="list-icons">
                                    <a href='/adminapp/supplier/cost_request_view/${row.id}'><i class="fas fa-eye"></i></a>
                                </div>
                            </div>`;
                    }
                }
            ]
        });

        // Event to redraw table when date range changes
        $(document).on('change', '#daterange', function() {
            table.draw();
        });

        // Event to redraw table when supplier company filter changes
        $(document).on('keyup', '#supplier_company', function() {
            table.draw();
        });

        // Event to redraw table when supplier manager filter changes
        $(document).on('keyup', '#supplier_manager', function() {
            table.draw();
        });

        // Event to redraw table when supplier country filter changes
        $(document).on('change', '#supplier_country', function() {
            table.draw();
        });

        // Initialize daterangepicker
        $('input[name="daterange"]').daterangepicker({
            autoUpdateInput: false, // Prevent input from being pre-filled
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'Last 45 Days': [moment().subtract(44, 'days'), moment()],
                'Last 60 Days': [moment().subtract(59, 'days'), moment()],
                'Last 90 Days': [moment().subtract(89, 'days'), moment()],
                'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
            }
        }, function(start, end, label) {
            // Update start and end dates when a range is selected
            startdate = start.format('YYYY-MM-DD');
            enddate = end.format('YYYY-MM-DD');
            table.draw(); // Redraw the table with the updated dates
        });

        // Handle apply button in daterangepicker
        $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        // Handle cancel button in daterangepicker
        $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val(''); // Clear the input field
            startdate = '';  // Reset start date
            enddate = '';    // Reset end date
            table.draw();    // Redraw the table to show all data
        });
    });
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
              
                <div class="card-header header-elements-inline">
                    <a class="ml-2 card-title" style="color:#fff !important;">View Total Cost Requests Sent To Supplier</a>
                </div>

                    <div class="card-body">
                       
                        <div class="row mt-5">
                            
                                
                                        
                           <div class="col-md-3">
                                <label>Supplier Company</label>
                                <input type="text" class="form-control" id="supplier_company" name="supplier_company">
                            </div>
                             <div class="col-md-3">
                                <label>Supplier Manager</label>
                                <input type="text" class="form-control" id="supplier_manager" name="supplier_manager">
                            </div>
                            <div class="col-md-3">
                                <label>Supplier Country</label>
                  
                                <select class='form-control border border-secondary label-gray-3' name='supplier_country' id='supplier_country'> 
                                    <option value=""> Select Country</option>
                                    @if(isset ($country) && count($country) > 0)
                                    @foreach($country as $v)
                                <option value="{{$v->name}}">{{$v->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Date</label>
                                <input type="text" class="form-control" name="daterange"   id="daterange"/>
                            </div>
                           
                        </div>
                    <div class="table-responsive mt-4" id="cost_request_view">
                                
                                <table class="table table-hover table1 data-table">
                                    <thead>
                                        <tr class="awite-row">
                                            <th>RFQ No</th>
                                            <th>Supplier Company Name </th>
                                            <th>Supplier Manager</th>
                                            <th>Supplier Email</th>
                                            <th>Supplier Phone Number</th>
                                            <th>Supplier Country</th>
                                            <th>view</th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">
                                    </tbody>
                                </table>
                            </div>


                    </div>
                </div>
                
             </div>
        </div>
    </div>


       


        @endsection
        @section('script')


        @endsection