@extends('layouts.master')
  <style>
    .header {
      background: linear-gradient(43deg, #0b5dbb, #0b5dbb);

    }

    .error {
      color: red;
      margin-top: 3px;
    }
    .card-header{
      background-color: #007bff;
    }
    .dropdown .dropdown-menu .dropdown-item:hover {
    background-color: #3777b8;
    color: #f7eded;
    }
    .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
    width: 80%;
     }
     body{
         overflow-x:hidden;
     }
     h3.title-2 {
    margin-top: 18px;
    }
    .title-3 {
    margin-top: 18px;
   }
   .title-4 {
    margin-top: 18px;
   }
   #success h4 {
    color: #DC3545;
    text-align:center;
   }
   #success p {
    text-align:center;
   }
   .main-panel {
    background-color: #f8f8f8;
   }
   .card-header{
    background: linear-gradient(43deg,#0b5dbb,#0b5dbb);
    color: #fff;
   }
  </style>
  @section('page_title', 'Client List')
  @section('content')
    <div class="lang-question-ans mt-4">
    <form id="register">
    <div class="row ">
    <div class="container">
    <div class="col-md-12">
    <div class="conatiner">
        <div class="card">
           <h5 class="card-header">Registration</h5>
      <div class="card-body">
        @foreach($pdf1 as $ans_key=> $ans)
             


             <!--persoanl info-->
     
              <div class="lang-personal ">
              <div class="col-md-12 mt-2">
                    <div class="row">
                       <div class="col-md-6 mt-3">
                         <label>Country<p>
                       </div>
                      <div class="col-md-6 mt-1">
     
                        <div class="form-check">
                          <input class="form-control" type="text" name="Country"  value="{{$ans->country}}" required readonly="readonly">
                          </label>
                        </div>
     
                      </div>
                    </div>

              <div class="row">
                <div class="col-md-6 mt-3">
                  <label>First Name<p>
                </div>
                <div class="col-md-6 mt-1">

                  <div class="form-check">
                    <input class="form-control lang-name lang-cal" type="text" name="fname" value="{{$ans->fname}}" required readonly="readonly">
                    </label>
                  </div>

                </div>
              </div>


              <div class="row">
                <div class="col-md-6 mt-3">
                  <label>Last Name<p>
                </div>
                <div class="col-md-6 mt-1">

                  <div class="form-check">
                    <input class="form-control lang-name lang-cal1" type="text" name="lname"  value="{{$ans->lname}}" required readonly="readonly">
                    </label>
                  </div>

                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mt-3">
                  <label>Mobile Number
                    <p>
                </div>
                <div class="col-md-6 mt-1">

                  <div class="form-check">
                    <input class="form-control lang-name lang-cal2" type="number" name="phone" minlength="9" minlength="10" value="{{$ans->phone}}" required readonly="readonly">
                    </label>
                  </div>

                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mt-3">
                  <label>Email<p>
                </div>
                <div class="col-md-6 mt-1">

                  <div class="form-check">
                    <input class="form-control lang-name lang-cal3" type="email" name="email" required pattern="[^@]+@[^@]+\.[com]{3,6}" value="{{$ans->email}}" readonly="readonly">
                    </label>
                  </div>

                </div>
              </div>



              <div class="row">
                <div class="col-md-6 mt-3">
                  <label>Address<p>
                </div>
                <div class="col-md-6 mt-1">

                  <div class="form-check">
                      <textarea class="form-control lang-name lang-cal4" name="address"
                      rows="5" cols="33" value="{{$ans->address}}" readonly="readonly"></textarea>
                    <!--<input class="form-control lang-name lang-cal4" type="text" name="address" required>-->
                    </label>
                  </div>

                </div>
              </div>


              <div class="row">
                <div class="col-md-6 mt-3">
                  <label>Zip Code<p>
                </div>
                <div class="col-md-6 mt-1">

                  <div class="form-check">
                    <input class="form-control lang-name lang-cal5" type="number" name="zipcode" required value="{{$ans->zipcode}}" readonly="readonly">
                    </label>
                  </div>

                </div>
              </div>
           

          

              </div>
              </div>
             <!--end persoanl info-->
          
             <!--All Questions-->
              <!-- Questions-1 -->
              <div class="lang-first-que mt-4">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.1 How would you characterize the place where you live?</h5>
                        </div>
                          <div class="ans1 ml-2">
                              <h6>1.URBAN</h6> 
                          </div>
                          <div class="ans1 ml-2">
                            <h6>2.SUB URBAN</h6>   
                          </div>
                           <div class="ans1 ml-2">
                                <h6>3.URBAN</h6>    
                           </div>
                           <div class="ans1 ml-2">
                                <h6>Ans:</h6>
                                {{$ans->que_1}}

                           </div>
                    </div>

                    </div>
                    
                      

                </div>
              </div>
              <!-- Questions-1 -->

              <!-- Questions-2 -->
              <div class="lang-second-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.2 QWhat type of research (except online surveys) are you interested to be invited to participate in? (Additional incentives are paid)?</h5>
                        </div>
                        <div class="ans ml-2">
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
                              {{$ans->que_2}}

                           </div>
                    </div>

                    </div>
                    
                      

                </div>
              </div>
              <!-- Questions-2 -->

              <!-- Questions-3 -->
              <div class="lang-third-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.3 Does the computer you primarily use to interact with research studies have a web camera?</h5>
                        </div>
                          <div class="ans ml-2">
                                <h6>1.Yes</h6>
                          </div>
                          <div class="ans ml-2">
                              <h6>2.No</h6>
                          </div>
                          <div class="ans ml-2">
                             <h6>Ans:<h6>
                               {{$ans->que_3}}
                         </div>
                    </div>

                    </div>
                   
                      

                </div>
              </div>
              <!-- Questions-3 -->

              <!-- Questions-4 -->
              <div class="lang-four-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.4 Would you be willing to participate in a research study that reads your facial expressions to analyse emotional response? The data is fully anonymous and would be used for research purposes only.</h5>
                        </div>
                          <div class="ans ml-2">
                                <h6>1.Yes</h6>
                          </div>
                          <div class="ans ml-2">
                              <h6>2.No</h6>
                          </div>
                          <div class="ans ml-2">
                             <h6>Ans:<h6>
                               {{$ans->que_4}}
                         </div>
                    </div>

                    </div>
                   
                      

                </div>
              </div>
              <!-- Questions-4 -->

              											
             
              <!-- Questions-5 -->
              <div class="lang-five-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.5   Do you agree to opt-in and participate in types of research that may require you to download an application (on mobile, PC or tablet) that will track your online behaviour?</h5>
                        </div>
                          <div class="ans ml-2">
                                <h6>1.Yes</h6>
                          </div>
                          <div class="ans ml-2">
                              <h6>2.No</h6>
                          </div>
                          <div class="ans ml-2">
                             <h6>Ans:<h6>
                               {{$ans->que_5}}
                         </div>
                    </div>

                    </div>
                   
                      

                </div>
              </div>
              <!-- Questions-5 -->

              <!-- Questions-6 -->
              <div class="lang-six-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.6 Do you agree to opt-in and participate in types of research that may require cookies to be dropped onto your Mobile/PC/Tablet that will track your exposure to certain advertising?</h5>
                        </div>
                        <div class="ans ml-2">
                                <h6>1.Yes</h6>
                          </div>
                          <div class="ans ml-2">
                              <h6>2.No</h6>
                          </div>
                          <div class="ans ml-2">
                              <h6>3.Next</h6>
                          </div>
                          <div class="ans ml-2">
                             <h6>Ans:<h6>
                               {{$ans->que_6}}
                         </div>
                         
                    </div>

                    </div>
                    
                      

                </div>
              </div>
              <!-- Questions-6 -->

              <!-- Questions-7 -->
              <div class="lang-seven-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.7 What is your highest level of education?</h5>
                        </div>
                          <div class="ans ml-2">
                                 
                                <h6>1.Illiterate</h6>   
                          </div>
                          <div class="ans ml-2">
                                <h6>2.Literate but no formal schooling</h6>
                          </div>
                          <div class="ans ml-2">
                                <h6>3.School - up to 4 years</h6>    
                          </div>
                          <div class="ans ml-2"> 
                                <h6>4.School - 5 to 9 years</h6>    
                          </div>
                          <div class="ans ml-2">
                                 <h6>5.SSC / HSC</h6>
                          </div>
                          <div class="ans ml-2">
                                <h6>6.Some College but not graduate</h6>
                          </div>
                          <div class="ans ml-2"> 
                                <h6>7.Graduate / Post Graduate - General</h6> 
                          </div>
                          <div class="ans ml-2">
                                <h6>8.Graduate / Post Graduate - Professional</h6>
                          </div>
                          <div class="ans ml-2">
                                <h6>9.PhD</h6>
                          </div>
                          <div class="ans ml-2">
                                <h6>10.Masters/Post-Graduate</h6>  
                          </div>
                          <div class="ans ml-2">
                                <h6>11.MBA</h6>
                          </div>
                          <div class="ans ml-2">
                                <h6>Ans:</h6>
                                 {{$ans->que_7}}
                          </div>
                    </div>

                    </div>
                      

                </div>
              </div>
              <!-- Questions-7 -->
  
              <!-- Questions-8 -->
              <div class="lang-eight-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.8 What year did you graduate from university/college?</h5>
                        </div>
                        <div class="ans ml-2">
                        <div class="container mt-5">
                            @foreach($answers_9 as $k_9=> $ans_9)
                            <h6>{{$k_9}}.{{$ans_9}}</h6>
                            @endforeach
                            <h6>Ans:</h6>
                            {{$ans->que_8}}
                          
                        </div>
                              											

                            
                          </div>
                    </div>

                    </div>  

                </div>
              </div>
              <!-- Questions-8 -->

              <!-- Questions-9 -->
              <div class="lang-nine-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.9 On average, how many hours of television do you watch per week?</h5>
                        </div>
                          <div class="ans ml-2"> 
                               <h6>1.I don t watch TV	</h6>   
                          </div>
                          <div class="ans ml-2">
                               <h6>2.5 hours or less</h6>   
                          </div>
                          <div class="ans ml-2">
                               <h6>3.6 to 10 hours</h6>   
                          </div>
                          <div class="ans ml-2"> 
                                <h6>4.11 to 20 hours</h6>   
                          </div>
                          <div class="ans ml-2">
                               <h6>5.More than 20 hours</h6>   
                          </div>
                          <div class="ans ml-2">
                               <h6>6.Prefer not to say</h6>   
                          </div>
                          <div class="ans ml-2">
                               <h6>Ans:</h6>
                               {{$ans->que_9}}   
                          </div>
                    </div>

                    </div>
                    
                      

                </div>
              </div>
              <!-- Questions-9 -->

              <!-- Questions-10 -->
              <div class="lang-ten-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.10 Do you smoke?</h5>
                        </div>
                          <div class="ans ml-2"> 
                                <h6>1.Yes, I smoke</h6>    
                          </div>
                          <div class="ans ml-2">
                                <h6>2.Yes, I smoke now and then</h6>    
                          </div>
                          <div class="ans ml-2">
                               <h6>3.Yes, I smoke but I m planning to quit</h6>    
                          </div>
                          <div class="ans ml-2"> 
                                <h6>4.No, I have quit</h6>    
                          </div>
                          <div class="ans ml-2">
                                <h6>5.No, I don’t smoke</h6>    
                          </div>
                          <div class="ans ml-2">
                                <h6>6.No, I don’t smoke, but use other tobacco products</h6>    
                          </div>
                          <div class="ans ml-2">
                               <h6>7.Prefer not to say</h6>    
                          </div>
                          <div class="ans ml-2">
                               <h6>Ans:</h6>    
                               {{$ans->que_10}}
                          </div>
                    </div>

                    </div>
                    
                </div>
              </div>
              <!-- Questions-10 -->

              <!-- Questions-11 -->
              <div class="lang-eleven-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">  </h5>
                        </div>
                        <div class="ans ml-2">
                            @foreach($answers_11 as $k=> $ans_11)
                              <h6>{{$k}}.{{$ans_11}}</h6>
                            @endforeach
                              <h6>Ans:</h6>
                               {{$ans->que_11}}
                        </div>
                         
                    </div>

                  </div>
                    
                </div>
              </div>
              <!-- Questions-11 -->

              <!-- Questions-12 -->
              <div class="lang-twelve-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.12 On average, how many cigarettes do you smoke in a day?</h5>
                        </div>
                          <div class="ans ml-2"> 
                                <h6>1.I dont smoke cigarettes</h6>    
                          </div>
                          <div class="ans ml-2">
                               <h6>2.1 to 3 cigarettes</h6>    
                          </div>
                          <div class="ans ml-2">
                               <h6>3.4 to 6 cigarettes</h6>    
                          </div>
                          <div class="ans ml-2"> 
                                <h6>4.7 to 10 cigarettes</h6>    
                          </div>
                          <div class="ans ml-2">
                               <h6>5.More than 10 cigarettes</h6>    
                          </div>
                          <div class="ans ml-2">
                               <h6>6.Prefer not to say</h6>    
                          </div>
                          <div class="ans ml-2">
                               <h6>Ans:</h6> 
                               {{$ans->que_12}}   
                          </div>
                    </div>
                         
                  </div>
                </div>
              </div>
              <!-- Questions-12 -->

              <!-- Questions-13 -->
              <div class="lang-thirteen-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.13 Do you have access to a car?</h5>
                        </div>
                          <div class="ans ml-2"> 
                                <h6>1.I own a car/cars<h6>
                                </label>    
                          </div>
                          <div class="ans ml-2">
                               <h6>2.I lease/have a company car<h6>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                               <h6>3.I have access to a car/cars<h6>
                              </label>    
                          </div>
                          <div class="ans ml-2"> 
                                <h6>4.No, I dont have access to a car<h6>
                                </label>    
                          </div>
                          <div class="ans ml-2">
                               <h6>5.Prefer not to say<h6>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                               <h6>Ans:<h6>
                                {{$ans->que_13}}

                              </label>    
                          </div>
                    </div>       
                  </div>

                  
                      

                </div>
              </div>
              <!-- Questions-13 -->

              <!-- Questions-14 -->
              <div class="lang-fourteen-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.14 Are you the primary decision maker in your household for automotive-related purchases?</h5>
                        </div>
                          <div class="ans ml-2">  
                            <h6>1.Yes<h6>    
                          </div>
                          <div class="ans ml-2">
                            <h6>2.No<h6>    
                          </div>
                          <div class="ans ml-2">
                            <h6>3.I contribute equally in automotive decisions<h6>    
                          </div>
                          <div class="ans ml-2"> 
                            <h6>4.Prefer not to say<h6>    
                          </div>
                          <div class="ans ml-2"> 
                            <h6>Ans:<h6>    
                                {{$ans->que_14}}
                          </div>
                    </div>
                         
                  </div>

                </div>
              </div>
              <!-- Questions-14 -->

              <!-- Questions-15 -->
              <div class="lang-fifteen-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.15 How many cars are there in your household (including leasing or company cars)?</h5>
                        </div>
                          <div class="ans ml-2"> 
                                <h6>1.1</h6>    
                          </div>
                          <div class="ans ml-2">
                               <h6>2.2</h6>    
                          </div>
                          <div class="ans ml-2">
                               <h6>3.3</h6>    
                          </div>
                          <div class="ans ml-2"> 
                                <h6>4.4</h6>    
                          </div>
                          <div class="ans ml-2"> 
                                <h6>5.OR MORE</h6>    
                          </div>
                          <div class="ans ml-2"> 
                                <h6>Ans:</h6>   
                                 {{$ans->que_15}} 
                          </div>
                    </div>
                         
                  </div>
                </div>
              </div>
              <!-- Questions-15 -->

              <!-- Questions-16 -->
              <div class="lang-sixteen-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.16 If you own/lease a car(s), which brand are they?</h5>
                        </div>
                        <div class="ans ml-2">
                          @foreach($answers_16 as $k_16 => $ans_16)
                              <h6>{{$k_16}}.{{$ans_16}}</h6>
                          @endforeach
                             <h6>Ans:</h6>
                              {{$ans->que_16}}
                        </div>
                    </div>
                         
                  </div>

                      

                </div>
              </div>
              <!-- Questions-16 -->

              <!-- Questions-17 -->
              <div class="lang-seventeen-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.17 How would you describe the car(s) you own/lease?</h5>
                        </div>
                        <div class="ans ml-2">
                          @foreach($answers_17 as $k_17 => $ans_17)
                              <h6>{{ $k_17 }}.{{$ans_17}}</h6>
                          @endforeach
                              <h6>{{$ans->que_17}}</h6>
                        </div>
                         
                         
                    </div>

                  </div>
                      

                </div>
              </div>
              <!-- Questions-17 -->

              <!-- Questions-18 -->
              <div class="lang-eighteen-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.18 What year was your main car (owned or leased) manufactured?</h5>
                        </div>
                        <div class="ans ml-2">
                        
                          @foreach($answers_18 as $k_18 => $ans_18)
                              <h6>{{$k_18}}.{{$ans_18}}</h6>
                          @endforeach
                              <h6>Ans:</h6>
                              {{$ans->que_18}}
                        </div>
                         
                    </div>

                  </div>                      

                </div>
              </div>
              <!-- Questions-18 -->

              <!-- Questions-19 -->
              <div class="lang-nineteen-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.19 Do you own a motorcycle?</h5>
                        </div>
                        <div class="ans ml-2"> 
                                <h6>1.Yes</h6>    
                          </div>
                          <div class="ans ml-2">
                               <h6>2.No</h6>  
                          </div>
                          <div class="ans ml-2">
                               <h6>Ans:</h6>  
                               {{$ans->que_19}}
                          </div>
                        
                         
                    </div>

                  </div>
                </div>
              </div>
              <!-- Questions-19 -->

              <!-- Questions-20 -->
              <div class="lang-twenty-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.20 If you own a two wheeled vehicle, which brand are they?</h5>
                        </div>
                        <div class="ans ml-2">
                            @foreach($answers_20 as $k_20 => $ans_20)
                               <h6>{{$k_20}},{{$ans_20}}</h6>
                            @endforeach
                            <h6>Ans:</h6>
                            {{$ans->que_20}}
                        </div>

                       
                         
                    </div>

                  </div>
                
                </div>
              </div>
              <!-- Questions-20-->

              <!-- Questions-21 -->
              <div class="lang-twenty-one-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.21 If you own a two wheeled vehicle, what engine capacity does it have?</h5>
                        </div>
                        <div class="ans ml-2">
                            <h6>1.Less than 100 CC</h6>  
                            <h6>2.100-149 CC</h6>
                            <h6>3.150-199 CC</h6>
                            <h6>4.200 CC+</h6>
                            <h6>5.I don’t own a two wheeled vehicle</h6>
                            <h6>6.Prefer not to say</h6>
                            <h6>Ans:</h6>
                            {{$ans->que_21}}
                        </div>
                         
                    </div>

                  </div>
                </div>
              </div>
              <!-- Questions-21 -->

              <!-- Questions-22 -->
              <div class="lang-twenty-two-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.22 If you own a two wheeled vehicle, how would you describe it?</h5>
                        </div>
                          <div class="ans ml-2"> 
                                <h6>1.I don’t own a two wheeled vehicle</h6>    
                          </div>
                          <div class="ans ml-2">
                               <h6>2.Standard</h6>    
                          </div>
                          <div class="ans ml-2">
                               <h6>3.Cruiser</h6>    
                          </div>
                          <div class="ans ml-2"> 
                                <h6>4.Sports bike</h6>    
                          </div>
                          <div class="ans ml-2">
                               <h6>5.Touring</h6>    
                          </div>
                          <div class="ans ml-2">
                               <h6>6.Sports touring</h6>    
                          </div>
                          <div class="ans ml-2"> 
                                <h6>7.Dual-sport</h6>    
                          </div>
                          <div class="ans ml-2">
                               <h6>8.Scooter, underbone or moped</h6>    
                          </div>
                          <div class="ans ml-2">
                               <h6>9.Other</h6>    
                          </div>
                          <div class="ans ml-2"> 
                                <h6>10.Prefer not to say</h6>    
                          </div>
                          <div class="ans ml-2"> 
                                <h6>Ans:</h6>
                                {{$ans->que_22}}    
                          </div>
                    </div>
                         
                  </div>
                      
                </div>
              </div>
              <!-- Questions-22 -->

              <!-- Questions-23 -->
              <div class="lang-twenty-three-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.23 If you own/lease a car(s), what fuel do they use?</h5>
                        </div>
                        <div class="ans ml-2">
                              <h6>1.Bio-diesel / Bio-gas</h6>			
                              <h6>2.Diesel</h6>			
                              <h6>3.Electric (EV)</h6>		
                              <h6>4.Ethanol / Flexible Fuel (FFV)</h6>			
                              <h6>5.Hybrid (HEV/PHEV)</h6>			
                              <h6>6.Hydrogen / Fuel Cell (FCEV)</h6>			
                              <h6>7.Natural Gas (NGV)</h6>			
                              <h6>8.Petrol / Gasoline</h6>			
                              <h6>9.Propane / Liquefied Petroleum Gas (LPG)</h6>			
                              <h6>10.>Other</h6>			
                              <h6>11.>None of the above</h6>			
                              <h6>12.>I dont own/lease a car</h6>	
                              <h6>Ans:</h6>
                              {{$ans->que_23}}
                        </div>		
                    </div>       
                  </div>
  

                </div>
              </div>
              <!-- Questions-23 -->

              <!-- Questions-24 -->
              <div class="lang-twenty-four-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.24 Are you considering buying or leasing a new or used car within the next 2 years?</h5>
                        </div>
                          <div class="ans ml-2"> 
                                <h6>1.No, I m not considering it</h6>    
                          </div>
                          <div class="ans ml-2">
                               <h6>2.Yes, I m considering buying or leasing a used car</h6>    
                          </div>
                          <div class="ans ml-2">
                               <h6>3.Yes, Im considering buying or leasing a new car</h6>    
                          </div>
                          <div class="ans ml-2"> 
                                <h6>4.Yes, but unsure if the car will be used or new</h6>    
                          </div>
                          <div class="ans ml-2"> 
                                <h6>5.I do not know</h6>    
                          </div>
                          <div class="ans ml-2"> 
                                <h6>Ans:</h6>
                                {{$ans->que_24}}    
                          </div>
                    </div>
                         
                  </div>

                      

                </div>
              </div>
              <!-- Questions-24 -->

              <!-- Questions-25 no-->
              <div class="lang-twenty-five-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.25 What is your current occupational status?</h5>
                        </div>
                          <div class="ans ml-2"> 
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
                                   {{$ans->que_25}}	     
                          </div>
                    </div>
                         
                  </div>          

                </div>
              </div>
              <!-- Questions-25 -->

              <!-- Questions-26 -->
              <div class="lang-twenty-six-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.26 What is your occupation?</h5>
                        </div>
                        <div class="ans ml-2">
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
                              {{$ans->que_26}}	
                        </div>
                    </div>
                         
                  </div>

                      

                </div>
              </div>
              <!-- Questions-26 -->

              <!-- Questions-27 -->
              <div class="lang-twenty-seven-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.27 Which of the following categories best describes your organisation's primary industry?</h5>
                        </div>
                        <div class="ans ml-2">
                          @foreach($answers_27 as $k_27 => $ans_27)
                              <h6>{{$k_27}}.{{$ans_27}}	</h6>
                          @endforeach
                             <h6>Ans:</h6>
                             {{$ans->que_27}}
                        </div>
                         
                         
                    </div>

                  </div>
                </div>
              </div>
              <!-- Questions-27 -->

              <!-- Questions-28 -->
              <div class="lang-twenty-eight-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.28  Approximately how many employees work at your organisation (all locations)?</h5>
                        </div>
                        <div class="ans ml-2">
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
                              {{$ans->que_28}}
                        </div>
                         
                    </div>

                  </div>
                   
                      

                </div>
              </div>
              <!-- Questions-28 -->

              <!-- Questions-29 -->
              <div class="lang-twenty-nine-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.29  Which department do you primarily work within at your organisation?</h5>
                        </div>
                          <div class="ans ml-2">								
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
                           {{$ans->que_29}} 
                          </div>    
                    </div>
                  </div>
                </div>
              </div>
              <!-- Questions-29 -->

              <!-- Questions-30 -->
              <div class="lang-thirty-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.30  If you work in your organisation's IT department, please provide more detail about your role.</h5>
                        </div>
                        <div class="ans ml-2">
                            @foreach($answers_30 as $k_30 => $ans_30)
                              <h6>{{$k_30}}.{{$ans_30}}</h6>
                            @endforeach
                              <h6>Ans:</h6>
                               {{$ans->que_30}}
                        </div>

                       
                         
                    </div>

                  </div>
                </div>
              </div>
              <!-- Questions-30-->

              <!-- Questions-31 -->
              <div class="lang-thirty-one-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.31  What is your primary role in your organisation?</h5>
                        </div>
                        <div class="ans ml-2">
                            @foreach($answers_31 as $k_31 => $ans_31)
                             <h6>{{$k_31}}.{{$ans_31}}</h6>
                            @endforeach  
                              <h6>Ans:</h6>
                               {{$ans->que_31}}   
                        </div>
                         
                    </div>

                  </div>
                </div>
              </div>
              <!-- Questions-31 -->

              <!-- Questions-32 -->
              <div class="lang-thirty-two-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.32  What is your professional position in the organisation you work for?</h5>
                        </div>
                          <div class="ans ml-2"> 
                                <h6>1.Director/Manager<h6>    
                          </div>
                          <div class="ans ml-2">
                               <h6>2.Not a managing position<h6>    
                          </div>
                          <div class="ans ml-2">
                               <h6>3.Other decision maker<h6>    
                          </div>
                          <div class="ans ml-2"> 
                                <h6>4.I don't work<h6>    
                          </div>
                          <div class="ans ml-2">
                               <h6>5.Prefer not to say<h6>    
                          </div>
                          <div class="ans ml-2">
                               <h6>Ans:<h6>    
                                {{$ans->que_32}}
                          </div>
                    </div>
                         
                  </div>
                      

                </div>
              </div>
              <!-- Questions-32 -->

              <!-- Questions-33 -->
              <div class="lang-thirty-three-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.33  Have you been diagnosed with any of the following illnesses/conditions? Note that the information will be kept in strictest confidence.</h5>
                        </div>
                        <div class="ans ml-2">
                              @foreach($answers_33 as $k_33 => $ans_33)
                               <h6>{{$k_33}}.{{$ans_33}}</h6>
                              @endforeach 	
                              <h6>Ans:</h6>
                              {{$ans->que_33}}
                        </div>		
                    </div>       
                  </div>

                      

                </div>
              </div>
              <!-- Questions-33 -->

              <!-- Questions-34 -->
              <div class="lang-thirty-four-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.34  If you stated that you have been diagnosed with cancer, can you define the type of cancer?</h5>
                        </div>
                        <div class="ans ml-2">
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
                              {{$ans->que_34}}
                        </div>	

                    </div>
                         
                  </div>

                   
                      

                </div>
              </div>
              <!-- Questions-34 -->

              <!-- Questions-35 -->
              <div class="lang-thirty-five-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.35  If you stated that you have been diagnosed with diabetes, can you define the type of diabetes?</h5>
                        </div>
                        <div class="ans ml-2">
                              <h6>1.Diabetes Type 1</h6>
                              <h6>2.Diabetes Type 2</h6>
                              <h6>3.Diabetes Type 3	</h6>
                              <h6>4.I don't have diabetes	</h6>
                              <h6>5.Prefer not to say</h6>
                              <h6>Ans:</h6>
                              {{$ans->que_35}}
                        </div>
                    </div>
                         
                  </div>

                      

                </div>
              </div>
              <!-- Questions-35 -->

              <!-- Questions-36 -->
              <div class="lang-thirty-six-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.36  Do you use glasses or contact lenses?</h5>
                        </div>
                        <div class="ans ml-2">
                              <h6>1.Glasses</h6>
                              <h6>2.Contact lenses</h6>
                              <h6>3.Diabetes Type 3	</h6>
                              <h6>4.Both Glasses and Contact lenses</h6>
                              <h6>5.I don't use Glasses/Contact lenses</h6>	
                              <h6>6.Prefer not to say</h6>
                              <h6>Ans:</h6>
                              {{$ans->que_36}}
                        </div>
                    </div>
                         
                  </div>                      

                </div>
              </div>
              <!-- Questions-36 -->

              <!-- Questions-37 -->
              <div class="lang-thirty-seven-que mt-2">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.37  Do you use a hearing aid?</h5>
                        </div>
                        <div class="ans ml-2">
                               <h6>1.YES</h6>   
                          </div>
                          <div class="ans ml-2"> 
                                <h6>2.NO</h6>   
                          </div>
                          <div class="ans ml-2"> 
                          <h6>Ans:</h6>
                              {{$ans->que_37}}
                          </div>
                         
                         
                    </div>

                  </div>
                </div>
              </div>
              <!-- Questions-37 -->
        @endforeach
              
            <!--End All Questions-->

        </div>
      </div>
    </div>
    </div>
    </div>
    </form>
    </div>
    
   <script type="text/javascript">
    
   
  </script>
  <!-- next -->
 @endsection