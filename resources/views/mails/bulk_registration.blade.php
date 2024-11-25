<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>
<style>
    .fontstyle{
        font-family: "Lucida Console", "Courier New", monospace;
    }
    .activebutton{
        width: 106px;
        height: 51px;
        margin: 15px;
        background: linear-gradient(43deg,#0b5dbb,#0b5dbb);
        color: whitesmoke;
        border-radius: 8px;
        }
  
        .button-9 {
        margin: 15px;
        appearance: button;
        backface-visibility: hidden;
        background-color: #405cf5;
        border-radius: 6px;
        border-width: 0;
        /* box-shadow: rgba(50, 50, 93, .1) 0 0 0 1px inset,rgba(50, 50, 93, .1) 0 2px 5px 0,rgba(0, 0, 0, .07) 0 1px 1px 0;
        box-sizing: border-box;
        color: #fff;
        cursor: pointer;
        font-family: -apple-system,system-ui,"Segoe UI",Roboto,"Helvetica Neue",Ubuntu,sans-serif;
        font-size: 100%;
        height: 44px;
        line-height: 1.15;
        margin: 12px 0 0;
        outline: none;
        overflow: hidden;
        padding: 0 25px;
        position: relative;
        text-align: center;
        text-transform: none;
        transform: translateZ(0);
        transition: all .2s,box-shadow .08s ease-in;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
        width: 100%; */
        }   

        .button-9:disabled {
        cursor: default;
        }

        .button-9:focus {
        box-shadow: rgba(50, 50, 93, .1) 0 0 0 1px inset, rgba(50, 50, 93, .2) 0 6px 15px 0, rgba(0, 0, 0, .1) 0 2px 2px 0, rgba(50, 151, 211, .3) 0 0 0 4px;
        }
</style>
<body>
    <div class="container">
            <h4 style="color:#405cf5;" >Dear Sir/Madam,</h4>
            <p>We are an international market research organisation with offices in India, Dubai, New Zealand and London and we conduct market research surveys to understand the behaviour and perception of consumers towards different products and services.</p>
            <p>We invite and ask people like yourself to participate in our phone / online surveys and we people who participate in our surveys get paid for their time.</p>
            <p>So today we would like to invite you to register yourself and become our panel member for online or Phone surveys.</p>
            <p>Once you register with us, we will start sending you surveys that matches to your profile.</p>
            <p>To register yourself you just need to click on the following link and we will get back to you accordingly.</p> 
            <p><span style="font-weight:bold;">Kindly note that this is a free registration and you do not have to pay anything for the same.</span></p> 
            <div  style="width:100%;  height:50px; display:flex;" >
                <a type="button" href="{{url('/adminapp/user/activation/').'/'.$data[1]}}"> <button class="button-9" style="background: #0475f5;color:white;border-radius:5px;width:90px;outline:none;border:none;height: 31px;
                margin-top: 10px;">Activate</button></a>
                {{-- <p style="margin-top:15px;">Please attach your medical registration certificate / document to verify that you are a medical profession </p> --}}
            </div>
            <p class="fontstyle">Thank you and Regards <br>Operations Team</p>
           
            
    </div>
  
</body>

</html>