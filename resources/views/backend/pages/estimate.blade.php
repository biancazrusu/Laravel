@extends('backend.layouts.main')

@section('title', 'Lori')

@section('header')
    @include('backend.components.header')
@endsection

@section('topper')
    <div class="ui sixteen wide column top-bar">
        <div class="ui two column grid">
            <div class="four wide column">
                <h4 class="ui header sidebar-title">{{trans('cms.estimates')}} </h4>
            </div>
            <div class="twelve wide column content-top">
                <div class="top-buttons">
                    {{-- <a class="ui right floated button green save-form">{{trans('cms.save')}}</a> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('sidebar')
    <div class="ui four wide column">
        <div class="sortable-wrapper">
            <ul class="sortable">
                <li>Estimate: {{$estimate->id}}</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="ui twelve wide column content">
        @include('backend.components.message')
        <div class="ui secondary pointing menu tabbed-menu">
            <a class="blue item @if(!Session::has('focusQuestion')) active @endif" data-tab="question">General</a>
            <a class="item blue" data-tab="user">User information</a>
        </div>

        <div class="ui bottom tab @if(!Session::has('focusQuestion')) active @endif" data-tab="question">
            <form id="save-form"
                class="ui form"
                @if($estimate->id)
                action="{{URL::route('estimates.update', ['id' => $estimate->id])}}"
                @endif
                method="POST"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                @if($estimate->id)
                {{ method_field('PUT') }}
                @else
                {{ method_field('POST') }}
                @endif

                {{isset($estimate->id) ? Form::hidden('id', $estimate->id) : ''}}

                <div class="fields">
                    <div class="four wide field">
                        <label>{{trans('cms.username')}}</label>
                        {{Form::text('name',
                            old('text', isset($currentUser->name) ? $currentUser->name : ''),
                            array('class' => 'ui input','readonly' => 'true', 'placeholder' => trans('cms.text')))}}
                    </div>
                    <div class="four wide field">
                        <label>Total {{trans('cms.price')}} on estimation</label>
                        {{Form::text('price',
                            old('price', isset($prices['totalPrice']) ? $prices['totalPrice'] : ''),
                            array('class' => 'ui input', 'readonly' => 'true','placeholder' => trans('cms.text')))}}
                    </div>
                    <div class="three wide field">
                        <label>{{trans('cms.status')}}</label>
                        {{Form::select('status',
                            [0 => "Pending", 1 => "Canceled", 2 => "Contacted", 3 => "Finished",],
                            old('type', isset($estimate->status) ? $estimate->status : ''),
                            array('class' => 'ui input '))}}
                    </div>
                </div>
                <label>Questions</label>
                <div class="ui divider"></div>
                @foreach($estimate->responses->unique('question_id') as $response)
                    @include('backend.components.question_estimate', ['response' => $response])
                @endforeach
                <div class="ui divider"></div>
                <button class="ui left floated button green" type="submit">{{trans('cms.save')}}</button>

            </form>
        </div>
        <div class="ui bottom tab" data-tab="user">
            @include('backend.components.user_info_estimate')
        </div>
    </div>
    {{-- @include('backe.partial.modal') --}}
@endsection
<script type="text/javascript" src="{{ asset('jquery-2.2.4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('semanticui/semantic.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.tabbed-menu .item').tab();

        $('.dropdown').dropdown({
            'forceSelection': false
        });

        $('.save-form').click(function() {
            if (!$(this).is('.loading')) {
                $('#save-form').submit();
            }
        });

        $('.delete-form').click(function() {
            if (!$(this).is('.loading')) {
                $('#delete-form').submit();
            }
        });

        $('.slide-down').click(function() {
            $(this).children().toggleClass('down').toggleClass('up');
            $(this).siblings('.answer-content').slideToggle(200);
        });

        $('.toggle-expand').click(function() {
            var list = $(this).siblings('ul');

            if (list.is(".expanded")) {
                $(this).text('+');
            } else {
                $(this).text('-');
            }

            list.slideToggle(300, function(){
                list.toggleClass('expanded');
            })

        });

    });
</script>