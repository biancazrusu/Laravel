            <div class="answers-wrapper clearfix">
                <div class="answer-title">
                    @if($answer) {{$answer->id}}: {{$answer->text}} @else Add answer @endif
                </div>
                <span class="ui compact mini icon button slide-down">
                    <i class="caret down icon"></i>
                </span>
                <div class="answer-content {{session('lastEditedAnswer') && isset($answer) && $answer->id == session('lastEditedAnswer') ?  'extended' : '' }}">
                    <form class="ui form" method="POST" enctype="multipart/form-data"
                        @if(isset($answer) && $answer->id)
                        action="{{URL::route('answers.update', ['id' => $answer->id])}}"
                        @else
                        action="{{URL::route('answers.store')}}"
                        @endif>
                        {{ csrf_field() }}

                        @if(isset($answer))
                        {{ method_field('PUT') }}
                        @else
                        {{ method_field('POST') }}
                        @endif

                        <input type="hidden" name="parent_id" value="{{$currentQuestion->id}}">
                        <div class="fields">
                            <div class="ten wide required field">
                                <label>{{trans('cms.text')}}</label>
                                {{Form::text('text', $answer ? $answer->text : '',
                                    array('class' => 'ui input', 'placeholder' => trans('cms.text')))}}
                            </div>
                            <div class="two wide required field">
                                <label>{{trans('cms.price')}}</label>
                                {{Form::number('price', $answer ? $answer->price : 0,
                                    array('class' => 'ui input', 'placeholder' => trans('cms.price')))}}
                            </div>
                            <div class="three wide field">
                                <label>{{trans('cms.status')}}</label>
                                <div class="ui toggle checkbox centered">
                                {{Form::checkbox('status',
                                    true,
                                    $answer ? $answer->status : '')}}
                                    <label>{{trans('cms.disabled')}}/{{trans('cms.active')}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="fields">
                            <div class="ten wide field">
                                <label>{{trans('cms.childQuestions')}}</label>
                                <div class="ui fluid multiple search selection dropdown">
                                    <input type="hidden" name="child_questions" value="{{isset($answer) ? implode(',', $answer->children->pluck('id')->toArray()) : ''}}">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">{{trans('cms.childQuestions')}}</div>
                                    <div class="menu">
                                        @foreach (\App\Models\Question::all()->except($currentQuestion->id) as $question)
                                        <div class="item"
                                            data-value="{{$question->id}}"
                                            data-text="{{$question->id}}: {{$question->text}}">{{$question->id}}: {{$question->text}}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="ten wide required field">
                                    <label>{{trans('cms.position')}}</label>
                                    {{Form::number('position', $answer ? $answer->position : 0,
                                        array('class' => 'ui input', 'style' => 'width: 90px;', 'placeholder' => trans('cms.position')))}}
                                </div>
                                <div class="six wide field">
                                    <label>{{trans('cms.image')}}</label>
                                    <input type='file' name="image" style="width: 300px;">
                                    @if(isset($answer))
                                    <img src="{{url('/')}}/design/images/{{$answer->image}}" width="100px" height="100px">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="ui divider"></div>

                        <button class="ui right floated mini button green" type="submit">{{trans('cms.save')}}</button>
                        {!!Form::close() !!}
                    </form>
                    <form action="{{URL::route('answers.destroy',['id' => $answer])}}" method="POST">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="ui right floated mini button red" type="submit" >{{trans('cms.delete')}}</a>
                    </form>
                </div>
            </div>