@extends('frontend.layouts.main')

@section('content')
	<div class="container">
        <div class="welcome text-center">
            <img src="design/images/rsz_lori_transparent.png" alt="Lori" class="lori-image" />
            <div class="introduction dialog-box">
                <h2>Hi, I'm Lori!</h2>
                <p class="desc">I am your personal assistant &#38; lead you through my world today at <span class="base-site">www.erstelle-deine-app.de</span> -Together with your help I tell you what the development of your app costs! I also give you more information about the topic app development.</p>
                <h2>What's your name?</h2>
                <form method="POST" action="{{URL::route('frontend_index_enter_name')}}" style="padding: 0;">
                	{{csrf_field()}}
                	{{ method_field('POST') }}
                	<div class="user-data">
	                    <label>Hi Lori, my name is</label>
	                    <input type="text" name="name" required/>
	                    <div class="submit">
	                        <button type="submit" title="Submit">let's go!</button>
	                    </div>
	                    <a href="{{URL::route('frontend_skip_intro')}}" title="I'll do it on my own" class="dismiss-lori">I can do it without your help, Lori!</a>
	                </div>
                </form>
            </div>
        </div>
    </div>
@endsection