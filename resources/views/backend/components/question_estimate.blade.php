            <div class="answers-wrapper clearfix">
                <div class="answer-title">
                    @if($response->question) {{$response->question->position}}: {{$response->question->text}} @endif
                </div>
                <span class="ui compact mini icon button slide-down">
                    <i class="caret down icon"></i>
                </span>
                <div class="answer-content {{session('lastEditedAnswer') && isset($answer) && $answer->id == session('lastEditedAnswer') ?  'extended' : '' }}">
                    <div class="ui form">
                        <div class="fields">
                            <div class="ten wide field">
                                <label>{{trans('cms.text')}}</label>
                                {{Form::text('text', $response->question ? $response->question->text : '',
                                    array('class' => 'ui input', 'readonly' => 'true', 'placeholder' => trans('cms.text')))}}
                            </div>
                            <div class="four wide field">
                                <label>Type of question</label>
                                {{Form::text('type', $response->question->type == 1 ? 'Multiple Choices' : 'Single Choice',
                                    array('class' => 'ui input', 'readonly' => 'true'))}}
                            </div>
                        </div>
                        <label>Answers</label>
                        <div class="ui divider"></div>
                    </div>
                    @foreach($estimate->responses->where('question_id',$response->question_id) as $value)
                        @include("backend.components.estimate_response", ['answer' => $value->answer] )
                    @endforeach
                </div>
            </div>