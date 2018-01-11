<div id="change-password-popup" class="custom-popup  @if(!Session::has('error')) hidden-popup @endif ">
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
        <form method="POST" action="{{URL::route('changePassword')}}">
            {!! csrf_field() !!}
            <input type="hidden" name="token" value="">

            @if(Session::has('wrongOldPass'))
            <p class="desc error">Wrong old password!</p>
            @elseif(Session::has('passMatch'))
            <p class="desc error">The passwords doesn't match.</p>
            @endif

            <div class="fields">
                <div class="field">
                    <label>Current Password</label>
                    <input type="password" name="oldPass">
                </div>
            </div>

            <div class="fields">
                <div class="field">
                    <label>Password</label>
                    <input type="password" name="password">
                </div>
            </div>

            <div class="fields">
                <div class="field">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation">
                </div>
            </div>

            <div class="fields">
                <div class="field">
                    <button type="submit">Reset Password</button>
                </div>
            </div>
        </form>
    </div>
</div>
