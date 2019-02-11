<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">
    <link rel="stylesheet" href="{{asset('client/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('client/css/main.css')}}">
    <link rel="icon"
          href="{{asset('images/LOGO.jpg')}}">
    @yield('stylesheets')
    <title>@yield('title')</title>
</head>

<body>
<header style="padding: 0;" class="header bg">
    <div class="container text-white">
        <div class="row">
            <div class="col-sm-4 align-self-center text-left">
                {{--<h6>Estd 1905</h6>--}}
            </div>
            <div class="col-sm-4 col-12 align-self-center box-1 text-center">
                <a class="navbar-brand" href="/"><img style="max-height: 70px;max-width: 200px;" src="{{asset('images/LOGO.jpg')}}" alt="logo"></a>
            </div>
            <div class="col-sm-4 align-self-center text-right">
                <div class="social-icons">
                    <a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
        <!--/row-->
    </div>
    <!--container-->
</header>
<span class="position-absolute trigger"><!-- hidden trigger to apply 'stuck' styles --></span>
<nav class="navbar navbar-expand-sm sticky-top navbar-dark">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar1">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link active" href="/"><i class="fa fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/client/cars"><i class="fas fa-car"></i> Cars</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/client/bikes"><i class="fas fa-motorcycle"></i> Bike</a>
                </li>
               @auth
                    <li class="nav-item">
                        <a class="nav-link" href="/client/bid"><i class="fa fa-rub"></i> My Bids</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/common/profile-settings"><i class="fa fa-user"></i> Profile Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/common/account-settings"><i class="fa fa-edit"></i> Account Settings</a>
                    </li>
                   <li class="nav-item">
                       <a onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="nav-link" href="#"><i class="fa fa-sign-out"></i> Logout</a>
                       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                           @csrf
                       </form>
                   </li>

                @endauth

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
    <!--container end-->
</nav>
<!--Section-1-->
<div id="myContainer">
    @yield('content')
</div>
<!--Section-2-->

<section class="section-7">
    <!-- Footer -->
    <footer class="page-footer font-small stylish-color-dark">

        <!-- Footer Links -->
        <!-- Footer Links -->

        <!-- Copyright -->
        <div class="footer-copyright text-center">
            <div class="gradient"></div>
            <p>© 2019, All Rights reserved, Sabsolutions</p>
        </div>
        <!-- Copyright -->

    </footer>
    <!-- Footer -->
</section>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
<script src="{{asset('client/js/animate.js')}}"></script>
<script src="{{asset('client/js/custom.js')}}"></script>
<script>
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });

</script>

@yield('scripts')
<style>
    #myContainer{
        min-height: 80vh;
    }
</style>
</body>

</html>
