@extends('backend.layouts.main')

@section('title', 'Lori')

@section('header')
    @include('backend.components.header')
@endsection

@section('topper')
<form action="{{URL::route('questions_delete')}}" method="GET" style="width: 100%; padding-top: 30px;">
    <div class="ui sixteen wide column top-bar" style="padding-bottom: 50px;">
                <div class="ui two column grid">
                    <div class="four wide column">
                        <h4 class="ui header sidebar-title">{{trans('cms.questions')}}</h4>
                    </div>
                    <div class="twelve wide column content-top">
                        <div class="top-buttons">
                            <a class="ui right floated button loadable" href="{{ URL::current() }}">{{trans('cms.reset')}}</a>
                            <a class="ui right floated button blue {{-- {{!Auth::user()->userGroup->permissions()->decors_edit ? 'disabled' : ''}} --}}" href="{{URL::route('create_question')}}">{{trans('cms.addQuestion')}}</a>

                                {{ csrf_field() }}
                                {{ method_field('DELETE')}}
                                <button type="submit" class="ui right floated button red deco-delete-button">{{trans('cms.delete')}}</button>
                        </div>
                    </div>
                </div>
            </div>
@endsection

@section('content')
    <div class="sixteen wide column content">
        @include('backend.components.message')
        <table class="ui table selectable striped unstackable">
            <thead>
                <tr>
                    <th></th>
                    <th>{{trans('cms.id')}}</th>
                    <th>{{trans('cms.position')}}</th>
                    <th>{{trans('cms.text')}}</th>
                    <th>{{trans('cms.status')}}</th>
                    <th>{{trans('cms.actions')}}</th>
                </tr>
            </thead>
            <tbody>
                @if(\App\Models\Question::all()->count())
                    @foreach($questions as $question)
                    <tr class="@if(!$question->status) negative @endif">
<!--                         <td>{{Form::checkbox('decors['.$question->id.']', 'true', false, ['style' => 'vertical-align:middle'])}}</td> -->
                        <td><input type="checkbox" name="question[]" style="vertical-align:middle;" value="{{ $question->id }}"></td>
                        <td>{{$question->id}}</td>
                        <td>{{$question->position}}</td>
                        <td>{{$question->text}}</td>
                        <td>{{$question->status ? trans('cms.active') : trans('cms.disabled')}}</td>
                        <td class="collapsing">
                            <a class="ui icon button yellow mini"  href="{{URL::route('questions.edit', ['id' => $question->id])}}">
                                <i class="write icon"></i>
                            </a>
                            <a class="ui icon button red mini deco-delete-button" href="{{URL::route('question_destroy', ['id' => $question->id ])}}">
                                <i class="trash icon"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <td colspan="16"><p>{{trans('cms.noQuestions')}}</p></td>
                @endif
            </tbody>
        </table>
    </form>
    </div>
    {{-- @include('backend.components.modal') --}}
@endsection