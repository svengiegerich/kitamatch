<!DOCTYPE html>
<html lang="en">
    <head>
        <title>KitaMatch</title>

        <!-- CSS And JavaScript -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('js/app.js' ) }}" rel="">
        <link href="{{ asset('js/bootstrap.js' ) }}" rel="">
        <script type="text/javascript" src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/minified/i18n/jquery-ui-i18n.min.js"></script>
    </head>

    <body class=".bg-light">
        <div class="container">
            <nav class="navbar navbar-default">
                <!-- Navbar Contents -->
            </nav>
            
            <div class="py-5 text-center">   
                <h2>KitaMatch</h2>
                <p class="lead"></p>
            </div>

            @yield('content')
        
        </div>
        
        <br>
        <br>
        <br>
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>