<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Beetroot Family Portal</title>

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/ico" href="{{ asset('favicon.ico') }}"/>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,200,300,400,500,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #A51140;
                font-family: 'Roboto', sans-serif;
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

            .content {
                text-align: center;
                max-width: 768px;
                padding: 0 15px;
            }

            .title {
                font-size: 60px;
                font-weight: 500;
            }

            .subtitle {
                font-size: 30px;
                font-weight: 300;
            }

            a {
                color: #A51140;
                font-size: 24px;
            }

            .m-b-md {
                margin-bottom: 20px;
            }

            .background-image {
                background-image: url("{{ asset('images/welcome.svg') }}");
                height: 100%;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }

            @media (max-width: 768px) {
                .title {
                    font-size: 36px;
                }

                .subtitle {
                    font-size: 24px;
                }

                .content {
                    max-width: 90%;
                }

                a {
                    font-size: 20px;
                }
            }
        </style>

        <!-- Scripts -->
        <script defer src="https://use.fontawesome.com/releases/v5.2.0/js/all.js"></script>
    </head>
    <body class="background-image">
        <div class="flex-center full-height">

            <div class="content">
                <div class="title m-b-md">
                    Look who's here!
                </div>

                <div class="subtitle">
                    <p>
                        You're about to dive into a Beetroot family portal,
                        where all the information about your fellow beets,
                        their clients and offices is stored.
                        Does it sound exciting? Then let's roll!
                    </p>

                    <a href="@auth {{ route('dashboard') }} @else {{ @route('login') }} @endauth">
                        Go to portal
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
