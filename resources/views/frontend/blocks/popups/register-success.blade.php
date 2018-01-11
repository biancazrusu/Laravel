<div id="register-success-popup" class="custom-popup @if(!Session::has('registerSuccess'))hidden-popup @endif">
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
        <div class="custom-box success-popup">
            <h2 class="title">Almost done!</h2>
            <img src="{{url('/')}}/design/images/rsz_lori_transparent_small.png" alt="Lori" class="lori-image-main" />
            <div class="dialog-box">
                <h2>Thank you for registering!</h2>
                <p class="desc">
                    You almost did it! You will soon receive an email from me with a confirmation link - just to make sure it is also about you!
                </p>
            </div>
        </div>
    </div>
</div>