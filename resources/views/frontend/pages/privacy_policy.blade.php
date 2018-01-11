@extends('frontend.layouts.main')

@section('content')

<div class="container">
        <div class="col-md-10 col-md-offset-2">
            <div class="breadcrumbs">
                <ul>
                    <li class="breadcrumbs-separator"></li>
                    <li class="current">Privacy Policy</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @include('frontend.blocks.left-menu')
            <div class="page-main-content col-xs-12 col-md-10">
                <div class="row">
                    <div class="col-md-12">
                        <div class="about-lori">
                            <h1 style="font-size: 35px">
                                Privacy Policy
                            </h1>
                            <h2 style="font-size: 28px">Personal Data</h2>
                            <p style="font-size: 21px">  When you visit our website, we automatically record the name of your internet service provider, the website from which you visit us, the pages of our website you actually visit and the date and length of your visit as well as information about the equipment (brand, model, operating system) and the internet browser you have used. We also collect your IP address, but with the last four digits anonymised.
                            </p>

                            <h2 style="font-size: 28px">Use of cookies</h2>
                            <p style="font-size: 21px">On various pages of our website, we use cookies in order to make our website more attractive to visitors and to enable the use of certain functions. Cookies are small data files that are stored on your terminal equipment. Some of the cookies we use are deleted at the end of the browser session, i.e. as soon as you close your browser (so-called session cookies). Other cookies remain on your computer and allow us or our partner companies to recognise your computer on your next visit (so-called permanent cookies).

                            Cookies cannot be used to access other files on your computer or to reveal your email address.

                            Most browsers are initially set to accept cookies automatically. If you use your browser's default settings, all processes will be running quietly in the background. Nevertheless, you can change your settings at any time.

                            You can set your browser to inform you every time before storing cookies and decide on a case-by-case basis, whether to accept them. You can also limit the acceptance of cookies to certain cases or block the acceptance of cookies altogether.

                            However, without cookies, the features of some websites - including ours - will not function properly, as these files are used in processes.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection