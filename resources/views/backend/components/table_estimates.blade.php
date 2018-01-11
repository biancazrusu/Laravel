        <div class="sixteen wide column content">
            @include('backend.components.message')
            <table id="{{$id}}" class="ui table selectable striped unstackable paginated">
                <thead>
                    <tr>
                        <th>{{trans('cms.id')}}</th>
                        <th>{{trans('cms.user')}}</th>
                        <th>{{trans('cms.completed')}}</th>
                        <th>{{trans('cms.status')}}</th>
                        <th>{{trans('cms.createdAt')}}</th>
                        <th>{{trans('cms.updatedAt')}}</th>
                        <th>{{trans('cms.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($estimates))
                        @foreach($estimates as $estimate)
                        <tr>
                            <td>{{$estimate->id}}</td>
                            <td>
                            <?php $user = \App\User::find($estimate->user_id); ?>
                            {{ $user->name }}
                            </td>
                            <td>{{$estimate->completed ? trans('cms.yes') : trans('cms.no')}}</td>
                                @php
                                    switch ($estimate->status){
                                        case 0:
                                            echo "<td>Pending</td>";
                                            break;
                                        case 1:
                                            echo "<td>Canceled</td>";
                                            break;
                                        case 2:
                                            echo "<td>Contacted</td>";
                                            break;
                                        case 3:
                                            echo "<td>Finished</td>";
                                            break;
                                        case 4:
                                            echo "<td>Not Completed</td>";
                                            break;
                                        default:
                                            break;
                                    }
                                @endphp
                            <td>{{$estimate->created_at}}</td>
                            <td>{{$estimate->updated_at}}</td>
                            <td class="collapsing">
                                <a class="ui icon button blue mini" href="{{URL::route('estimate.estimateEdit', ['id' => $estimate->id, 'question' => null ])}}">
                                    <i class="search icon"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <td colspan="16"><p>{{trans('cms.noQuestions')}}</p></td>
                    @endif
                </tbody>
            </table>
        </div>