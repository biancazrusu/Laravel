@extends('backend.layouts.main')

@section('title', 'Lori')

@section('header')
    @include('backend.components.header')
@endsection

@section('topper')
    <div class="ui sixteen wide column top-bar">
        <div class="ui two column grid">
            <div class="four wide column">
                <h4 class="ui header sidebar-title">{{trans('cms.user')}}</h4>
            </div>
            <div class="twelve wide column content-top">
                <div class="top-buttons">
                    <a class="ui right floated button green save-form" {{-- href="{{URL::route('users.update',['data' => 'test','action' => 'update'])}}" --}} >{{trans('cms.save')}}</a>
                    <a class="ui right floated button loadable" href="{{URL::current()}}">{{trans('cms.reset')}}</a>
                    <form action="{{isset($currentUser->name) ? URL::route('users.destroy',['id' => $currentUser->id]) : '#'}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE')}}
                        <button type="submit" class="ui right floated button red deco-delete-button">{{trans('cms.delete')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('sidebar')
    <div class="ui four wide column">
        <div class="sortable-wrapper">
            <ul class="sortable">
                @foreach(\App\User::all() as $user)
                <li class="@if($currentUser->id == $user->id)active @endif">
                    {{$user->id}}: {{$user->name}}
                    <a href="{{URL::route('users.edit', ['id' => $user->id])}}"><i class="edit icon"></i></a>
                </li>
                @endforeach
                <li class="disabled new">
                    <a href="{{URL::route('users.create')}}">Add User</a>
                </li>
            </ul>
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
            @include('backend.components.user_information')
        </div>
    </div>
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


    });
</script>