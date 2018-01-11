@extends('frontend.layouts.main')

@section('content')
	<div class="container">
        <div class="row">

            @include('frontend.blocks.left-menu')
            <div class="page-main-content col-xs-12 col-md-10">

            	@include('frontend.blocks.templates.templates')
				<div id="vue-app">
						<lr-step-form :question="question" :step="step"></lr-step-form>
				</div>

            </div>
        </div>
    </div>





		<script type="text/javascript" src="https://unpkg.com/vue@2.2.6"></script>
		<script type="text/javascript" src="https://unpkg.com/vue-resource@1.3.3"></script>

		<script>
		window.Active = true;
			Vue.component('lr-fs-popup', {
			    template: '#lr-fs-popup'
			});

			Vue.component('lr-question', {
			    template: '#lr-question',
			    props: ['question'],
			    computed: {

			    }

			});

			Vue.component('lr-answer', {
			    template: '#lr-answer',
			    props: ['answer'],
			    data: function(){
			    	return {
			    		isActive:false
			    	}
			    },
			    methods: {
			    	selectAnswer: function(event){
			    		var data = [];
			    		data['id'] = this.answer.id;
			    		data['price'] = this.answer.price;
			    		this.$root.$emit('selectAnswer', data);
			    		if(this.$root.question.type == 0){
			    			document.getElementById(this.answer.id).classList.add('selected');
			    		}else{
			    			this.isActive = !this.isActive;
			    		}
			    	}
			    }
			});

			Vue.component('lr-step-button', {
			    template: '#lr-step-button',
			    props: ['step'],
			    methods: {
			    	submitAnswer: function(){
			    		disabled: true
			    		this.$root.$emit('nextQuestion');
			    	}
			    }
			});

			Vue.component('lr-step', {
			    template: '#lr-step',
			    props: ['question', 'step']
			});

			Vue.component('lr-step-form', {
			    template: '#lr-step-form',
			    props: ['question', 'step']
			});

			var Root = new Vue({
			    el: '#vue-app',
			    data: {
			    	question: {},
			    	selectedAnswers: [],
			    	step: 0,
			    	estimate: {
			    		id: {{$estimate->id}}
			    	}
			    },
			    methods: {
			    	init: function(){

			    		this.getQuestion();
			    	},
			    	getQuestion: function(){
			    		var data = {'estimate_id' : this.estimate ? this.estimate.id : null};
			    		this.$http.post('{{URL::to("api/get-questions")}}', data).then(response => {
			    			if(response.body.question){
			    				this.question = response.body.question;
						    	console.log(this.question);
						    	this.estimate = response.body.estimate;
						    	this.step = response.body.step;
						    	return;
			    			}

			    			// Redirect to total or show another view
			    			window.location = "{{URL::route('calculate.final', ['estimate' => $estimate->id])}}";
			    			return false;

					  	}, response => {
					  		console.log(response);
					  	});
			    	},
			    	submitAnswer: function(event){

			    		var count = 0;
						for(var i = 0; i < this.selectedAnswers.length; ++i){
						    if(typeof this.selectedAnswers[i] != 'undefined')
						        count++;
						}
			    		if(count){
			    			$(".submitAnswer").attr("disabled", true);
			    			var data = {'estimate_id' : this.estimate.id, 'question_id' : this.question.id, 'answers': Object.entries(this.selectedAnswers)};
							this.$http.post('{{URL::to("api/submit-answer")}}', data).then(response => {
						    	if(response.body.response){
						    		this.getQuestion();
						    	} else {
						    		alert('error pliz fix');
						    	}
						    	this.selectedAnswers = [];
						  	}, response => {
						    	console.log(response);
						  	});
						}else{
							alert('Choose an answer!');
						}

			    	},
			    	selectAnswer: function(data){
			    		if( data['id'] in this.selectedAnswers ){
			    			var index = data['id'];
			    		}else{
			    			var index = -1;
			    		}
			    		switch(this.question.type) {
			    			case 0:
			    				var answers = document.querySelectorAll(".selected");
			    				for (let i=0; i<answers.length; i++) {
						            answers[i].classList.remove("selected");
						        }
			    				questionType = this.question.type;
			    				this.selectedAnswers = [];
			    				this.selectedAnswers[data['id']] = data['price'];
			    				break;
			    			case 1:
			    				if(index == -1){
			    					this.selectedAnswers[data['id']] = data['price'];
			    				} else {
			    					delete this.selectedAnswers[index];
			    				}
			    				break;
			    			default:

			    			}
			    		}
			    	},
			    created: function(){
			    	this.init();

			    	this.$on('nextQuestion', function (event) {
			            this.submitAnswer(event);
			        });

			        this.$on('selectAnswer', function (event) {
			            this.selectAnswer(event);
			        });

			     //    this.$on('closeContextMenu', function (event) {
			     //        this.closeContextMenu(event);
			     //    });
			     //    this.$on('addNode', function (type) {
			     //        this.addNode(type);
			     //    });
			     //    this.$on('initCanvas', function (canvas) {
			     //        this.canvas = canvas;
			     //    });
			    },
			    mounted: function(){
			    	// this.init();
			    }
			});

		</script>
@endsection
