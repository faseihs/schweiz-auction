<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Schweiz Auction @yield('title')</title>
    <meta name="author" content="Faseih Saad">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon"
          href="{{asset('images/LOGO.jpg')}}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    @yield('stylesheets')

</head>

<body>
<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                @if(Auth::user()->role_id==2)
                    <li id="dashboard">
                        <a href="/client/dashboard"><i class="menu-icon fa fa-bar-chart-o"></i>Dashboard </a>
                    </li>
                    {{--<li class="auctions" id="auctions">
                        <a href="/client/auction?type=new"><i class="menu-icon fa fa-laptop"></i>New Auctions</a>
                    </li>--}}
                    <li class="auctions" id="auctions">
                        <a href="/client/dashboard"><i class="menu-icon fa fa-dollar"></i>Auctions</a>
                    </li>
                    <li class="auctions" id="auctions">
                        <a href="/client/cars"><i class="menu-icon fas fa-car"></i>Cars</a>
                    </li>
                    <li class="auctions" id="auctions">
                        <a href="/client/bikes"><i class="menu-icon fas fa-motorcycle"></i>Bikes</a>
                    </li>

                    <li id="bids">
                        <a href="/client/bid"><i class="menu-icon fa fa-rub"></i>My Bids</a>
                    </li>
                @endif


            <!-- Admin Links -->
                @if(Auth::user()->role_id==1)
                    <li id="dashboard">
                        <a href="/admin/dashboard"><i class="menu-icon fa fa-bar-chart-o"></i>Dashboard </a>
                    </li>
                    <li id="auctions">
                        <a href="/admin/auction"><i class="menu-icon fa fa-dollar"></i>Auctions</a>
                    </li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
<!-- /#left-panel -->
<!-- Right Panel -->
<div id="right-panel" class="right-panel">
    <!-- Header-->
    <header id="header" class="header">
        <div class="top-left">
            <div class="navbar-header">
                <a class="navbar-brand" href="./"><img style="max-height: 40px;" src="{{asset('images/LOGO.jpg')}}" alt="Schweiz Auction"></a>
                <a class="navbar-brand hidden" href="./"><img src="{{asset('images/LOGO.jpg')}}" alt="Logo"></a>
                <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
            </div>
        </div>
        <div class="top-right">
            <div class="header-menu">
                <div class="header-left">
                    <button class="search-trigger"><i class="fa fa-search"></i></button>
                    <div class="form-inline">
                        <form class="search-form">
                            <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                            <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                        </form>
                    </div>

                </div>

                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="user-avatar rounded-circle" src="{{Auth::user()->profile->getDp()}}" alt="Avatar">
                    </a>

                    <div class="user-menu dropdown-menu">

                        <a class="nav-link" href="/common/profile-settings"><i class="fa fa- user"></i>Profile Settings</a>
                        <a class="nav-link" href="/common/account-settings"><i class="fa fa -cog"></i>Account Settings</a>

                        <a onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="nav-link" href="#"><i class="fa fa-power -off"></i>Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </header>
    <!-- /#header -->
    <!-- Content -->
    <div class="content">
        <!-- Animated -->
        <div class="animated fadeIn">

            @yield('content')
        </div>

        <!-- .animated -->
    </div>
    <!-- /.content -->
    <div class="clearfix"></div>
    <!-- Footer -->
    <footer class="site-footer">
        <div class="footer-inner bg-white">
            <div class="row">
                <div class="col-sm-6">
                    Copyright &copy; 2019 Sab Solutions
                </div>

            </div>
        </div>
    </footer>
    <!-- /.site-footer -->
</div>
<!-- /#right-panel -->

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="{{asset('assets/js/main.js')}}"></script>

@yield('scripts')
<style>
    .content{
        min-height: 75vh;
    }
</style>
</body>
</html>
<?php
/**
 * Created by PhpStorm.
 * User: Grace
 * Date: 01/02/2019
 * Time: 03:01 PM
 */