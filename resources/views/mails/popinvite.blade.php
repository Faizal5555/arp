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
    .fontstyle {
        font-family: "Lucida Console", "Courier New", monospace;
    }

    .button-9 {
        width: 106px;
        height: 51px;
        margin: 15px;
        background: linear-gradient(43deg, #0b5dbb, #0b5dbb);
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
    }

    .button-9:disabled {
        cursor: default;
    }

    .button-9:focus {
        box-shadow: rgba(50, 50, 93, .1) 0 0 0 1px inset, rgba(50, 50, 93, .2) 0 6px 15px 0, rgba(0, 0, 0, .1) 0 2px 2px 0, rgba(50, 151, 211, .3) 0 0 0 4px;
    }

    h3 {
        text-align: center;
    }
    .container {
     height: 200px;
     position: relative;
    }
    .center {
     margin: 0;
     position: absolute;
     top: 50%;
     left: 50%;
    -ms-transform: translate(100%, 100%);
     transform: translate(100%, 100%);
    }
</style>

<body>
    <div class="container">
        <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;table-layout:fixed;background-color:#4374e0!important;border-top-right-radius:25px;border-top-left-radius:25px;">

            <p style="color:white;font-size:25px;padding-top:22px;text-align: center;margin:auto">General User Notification</p>

            <br>
        </div>

        <div class="vertical-center" style="max-width:200px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;table-layout:fixed;">
            <h2></h2>
            <a type="button" href="{{url('/adminapp/lang/home').'/'.$url[1]}}" style="text-align: center; margin-left: 60px;"> <button class="button-9" style="background: #0475f5;color:white;border-radius:5px;width:90px;outline:none;border:none;height: 31px;
                margin-top: 10px;">Click here</button></a>
               

        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;table-layout:fixed;background-color: #4374e0!important;border-bottom-right-radius:25px;border-bottom-left-radius:25px;height: 71px;">

                    

                    <br>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>




</body>

</html>