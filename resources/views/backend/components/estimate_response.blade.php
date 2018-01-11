            <div class="answers-wrapper clearfix">
                <div class="answer-title">
                    @if($answer) {{$answer->id}}: {{$answer->text}} @else Add answer @endif
                </div>
                <span class="ui compact mini icon button slide-down">
                    <i class="caret down icon"></i>
                </span>
                <div class="answer-content {{session('lastEditedAnswer') && isset($answer) && $answer->id == session('lastEditedAnswer') ?  'extended' : '' }}">
                    <div class="ui form">
                        <input type="hidden" name="parent_id" value="{{$currentQuestion->id}}">
                        <div class="fields">
                            <div class="ten wide field">
                                <label>{{trans('cms.text')}}</label>
                                {{Form::text('text', $answer ? $answer->text : '',
                                    array('class' => 'ui input','readonly' => 'true', 'placeholder' => trans('cms.text')))}}
                            </div>
                            <div class="two wide field">
                                <label>{{trans('cms.price')}}</label>
                                {{Form::number('price', $answer ? $answer->price : 0,
                                    array('class' => 'ui input','readonly' => 'true' ,'placeholder' => trans('cms.price')))}}
                            </div>
                        </div>
                        <div class="ui divider"></div>
                    </div>
                </div>
            </div>