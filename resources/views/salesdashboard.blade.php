
@extends('layouts.master')

@section('content')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
  .card-icon{
    border-radius: 3px;
    background-color: #007bff;
    color: #fff;
    padding: 21px;
    margin-top: 7px;
    margin-right: 15px;
    float: left;
  }
  .card-icon1{
    border-radius: 3px;
    background-color: #fb8c00;
    color: #fff;
    padding: 21px;
    margin-top: 7px;
    margin-right: 15px;
    float: left;
  }
  .card-icon2{
    border-radius: 3px;
    background-color: #d81b60;
    color: #fff;
    padding: 21px;
    margin-top: 7px;
    margin-right: 15px;
    float: left;
  }
  .card-icon3{
    border-radius: 3px;
    background-color: #43a047;
    color: #fff;
    padding: 21px;
    margin-top: 7px;
    margin-right: 15px;
    float: left;
  }
  .card-icon4{
    border-radius: 3px;
    background-color: #9a55ff;
    color: #fff;
    padding: 21px;
    margin-top: 7px;
    margin-right: 15px;
    float: left;
  }
  .card-icon5{
    border-radius: 3px;
    background-color: #17a2b8;
    color: #fff;
    padding: 21px;
    margin-top: 7px;
    margin-right: 15px;
    float: left;
  }
  .card-icon6{
    border-radius: 3px;
    background-color: var(--teal);
    color: #fff;
    padding: 21px;
    margin-top: 7px;
    margin-right: 15px;
    float: left;
  }
  .card-icon7{
    border-radius: 3px;
    background-color: #b66dff;
    color: #fff;
    padding: 21px;
    margin-top: 7px;
    margin-right: 15px;
    float: left;
  }
  .card-icon8{
    border-radius: 3px;
    background-color: #394db9;
    color: #fff;
    padding: 21px;
    margin-top: 7px;
    margin-right: 15px;
    float: left;
  }
  .card-icon9{
    border-radius: 3px;
    background-color: #8bc34a;
    color: #fff;
    padding: 21px;
    margin-top: 7px;
    margin-right: 15px;
    float: left;
  }
  .card-icon10{
    border-radius: 3px;
    background-color: #f44336;
    color: #fff;
    padding: 21px;
    margin-top: 7px;
    margin-right: 15px;
    float: left;
  }
  .card-icon11{
    border-radius: 3px;
    background-color: #607d8b;
    color: #fff;
    padding: 21px;
    margin-top: 7px;
    margin-right: 15px;
    float: left;
  }
  .card-icon12{
    border-radius: 3px;
    background-color: #6837b7;
    color: #fff;
    padding: 21px;
    margin-top: 7px;
    margin-right: 15px;
    float: left;
  }
  .card-icon13{
    border-radius: 3px;
    background-color: #03a9f4;
    color: #fff;
    padding: 21px;
    margin-top: 7px;
    margin-right: 15px;
    float: left;
  }
  
  .my-icon{
    font-size: 36px;
    line-height: 56px;
    width: 56px;
    height: 56px;
    text-align: center;
  }
</style>
<div class="content-wrapper">
    <!--<div class="row" id="proBanner">-->
    <!--<div class="col-12">-->
    <!--  <span class="d-flex align-items-center purchase-popup">-->
    <!--    <p>Get tons of UI components, Plugins, multiple layouts, 20+ sample pages, and more!</p>-->
    <!--    <a href="https://www.bootstrapdash.com/product/purple-bootstrap-admin-template?utm_source=organic&utm_medium=banner&utm_campaign=free-preview" target="_blank" class="btn download-button purchase-button ml-auto">Upgrade To Pro</a>-->
    <!--    <i class="mdi mdi-close" id="bannerClose"></i>-->
    <!--  </span>-->
    <!--</div>-->
    <!--</div>-->
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>
            </span>Admin Dashboard
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 d-flex align-items-center mb-2">
            <label class="start_1"
                style="margin-right:13px; font-size:15px; margin-left:46px;font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; color:#5c4949;">Date:</label>
            <input type="text" name="RFQs" class="won_project " value="" id="daterange"
                style="max-width: 100%; max-height: 100%;  padding:auto; margin-top:-7px;  border-color: #237ee6 !important;">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon">
                       <i class="fas fa-id-badge"></i>
                    </div>
                    <p class="card-category">Total RFQ Bid Value</p>
                    <h3 class="card-title" id="k1">{{ $bid ? $bid:0 }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="my-icons">sales</i>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon1">
                       <i class="fas fa-clipboard-check"></i>
                    </div>
                    <p class="card-category">Total Won Projects </p>
                    <h3 class="card-title" id="k2">6</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="my-icons">sales</i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon2">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <p class="card-category">Total Invoice Value</p>
                    <h3 class="card-title" id="k3">{{ $totalrevenue ? $totalrevenue : 0 }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="my-icons">sales</i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon3">
                        <i class="fa-solid fa-comments-dollar"></i>
                        <!--<i class="fa-solid fa-tags"></i>-->
                    </div>
                    <p class="card-category">Total Margin Value</p>
                    <h3 class="card-title" id="k4">{{ $totalmargin ? $totalmargin : 0 }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">sales</i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon4">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <p class="card-category">Total No Of Projects</p>
                    <h3 class="card-title" id="k5">{{ $operation1 ? $operation1 :0 }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="my-icons ">Operation</i>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon5">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <p class="card-category">Total Existing Projects </p>
                    <h3 class="card-title" id="k6">{{ $operation1 ? $operation1 :0 }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="my-icons">Operation</i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon6">
                        <i class="fas fa-money-check"></i>
                    </div>
                    <p class="card-category">Total Closed Projects </p>
                    <h3 class="card-title" id="k7">{{ $closed1 ? $closed1 : 0 }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="my-icons">Operation</i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon7">
                        <i class="fa-solid fa-tags"></i>
                    </div>
                    <p class="card-category">Field Team Projects</p>
                    <h3 class="card-title" id="k8">{{ $field_team ? $field_team : 0 }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">Field Team</i>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row mt-4">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon8">
                        <i class="fas fa-money-bill"></i>
                    </div>
                    <p class="card-category">Client Invoices Pending</p>
                    <h3 class="card-title" id="k9">{{ $operation1 ? $operation1 :0 }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="my-icons ">Accounts</i>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon9">
                       <i class="fas fa-money-bill-wave"></i> 
                    </div>
                    <p class="card-category">Vendor Invoices Pending</p>
                    <h3 class="card-title" id="k10">{{ $operation1 ? $operation1 :0 }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="my-icons">Accounts</i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon10">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                    <p class="card-category">Total Payments Awaited </p>
                    <h3 class="card-title" id="k11">{{ $closed1 ? $closed1 : 0 }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="my-icons">Accounts</i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon11">
                        <i class="fas fa-people-carry"></i>
                    </div>
                    <p class="card-category">Total <br>Suppliers </p>
                    <h3 class="card-title" id="k12">{{ $total_supplier ? $total_supplier : 0 }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                     <i class="my-icons ">Suppliers</i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon12">
                        <i class="fa-solid fa-coins"></i>
                    </div>
                    <p class="card-category">Total Cost Request</p>
                    <h3 class="card-title" id="k13">{{ $total_cost_request ? $total_cost_request :0 }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="my-icons ">Suppliers</i>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon13">
                       <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <p class="card-category">Total <br>physician</p>
                    <h3 class="card-title" id="k14">{{ $datacenter1 ? $datacenter1 :0 }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="my-icons">Data Center</i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
        </div>

    </div>        
<script>
        $(function () {
            $('#daterange').daterangepicker({
                    "showDropdowns": true,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,'month').endOf('month')]
                    },
                    opens: 'right'
                },
                function (start, end, label) {
                    //  console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                    RFQs(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'))
                });
        });
</script>   
    <script>
        $(document).ready(function () {
            var startDate = moment().format('YYYY-MM-DD');
            var endDate = moment().format('YYYY-MM-DD');

            RFQs(startDate, endDate)
        });

        function RFQs(start_date, end_date) {
            $.ajax({
                url: "{{route('admin.daterangepicker') }}",
                type: "POST",
                data: {
                    start_1: start_date,
                    end_1: end_date
                },
                success: function (data) {
                    console.log(data);
                    $("#k1").html(data.Total_Rfq_Bid);
                    $("#k2").html(data.Total_Won_Projects);
                    $("#k3").html(data.Total_Invoice_Value1);
                    $("#k4").html(data.Total_Margin_Value);
                    $("#k5").html(data.Total_No_of_projects);
                    $("#k6").html(data.Total_Existing_Projects);
                    $("#k7").html(data.Total_closed_projects);
                    $("#k8").html(data.Total_Existing_Projects);
                    $("#k9").html(data.Client_invoices_pending);
                    $("#k10").html(data.Vendor_invoices_pending);
                    $("#k11").html(data.Total_Payments_awaited);
                    $("#k12").html(data.Total_Suppliers_by_country);
                    $("#k13").html(data.Total_Cost_request);
                    $("#k14").html(data.Total_doctor);
                }
            });
        }

    </script>    
@endsection