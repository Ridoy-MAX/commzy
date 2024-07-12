@extends('layouts.dashboard')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <div class="dashboard__content hover-bgc-color">
        <div class="row pb40">
            <div class="col-lg-12">
            @include('components.main_component.dashboard_navigation')
            </div>
        </div>
        <div class="row pb40">
            <div class="col-lg-12">
                <div class="dashboard_title_area">
                    <h2>Messages</h2>
                    <p class="text">Communicate with your team.</p>
                </div>
            </div>
        </div>
        <div class="row mb40">
            <div class="col-lg-6 col-xl-5 col-xxl-4">
                <div class="message_container">
                    <div class="inbox_user_list">
                        <div class="iu_heading pr35">
                            <div class="chat_user_search">
                                <form class="d-flex align-items-center">
                                    <button class="btn" type="submit"><span
                                            class="far fa-magnifying-glass"></span></button>
                                    <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                </form>
                            </div>
                        </div>
                        <div class="chat-member-list pr20" style="">
                            @foreach ($users as $item)
                                <div class="list-item">
                                    <a href="{{ route('open.conversation', $item->username) }}">
                                        <div class="d-flex align-items-center position-relative">
                                            <img class="img-fluid float-start rounded-circle mr10"
                                                style="border-radius: 50%; height: 50px" width="40px"
                                                src="{{ asset($item->profile_pic) }}" alt="{{ $item->username }}"
                                            >
                                            <div class="d-sm-flex">
                                                <div class="d-inline-block">
                                                    <div class="fz15 fw500 dark-color ff-heading mb-0">{{ $item->name }}
                                                    </div>
                                                    <p class="preview">
                                                        @if (isset($item->display_name))
                                                            {{ $item->display_name }}
                                                        @else
                                                            {{ $item->username }}
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="iul_notific">
                                                    <small>35 mins</small>
                                                    <div class="m_notif online">2</div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-7 col-xxl-8">
                <div class="message_container mt30-md">
                    <div class="user_heading px-0 mx30">
                        <div class="wrap">
                            <img class="img-fluid mr10" style="border-radius: 50%; height: 50px" width="50px"
                                src="{{ asset($user->profile_pic) }}" alt="{{ $user->username }}">
                            <div class="meta d-sm-flex justify-content-sm-between align-items-center">
                                <div class="authors">
                                    <h6 class="name mb-0">{{ $user->name }}</h6>
                                    <p class="preview">{{ $user->isActive ? 'Online' : 'Offline' }}</p>
                                </div>
                                <div>
                                    <a class="text-decoration-underline fz14 fw500 text-red ff-heading"
                                        onclick="alert('Are you sure?')"
                                        href="{{ route('delete.conversation', $conversation->id) }}">Delete Conversation</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="inbox_chatting_box">
                        <ul class="chatting_content">
                            @if (!is_null($messages))
                                @foreach ($messages as $message)
                                    @if ($message->sender_id === auth()->user()->id)
                                        <li class="sent float-end">
                                            <div class="d-flex align-items-center justify-content-end mb15">
                                                <div class="title fz15"> Me <small class="ml10">{{ $message->created_at->diffForHumans() }}</small></div>
                                            </div>
                                            <p>{{ $message->message }}</p>
                                        </li>
                                    @else
                                        <li class="reply float-start mb-3">
                                            <div class="d-flex align-items-center justify-content-start mb15">
                                                <div class="title fz15"> {{ $message->sender->name }} <small class="mr10">{{ $message->created_at->diffForHumans() }}</small></div>
                                            </div>
                                            <p>{{ $message->message }}</p>
                                        </li>
                                    @endif
                                    @endforeach
                                    <div class="message_replied" id="message_replied">
                                    </div>
                            @else
                                <p>Send a message</p>
                            @endif
                        </ul>
                    </div>

                    <div class="mi_text">
                        <div class="message_input">
                            <form class="d-flex align-items-center">
                                @csrf
                                <input class="form-control" id="message-input" type="text" name="message" placeholder="Type a Message" aria-label="Search">
                                <button type="button" id="send-button" class="btn btn-sm ud-btn btn-thm"><i class="fal fa-send"></i></button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <audio id="notificationSound" src="{{ asset('/audio/notification.mp3') }}" preload="auto" style="display: none"></audio>
    <!-- Include Pusher JavaScript library -->
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!-- Initialize Pusher and subscribe to the 'chat' channel -->
    <script>
        Pusher.logToConsole = true;
        const pusher = new Pusher('ab0facefdb30487aa4f2', {
            cluster: 'ap1'
        });
        const channel = pusher.subscribe('public');

        //Receive messages
        channel.bind('chat', function(data) {
            var message = data.message;
            var messageHtml = '<li class="reply float-start mb-3">' +
                '<div class="d-flex align-items-center justify-content-start mb15">' +
                '<div class="title fz15">{{ $user->name }} <small class="mr10">@if(!is_null($messages)) {{ $message->created_at->diffForHumans() }} @endif</small> </div>' +
                '</div>' +
                '<p>' + message.message + '</p>' +
            '</li>';
            $("#message_replied").last().before(messageHtml);
            $(document).scrollTop($(document).height());

            // Play the notification sound
            var audio = document.getElementById("notificationSound");
            audio.play();
        });

        //Broadcast messages
        $("#send-button").click(function(event) {
            event.preventDefault();

            $.ajax({
                url: "{{ route('broadcast', ['receiverId' => $receiverId, 'conversation_id' => $conversation->id]) }}",
                method: 'POST',
                headers: {
                    'X-Socket-Id': pusher.connection.socket_id
                },
                data: {
                    _token: '{{ csrf_token() }}',
                    message: $("form #message-input").val(),
                }
            }).done(function(res) {
                $("#message_replied").last().before(res);
                $("form #message-input").val('');
                $(document).scrollTop($(document).height());
            });
        });
    </script>
@endsection
