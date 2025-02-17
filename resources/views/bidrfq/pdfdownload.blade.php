<!DOCTYPE html>
<html lang="en">
<style>

      img {
            width: 30%;
            float: right;
        }
        body {
            font-family: Arial, sans-serif;
        }
        h3, h4 {
            color: #0b5dbb;
        }
        .table th, .table td {
            text-align: center;
        }
        .company-header {
            font-weight: bold;
            color: red;
        }
        .subtitle {
            color: #0b5dbb;
            font-weight: bold;
        }
        .rfq-table th, .rfq-table td {
            font-size: 15px;
            padding-bottom: 10px;
        }

        .rfq-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .rfq-details {
            font-weight: bold;
        }
        .table-bordered td,
    .table-bordered th {
        border: 1px solid #dee2e6;
        padding-left: 33px;
        padding-right: 23px;
        padding-top: 10px;
        padding-bottom: 10px;
    }
    .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header-container img {
            width: 150px;
        }
</style>
<body>
<div class="container mt-4">
  <div class="header-container">
    <div>
        <p class="company-header">ASIA Research Partners LLP</p>
        <p class="subtitle">Accurate Solutions & Insightful Analysis</p>
    </div>
    <img src="{{$logo}}" alt="Company Logo" style="margin-top:-85px">
</div>
<br>

                                
              <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 50%; text-align: left;"><strong>RFQ No:</strong> {{ $biddownload->rfq_no }}</td>
                    <td style="width: 50%;"><strong>Date:</strong> </td>
                </tr>
              </table>
              <br>
              <br>
                <?php
                $sample_size=json_decode($biddownload->sample_size,true); 
                $setup_cost=json_decode($biddownload->setup_cost,true);
                $methodology=json_decode($biddownload->methodology,true);
                $recruitment = json_decode($biddownload->recruitment,true);
                $incentives = json_decode($biddownload->incentives,true);
                $moderation = json_decode($biddownload->moderation,true);
                $transcript = json_decode($biddownload->transcript);
                $others = json_decode($biddownload->others);
                $world = json_decode($biddownload->country);
                $total_cost = json_decode($biddownload->total_cost);
                $client_id =json_decode($biddownload->client_id);
                $vendor_id = json_decode($biddownload->vendor_id);

                $costItems = [
                    'Methodology' => $methodology,
                    'Sample Size' => $sample_size,
                    'Setup Cost' => $setup_cost,
                    'Recruitment' => $recruitment,
                    'Incentives' => $incentives,
                    'Moderation' => $moderation,
                    'Transcript' => $transcript,
                    'Others' => $others
                ];
?>

    <!-- ARP Sales Manager Name -->
    
   <!--content-->
   <h3>Dear Client,</h3>
   <p>We thank you for sending us the project specifications. Our operations team has checked feasibility, and the project is feasible with us. Below, you will find our costs. If you have any different considerations regarding the costs, please do not hesitate to contact us back.</p>
   <p>We have strong panels and use multi-dimension approach for recruitments such as using
    proprietary panels, phone recruitments, social media, LinkedIn, Snowball, Industry contact and
    other ways.</p>
   <p>We have strong experience in this industry and would be happy to send you case studies.</p> 
   <p>Also for qualitative research, please note that we only use 10+ years of native moderators
    operating from their respective countries.</p>
   <!--End content-->
   <br>
   <br>
   

 
   <div class="container mt-5">
    <div class=" col-md-12">
        @foreach ($world as $key => $country)
        <h3>Country:{{$country[0]}}</h3>
        <table class="table table-bordered border-primary add-country">
            <tr>
                <th>Client Name</th>
                @foreach ($client_id[$key] as  $data)
                    <th>{{$data}}</th>
                @endforeach
            </tr>
            @foreach ($costItems as $label => $costArray)
            <tr>
                <td class="sub-cost">{{ $label }}</td>
                @foreach ($costArray[$key] as $key1 => $data)
                    @if ($label == 'Others')
                        @if ($key1 % 3 == 1) 
                            <td>{{ $data }}</td>
                        @endif
                    @else
                        @if ($key1 % 2 == 0)
                            <td>{{ $data }}</td>
                        @endif
                    @endif
                @endforeach
            </tr>
        @endforeach
        </table>
        @endforeach
    </div>
    <br>
    <br>

 <h3 style="text-decoration:underline">About - Asia Research Partners LLP</h3>
  
 <p>Asia Research Partners LLP is an award-winning and ISO 9001:2015 & ISO/IEC 27001:2013
  certified global market research agency, providing state-of-the-art business intelligence
  solutions to companies across industries and regions. Our custom research solutions are
  tailored to our client’s strategic and informative knowledge needs. We have extensive
  experience in various industries and geographic locations, including APAC, Europe, Middle
  East, AMERICAS and Africa.</p>
 <p style="font-family: DejaVu Sans;">• For more information, Please visit https://www.asiaresearchpartners.com</p>
 
 <h3 style="text-decoration: underline; color:black;">Terms and Conditions for the proposal</h3>
 <p style="font-family: DejaVu Sans;">• Quotation is valid only for three months.</p>
 <p style="font-family: DejaVu Sans;">• 100% payment to be made within 30 days of project completion.</p>
 <p style="font-family: DejaVu Sans;">• In case client delays payment determined in the Agreement hereto, Asia Research Partners
  is entitled to claim penalty at the rate of 4% of the invoice value each month.</p>
 <p style="font-family: DejaVu Sans;">• The parties acknowledge that the purpose of the relationship created will be that of an
  independent contractor relationship only (Asia Research Partners as independent
  contractor of Client). Client and Asia Research Partners as mutually agree as to the
  objectives, scope of services and the Service Level Agreements set forth. Asia Research
  Partners as shall use client methodology to complete the research fieldwork however Asia
  Research Partners as is also free to use its own methodology if needed to accomplish the
  tasks outlined in the scope of work.</p>
 <p style="font-family: DejaVu Sans;">• The parties recognize and agree that no joint venture or partnership agreement is intended
  or created hereby. No agent, employee or servant of client shall be or deemed to be the
  agent, employee or servant of Asia Research Partners nor shall any agent, employee or
  servant of ARP be or deemed to be the agent, employee or servant of client. ARP will have
  full power and authority to select the means, manner and the method of performing the
  work and accomplishing the tasks outlined in the scope of work. Neither Asia Research
  Partners nor client shall act on behalf or represent itself directly or by implication as having
  authority to act on behalf of the other party except as specifically set forth in this
  Agreement. Neither party shall have the authority to create any obligation for, on behalf of,
  or in the name of the other party except as specifically set forth herein.</p>		
 <p style="font-family: DejaVu Sans;">• The parties acknowledge that client will disclose to Asia Research Partners certain
  information (Confidential Information) relating to the business of client’s client. Asia
  Research Partners agrees that it shall not use such information except in the pursuit of Asia
  Research Partners’s responsibilities and rights under this Agreement.</p>	
 <p style="font-family: DejaVu Sans;">• Asia Research Partners will retain the project documents, project data and other
  information only for 3 (three) months from the date of project completion.</p>	
 <p style="font-family: DejaVu Sans;">• Any re-contacts with respondents will happen on best effort basis only.</p>	
 <p style="font-family: DejaVu Sans;">• The information contained in the data collection will be based on the responses
  collected by individual respondents.<p>
<p style="font-family: DejaVu Sans;">• Asia Research Partners LLP will make no warranty (express, implied, or otherwise),
  nor assumes any legal liability or responsibility of the information that will come from
  respondents. The opinion that will be expressed in the data collection will be the
  opinion based on the responses given by individual respondents at the time of data
  collection and is subject to change from time to time.</p>
</body>
</html>