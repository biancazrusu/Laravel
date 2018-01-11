{{-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ro" lang="ro">
    @include('frontend.blocks.head')
    <body class="home">
    	@include('frontend.blocks.templates.templates')
		<div class="container">
			@include('frontend.blocks.header')
			<div class="content row">
				@include('frontend.blocks.navigation')
				@yield('content')
			</div>
			@include('frontend.blocks.footer')
		</div>
		<example></example>
    </body>
</html>
 --}}

<!DOCTYPE html>
<html>
	@include('frontend.blocks.head')
    <body class="@if(Session::has('isNotLoggedIn'))overflow-hidden @endif">
    	<div class="page-wrapper">
	    	@include('frontend.blocks.header')
	    	<main>
	    		@yield('content')
	    	</main>

			@include('frontend.blocks.popups.login')
			@include('frontend.blocks.popups.reset-pass')
			@include('frontend.blocks.popups.reset-success')
			@include('frontend.blocks.popups.register-step-one')
			@include('frontend.blocks.popups.register-step-two')
			@include('frontend.blocks.popups.register-success')
            @include('frontend.blocks.popups.change-password')
            @include('frontend.blocks.popups.update-my-account')
            @include('frontend.blocks.popups.lori-help')


	    	@include('frontend.blocks.footer')
    	</div>
    	<script src="{{ url('/') }}/design/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="{{ url('/') }}/design/js/main.js"></script>
        <script src="{{ url('/') }}/design/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
        <link href="{{ asset('css/styles.css') }}" media="all" rel="stylesheet" type="text/css" />

        <script src="{{ url('/') }}/design/js/ie.placeholder.min.js"></script>
    </body>
</html>