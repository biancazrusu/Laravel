@extends('backend.layouts.main')

@section('title', 'Lori')

@section('header')
    @include('backend.components.header')
@endsection

@section('topper')
    <div class="ui sixteen wide column top-bar">
        <div class="ui two column grid">
            <div class="four wide column">
                <h4 class="ui header sidebar-title">New User</h4>
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
            <form id="save-form"
                class="ui form"
                @if($currentUser->id)
                    action="{{URL::route('users.update', ['id' => $currentUser->id])}}"
                @else
                    action="{{URL::route('users.store')}}"
                @endif
                method="POST"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                @if($currentUser->id)
                    {{ method_field('PUT') }}
                @else
                    {{ method_field('POST') }}
                @endif

                {{isset($currentUser->id) ? Form::hidden('id', $currentUser->id) : ''}}

                <div class="fields">
                    <div class="sixteen wide required field">
                        <label>{{trans('cms.username')}}</label>
                        {{Form::text('name',
                            old('text',''),
                            array('class' => 'ui input', 'placeholder' => trans('cms.username')))}}
                    </div>
                </div>
                <div class="fields">
                    <div class="sixteen wide required field">
                        <label>{{trans('cms.password')}}</label>
                        {{Form::password('password',
                            array('class' => 'ui input', 'placeholder' => trans('cms.password')))}}
                    </div>
                </div>
                <div class="fields">
                    <div class="sixteen wide required field">
                        <label>{{trans('cms.email')}}</label>
                        {{Form::text('email',
                            old('text',''),
                            array('class' => 'ui input', 'placeholder' => trans('cms.email')))}}
                    </div>
                </div>
                <div class="fields">
                    <div class="sixteen wide required field">
                        <label>{{trans('cms.job')}}</label>
                        {{Form::text('job',
                            old('text',''),
                            array('class' => 'ui input', 'placeholder' => trans('cms.job')))}}
                    </div>
                </div>
                <div class="fields">
                    <div class="sixteen wide required field">
                        <label>{{trans('cms.type')}}</label>
                        {{Form::text('type',
                            old('text',''),
                            array('class' => 'ui input', 'placeholder' => trans('cms.type')))}}
                    </div>
                </div>
                <div class="fields">
                    <div class="sixteen wide required field">
                        <label>{{trans('cms.interests')}}</label>
                        {{Form::text('interested_in',
                            old('text',''),
                            array('class' => 'ui input', 'placeholder' => trans('cms.interests')))}}
                    </div>
                </div>
                <div class="fields">
                    <div class="sixteen wide required field">
                        <label>{{trans('cms.firstName')}}</label>
                        {{Form::text('first_name',
                            old('text',''),
                            array('class' => 'ui input', 'placeholder' => trans('cms.firstName')))}}
                    </div>
                </div>
                <div class="fields">
                    <div class="sixteen wide required field">
                        <label>{{trans('cms.lastName')}}</label>
                        {{Form::text('last_name',
                            old('text',''),
                            array('class' => 'ui input', 'placeholder' => trans('cms.lastName')))}}
                    </div>
                </div>
                <div class="fields">
                    <div class="sixteen wide required field">
                       <div class="four wide field">
                        <label>{{trans('cms.country')}}</label>
                        <div class="select-wrapper" >
                                <select name="country" id="country" style="width: 830px;">
                                <option  selected="selected" disabled style="color: #e9e9e9;">
                               Country</option>
                                    <?php $countries =  Session::get('countries'); ?>
                                    <?php $countryDB = $currentUser->country ?>
                                   @foreach ($countries as $key => $country)
                                   @if($key != $countryDB)
                                        <option value="{{ $key }}" class="option-green">
                                            {{ $country[0] }}
                                        </option>
                                    @else
                                        <option value="{{ $key }}" selected="true">
                                            {{ $country[0] }}
                                        </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="four wide field">
                        <label>City</label>
                        <div class="select-wrapper">
                        <select name="location" id="city" style="width: 830px;">
                            <?php $cityDB = $currentUser->location ?>
                            <input value="{{ $cityDB }}" id="cityDB" hidden/>
                        </select>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="fields">
                    <div class="sixteen wide required field">
                        <label>{{trans('cms.phoneNumber')}}</label>
                        {{Form::text('phone_number',
                            old('text',''),
                            array('class' => 'ui input', 'placeholder' => trans('cms.phoneNumber')))}}
                    </div>
                </div>
                <div class="fields">
                    <div class="eight wide required field">
                        <label>{{trans('cms.status')}}</label>
                        <div class="ui toggle checkbox centered">
                            {{Form::checkbox('status', true, '')}}
                        <label>{{trans('cms.disabled')}}/{{trans('cms.active')}}</label>
                    </div>
                </div>
                <div>
                    <div class="eight wide required field">
                        <label>{{trans('cms.userRole')}}</label>
                        <div class="ui toggle checkbox centered">
                            {{Form::checkbox('user_type', true, '')}}
                        <label>{{trans('cms.userNormal')}}/{{trans('cms.admin')}}</label>
                    </div>
                </div>

                <button class="ui left floated button green" type="submit">{{trans('cms.save')}}</button>
            </form>
        </div>
    </div>
@endsection