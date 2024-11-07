<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email User</title>
</head>
<body>
    <h4>Dear  <span style="color:blue">{{$details->firstname}}</span>,</h4>
    <h4>Membership Activated Successfully!</h4>
    <h4>username : {{$details->email}}</h4>
    <h4>password : {{$details->password}}</h4>
</body>
</html>