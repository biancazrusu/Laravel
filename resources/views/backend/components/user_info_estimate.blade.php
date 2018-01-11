<div id="save-form" class="ui form">
<input type="text" name="form" value="backend" hidden>
                <div class="fields">
                    <div class="four wide field">
                        <label>{{trans('cms.username')}}</label>
                        {{Form::text('name',
                            old('text', isset($currentUser->name) ? $currentUser->name : ''),
                            array('class' => 'ui input', 'readonly' => 'true', 'placeholder' => trans('cms.text')))}}
                    </div>
                    <div class="eight wide field">
                        <label>Email</label>
                        {{Form::text('email',
                            old('text', isset($currentUser->name) ? $currentUser->email : ''),
                            array('class' => 'ui input', 'readonly' => 'true', 'placeholder' => trans('cms.text')))}}
                    </div>
                    <div class="three wide field">
                        <label>{{trans('cms.status')}}</label>
                        <div class="ui toggle checkbox centered">
                             <input type="checkbox" name="status"  @if($currentUser->subscribed) checked @endif disabled>
                            <label>{{trans('cms.active')}}/{{trans('cms.disabled')}}</label>
                        </div>
                    </div>
                </div>
                <div class="fields">
                    <div class="four wide field">
                        <label>{{trans('cms.job')}}</label>
                        {{Form::text('job',
                            old('text', isset($currentUser->job) ? $currentUser->job : ''),
                            array('class' => 'ui input', 'readonly' => 'true', 'placeholder' => trans('cms.text')))}}
                    </div>
                    <div class="four wide field">
                        <label>{{trans('cms.location')}}</label>
                        {{Form::text('location',
                            old('text', isset($currentUser->location) ? $currentUser->location : ''),
                            array('class' => 'ui input', 'readonly' => 'true', 'placeholder' => trans('cms.text')))}}
                    </div>
                    <div class="four wide field">
                        <label>{{trans('cms.interests')}}</label>
                        {{Form::text('interested_in',
                            old('text', isset($currentUser->interested_in) ? $currentUser->interested_in : ''),
                            array('class' => 'ui input', 'readonly' => 'true', 'placeholder' => trans('cms.text')))}}
                    </div>
                    <div class="four wide field">
                        <label>{{trans('cms.type')}}</label>
                        {{Form::text('type',
                            old('text', isset($currentUser->type) ? $currentUser->type : ''),
                            array('class' => 'ui input', 'readonly' => 'true', 'placeholder' => trans('cms.type')))}}
                    </div>
                </div>
                <div class="fields">
                    <div class="four wide field">
                        <label>{{trans('cms.firstName')}}</label>
                        {{Form::text('first_name',
                            old('text',isset($currentUser->first_name) ? $currentUser->first_name : ''),
                            array('class' => 'ui input', 'readonly' => 'true', 'placeholder' => trans('cms.firstName')))}}
                    </div>
                    <div class="four wide field">
                        <label>{{trans('cms.lastName')}}</label>
                        {{Form::text('last_name',
                            old('text',isset($currentUser->last_name) ? $currentUser->last_name : ''),
                            array('class' => 'ui input', 'readonly' => 'true', 'placeholder' => trans('cms.lastName')))}}
                    </div>
                    <div class="four wide field">
                        <label>{{trans('cms.country')}}</label>
                        {{Form::text('country',
                            old('text',isset($currentUser->country) ? $currentUser->country : ''),
                            array('class' => 'ui input', 'readonly' => 'true', 'placeholder' => trans('cms.country')))}}
                    </div>
                    <div class="four wide field">
                        <label>City</label>
                        {{Form::text('location',
                            old('text',isset($currentUser->location) ? $currentUser->location : ''),
                            array('class' => 'ui input', 'readonly' => 'true', 'placeholder' => trans('cms.location')))}}
                    </div>
                    <div class="four wide field">
                        <label>{{trans('cms.phoneNumber')}}</label>
                        {{Form::text('phone_number',
                            old('text',isset($currentUser->phone_number) ? $currentUser->phone_number : ''),
                            array('class' => 'ui input', 'readonly' => 'true', 'placeholder' => trans('cms.phoneNumber')))}}
                    </div>
                </div>
                <div class="fields">
                    <div class="four wide field">
                        <label>{{trans('cms.userRole')}}</label>
                        <div class="ui toggle checkbox centered">
                            <input type="checkbox" name="user_type" @if( $currentUser->user_type == 'admin') checked @endif disabled>
                            <label>{{trans('cms.userNormal')}}/{{trans('cms.admin')}}</label>
                        </div>
                    </div>
                    <div class="four wide field">
                        <label>{{trans('cms.subscribed')}}</label>
                        <div class="ui toggle checkbox centered">
                            <input type="checkbox" name="user_type" disabled="disabled"  @if($currentUser->subscribed == '1') checked @endif>
                            <label>{{trans('cms.active')}}/{{trans('cms.disabled')}}</label>
                        </div>
                    </div>
                </div>
</div>