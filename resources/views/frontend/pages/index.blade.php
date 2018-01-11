@extends('frontend.layouts.main')

@section('content')
<img src="design/images/icoldo.png" alt="iColdo" class="contributor top" />
    <div class="container">
        <div class="col-md-10 col-md-offset-2">
            <div class="breadcrumbs">
                <ul>
                    <li class="breadcrumbs-separator"></li>
                    <li class="current">Home</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @include('frontend.blocks.left-menu')

            <div class="page-main-content col-xs-12 col-md-10">
                <div class="homepage clearfix">

                <div class="row">

                    <div class="col-xs-12 col-md-5 vertically-aligned">
                        <div class="home-left">
                            <h1>Lori calculated the price for your mobile app</h1>

                            <span class="slogan">Free, easy, flexible!</span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-7 vertically-aligned">
                        <div class="home-right">
                            <img src="design/images/rsz_lori_transparent_small.png" alt="Lori" class="lori-image-home" />
                            <div class="dialog-box custom-width">
                                <h2>
                                <span class="greeting">Hello</span>
                                <span class="firstname">{{Auth::user() ? Auth::user()->name : session()->get('name')}}&#33;</span>
                                </h2>
                                <span class="desc">Where do we want to start?</span>
                                <ul class="starter">
                                    <li class="custom-list-item">
                                        <a href="{{URL::route('about')}}" title="Tell us about you">
                                            <i class="icon-Help"></i>
                                            <span>Tell me more about you!</span>
                                        </a>
                                    </li>
                                    <li class="custom-list-item">
                                        <a href="" title="More info">
                                            <i class="icon-Glasses"></i>
                                            <span>More about app-development</span>
                                        </a>
                                    </li>
                                    <li class="custom-list-item">
                                        <a href="" title="Lori's blog">
                                        <i class="icon-Star"></i>
                                        <span>Take a look in Lori's blog</span>
                                        </a>
                                    </li>
                                </ul>
                                <button class="calc-start fluid" title="Start you calculation" onclick="location.href='{{URL::route('calculate.index')}}'">start with your calculation</button>
                            </div>
                        </div>
                    </div>

                </div>

                </div>
            </div>
        </div>
    </div>
    <img src="design/images/desight-studio.png" alt="iColdo" class="contributor bottom" />
@endsection