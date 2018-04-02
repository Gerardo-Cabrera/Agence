<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.3/combined/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.3/combined/js/gijgo.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.3/combined/js/messages/messages.es-es.js" type="text/javascript"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/classConsultores.js') }}" ></script>
</head>
<body>
    <table cellSpacing=0 cellPadding=0 width="100%" border=0>
        <tbody>
            <tr>
                <td style="border-bottom: #ccc 1px solid">&nbsp;</td>
                <td width=98 background="" height=40 rowSpan=2>
                    <a href="http://www.agence.com.br/" target=_blank>
                        <img alt="" src="{{ asset('inc/logo.gif') }}" border=0>
                    </a>
                </td>
            </tr>
            <tr>
                <td style="padding-right: 3px; padding-left: 3px; padding-bottom: 3px; border-left: #ccc 1px dotted; padding-top: 3px">
                    <img height=15 alt="" src="inc/fig.gif" width=51 border=0>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="container">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
    </div>
</body>
</html>