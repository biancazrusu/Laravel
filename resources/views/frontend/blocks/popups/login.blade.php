<div id="login-popup" class="custom-popup @if(!Session::has('isNotLoggedIn'))hidden-popup @endif">
    <div class="container">
        <a href="#" title="Create your app" class="logo">
            <span class="logo-font-light">Create</span>
            <span class="logo-font-light">your</span>
            <span class="logo-font-bold">App.</span>
        </a>
        <a href="#" title="Close" class="close-popup">
            <i class="icon-Exit"></i>
            <span>close</span>
        </a>
    </div>
    <div class="container text-center no-p-mobile">
        <form id="login" method="POST" action="{{URL::route('loginPost')}}">
            {{csrf_field()}}
            <h2>login</h2>
            <p class="desc">Use your username or e-mail address and log in with your password at {{URL::to('/')}}.</p>
            @if(Session::has('confirmedFirst'))
            <p class="desc error">Your email address is not confirmed with us, please confirm your email address.</p>
            @elseif(Session::has('badLogin'))
            <p class="desc error">Invalid email address or password.</p>
            @endif
            <input type="text" name="email" placeholder="email address or username" />
            <input type="password" name="password" placeholder="type in your password" />
            <a title="Forgot your password?" class="reset-password" href="#">Forgot your password?</a>
            <button type="Submit">let's go!</button>
            <a href="#" title="Create account" class="create-your-app">You do not have an account at create-your-app?</a>
        </form>
    </div>
</div>