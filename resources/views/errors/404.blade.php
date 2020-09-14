<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    </head>

    <style>
        .err{
            float: left;
            margin-top: 1px;
        }

        .letter{
            float: left;
            position: relative;
            width: 90%;
            margin-left: 20px;
            margin-bottom:-20px;
            font-family: Arial black,Courier,sans-serif;
            color: rgb(56, 55, 55);
            /* z-index: order; */
        }

        a.back{
            color:#A52a2a;
            padding-left:50px;
        }
        a.back:hover{
            color:red;
        }

        img.gif1{ 
            /* float: left; */
            position: relative;
            margin-top: -100px;
            margin-left: auto; 
            margin-right:auto; 
            size: 120%;
            z-index: -1;
		    display: table-cell;
		    vertical-align: middle;
            text-align: center;
        }

        .search{
            position:relative;
            margin:0 auto;
            padding:0 auto;
        }
        .body{
             background-color: rgb(255, 238, 74);
       }
    </style>

    <body class="body" id="formbackground">
        <title>404</title>
        <div class="err"> 
            <div class="letter">
                <p style="font-size:80px;">Oops...</p>
                <p style="font-size:40px;">&#8195;Something is missing</p>
                <p style="font-size:30px;">&#8195;&#8195;&#8195;No page found.Sorry about that,let's keep you moving</p>
                <p style="font-size:25px;"><a href="http://www.52banana.fun/"  class='back'>ホームページに戻る</a></p>
            </div>

            <img src="{{ asset('/img/505.gif') }}" class="gif1">
        </div>
         <!-- Search Area Starts -->
        
         @include('includes.footer')
     

    
    <!-- Search Area End -->

<!-- <div class="overlay"></div> -->
    </body>


</html>

        


        
    
    


