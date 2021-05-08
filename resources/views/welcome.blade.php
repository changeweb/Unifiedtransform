<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
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

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 25px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            /* Source: https://codepen.io/quasimondo/pen/lDdrF */
            #gradient
            {
            width: 100%;a
            height: 800px;
            padding: 0px;
            margin: 0px;
            }
        </style>
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    </head>
    <body id="gradient">
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="m-b-md">
                    <!-- {{config('app.name')}} -->
                    <img src="appname.svg" width="500">
                </div>
                <!-- <p style="font-size: 25px;">@lang('Makes managing schools an amazing experience')</p> -->
                <div class="links">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/home') }}">@lang('Home')</a>
                        @else
                            <a href="{{ route('login') }}">@lang('Login')</a>
                        @endauth
                    @endif
                    <a href="https://github.com/changeweb/Unifiedtransform">
                        <i class="fa fa-github"></i>
                        @lang('GitHub')
                    </a>
                </div>
            </div>
        </div>
        <script src="{{asset('js/jquery-2.1.3.min.js')}}"></script>
        <script>
            // Source: https://codepen.io/quasimondo/pen/lDdrF
            // Author: Mario Klingemann
            // Slightly modified
// var colors = new Array(
//   [120,150,255],
//   [160,255,130],
//   [255,215,199],
//   [45,175,230],
//   [255,58,255],
//   [255,128,50]);

// var step = 0;
// //color table indices for: 
// // current color left
// // next color left
// // current color right
// // next color right
// var colorIndices = [0,1,2,3];

// //transition speed
// var gradientSpeed = 0.002;

// function updateGradient()
// {
  
//   if ( $===undefined ) return;
  
// var c0_0 = colors[colorIndices[0]];
// var c0_1 = colors[colorIndices[1]];
// var c1_0 = colors[colorIndices[2]];
// var c1_1 = colors[colorIndices[3]];

// var istep = 1 - step;
// var r1 = Math.round(istep * c0_0[0] + step * c0_1[0]);
// var g1 = Math.round(istep * c0_0[1] + step * c0_1[1]);
// var b1 = Math.round(istep * c0_0[2] + step * c0_1[2]);
// var color1 = "rgb("+r1+","+g1+","+b1+")";

// var r2 = Math.round(istep * c1_0[0] + step * c1_1[0]);
// var g2 = Math.round(istep * c1_0[1] + step * c1_1[1]);
// var b2 = Math.round(istep * c1_0[2] + step * c1_1[2]);
// var color2 = "rgb("+r2+","+g2+","+b2+")";

//  $('#gradient').css({
//    background: "-webkit-gradient(linear, left top, right top, from("+color1+"), to("+color2+"))"}).css({
//     background: "-moz-linear-gradient(left, "+color1+" 0%, "+color2+" 100%)"});
  
//   step += gradientSpeed;
//   if ( step >= 1 )
//   {
//     step %= 1;
//     colorIndices[0] = colorIndices[1];
//     colorIndices[2] = colorIndices[3];
    
//     //pick two new target color indices
//     //do not pick the same as the current one
//     colorIndices[1] = ( colorIndices[1] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length;
//     colorIndices[3] = ( colorIndices[3] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length;
    
//   }
// }

// setInterval(updateGradient,10);
        </script>
    </body>
</html>
