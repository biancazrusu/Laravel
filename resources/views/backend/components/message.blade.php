@if(Session::has('errors'))
    <div class="ui visible error message">
        <i class="close icon"></i>
        <div class="header">
        </div>
        <ul class="list">
            @foreach (Session::get('errors') as $error)
            <li>{{$error}}</li>
            @endforeach
            @if(isset($errors))
                @foreach($errors->all() as $error)
                <li><p class="desc error">{{$error}}</p></li>
                @endforeach
            @endif
        </ul>
    </div>
@endif
@if(Session::has('exceptions'))
    <div class="ui visible error message">
        <i class="close icon"></i>
        <div class="header">
        {{trans('cms.exception')}}
        </div>
        <ul class="list">
            @foreach (Session::get('exceptions') as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(Session::has('success'))
    <div class="ui visible success message">
        <i class="close icon"></i>
        <div class="header">
        {{trans('cms.success')}}
        </div>
        <ul class="list">
            @foreach (Session::get('success') as $success)
            <li>{{$success}}</li>
            @endforeach
        </ul>
    </div>
@endif