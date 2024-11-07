 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Website</title>
    {{-- css --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    {{-- javastrip --}}
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<style>
   body{
       background: rgb(63,94,251);
       background: radial-gradient(circle, rgba(63,94,251,1) 0%, rgba(252,70,107,1) 100%);
   }
</style>
<body>
    {{-- {{dd($emaildata)}} --}}
        <div class="container " style="margin-top:220px; text-align:center;">
            <h4 style="text-align:center;font-size: 38px; color:white;">Dear{{$emaildata->firstname}},</h4>
            <p style="text-align:center;font-size: 28px; color:white;">Membership Activated Successfully</p>
            <!--<h4 style="color:white;">User Email : {{$emaildata->email}}</h4>-->
            <!--<h4 style="color:white;">Password   : {{$emaildata->password}}</h4>-->
            <!--<a href="{{url('/adminapp/login')}}" style="color:rgb(251, 3, 3);">Click Here To Login</a>-->
        </div>
</body>
</html> 