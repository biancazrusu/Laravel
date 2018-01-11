@extends('backend.layouts.main')

@section('title', 'Lori')

@section('header')
    @include('backend.components.header')
@endsection

@section('topper')
    <div class="ui sixteen wide column top-bar">
        <div class="ui two column grid">
            <div class="four wide column">
                <h4 class="ui header sidebar-title">New Question</h4>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="ui twelve wide column content">
        @include('backend.components.message')
        <div class="ui secondary pointing menu tabbed-menu">
            <a class="blue item active" data-tab="user">General</a>
        </div>

        <div class="ui bottom tab active" data-tab="user">
            <form id="save-form" class="ui form" action="{{URL::route('questions_store')}}">

                <div class="fields">
                    <div class="sixteen wide required field">
                        <label>{{trans('cms.text')}}</label>
                        {{Form::text('text',
                            old('text',''),
                            array('class' => 'ui input', 'required', 'placeholder' => trans('cms.text')))}}
                    </div>
                </div>

                <div class="fields">
                    <div class="sixteen wide required field">
                        <label>{{trans('cms.website')}}</label>
                        {{Form::select('website_id',
                            App\Models\Website::pluck('name','id')->toArray(),
                            old('text',''),
                            array('class' => 'ui input', 'required', 'placeholder' => trans('cms.website')))}}
                    </div>
                </div>
                <div class="fields">
                    <div class="sixteen wide required field">
                        <label>{{trans('cms.position')}}</label>
                        <span style="font-size: 12px;">(max: {{count(App\Models\Question::all()) + 1}})</span>
                        {{Form::text('position',
                            old('text',''),
                            array('class' => 'ui input', 'required', 'placeholder' => trans('cms.position')))}}
                    </div>
                </div>
                <div class="fields">
                    <div class="sixteen wide required field">
                        <label>{{trans('cms.type')}}</label>
                        {{Form::select('type',
                            [0 => "Radio", 1 => "Select", 2 => "Text", 3 => "Number"],
                            old('type', ''),
                            array('class' => 'ui input', 'required', 'placeholder' => trans('cms.choseType')))}}
                    </div>
                </div>
                <div class="fields">
                    <div class="sixteen wide required field">
                    <label>{{trans('cms.status')}}</label>
                    <div class="ui toggle checkbox centered">
                        {{Form::checkbox('status',
                            true,
                            '')}}
                        <label>{{trans('cms.active')}}/{{trans('cms.disabled')}}</label>
                    </div>
                    </div>
                </div>

                <button class="ui left floated button green" type="submit">{{trans('cms.save')}}</button>
            </form>
        </div>
    </div>
@endsection