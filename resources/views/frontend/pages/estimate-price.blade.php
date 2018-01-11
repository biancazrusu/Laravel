@extends('frontend.layouts.main')

@section('page-title')
Calculate the costs of your app
@endsection

@section('content')
<div class="container">
        <div class="col-md-10 col-md-offset-2">
            <div class="breadcrumbs">
                <ul>
                    <li class="breadcrumbs-separator"></li>
                    <li class="current">Calculate the costs of your app</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <!-- <?php #include 'left-menu-calculate.php'; ?> -->

            <div class="page-main-content col-xs-12 col-md-10">
            <div class="step-wrapper step1">
                <form id="step1" class="step-form" action="{{URL::route('calculate.finalStep', ['id'=>$estimate->id])}}" method="post">
                {{csrf_field()}}
                    <h1>Tell me something more before we continue!</h1>
                    <div><p>Hi Lori, my name is
                        <input type="text" name="username" value="{{ Auth::user() ? Auth::user()->name : session()->get('name') }}" hidden>
                        <span style="color: #00e777;">{{ Auth::user() ? Auth::user()->name : session()->get('name') }}</span>&#46;
                    </p></div>

                    <p>My planned budget for developing my app is</p>
                        <div class="budget-wrapper">
                            <span>&#8364;</span>
                            <input type="number" name="budget" min="0" required>
                        </div>
                        <p>&#46;</p>
                    <p>You can send my estimate by e-mail &#46;</p>
                    <p>I'm looking forward to working with you to calculate my app, Lori &#33;</p>

                    <div class="submit">
                        <button type="submit">let's go</button>
                    </div>
                </form>
                <div class="step-footer">
                    <div class="helper">
                        <a href="#" id="lori-help" class="lori-help" title="Ask Lori for help">
                            <i class="icon-Help"></i>
                            <span>Ask Lori for help &#33;</span>
                        </a>
                    </div>
                    <div class="pager steps-pager">
                        <div class="step first-step current">
                            <i class="icon-Arrow"></i>
                            <span class="page">1</span>
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
        </div>
    </div>
@endsection