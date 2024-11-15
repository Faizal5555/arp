<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notification</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<style>
    .fontstyle{
        font-family: "Lucida Console", "Courier New", monospace;
    }
   .button-9{
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
        <h3>Dear Doctor / Healthcare Practitioner,</h3>
        <p>{!! nl2br(e($emailContent)) !!}</p>
        <p>Kindly click the link below to register:</p>
        <a type="button" href="{{url('/adminapp/newdoctorregister')}}"> <button class="button-9" style="background: #0475f5;color:white;border-radius:5px;width:90px;outline:none;border:none;height: 31px;
                margin-top: 10px;">Next</button></a>
    </div>
  
</body>

</html>