<div id="update-my-account-popup" class="custom-popup @if(!Session::has('success'))hidden-popup @endif">
    <div class="container">
        <a href="#" title="Create your app" class="logo">
            <span class="logo-font-light">Create</span>
            <span class="logo-font-light">your</span>
            <span class="logo-font-bold">App.</span>
        </a>
        <a href="#" title="Close" class="close-popup">
            <i class="icon-Exit"></i>
            <span>close</span>
        </a>
    </div>
    <div class="container text-center no-p-mobile">
        <div class="custom-box">
            <h2 class="title">My account</h2>
            @if(Auth::user())
            <form id="update-my-account" method="POST" action="{{URL::route('users.update', ['id' => Auth::user()->id])}}" enctype="multipart/form-data">
            @if(isset(Auth::user()->id))
                {{ method_field('PUT') }}
            @else
                {{ method_field('POST') }}
            @endif
            @if(Session::has('success'))
            <p class="desc error">The account has been updated succesfully.</p>
            @endif
            {{csrf_field()}}
            <input type="text" name="form" value="frontend" hidden>
                <div class="fields">
                    <div class="field">
                        <label>Username </label>
                        <input type="text" name="name" placeholder=""
                        value="{{Auth::user()->name}}" readonly/>
                    </div>
                    <div class="field">
                        <label>First name </label>
                        <input type="text" name="first_name" placeholder=""
                        value="{{Auth::user()->first_name}}"/>
                    </div>
                    <div class="field">
                        <label>Last name </label>
                        <input type="text" name="last_name" placeholder=""
                        value="{{Auth::user()->last_name}}"/>
                    </div>
                    <div class="field">
                        <label>Phone number </label>
                        <input type="text" name="phone_number" placeholder=""
                        value="{{Auth::user()->phone_number}}"/>
                    </div>
                    <div class="field">
                        <div class="select-wrapper">
                            <label>Job</label>
                            <select name="job" onchange="this.className='selected-green'" id="selectJob">
                            <option selected="selected" disabled>What's your job?</option>
                            <?php $jobs = array('Managing Director / Owner', 'Manager / Management Position',
                                'Head of department', 'Employee') ?>
                            <?php $jobDB = Auth::user()->job ?>
                                @foreach ($jobs as $job)
                                    @if($jobDB != $job)
                                        <option value=" {{ $job }} " class="option-green">
                                            {{ $job }}
                                        </option>
                                    @else
                                        <option value=" {{ $job }} " class="option-green" selected="true">
                                            {{ $job }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="fields">
                    <div class="field">
                        <label>Email</label>
                        <input type="email" name="email" placeholder=""
                        value="{{Auth::user()->email}}"/>
                    </div>
                </div>
                <div class="fields">
                    <div class="field">
                        <div class="select-wrapper">
                            <label>Intersted in</label>
                            <select name="interested_in" onchange="this.className='selected-green'" id="selectInterest">
                                <option selected="selected" disabled>What are you interested in?</option>
                                <?php $interests = array('Interest1', 'Interest2', 'Interest3', 'Interest4') ?>
                                <?php $interestDB = Auth::user()->interested_in ?>
                                @foreach ($interests as $interested_in)
                                    @if($interestDB != $interested_in)
                                        <option value="{{ $interested_in }}" class="option-green" >
                                        {{ $interested_in }}
                                        </option>
                                    @else
                                        <option value="{{ $interested_in }}" class="option-green" selected="true">
                                        {{ $interested_in }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="field">
                        <label>Country</label>
                            <div class="select-wrapper" >
                                <select name="country" id="countryID"  class="js-example-basic-single  form-control">
                                <option  selected="selected" disabled style="color: #e9e9e9;">
                                Where country are you from?</option>
                                    <?php $countries =  Session::get('countries'); ?>
                                    <?php $countryDB = Auth::user()->country ?>
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
                    <div class="field">
                        <label>City</label>
                        <div class="select-wrapper" >
                        <select name="location" id="cityId" class="js-example-basic-single form-control">
                            <?php $cityDB = Auth::user()->location ?>
                            <input value="{{ $cityDB }}" id="cityDB" hidden/>
                        </select>
                        </div>
                    </div>
                </div>

                <div class="fields">
                    <div class="field allow">
                        @if(Auth::user()->subscribed == 1)
                            <input id="allow" type="checkbox" name="status" checked="checked"/>
                        @else
                            <input id="allow" type="checkbox" name="status"/>
                        @endif
                            <label for="allow" >Allowed to send me information</label>

                    </div>
                    <div class="field">
                        <input id='type' type="" name="type"
                        value="{{Auth::user() ? Auth::user()->type : session()->get('type')}}" hidden>
                        <label class="user-status">I am:</label>

                        <div class="user-type">
                            <?php $types = array('Company', 'Self-employed', 'Student', 'Others') ?>
                                <?php $typeDB = Auth::user()->type ?>
                                @foreach ($types as $type)
                                    @if($typeDB != $type)
                                        <div class="user-type-field">
                                            <input id="type" type="radio" name="type" value="{{ $type }}" />
                                            <label for="type">{{ $type }}</label>
                                        </div>
                                    @else
                                        <div class="user-type-field">
                                            <input id="type" type="radio" name="type" value="{{ $type }}" checked />
                                            <label for="type">{{ $type }}</label>
                                        </div>
                                    @endif
                                @endforeach
                        </div>
                    </div>
                </div>
                <button type="Submit">Save</button>
            </form>
            @endif
        </div>

    </div>
</div>