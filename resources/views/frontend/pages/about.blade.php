@extends('frontend.layouts.main')

@section('content')
<div class="container">
        <div class="col-md-10 col-md-offset-2">
            <div class="breadcrumbs">
                <ul>
                    <li class="breadcrumbs-separator"></li>
                    <li class="current">On the trail of Lori!</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @include('frontend.blocks.left-menu')
            <div class="page-main-content col-xs-12 col-md-10">
                <div class="row">
                    <div class="col-md-8">
                        <div class="about-lori">
                            <h1>
                                Who is Lori?
                            </h1>
                            <p class="desc">
                                Who I am? I'm Lori. A high-minded, young lady, who will help you to calculate the costs of your app development together with your help.
                            </p>

                            <p class="desc">
                                After my last beach visit, my creators decided to send me back into the active service of the best assistance in the world - so I landed on erstelle-deine-app.de!
                            </p>

                            <p class="desc">
                                If you have any questions, don’t hesitate, to contact me! In any case, I'm looking forward to your request!
                            </p>

                            <div class="signature">
                                <i class="icon-Heart"></i>
                                <span>Yours Lori</span>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="images-lori">
                            <div class="image-lori first">
                                <div class="images-wrapper">
                                    <img src="{{url('/')}}/design/images/texas.png" alt="Location" class="location-image img-responsive" />
                                    <img src="{{url('/')}}/design/images/rsz_lori_transparent_small.png" alt="Lori" class="lori-image img-responsive" />
                                </div>
                                <div class="bottom-description clearfix">
                                    <span class="location">Dallas, Texas</span>
                                    <span class="date">17th Apr. 1994</span>
                                </div>
                            </div>
                            <div class="image-lori second">
                                <div class="images-wrapper">
                                    <img src="{{url('/')}}/design/images/california.png" alt="Location" class="location-image img-responsive" />
                                    <img src="{{url('/')}}/design/images/rsz_lori_transparent_small.png" alt="Lori" class="lori-image img-responsive" />
                                </div>
                                <div class="bottom-description clearfix">
                                    <span class="location">Dallas, Texas</span>
                                    <span class="date">17th Apr. 1994</span>
                                </div>
                            </div>
                            <div class="image-lori third">
                                <div class="images-wrapper">
                                    <img src="{{url('/')}}/design/images/nasa.png" alt="Location" class="location-image img-responsive" />
                                    <img src="{{url('/')}}/design/images/rsz_lori_transparent_small.png" alt="Lori" class="lori-image img-responsive" />
                                </div>
                                <div class="bottom-description clearfix">
                                    <span class="location">ISS | NASA</span>
                                    <span class="date">17th Apr. 1994</span>
                                    <span class="coordinates">28,19° Nord,  19,16° Ost</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection