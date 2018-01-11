@extends('frontend.layouts.main')

@section('content')
<div class="container">
        <div class="col-md-10 col-md-offset-2">
            <div class="breadcrumbs">
                <ul>
                    <li class="breadcrumbs-separator"></li>
                    <li class="current">Success!</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container" >
        <div class="row">
        @include('frontend.blocks.left-menu')
        <div class="page-main-content col-xs-12 col-md-10" align="middle" >
        <div class="col-xs-12 col-md-7 vertically-aligned">
                <div class="row" style="margin-right: 20px; margin-top: 50px;">
                    <div >
                        <div class="home-right">
                            <img src="{{url('/')}}/design/images/rsz_lori_transparent_small.png" alt="Lori" class="lori-image-home" />
                            <div class="dialog-box custom-width">
                                <h2>
                                <span class="firstname">Success!</span>
                                </h2>
                            <p class="desc">
                             You will receive an email from me within the next few minutes with a link to view your estimate. The email comes by lori@er-stelle-deine-app.de!</p>
                            </div>
                        </div>

                        </div>
                    </div>
                    </div>
                    <div class="pager steps-pager" style="float: right; padding-top: 60px;">
                            <div class="step first-step current">
                                <i class="icon-Arrow"></i>
                                <span class="page">2</span>
                            </div>
                            <span class="separator">
                                /
                            </span>
                            <div class="step second-step">
                                <span class="page">2</span>
                                <i class="icon-Arrow"></i>
                            </div>
                </div>
        </div>
        </div>
    </div>
@endsection