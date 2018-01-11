{{-- <template id="lr-fs-popup">
	<div id="popup-login" class="pop-up row" style="display: none;">
        <div class="background">
            <div class="container">
                <div class="pop-up-inner">
                    <div class="create-your-app">
                        <a href="/home.html" class="text-left">Create <br> your<span class="app">App.</span></a>
                    </div>
                    <div class="modal-box">
                        <div class="modal-container">
                            <span class="header-text">Login</span>
                            <span class="content-text">Use your username or e-mail address &amp; log in with your password at erstelle-deine-app.de.</span>
                            <input type="text" name="email" placeholder="e-mail address or username">
                            <input type="password" name="password" placeholder="type in your password">
                            <a href="#" id="forgot-pass" class="under-text">Forgot your password?</a>
                            <a href="#" class="button button-text">Let's go!</a>
                            <a href="#" class="under-text no-account">You do not have an account at create-your-app.de?</a>
                        </div>
                    </div>
                    <a href="#" class="close-button">
                        <i class="icon-Exit">&nbsp;</i>
                        <span class="close-text">Close</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template> --}}
<link href="{{ asset('css/styles.css') }}" media="all" rel="stylesheet" type="text/css" />

<template id="lr-question">
	<h1>@{{question.text}}</h1>
</template>

{{-- <template id="lr-answer">
    <div class="box-choice">
        <a href="#" class="box-choice-inner" @click.prevent="selectAnswer" v-bind:class="{ selected: isActive }">
            <img class="box-icon ios" src="{{asset('/images/windows.png')}}">
            <i class="icon-Like">&nbsp;</i>
            <span class="box-title">@{{answer.text}}</span>
        </a>
    </div>
</template>
 --}}

<template id="lr-answer">
    <div class="col-xs-12 col-sm-4">
        <div class="system user-option"  @click.prevent="selectAnswer" v-bind:class="{ selected: isActive }" v-bind:id="answer.id">
            <div class="overlay">
                <i class="icon-Like"></i>
            </div>
            <div class="image-wrapper">
                <img class="img-responsive" v-bind:src="'../design/images/' + answer.image" :alt="answer.text" width="100px" height="100px"/>
            </div>
            <input type="checkbox" name="option[android]" id='input'>
            <span class="option-title">@{{answer.text}}</span>
        </div>
    </div>
</template>

<template id="lr-step-button">
    <div class="submit">
        <button @click.prevent="submitAnswer" class="submitAnswer" v-bind:disabled="disabled">
            <span>continue to step</span>
            <span class="step-counter">@{{step}}</span>
        </button>
    </div>
</template>

<template id="lr-step">
	<div>
		<lr-question :question="question"></lr-question>
		<div class="systems clearfix">
			<lr-answer v-for="answer in question.answers" :answer="answer" :key="answer.id"></lr-answer>
		</div>
		<lr-step-button :step="step"></lr-step-button>
	</div>
</template>

<template id="lr-step-form">
	<div class="step-wrapper">
        <form class="step-form">
    		<lr-step :question="question" :step="step"></lr-step>
        </form>
	</div>
</template>
