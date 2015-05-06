@extends('layouts.game')

@section('content')
<div class="col-md-12">
    <div class="mail-area">
        <div class="mail-box-list">
            <ul class="mail-list">
                @foreach($conversations as $li_conversation)
                    <li class="new-mail">
                        <div class="mail-user-image user-picture">
                            <!--<i class="fa fa-user"></i>-->
                            <img src="/img/testavatar-80.png" alt="">
                        </div>
                        <div class="mail-user-mail">
                            <span>{{ $li_conversation->users[1]->name() }}</span>

                            <div class="mail-action">
                                <a href="javascript:void (0)"><i class="fa fa-eye"></i></a>
                                <a href="javascript:void (0)"><i class="fa fa-star"></i></a>
                                <a href="javascript:void (0)"><i class="fa fa-trash-o"></i></a>
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
                @foreach($messageGroups as $messageGroup)
                    <span class="name">{{ $messageGroup->getUser()->player->name() }}</span>
                    <span class="time">{{ $messageGroup->getStart()->format('d.m.Y H:i:s');  }}</span>
                    <div class="content">


                    @foreach($messageGroup->getMessages() as $message)
                        <p>{{ nl2br($message->content)  }}</p>
                    @endforeach
                    </div>
                @endforeach
            </div>

        </div>
    </div>

</div>

@endsection