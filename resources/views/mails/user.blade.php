<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notification</title>

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
        
        <p>username:{!!$data[0]!!}</p>
        <p>password:{!!$data[1]!!}</p>
        
    </div>
  
</body>

</html>