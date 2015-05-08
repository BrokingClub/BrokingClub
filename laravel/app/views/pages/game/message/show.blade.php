@extends('layouts.game')

@section('content')
<div class="col-md-12">
    <div class="mail-area">
        <div class="mail-box-list">
            <ul class="mail-list">
                @foreach($conversations as $li_conversation)
                    <li class="@if($li_conversation->isUnread()) new-mail @endif @if($li_conversation->id == $conversation->id) active @endif">
                        <div class="mail-user-image user-picture">
                            <!--<i class="fa fa-user"></i>-->
                            <img src="/img/testavatar-80.png" alt="">
                        </div>
                        <div class="mail-user-mail">

                            <a href="{{ URL::route('messages.show', [$li_conversation->id]) }}">{{ $li_conversation->otherUsers()->first()->name() }}</a>

                            <div class="mail-action">
                                <a href="{{ URL::route('messages.show', [$li_conversation->id]) }}"><i class="fa fa-eye"></i></a>
                                <a href="{{ URL::route('messages.show', [$li_conversation->id]) }}"><i class="fa fa-star"></i></a>
                                <a href="{{ URL::route('messages.destroy', [$li_conversation->id]) }}"><i class="fa fa-trash-o"></i></a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>

    <div class="mail-body mail-body-inbox">
        <div class="mail-main-content">
            <div class="col-md-12 message-column">
                <div class="messages">
                @foreach($messageGroups as $messageGroup)
                    <div class="message">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="name">{{ $messageGroup->getUser()->player->name() }}</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <span class="time">{{ $messageGroup->getStart()->format('d.m.Y H:i:s');  }}</span>
                            </div>
                            <div class="col-md-12">
                                <div class="content">
                                    @foreach($messageGroup->getMessages() as $message)
                                    <p>{{ nl2br($message->content)  }}</p>
                                @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
                </div>
                <div class="new-message-container">
                    {{Form::open(array('route' => array('messages.update', $conversation->id), 'method' => 'PUT'))}}
                        <textarea class="form-control" name="message"></textarea>
                        <input class="btn btn-success btn-block" type="submit" value="Send" />
                    {{ Form::close() }}
                </div>
            </div>

        </div>
    </div>

</div>

@endsection