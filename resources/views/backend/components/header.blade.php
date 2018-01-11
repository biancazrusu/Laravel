<header class="ui {{-- fixed --}} secondary pointing menu">
    <div class="ui container">
        <a class="item
        	@if(Route::currentRouteName() == 'questions.index' || Route::currentRouteName() == 'questions.edit')active @endif"
        	href="{{URL::route('questions.index')}}">Questions</a>
        <a class="item
        	@if(Route::currentRouteName() == 'users.index' || Route::currentRouteName() == 'users.edit')active @endif"
        	href="{{URL::route('users.index')}}">Users</a>
        <a class="item
            @if(Route::currentRouteName() == 'estimates.index' || Route::currentRouteName() == 'estimates.edit')active @endif"
            href="{{URL::route('estimates.index')}}">Estimates</a>
        <a class="item
        	@if(Route::currentRouteName() == 'websites.index' || Route::currentRouteName() == 'websites.edit')active @endif"
        	href="{{URL::route('websites.index')}}">Websites</a>
        <div class="right menu">

            <a class="ui item" href="{{URL::route('admin.logout')}}">{{trans('cms.logout')}}</a>
        </div>
    </div>
</header>