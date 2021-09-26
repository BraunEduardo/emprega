<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Emprega - @yield('titulo')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html,
            body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
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

            .title {
                font-size: 40px;
            }

            @media (min-width: 768px) {
                .title {
                    font-size: 84px;
                }
            }

            .fab {
                position: fixed;
                bottom: 10px;
                right: 10px;
            }
        </style>
    </head>

    <body {{ $_COOKIE['hc']=='true' ? 'class=contrast' : '' }}>
        <div class="flex-center position-ref full-height">
            @yield('conteudo')
        </div>
        <button type="button" class="fab btn btn-dark" title="Ativar modo de alto contraste" onclick="toggleHC();"><i class="fa fa-adjust"></i></button>
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <script>
            function setCookie(cname, cvalue, exdays) {
                const d = new Date();
                d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                let expires = "expires=" + d.toUTCString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            }

            function getCookie(cname) {
                let name = cname + "=";
                let decodedCookie = decodeURIComponent(document.cookie);
                let ca = decodedCookie.split(';');
                for (let i = 0; i < ca.length; i++) {
                    let c = ca[i];
                    while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                }
                return "";
            }

            function toggleHC() {
                if (getCookie('hc') === 'true') {
                    setCookie('hc', 'false');
                } else {
                    setCookie('hc', 'true');
                }

                document.body.classList.toggle('contrast');

            }
        </script>
        @yield('script')
    </body>

</html>
