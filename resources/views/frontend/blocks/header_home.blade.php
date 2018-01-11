<div class="header row">
    <div class="create-your-app col-lg-2 col-md-2 col-sm-3 col-xs-5 text-left">
        <a href="/home.html" class="text-left">Create <br/> your<span class="app">App.</span></a>
    </div>
    <div class="bread-crumbs col-lg-2 col-md-2 col-sm-3 col-xs-5">
        <span class="bread-crumbs-separation">/</span>
        <span class="section">@yield('page-title')</span>
    </div>

    @if(Route::current()->getName() == 'frontend_index')
    <div class="mobile-logo col-lg-5 col-md-5 visible-lg visible-md">
        <span>&nbsp;</span>
    </div>
    @endif

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
</div>