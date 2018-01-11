<div id="reset-popup" class="custom-popup hidden-popup @if(!Session::has('isNotLoggedIn'))hidden-popup @endif">
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
        <form id="reset" action="{{URL::route('forgotPassword')}}" method="post">
        {{csrf_field()}}
            <h2>forgotten your password?</h2>
            @if(Session::has('noUserWithEmail'))
            <p class="desc error">Invalid email address.</p>
            @endif
            <p class="desc">Oops, such thing can happen to everybody. But do not worry, Lori will find your password for you and send it to your e-mail address!</p>
            <input type="email" name="reset-email" placeholder="e-mail address or username" />
            <button title="Submit">lori should send my password!</button>
            <a href="#" title="Create account" class="create-your-app">You do not have an account at create-your-app?</a>
        </form>
    </div>
</div>