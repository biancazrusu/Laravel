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
                <input type="text" name="form" value="backend" hidden>
                <div class="fields">
                    <div class="four wide field">
                        <label>{{trans('cms.username')}}</label>
                        {{Form::text('name',
                            old('text', isset($currentUser->name) ? $currentUser->name : ''),
                            array('class' => 'ui input', 'placeholder' => trans('cms.text')))}}
                    </div>
                    <div class="eight wide field">
                        <label>Email</label>
                        {{Form::text('email',
                            old('text', isset($currentUser->name) ? $currentUser->email : ''),
                            array('class' => 'ui input', 'placeholder' => trans('cms.text')))}}
                    </div>
                    <div class="three wide field">
                        <label>{{trans('cms.status')}}</label>
                        <div class="ui toggle checkbox centered">
                        {{Form::checkbox('status',
                            true,
                            isset($currentUser->confirmed) ? $currentUser->confirmed : '')}}
                            <label>{{trans('cms.active')}}/{{trans('cms.disabled')}}</label>
                        </div>
                    </div>
                </div>
                <div class="fields">
                    <div class="four wide field">
                        <label>{{trans('cms.job')}}</label>
                        {{Form::text('job',
                            old('text', isset($currentUser->job) ? $currentUser->job : ''),
                            array('class' => 'ui input', 'placeholder' => trans('cms.text')))}}
                    </div>
                    <div class="four wide field">
                        <label>{{trans('cms.location')}}</label>
                        {{Form::text('location',
                            old('text', isset($currentUser->location) ? $currentUser->location : ''),
                            array('class' => 'ui input', 'placeholder' => trans('cms.text')))}}
                    </div>
                    <div class="four wide field">
                        <label>{{trans('cms.interests')}}</label>
                        {{Form::text('interested_in',
                            old('text', isset($currentUser->interested_in) ? $currentUser->interested_in : ''),
                            array('class' => 'ui input', 'placeholder' => trans('cms.text')))}}
                    </div>
                    <div class="four wide field">
                        <label>{{trans('cms.type')}}</label>
                        {{Form::text('type',
                            old('text', isset($currentUser->type) ? $currentUser->type : ''),
                            array('class' => 'ui input', 'placeholder' => trans('cms.type')))}}
                    </div>
                </div>
                <div class="fields">
                    <div class="four wide field">
                        <label>{{trans('cms.firstName')}}</label>
                        {{Form::text('first_name',
                            old('text',isset($currentUser->first_name) ? $currentUser->first_name : ''),
                            array('class' => 'ui input', 'placeholder' => trans('cms.firstName')))}}
                    </div>
                    <div class="four wide field">
                        <label>{{trans('cms.lastName')}}</label>
                        {{Form::text('last_name',
                            old('text',isset($currentUser->last_name) ? $currentUser->last_name : ''),
                            array('class' => 'ui input', 'placeholder' => trans('cms.lastName')))}}
                    </div>
                    <div class="four wide field">
                        <label>{{trans('cms.country')}}</label>
                        <div class="select-wrapper" >
                                <select name="country" id="countryID" >
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
                        <select name="location" id="cityId">
                            <?php $cityDB = $currentUser->location ?>
                            <input value="{{ $cityDB }}" id="cityDB" hidden/>
                        </select>
                        </div>
                    </div>
                    <div class="four wide field">
                        <label>{{trans('cms.phoneNumber')}}</label>
                        {{Form::text('phone_number',
                            old('text',isset($currentUser->phone_number) ? $currentUser->phone_number : ''),
                            array('class' => 'ui input', 'placeholder' => trans('cms.phoneNumber')))}}
                    </div>
                </div>

                <div class="fields">
                    <div class="four wide field">
                        <label>{{trans('cms.subscribed')}}</label>
                        <div class="ui toggle checkbox centered">
                        {{Form::checkbox('subscribed',
                            true,
                            isset($currentUser->subscribed) ? $currentUser->subscribed : '')}}
                            <label>{{trans('cms.active')}}/{{trans('cms.disabled')}}</label>
                        </div>
                    </div>
                    <div class="four wide field">
                        <label>{{trans('cms.userRole')}}</label>
                        <div class="ui toggle checkbox centered">
                            {{Form::checkbox('user_type',true,
                                ($currentUser->user_type == 'admin') ? true : '')}}
                            <label>{{trans('cms.userNormal')}}/{{trans('cms.admin')}}</label>
                        </div>
                    </div>
                </div>
            </form>