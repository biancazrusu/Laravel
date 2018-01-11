@extends('backend.layouts.main')

@section('title', 'Lori')

@section('header')
    @include('backend.components.header')
@endsection

@section('topper')
    <div class="ui sixteen wide column top-bar">
        <div class="ui two column grid">
            <div class="four wide column">
                <h4 class="ui header sidebar-title">{{trans('cms.question')}}</h4>
            </div>
            <div class="twelve wide column content-top">
                <div class="top-buttons">
                    <a class="ui right floated button green save-form {{-- {{!Auth::user()->userGroup->permissions()->decors_edit ? 'disabled' : ''}} --}}">{{trans('cms.save')}}</a>
                    <a class="ui right floated button loadable" href="{{URL::current()}}">{{trans('cms.reset')}}</a>
                    <a class="ui right floated button red deco-delete-button {{-- {{!isset($question->name) ? 'disabled' : ''}} {{!Auth::user()->userGroup->permissions()->decors_delete ? 'disabled' : ''}} --}}"
                        href="{{isset($question->name) ? URL::route('questions',
                            ['id' => $question->id,
                            'action' => 'delete']) : '#'}}">{{trans('cms.delete')}}</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('sidebar')
    <div class="ui four wide column">
        <div class="sortable-wrapper">
            <ul class="sortable">
                @foreach($questions as $question)
                <li class="@if($currentQuestion->id == $question->id)active @endif">
                    @if(count($question->answers)) <span class="toggle-expand">+</span> @endif
                    {{$question->position}}: {{$question->text}}
                    <a href="{{URL::route('questions.edit', ['id' => $question->id])}}"><i class="edit icon"></i></a>
                    <ul class="sortable {{-- @if($currentZone->isExpanded($zone->id))expanded @endif--}}">
                        @foreach($question->answers->sortBy('position') as $answer)
                            <li>
                                {{$answer->id}}: {{$answer->text}}
                                <a href="{{URL::route('questions.edit', ['id' => $question->id])}}"><i class="edit icon"></i></a>
                            </li>
                        @endforeach
                    </ul>

                </li>
                @endforeach
                <li class="disabled new">
                    <a href="{{URL::route('create_question')}}">Add Question</a>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="ui twelve wide column content">
        @include('backend.components.message')
        <div class="ui secondary pointing menu tabbed-menu">
            <a class="blue item @if(!Session::has('focusQuestion')) active @endif" data-tab="question">General</a>
            <a class="item blue @if(Session::has('focusQuestion')) active @endif @if(!$currentQuestion->id) disabled @endif"
            data-tab="answers">Answers ({{$currentQuestion->id ? $currentQuestion->answers->count() : 0}})</a>
        </div>

        <div class="ui bottom tab @if(!Session::has('focusQuestion')) active @endif" data-tab="question">
        {{-- {{dump($currentQuestion->childQuestions)}} --}}
            <form id="save-form"
                class="ui form"
                @if($currentQuestion->id)
                action="{{URL::route('questions.update', ['id' => $currentQuestion->id])}}"
                @else
                action="{{URL::route('questions.store')}}"
                @endif
                method="POST"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                @if($currentQuestion->id)
                {{ method_field('PUT') }}
                @else
                {{ method_field('POST') }}
                @endif

                {{isset($currentQuestion->id) ? Form::hidden('id', $currentQuestion->id) : ''}}

                <div class="fields">
                    <div class="eight wide required field">
                        <label>{{trans('cms.text')}}</label>
                        {{Form::text('text',
                            old('text', isset($currentQuestion->text) ? $currentQuestion->text : ''),
                            array('class' => 'ui input', 'placeholder' => trans('cms.text')))}}
                    </div>
                    <div class="four wide field required">
                        <label>{{trans('cms.type')}}</label>
                        {{Form::select('type',
                            [0 => "Radio", 1 => "Select", 2 => "Text", 3 => "Number"],
                            old('type', isset($currentQuestion->type) ? $currentQuestion->type : ''),
                            array('class' => 'ui input', 'placeholder' => trans('cms.choseType')))}}
                    </div>
                    <div class="three wide field">
                        <label>{{trans('cms.status')}}</label>
                        <div class="ui toggle checkbox centered">
                        {{Form::checkbox('status',
                            true,
                            isset($currentQuestion->status) ? $currentQuestion->status : '')}}
                            <label>{{trans('cms.active')}}/{{trans('cms.disabled')}}</label>
                        </div>
                    </div>
                </div>
                <div class="fields">
                    <div class="two wide field">
                        <label>{{trans('cms.position')}}</label>
                        {{Form::number('position', $currentQuestion ? $currentQuestion->position : 0,
                            array('class' => 'ui input', 'placeholder' => trans('cms.postion')))}}
                    </div>
                </div>
            </form>
        </div>
        <div class="ui bottom tab @if(Session::has('focusQuestion')) active @endif" data-tab="answers">
            @if($currentQuestion->answers->count())
                @foreach($currentQuestion->answers->sortBy('position') as $answer)
                    @include('backend.components.question_answer', ['answer' => $answer])
                @endforeach
            @endif

            @include('backend.components.question_answer', ['answer' => null])
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