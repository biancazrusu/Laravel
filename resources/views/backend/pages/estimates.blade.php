@extends('backend.layouts.main')
<script type="text/javascript" src="../js/scripts.js"></script>

<style>
    ul {
       list-style: none;
    }
</style>

@section('title', 'Lori')

@section('header')
    @include('backend.components.header')
@endsection

@section('topper')
    <div class="ui sixteen wide column top-bar">
        <div class="ui two column grid">
            <div class="four wide column">
                <h4 class="ui header sidebar-title">{{trans('cms.estimates')}}</h4>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="sixteen wide column content">
        <div class="ui secondary pointing menu tabbed-menu">
            <a class="item blue active" data-tab="allEstimates">All</a>
            <a class="item blue" data-tab="completedEstimates">Completed</a>
            <a class="item blue" data-tab="notCompletedEstimates">Not Completed</a>
        </div>
        @include('backend.components.message')
        <div class="ui bottom tab active" data-tab="allEstimates">
            <div class="sixteen wide column content">
                @include('backend.components.table_estimates', ['id' => 'myTable','estimates' => $allEstimates])
            </div>
        </div>
        <div class="ui bottom tab" data-tab="completedEstimates">
            <div class="sixteen wide column content">
                @include('backend.components.table_estimates', ['id' => 'completed','estimates' => $completedEstimates])
            </div>
        </div>
        <div class="ui bottom tab" data-tab="notCompletedEstimates">
            <div class="sixteen wide column content">
                @include('backend.components.table_estimates', ['id' => 'notCompleted','estimates' => $notCompletedEstimates])
            </div>
        </div>
    </div>


    {{-- @include('backend.components.modal') --}}
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

    });
</script>