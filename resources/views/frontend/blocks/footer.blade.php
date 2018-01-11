{{-- <div class="footer row">
    <div class="copyright col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <span>&copy; <script>document.write(new Date().getFullYear())</script> - DeSight Studio GmbH &amp; iColdo</span>
        <a href="#" class="imprint">Imprint</a>
        <a href="#">Privacy Policy</a>

        @if(Route::current()->getName() == 'frontend_index')
        <span class="desight">&nbsp;</span>
        @endif

    </div>
    <div class="sponsored col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
        <span>Sponsored by <a href="https://www.desightstudio.com/en/home-en.html"><strong>DeSight Studio<span class="original-symbol">®<span></strong></a> and <a href="https://www.icoldo.com/"><strong>iColdo</strong></a></span>
    </div>
</div> --}}

<footer>
    <div class="container">
        <div class="footer-wrapper clearfix">
            <div class="footer-left">
                <span class="copyright">&#169; <a href="https://www.desightstudio.com/">DeSight Studio GmbH</a> &#38; <a href="https://www.icoldo.com/">iColdo</a></span>
                <div class="footer-links">
                    <a href="" title="Imprint">Imprint</a>
                    <span class="separator"></span>
                    <a href="{{URL::route('privacy_policy')}}" target="_blank" title="Privacy policy">Privacy policy</a>
                </div>
            </div>
            <div class="footer-right">
                <span>Sponsored by <span class="partner">DeSight Studio</span><sup>&reg;</sup> and iColdo</span>
            </div>
        </div>
    </div>
</footer>