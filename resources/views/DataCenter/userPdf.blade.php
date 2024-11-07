<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>answer_key</title>

    <style type="text/css">
        @page {
            margin: 0px;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: x-small;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        .invoice table {
            margin: 15px;
        }
        .invoice h5 {
            margin-left: 15px;
        }
        .ans1 h6 {
            margin-left: 25px;
        }
        .information {
            background-color: #60A7A6;
            color: #FFF;
        }
        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 10px;
        }
    </style>

</head>
<body>

<div class="information">
    <table width="100%">
    @foreach($pdf1 as $ans_key=> $ans)
        <tr>
            <td align="left" style="width: 40%; margin: left 5px;">
               <h3>{{$ans->fname}}{{$ans->lname}}</h3>
               <h3>   Email: {{$ans->email}}</h3>
               <h3>    Phone: {{$ans->phone}}</h3>
               <h3>  City: {{$ans->address}}</h3>
               <h3>  Zipcode:{{$ans->zipcode}}</h3>
               <h3> Country:{{$ans->country}}</h3>
            </td>
            <td align="center">
                
            </td>
            <td align="right" style="width: 40%;">
            <img src="{{$logo}}" alt="Logo" width="150" height="100" class="logo"/>
            </td>
        </tr>
    
    </table>
</div>


<br/>

  <div class="invoice">

    <div class="qus_1">
      <h5 class="qus_1">Q.1 How would you characterize the place where you live?</h5>
        <div class="ans1 ">
            <h6>1.URBAN</h6> 
            <h6>2.SUB URBAN</h6>
            <h6>3.URBAN</h6>
            <h6>Ans:</h6>
            <h6>{{$ans->que_1}}</h6>
        </div>
    </div>

    <div class="qus_2">
      <h5 class="qus_2">Q.2 QWhat type of research (except online surveys) are you interested to be invited to participate in? </h5>
        <div class="ans1">
            <h6>1.  Focus group studies</h6>
            <h6>2. Inhome testing of new products</h6>
            <h6>3.  Webcamera studies</h6>
            <h6>4. Online bulletin boards/diaries</h6>
            <h6>5. Phone surveys</h6>
            <h6>6. SMS / WhatsApp surveys</h6>
            <h6>7. Mobile usage studies / Mobile phone surveys</h6>
            <h6>8. Food/wine tasting</h6>
            <h6>9. None of the above</h6>
            <h6>10.  Prefer not to say</h6>  

            <h6>Ans:</h6>
            <h6>{{$ans->que_2}}</h6>
        </div>
    </div>

    <div class="qus_3">
      <h5 class="qus_3">Q.3 Does the computer you primarily use to interact with research studies have a web camera?</h5>
        <div class="ans1">
                 <h6>1.Yes</h6>
                 <h6>2.No</h6>
                 <h6>Ans:</h6>
                 <h6>{{$ans->que_3}}</h6>
        </div>
    </div>

    <div class="qus_4">
      <h5 class="qus_4">Q.4 Would you be willing to participate in a research study that reads your facial expressions to analyse emotional response? The data is fully anonymous and would be used for research purposes only.</h5>
        <div class="ans1">
                 <h6>1.Yes</h6>
                 <h6>2.No</h6>
                 <h6>Ans:</h6>
                 <h6>{{$ans->que_4}}</h6>
        </div>
    </div>

    <div class="qus_5">
      <h5 class="qus_5">Q.5   Do you agree to opt-in and participate in types of research that may require you to download an application (on mobile, PC or tablet) that will track your online behaviour?</h5>
        <div class="ans1">
                 <h6>1.Yes</h6>
                 <h6>2.No</h6>
                 <h6>Ans:</h6>
                 <h6>{{$ans->que_5}}</h6>
        </div>
    </div>

    <div class="qus_6">
      <h5 class="qus_6">Q.6 Do you agree to opt-in and participate in types of research that may require cookies to be dropped onto your Mobile/PC/Tablet that will track your exposure to certain advertising?</h5>
        <div class="ans1">
                 <h6>1.Yes</h6>
                 <h6>2.No</h6>
                 <h6>2.Next</h6>
                 <h6>Ans:</h6>
                 <h6>{{$ans->que_6}}</h6>
        </div>
    </div>

    <div class="qus_7">
      <h5 class="qus_7">Q.7 What is your highest level of education?</h5>
        <div class="ans1">
                             
            <h6>1.Illiterate</h6>   
                
            <h6>2.Literate but no formal schooling</h6>
                
            <h6>3.School - up to 4 years</h6>    
                 
            <h6>4.School - 5 to 9 years</h6>    
                
             <h6>5.SSC / HSC</h6>
                
            <h6>6.Some College but not graduate</h6>
                 
            <h6>7.Graduate / Post Graduate - General</h6> 
                
            <h6>8.Graduate / Post Graduate - Professional</h6>
                
            <h6>9.PhD</h6>
                
            <h6>10.Masters/Post-Graduate</h6>  
                
            <h6>11.MBA</h6>
                
            <h6>Ans:</h6>
            <h6>{{$ans->que_7}}</h6>
        </div>
    </div>

    <div class="qus_8">
      <h5 class="qus_8">Q.8 What year did you graduate from university/college?</h5>
        <div class="ans1">                
             @foreach($answers_9 as $k_9=> $ans_9)
             <h6>{{$k_9}}.{{$ans_9}}</h6>
             @endforeach
             <h6>Ans:</h6>
             <h6>{{$ans->que_8}}</h6>
        </div>
    </div>

    <div class="qus_9">
      <h5 class="qus_9">Q.9 On average, how many hours of television do you watch per week?</h5>
      <div class="ans1"> 
         <h6>1.I don t watch TV	</h6>   
         <h6>2.5 hours or less</h6>   
         <h6>3.6 to 10 hours</h6>    
          <h6>4.11 to 20 hours</h6>   
         <h6>5.More than 20 hours</h6>   
         <h6>6.Prefer not to say</h6>   
         <h6>Ans:</h6>
         <h6>{{$ans->que_9}}</h6>   
      </div>
    </div>

    <div class="qus_10">
      <h5 class="qus_10">Q.10 Do you smoke?</h5>
      <div class="ans1">  
          <h6>1.Yes, I smoke</h6>    
                
          <h6>2.Yes, I smoke now and then</h6>    
                
          <h6>3.Yes, I smoke but I m planning to quit</h6>    
                 
          <h6>4.No, I have quit</h6>    
                
          <h6>5.No, I don’t smoke</h6>    
                
          <h6>6.No, I don’t smoke, but use other tobacco products</h6>    
                
         <h6>7.Prefer not to say</h6>    
                
         <h6>Ans:</h6>    
         <h6>{{$ans->que_10}}</h6>
      </div>
    </div>

    <div class="qus_11">
      <h5 class="qus_11">Q.11 What brand of cigarettes do you smoke?</h5>
      <div class="ans1">  
           @foreach($answers_11 as $k=> $ans_11)
              <h6>{{$k}}.{{$ans_11}}</h6>
            @endforeach
              <h6>Ans:</h6>
              <h6>{{$ans->que_11}}</h6>
      </div>
    </div>

    <div class="qus_12">
      <h5 class="qus_12">Q.12 On average, how many cigarettes do you smoke in a day?</h5>
      <div class="ans1">   
            <h6>1.I dont smoke cigarettes</h6>    
            <h6>2.1 to 3 cigarettes</h6>    
            <h6>3.4 to 6 cigarettes</h6>    
            <h6>4.7 to 10 cigarettes</h6>    
            <h6>5.More than 10 cigarettes</h6>    
            <h6>6.Prefer not to say</h6>    
            <h6>Ans:</h6> 
            <h6>{{$ans->que_12}}</h6>
      </div>
    </div>

    <div class="qus_13">
      <h5 class="qus_13">Q.13 Do you have access to a car?</h5>
      <div class="ans1">    
             <h6>1.I own a car/cars</h6>
             <h6>2.I lease/have a company car</h6>
             <h6>3.I have access to a car/cars</h6>
             <h6>4.No, I dont have access to a car</h6>
             <h6>5.Prefer not to say</h6>
             <h6>Ans:</h6>
             <h6>{{$ans->que_13}}</h6>

      </div>
    </div>

    <div class="qus_14">
      <h5 class="qus_14">Q.14 Are you the primary decision maker in your household for automotive-related purchases?</h5>
      <div class="ans1">      
         <h6>1.Yes</h6>    
         <h6>2.No</h6>    
         <h6>3.I contribute equally in automotive decisions</h6>    
         <h6>4.Prefer not to say</h6>    
         <h6>Ans:</h6>    
         <h6>{{$ans->que_14}}</h6>

      </div>
    </div>

    <div class="qus_15">
      <h5 class="qus_15">Q.15 How many cars are there in your household (including leasing or company cars)?</h5>
      <div class="ans1">    
            <h6>1.1</h6>    
            <h6>2.2</h6>    
            <h6>3.3</h6>    
            <h6>4.4</h6>    
            <h6>5.OR MORE</h6>    
            <h6>Ans:</h6>   
            <h6> {{$ans->que_15}} </h6>
      </div>
    </div>

    <div class="qus_16">
      <h5 class="qus_16">Q.16 If you own/lease a car(s), which brand are they?</h5>
      <div class="ans1">    
        @foreach($answers_16 as $k_16 => $ans_16)
              <h6>{{$k_16}}.{{$ans_16}}</h6>
        @endforeach
             <h6>Ans:</h6>
             <h6>{{$ans->que_16}}</h6>
      </div>
    </div>

    <div class="qus_17">
      <h5 class="qus_17">Q.17 How would you describe the car(s) you own/lease?</h5>
      <div class="ans1">    
        @foreach($answers_17 as $k_17 => $ans_17)
          <h6>{{ $k_17 }}.{{$ans_17}}</h6>
        @endforeach
          <h6>{{$ans->que_17}}</h6>
      </div>
    </div>

    <div class="qus_18">
      <h5 class="qus_18">Q.18 What year was your main car (owned or leased) manufactured?</h5>
      <div class="ans1">    
            @foreach($answers_18 as $k_18 => $ans_18)
                 <h6>{{$k_18}}.{{$ans_18}}</h6>
            @endforeach
                 <h6>Ans:</h6>
                 <h6>{{$ans->que_18}}</h6>
      </div>
    </div>

    <div class="qus_19">
      <h5 class="qus_19">Q.19 Do you own a motorcycle?</h5>
      <div class="ans1">     
        <h6>1.Yes</h6>    
        <h6>2.No</h6>  
        <h6>Ans:</h6>  
        <h6>{{$ans->que_19}}</h6>
      </div>
    </div>

    <div class="qus_20">
      <h5 class="qus_20">Q.20 If you own a two wheeled vehicle, which brand are they?</h5>
      <div class="ans1">     
        @foreach($answers_20 as $k_20 => $ans_20)
            <h6>{{$k_20}},{{$ans_20}}</h6>
        @endforeach
            <h6>Ans:</h6>
            <h6> {{$ans->que_20}}</h6>
      </div>
    </div>

    <div class="qus_21">
      <h5 class="qus_21">Q.21 If you own a two wheeled vehicle, what engine capacity does it have?</h5>
      <div class="ans1">     
        <h6>1.Less than 100 CC</h6>  
        <h6>2.100-149 CC</h6>
        <h6>3.150-199 CC</h6>
        <h6>4.200 CC+</h6>
        <h6>5.I don’t own a two wheeled vehicle</h6>
        <h6>6.Prefer not to say</h6>
        <h6>Ans:</h6>
        <h6>{{$ans->que_21}}</h6>
      </div>
    </div>

    <div class="qus_22">
      <h5 class="qus_22">Q.22 If you own a two wheeled vehicle, how would you describe it?</h5>
      <div class="ans1">     
       <h6>1.I don’t own a two wheeled vehicle</h6>    
       <h6>2.Standard</h6>    
       <h6>3.Cruiser</h6>    
       <h6>4.Sports bike</h6>    
       <h6>5.Touring</h6>    
       <h6>6.Sports touring</h6>    
       <h6>7.Dual-sport</h6>    
       <h6>8.Scooter, underbone or moped</h6>    
       <h6>9.Other</h6>    
       <h6>10.Prefer not to say</h6>    
       <h6>Ans:</h6>
       <h6>{{$ans->que_22}}</h6>    
      </div>
    </div>

    <div class="qus_23">
      <h5 class="qus_23">Q.23 If you own/lease a car(s), what fuel do they use?</h5>
      <div class="ans1">     
       <h6>1.Bio-diesel / Bio-gas</h6>			
       <h6>2.Diesel</h6>			
       <h6>3.Electric (EV)</h6>		
       <h6>4.Ethanol / Flexible Fuel (FFV)</h6>			
       <h6>5.Hybrid (HEV/PHEV)</h6>			
       <h6>6.Hydrogen / Fuel Cell (FCEV)</h6>			
       <h6>7.Natural Gas (NGV)</h6>			
       <h6>8.Petrol / Gasoline</h6>			
       <h6>9.Propane / Liquefied Petroleum Gas (LPG)</h6>			
       <h6>10.Other</h6>			
       <h6>11.None of the above</h6>			
       <h6>12.I dont own/lease a car</h6>	
       <h6>Ans:</h6>
       <h6>{{$ans->que_23}}</h6>
      </div>
    </div>

    <div class="qus_24">
      <h5 class="qus_24">Q.24 Are you considering buying or leasing a new or used car within the next 2 years?</h5>
      <div class="ans1">      
             <h6>1.No, I m not considering it</h6>    
             <h6>2.Yes, I m considering buying or leasing a used car</h6>    
             <h6>3.Yes, Im considering buying or leasing a new car</h6>     
             <h6>4.Yes, but unsure if the car will be used or new</h6>     
             <h6>5.I do not know</h6>     
             <h6>Ans:</h6>
             <h6>{{$ans->que_24}}</h6>  
      </div>
    </div>

    <div class="qus_25">
      <h5 class="qus_25">Q.25 What is your current occupational status?</h5>
      <div class="ans1">      
            <h6>1.Studies</h6>	
            <h6>2.Full-time work</h6>		
            <h6>3.Part-time work</h6>			
            <h6>4.Own business / Self-employed / Freelance</h6>			
            <h6>5.Active military service</h6>			
            <h6>6.Parental leave</h6>		
            <h6>7.Retired</h6>		
            <h6>8.Unemployed</h6>			
            <h6>9.Homemaker</h6>			
            <h6>10.Leave of absence</h6>			
            <h6>11.Unable to work</h6>			
            <h6>12.Other type of paid work</h6>		
            <h6>13.Prefer not to say</h6>	
            <h6>Ans:</h6>
            <h6>{{$ans->que_25}}</h6>	      
      </div>
    </div>

    <div class="qus_26">
      <h5 class="qus_26">Q.26 What is your occupation?</h5>
      <div class="ans1">      
        <h6>1.Unskilled Worker</h6>		
        <h6>2.Skilled Worked</h6>		
        <h6>3.Petty Trader</h6>		
        <h6>4.Shop Owner</h6>		
        <h6>5.Businessman / Industrialist - No employees</h6>			
        <h6>6.Businessman / Industrialist - 1-9 employees</h6>			
        <h6>7.Businessman / Industrialist - 10+ employees</h6>			
        <h6>8.Self Employed Professional</h6>			
        <h6>9.Clerical / Salesman</h6>			
        <h6>10.Supervisory Level</h6>			
        <h6>11.Officers / Executives - Junior</h6>			
        <h6>12.Officers / Executives - Middle / Senior</h6>	
        <h6>Ans:</h6>
        <h6>{{$ans->que_26}}</h6>      
      </div>
    </div>

    <div class="qus_27">
      <h5 class="qus_27">Q.27 Which of the following categories best describes your organisation's primary industry?</h5>
      <div class="ans1">      
        @foreach($answers_27 as $k_27 => $ans_27)
            <h6>{{$k_27}}.{{$ans_27}}	</h6>
        @endforeach
           <h6>Ans:</h6>
           <h6>{{$ans->que_27}}</h6>    
      </div>
    </div>

    <div class="qus_28">
      <h5 class="qus_28">Q.28  Approximately how many employees work at your organisation (all locations)?</h5>
      <div class="ans1">      
        <h6>1.1-10</h6>
        <h6>2.10-25</h6>
        <h6>3.26-50</h6>
        <h6>4.51-100</h6>
        <h6>5.101-250</h6>
        <h6>6.251-500</h6>
        <h6>7.501-1000</h6>
        <h6>8.1001-5000</h6>
        <h6>9.Greater than 5000</h6>
        <h6>10.I don't work/I don't know</h6>
        <h6>11.Prefer not to say</h6>
        <h6>Ans:</h6>
        <h6>{{$ans->que_28}}</h6>
      </div>
    </div>

    <div class="qus_29">
      <h5 class="qus_29">Q.29  Which department do you primarily work within at your organisation?</h5>
      <div class="ans1">      
        <h6>1.Administration/General Staff</h6>
        <h6>2.Human Resources</h6>
        <h6>3.Finance/Accounting</h6>
        <h6>4.Marketing/Advertising	</h6>
        <h6>5.Technology Implementation</h6>
        <h6>6.Production</h6>
        <h6>7.Management</h6>
        <h6>8.Medical</h6>
        <h6>9.Legal/Law/Compliance</h6>
        <h6>10.Engineering</h6>
        <h6>11.Creative/Design</h6>
        <h6>12.Entertainment</h6>
        <h6>13.Customer Service/Client Service</h6>
        <h6>14.Sales/Business Development</h6>
        <h6>15.IT/IS/MIS</h6>
        <h6>16.App/Software Development</h6>
        <h6>17.Operations</h6>
        <h6>18.Procurement</h6>
        <h6>19.Executive Leadership</h6>
        <h6>20.Product Management/Product Development</h6>
        <h6>21.Market Research</h6>
        <h6>22.Research/Development</h6>
        <h6>23.Logistics/Shipping</h6>
        <h6>24.Other</h6>
        <h6>25.I don't work</h6>
        <h6>26.Prefer not to say</h6>
        <h6>Ans:</h6>
        <h6>{{$ans->que_29}}</h6>
      </div>
    </div>

    <div class="qus_30">
      <h5 class="qus_30">Q.30  If you work in your organisation's IT department, please provide more detail about your role.</h5>
      <div class="ans1">      
        @foreach($answers_30 as $k_30 => $ans_30)
          <h6>{{$k_30}}.{{$ans_30}}</h6>
        @endforeach
          <h6>Ans:</h6>
          <h6>{{$ans->que_30}}</h6>
      </div>
    </div>

    <div class="qus_31">
      <h5 class="qus_31">Q.31  What is your primary role in your organisation?</h5>
      <div class="ans1">      
        @foreach($answers_31 as $k_31 => $ans_31)
         <h6>{{$k_31}}.{{$ans_31}}</h6>
        @endforeach  
          <h6>Ans:</h6>
          <h6>{{$ans->que_31}}</h6>
      </div>
    </div>

    <div class="qus_32">
      <h5 class="qus_32">Q.32  What is your professional position in the organisation you work for?</h5>
      <div class="ans1">       
           <h6>1.Director/Manager</h6>    
           <h6>2.Not a managing position</h6>    
           <h6>3.Other decision maker</h6>    
           <h6>4.I don't work</h6>    
           <h6>5.Prefer not to say</h6>    
           <h6>Ans:</h6>    
           <h6>{{$ans->que_32}}</h6>
      </div>
    </div>

    <div class="qus_33">
      <h5 class="qus_33">Q.33  Have you been diagnosed with any of the following illnesses/conditions? Note that the information will be kept in strictest confidence.</h5>
      <div class="ans1">       
        @foreach($answers_33 as $k_33 => $ans_33)
         <h6>{{$k_33}}.{{$ans_33}}</h6>
        @endforeach 	
        <h6>Ans:</h6>
        <h6>{{$ans->que_33}}</h6>
      </div>
    </div>

    <div class="qus_34">
      <h5 class="qus_34">Q.34  If you stated that you have been diagnosed with cancer, can you define the type of cancer?</h5>
      <div class="ans1">       
        <h6>1.Bowel cancer</h6>			
        <h6>2.Breast cancer</h6>			
        <h6>3.Kidney cancer	</h6>									
        <h6>4.Leukaemia</h6>			
        <h6>5.Liver cancer</h6>			
        <h6>6.Ovarian cancer</h6>
        <h6>7.Prostate cancer</h6>			
        <h6>8.Melanoma/Skin cancer</h6>			
        <h6>9.Bladder cancer</h6>
        <h6>10.Lung cancer</h6>			
        <h6>11.Non-Hodgkin's Lymphoma</h6>			
        <h6>12.Pancreatic cancer</h6>
        <h6>13.Thyroid cancer</h6>			
        <h6>14.Other cancer type</h6>			
        <h6>15.I don't have cancer	</h6>
        <h6>16.Prefer not to say</h6> 
        <h6>Ans:</h6>
        <h6>{{$ans->que_34}}</h6>
      </div>
    </div>

    <div class="qus_35">
      <h5 class="qus_35">Q.35  If you stated that you have been diagnosed with diabetes, can you define the type of diabetes?</h5>
      <div class="ans1">       
        <h6>1.Diabetes Type 1</h6>
        <h6>2.Diabetes Type 2</h6>
        <h6>3.Diabetes Type 3	</h6>
        <h6>4.I don't have diabetes	</h6>
        <h6>5.Prefer not to say</h6>
        <h6>Ans:</h6>
        <h6>{{$ans->que_35}}</h6>
      </div>
    </div>

    <div class="qus_36">
      <h5 class="qus_36">Q.36  Do you use glasses or contact lenses?</h5>
      <div class="ans1">       
        <h6>1.Glasses</h6>
        <h6>2.Contact lenses</h6>
        <h6>3.Diabetes Type 3	</h6>
        <h6>4.Both Glasses and Contact lenses</h6>
        <h6>5.I don't use Glasses/Contact lenses</h6>	
        <h6>6.Prefer not to say</h6>
        <h6>Ans:</h6>
        <h6>{{$ans->que_36}}</h6>
      </div>
    </div>

    <div class="qus_37">
      <h5 class="qus_37">Q.37  Do you use a hearing aid?</h5>
      <div class="ans1">       
              <h6>1.YES</h6>   
              <h6>2.NO</h6>   
              <h6>Ans:</h6>
              <h6>{{$ans->que_37}}</h6>
      </div>
    </div>
    




  

   
  </div>

<div class="information" style="position: absolute; bottom: 0;">
    <table width="100%">
        <tr>
            <td align="left" >
                &copy;  All rights reserved.
            </td>
            <td align="right" style="width: 50%;">
                Arp
            </td>
        </tr>

    </table>
</div>
@endforeach
</body>
</html>