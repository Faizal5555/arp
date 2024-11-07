<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.rawgit.com/tonystar/bootstrap-float-label/v4.0.1/dist/bootstrap-float-label.min.css">


<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- plugins:css -->
<link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}">
<!-- endinject -->
<!-- Plugin css for this page -->
<!-- End plugin css for this page -->
<!-- inject:css -->
<!-- endinject -->
<!-- Layout styles -->
<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
<!-- End layout styles -->

<link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<style>

img{
    width: 30%;
    float: right;
}
 body 
 { font-family: DejaVu Sans, sans-serif; }
 h3,h4{
     color:#0b5dbb;
 }
</style>
<body>
<div class="container">
<div class="row">
   

    <div class="col-md-4"></div>
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="logo" >
        <img  src="{{$logo}}">
        </div>
    </div>
    
   
</div>
</div>

                                       <?php
                                        $sample_size=json_decode($biddownload->sample_size,true); 
                                        $setup_cost=json_decode($biddownload->setup_cost,true);
                                        $recruitment = json_decode($biddownload->recruitment,true);
                                        $incentives = json_decode($biddownload->incentives,true);
                                        $moderation = json_decode($biddownload->moderation,true);
                                        $transcript = json_decode($biddownload->transcript);
                                        $others = json_decode($biddownload->others);
                                        $world = json_decode($biddownload->country); 
                                        $country = implode(',',array_merge(...$world));
                                        $total_cost = json_decode($biddownload->total_cost);
                                        $client_id =json_decode($biddownload->client_id);
                                        $vendor_id = json_decode($biddownload->vendor_id);
                                        ?>
<div class="container mt-5" >
<div class=" col-md-12" >
   
    <table style="margin-bottom: 10px;">
        <thead>
        <tr style="margin-bottom: 5px;">
            <th class="sub" style=" padding-left: 16px;
            padding-bottom:10px;
            font-size:15px;
            "> <label class="col-form-label font-weight-semibold">Company Name:</label></th>
            <th></th>
            <th></th>
            <th></th>
            <th style="
            padding-left: 6px;
            padding-bottom:10px;
            font-size:15px;
            ">Asia Research Partners</th>
         </tr>
         
         <tr style="margin-bottom:5px;">
            <th class="sub" style="margin-right:10px;
            padding-bottom:10px;
            font-size:15px;
            "> <label class="col-form-label font-weight-semibold text-align-start" style="margin-left:-55px;">RFQ No:</label></th>
            <th></th>
            <th></th>
            <th></th>
            <th align="start" style="
            padding-bottom:10px;
            font-size:15px;
            "> {{$biddownload->rfq_no}}</th>
         </tr>

         <tr style="margin-bottom: 5px;">
            <th class="sub" style="padding-right:10px;
            padding-bottom:10px;
            font-size:15px;
            "><label class="col-form-label font-weight-semibold" style="margin-left:-43px;">Country:</label></th>
            <th></th>
            <th></th>
            <th></th>
            <th class="sub-country" style="
            padding-bottom:10px;
            font-size:15px;
            ">
            {{$country}}
            </th>
         </tr>

         <tr style="margin-right:10px">
            <th class="sub" style="margin-right:10px;
            padding-bottom:10px;
            font-size:15px;
            "><label class="col-form-label font-weight-semibold"style="margin-left:-43px;">Currency:</label></th>
            <th></th>
            <th></th>
            <th></th>
            @if($biddownload->currency == '$')
            <th style="
            padding-left: 6px;
            font-size:15px;
            "> 
            (USD)</th>
            @elseif($biddownload->currency == '₹')
              <th style="
            padding-left: 6px;
            font-size:15px;
            "> 
            (INR)</th>
            @elseif($biddownload->currency == '€')
                <th style="
            padding-left: 6px;
            font-size:15px;
            "> 
            (EUR)</th>
            @esle 
            <th style="
            padding-left: 6px;
            font-size:15px;
            "> 
            </th>
            @endif
            
         </tr>
         
        <tr style="margin-bottom: 5px;justify-content:flex-start;">
            <th class="sub" style="
            padding-bottom:36px;
            font-size:15px;
            "><label class="col-form-label font-weight-semibold" style="margin-left:10px;"> Manager Name:</label></th>
            <th></th>
            <th></th>
            <th></th>
            <th style="
            padding-left: 6px;
            padding-bottom:36px;
            font-size:15px;
            ">
                
                {{$username[0]['name']}} </th>
         </tr>
</thead>
    </table>

    <!-- ARP Sales Manager Name -->
    
   <!--content-->
  <h3>Dear Sir / Madam,</h3>	
    <p>Based on the specifications in the RFQ, below you will see the costs and the timelines.</p> 	
    <p>We hope that the costs will be in-line with your expectations and if not please feel free to let us know.</p>	
   <!--End content-->

   

 <div class="container mt-5" style="border-top:1px solid; margin-top:10px;">
  <div class=" col-md-12" >
     @foreach($world as  $main=> $country1)
     @foreach($sample_size as $k1=> $value)     
     @if($k1==$main)    
     @foreach($country1 as $cou=> $countries)
     <h5  style="
            padding-left: 7px;
            padding-left: 10px;
            
            ">Country:{{$countries}}</h5>
      @endforeach
    
     
<div class="container ml-2 pl-2"> 

    <table class="table table-bordered border-primary add-country"  style="
            padding-left: 5px;
            ">
        <thead style="border-top:1px solid; border-left:1px solid; border-right:1px solid; border-bottom:1px solid;">
      <tr style="background-color:#0b5dbb;color:white;" >
        <th style="
    padding: 0.75rem;
    vertical-align: top;

    font-size:15px;background-color:#0b5dbb;color:white;"
    ">
           Client Name 
            <!--Client Name/ Vendor Name-->
            
        </th>

        <th style="
          padding: 0.75rem;
          vertical-align: top;
          font-size:15px; background-color:#0b5dbb;color:white;
        ">
            <div class="div ml-2" style="background-color:#0b5dbb;color:white;boder:1px solid black">
              Client
            </div>

        </th>

    
        </thead>
      </tr>
    <!-- Sample Size -->
    <tbody style="border-left:1px solid; border-right:1px solid; border-bottom:1px solid;">
    <tr>
        
     <td class="sub-cost" style="
          padding: 0.75rem;
          vertical-align: top;
          border-right:1px solid;">Sample Size</td>
             
                                      
            @foreach($value as $k=> $data)   
              @if($k==0)     
                        <td style="
          padding: 0.75rem;
          vertical-align: top;
          border-top:1px solid;
           border-right:1px solid;
         ">
                            {{$data}}
                        </td>    
            @endif
            @endforeach
    
                                                               
    </tr>
    <!-- Setup Cost -->
    <tr>
    <td class="sub-cost" style="
          padding: 0.75rem;
          vertical-align: top;
          border-top:1px solid;
          border-right:1px solid;
         ">Setup Cost</td>
     @foreach($value as $k=> $data)  
       @if($k==0)     
         <td style="
          padding: 0.75rem;
          vertical-align: top;
          border-top: 1px solid;
           border-right:1px solid;
         ">
             {{$setup_cost[$k1][$k]}}
        </td>  
        @endif
     @endforeach                                                                                         
    </tr>

    <!-- Incentives -->
    <tr>
     <td class="sub-cost" style="
          padding: 0.75rem;
          vertical-align: top;
          border-top: 1px solid;
           border-right:1px solid;
         ">Incentives</td>
        @foreach($value as $k=> $data)  
          @if($k==0)     
            <td style="
          padding: 0.75rem;
          vertical-align: top;
          border-top: 1px solid;
           border-right:1px solid;
         ">
                {{$incentives[$k1][$k]}}
            </td>  
        @endif
        @endforeach                                            
    </tr>

    <!-- Moderation -->
    <tr>
     <td class="sub-cost" style="
          padding: 0.75rem;
          vertical-align: top;
          border-top: 1px solid;
          border-right:1px solid;
         ">Moderation</td>
        @foreach($value as $k=> $data)  
          @if($k==0)     
            <td style="
          padding: 0.75rem;
          vertical-align: top;
          border-top: 1px solid;
           border-right:1px solid;
         ">
                {{$moderation[$k1][$k]}}
            </td>  
         @endif
        @endforeach 
                                           
    </tr>

    <!-- Transcript -->

    <tr>
     <td class="sub-cost" style="
          padding: 0.75rem;
          vertical-align: top;
          border-top: 1px solid;
          border-right:1px solid;
         ">Transcript</td>
        @foreach($value as $k=> $data)  
          @if($k==0)     
            <td style="
          padding: 0.75rem;
          vertical-align: top;
          border-top: 1px solid;
          border-right:1px solid;
         ">
                {{$transcript[$k1][$k]}}
            </td>  
         @endif
        @endforeach           
    </tr>

    <!-- Others -->

    <tr>
     <td class="sub-cost" style="
          padding: 0.75rem;
          vertical-align: top;
          border-top: 1px solid;
          border-right:1px solid;
         ">Others</td>
        @foreach($value as $k=> $data)  
          @if($k==0)     
            <td style="
          padding: 0.75rem;
          vertical-align: top;
          border-top: 1px solid;
          border-right:1px solid;
         ">
                {{$others[$k1][$k]}}
            </td>  
          @endif   
        @endforeach            
    </tr>


    <tr>
     <td class="sub-cost" style="
          padding: 0.75rem;
          vertical-align: top;
          border-top: 1px solid;
           border-right:1px solid;
         ">Total Cost</td>

     
     @foreach($value as $k3=> $data) 
       @if($k3==0)     
                <td style="
          padding: 0.75rem;
          vertical-align: top;
          border-top: 1px solid;
           border-right:1px solid;
         ">
                    {{$total_cost[$k1][$k3]}}
   
                </td>  
     @endif
     @endforeach    
                                           
    </tr>
  </tbody>
</table>
</div><br>
@endif
@endforeach
@endforeach

 <h3>Asia Research Partners.Differentiators - A Snap Shot.</h3>
  
 <h4>Project Resources</h4>
 <p>All Qual projects are executed by Native resources including interviewers and recruiters. All moderators are very well experienced with such target group and have minimum 12+ years of experience in Moderation. In case you need the moderator profiles, please do not hesitate to ask.</p>
 <p>A dedicated project manager will be allocated to Clients.</p>
 
 <h3>ARP Operational Timings (GMT / EST / IST)</h3>
 <p>04.30 AM GMT till . 18.30 GMT</p>
 <p>12.30 AM EST .till . 14.30 EST</p>
 <p>10.00 AM IST . till . 12.00 AM IST</p>
 
 <h3>Real Time Project Update</h3>
 <p>Clients will be given access to ARP portal where they can get live project updates. This way clients are not dependent or wait for project updates from ARP team.</p>
 
 <h3>Sample Databases./ Data Quality</h3>
 <p>All projects are executed using in-house databases or Panels. In case we fall short of our panels then we take support from partners panels however in case of support, we keep clients updated.</p>		
 <p>All Panels are Double opt in panels and cleaned on quarterly basis.</p>	
 <p>All Bad Ids are removed post highlighted by clients and confirmed by internal panel teams.</p>	
 <p>We expect 10 to 20% bad IDs in some projects on online studies, this is industry Standards. All bad IDs are replaced with fresh IDs for no extra costs however we would need the data file for Bad IDs.</p>	
 
 <h3>Standard Quality Measures.</h3>
 <p>Online Projects.<p>
<p>If links are programmed by clients then quality checks should be implemented from Client ends.</p>
<p>If links are programmed by ARP then we will implement checks such as IP / Geo IP trackers, Time Stamps, Quality Questions, Pre Screening Questions etc</p>
<p>F2F /Mystery Shopping Projects</p>
<p>All F2F surveys are executed using tablets with with GEO IP Tracers.</p>
<p>Field Supervisors travel with interviewers and ensure strict quality controls</p>
<p>50% field surveys are back checked by phone calls and recorded.</p>
<p>Phone numbers are available for respondents in case of quality checks required.</p>
<p>Phone Surveys</p>
<p>CATI Surveys are recorded for quality controls post taking respondent permissions. During quality checks if survey is rejected then the survey is replaced and client is informed.</p>
<p>Live listening of the surveys by quality check teams and real time feedback is given to interviewers.</p>
<p>A percentage of Call recordings sent to clients for quality control measures if required.</p>
<p>Phone numbers are available for respondents in case of quality checks required.</p>

<h3>Project Pricing and Payment Terms</h3>
<p>ARP holds low margins on projects to remain competitive.</p>
<p>For New Clients, we need advance 50% Project payments and our credit limit policy is upto USD $15,000.</p>
<p>In case of Multi-country projects, please do check for project discounts.</p>

<h3>ARP Client Reference</h3>
<p>Request for client references anywhere across globe is most welcome. We would love to make you hear what our client thinks about us.</p>
</body>
</html>