<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BetIQ</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">


        <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-114291271-4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-114291271-4');
</script>


   
        <style>
            html, body {            
               
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
                background-repeat: no-repeat;
                background-image: url('images/bg.jpg');
                background-size: 100% 100%;
           
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title{
                font-size: 34px;
            }

            .links > a {
                color: #fff;
                padding: 0 25px;
                
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">     

            <div class="content">             

                <div class="links">
                    <p style="color: #FFF; font-size: 200px;">Bet IQ</p>
                </div>

                <div class="links">
                    <p style="color: #FFF; font-size: 30px;">Your betting companion</p>
                </div>

                <div class="title m-b-md">
                    <a style="text-decoration: none; color: #ffffff;" class="btn btn-info" href="/login">Login</a>
                    <br>
                     <a style="text-decoration: none; color: #ffffff; font-size: 15px;" href="/register">Register here</a>
                     <br>
                     <span style="text-decoration: none; color: #000000; font-size: 30px;">It is better with few games</span>
                </div>

                
            </div>
        </div>
    </body>
</html>
