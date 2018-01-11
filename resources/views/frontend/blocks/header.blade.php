<header>
    <div class="container">
        <div class="header-wrapper clearfix">
            <a href="{{URL::route('frontend_index')}}" title="Create your app" class="logo">
                <span class="logo-font-light">Create</span>
                <span class="logo-font-light">your</span>
                <span class="logo-font-bold">App.</span>
            </a>

            @if(Auth::user())
            <div class="header-right">
            <ul class="nav navbar-nav" style="text-decoration: none;">
                <li class="dropdown" >
                    <a href="#" class="my-account nohover" title="My account" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="icon-User"></i>
                        <span>My Account</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a href="http://lori-back.icoldo.com/public/history">Estimates history</a></li>
                      <li><a href="#" class ="update-my-account">Update my account</a></li>
                      <li><a href="#" class= "change-password"> Change Password</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{URL::route('logout')}}" class="logout">
                        <i class="icon-OpenedLock"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </div>
            @else
            <div class="header-right">
                <a href="#" class="login" title="Log in">
                    <i class="icon-User"></i>
                    <span>Login</span>
                </a>
                <a href="#" class="register" title="Register">
                    <i class="icon-OpenedLock"></i>
                    <span>Register for free</span>
                </a>
            </div>
            @endif

        </div>
    </div>
</header>
{{-- <div class="header row">
    <div class="create-your-app col-lg-2 col-md-2 col-sm-3 col-xs-5 text-left">
        <a href="/home.html" class="text-left">Create <br/> your<span class="app">App.</span></a>
    </div>
    <div class="bread-crumbs col-lg-7 col-md-7 col-sm-6 col-xs-7">
        <span class="bread-crumbs-separation">/</span>
        <span class="section">@yield('page-title')</span>
    </div>


    <div class="header-menu col-lg-3 col-md-3 col-sm-6 col-xs-2 text-right">
        <div class="login-register">
            <a href="#" class="login hidden-xs">
                <i class="icon-User"></i>
                <span>Login</span>
            </a>
            <a href="#" class="register hidden-xs">
                <i class="icon-OpenedLock"></i>
                <span>Register for free</span>
            </a>
            <a href="{{URL::route('logout')}}" class="register hidden-xs">
                <i class="icon-OpenedLock"></i>
                <span>Logout</span>
            </a>
            <div class="mobile-menu visible-xs-block">
                <a href="#" class="mobile-menu-trigger">
                    <span class="icon-Menu">
                    </span>
                </a>
                <div class="mobile-menu-inner">
                    <a href="#" class="mobile-login">
                        <i class="icon-User"></i>
                        <span>Login</span>
                    </a>
                    <a href="#" class="mobile-register">
                        <i class="icon-OpenedLock"></i>
                        <span>Register for free</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<style type="text/css" rel="stylesheet">
    .nav .open>a, .nav .open>a:focus, .nav .open>a:hover {
        background-color: transparent;
    }
    .nav>li>a:focus, .nav>li>a:hover {
        background-color: transparent;
    }
    .dropdown-menu>li>a{
        color: #999;
    }
    .dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover{
        color: #00e777;
    }
</style>