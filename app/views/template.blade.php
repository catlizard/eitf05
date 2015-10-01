<!DOCTYPE html>
<head>
    <meta charset="utf-8"/>
    <title>
        @yield('title')
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="" name="description">
    <meta content="" name="author">

    <link rel="stylesheet" href="../assets/css/style.min.css" type="text/css">
</head>

<body>
    <header class="top-header">
        <div class="container text-right">
            @if($_SESSION['logged_in'])
                Logged in as {{$_SESSION['first_name']}} / <a href="logout">Log out</a>
            @else
                <a href="register">Register</a> / <a href="login">Log in</a>
            @endif
        </div>
    </header>

    <header class="branding">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <a href="{{APP_URL}}"><img src="../assets/img/logo.png"></a>
                </div>

                <div class="col-md-4 col-padding-small">
                    Contact Info<br>
                    (+46) 707 12 34 56
 
                </div>

                <div class="col-md-4 col-padding text-right">
                    <div class="pull-right">
                    <a class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">({{count($_SESSION['cart'])}}) My cart <span class="caret"></span></a>

                        <ul class="dropdown-menu">
                            @if(count($_SESSION['cart']) == 0) 
                                <li class="dropdown-header">Looks quite empty in here!</li>
                            @else
                                <li class="dropdown-header">You have {{count($_SESSION['cart'])}} itmes in the cart with a total value of {{$_SESSION['price']}}</li>
                                <li><a href="{{APP_URL}}/checkout">Checkout</a></li>
                            @endif
                        </ul>
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <header class="navigation">
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button class="navbar-toggle collapsed" data-target="#main-header" data-toggle="collapse" type="button">
                            <span class="icon-bar"></span> 
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button> 

                        <a class="navbar-brand" href="#">It's shopping time!</a>
                    </div>

                    <div class="collapse navbar-collapse" id="main-header">
                    </div>
                </div>
            </nav>
        </div>
    </header>


    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @yield('sidebar-left', 'Sidebar goes here')
            </div>

            <div class="col-md-9">
                @yield('content', 'Page content goes here')
            </div>
        </div>
    </div>

    @include('parts.footer')

    <script type="text/javascript" src="../assets/js/jquery.min.js"></script>	
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/toastr.min.js"></script>
    @yield('scripts')
</body>
<!-- END BODY -->
</html>