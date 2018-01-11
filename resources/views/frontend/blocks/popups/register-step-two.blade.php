<div id="register-step-two" class="custom-popup @if(!Session::has('registerError'))hidden-popup @endif">
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
            <h2 class="title">tell lori who you are</h2>

            <form id="registration" action="{{URL::route('register.create')}}" enctype="multipart/form-data">
                {{ method_field('PUT') }}
            {{csrf_field()}}
            @include('backend.components.message')
                <div class="fields">
                    <div class="field">
                        <input type="text" name="name" placeholder="What's your username?" required/>
                    </div>
                    <div class="field">
                        <div class="select-wrapper">
                            <select name="job" onchange="this.className='selected-green'">
                                <option selected="selected" disabled>What's your job?</option>
                                <option value="Managing Director / Owner" class="option-green">Managing Director / Owner</option>
                                <option value="Manager / Management Position" class="option-green">Manager / Management Position</option>
                                <option value="Head of department" class="option-green">Head of department</option>
                                <option value="Employee" class="option-green">Employee</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="fields">
                    <div class="field">
                        <input type="text" name="first_name" placeholder="What's your first name?" name="name" required/>
                    </div>
                    <div class="field">
                        <input type="text" name="last_name" placeholder="What's your last name?" required/>
                    </div>
                </div>

                <div class="fields">
                    <div class="field">
                        <input type="email" name="email" placeholder="Tell me your email address" required/>
                    </div>
                    <div class="field">
                        <input type="password" name="password" placeholder="Your desired password?" required/>
                    </div>
                </div>
                <div class="fields">
                    <div class="field">
                        <input type="text" name="phone_number" placeholder="What's your phone number?"/>
                    </div>
                    <div class="field">
                        <div class="select-wrapper">
                            <select name="interests" onchange="this.className='selected-green'">
                                <option selected="selected" disabled>What are you interested in?</option>
                                <option value="Interest1" class="option-green">Interest1</option>
                                <option value="Interest2" class="option-green">Interest2</option>
                                <option value="Interest3" class="option-green">Interest3</option>
                                <option value="Interest4" class="option-green">Interest4</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="fields">
                    <div class="field">
                        <div class="select-wrapper" >
                            <?php $countries =  Session::get('countries'); ?>
                            <select name="country" id="country" class="js-example-basic-single form-control">
                            <option  selected="selected" disabled style="color: #e9e9e9;">
                            What country are you from?</option>
                               @foreach ($countries as $key => $country)
                                    <option value="{{ $key }}">
                                        {{ $country[0]}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="field">
                        <div class="select-wrapper" >
                        <select name="location" id="city" class="js-example-basic-single form-control">
                            <option  selected="selected" disabled style="color: #e9e9e9;">
                            What city are you from?</option>
                        </select>
                        </div>
                    </div>
                </div>

                <div class="fields">
                    <div class="field allow">
                        <input id="allow" type="checkbox" name="status"/>
                        <label for="allow">Allowed to send me information</label>
                    </div>
                    <div class="field">
                        <label class="user-status">I am:</label>

                        <div class="user-type">
                            <div class="user-type-field">
                                <input id="company" type="radio" name="type" value="Company" />
                                <label for="company">Company</label>
                            </div>
                            <div class="user-type-field">
                                <input id="self-employed" type="radio" name="type" value="Self-employed" />
                                <label for="self-employed">Self-employed</label>
                            </div>
                            <div class="user-type-field">
                                <input id="student" type="radio" name="student"name="type" value="Student" />
                                <label for="student">Student</label>
                            </div>
                            <div class="user-type-field">
                                <input id="others" type="radio" name="type" value="Others" />
                                <label for="others">Others</label>
                            </div>

                        </div>
                    </div>
                </div>

                <button id="free-registration-done" type="Submit">register for free!</button>
            </form>


            <div class="pager register-pager">
                <div class="step first-step current">
                    <i class="icon-Arrow"></i>
                    <span class="page">2</span>
                </div>
                <span class="separator">
                    /
                </span>
                <div class="step second-step">
                    <span class="page">2</span>
                    <i class="icon-Arrow"></i>
                </div>
            </div>

        </div>
    </div>

</div>