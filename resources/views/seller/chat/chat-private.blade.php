@extends('seller.chat.layout')
@section('content-chat')
    <div class="chat-header d-flex align-items-center">
        <div class="chat-toggle-btn"><i class='bx bx-menu-alt-left'></i>
        </div>
        <div>
            <h4 class="mb-1 font-weight-bold">{{ $userReceive->name }}</h4>
            <div class="list-inline d-sm-flex mb-0 d-none"> <a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary"><small class='bx bxs-circle me-1 chart-online'></small>Active Now</a>
            </div>
        </div>
    </div>
    <div class="chat-content">
        @foreach($listMessages->reverse() as $chat)
            @if($chat->	user_send_id === $userSend->id)
                <div class="chat-content-rightside">
                    <div class="d-flex ms-auto">
                        <div class="flex-grow-1 me-2">
                            <p class="mb-0 chat-time text-end">{{ $chat->formatted_created_at }}</p>
                            <p class="chat-right-msg">{{ $chat->message }}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="chat-content-leftside">
                    <div class="d-flex">
                        <img src="{{ $userReceive->avatar ? \Storage::url($userReceive->avatar): asset('theme/client/assets/images/logos/avatar.jpg') }}" width="48" height="48"
                             class="rounded-circle" alt=""/>
                        <div class="flex-grow-1 ms-2">
                            <p class="mb-0 chat-time">{{ $chat->formatted_created_at }}</p>
                            <p class="chat-left-msg">{{ $chat->message }}</p>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

    </div>
    <div class="chat-footer d-flex align-items-center">
        <div class="flex-grow-1 pe-2">
            <div class="input-group"><span class="input-group-text"><i class='bx bx-smile'></i></span>
                <input type="text" id="chat-message" class="form-control" placeholder="Type a message">
            </div>
        </div>
        <div class="chat-footer-menu">
            <a href="javascript:;" id="send_btn"><i class='bx bx-send'></i></a>
        </div>
    </div>
@endsection

@section('js-chat')
    <script>
        const userReceiver = {{ $userReceive->id }};
        const userSend = {{ $userSend->id }};
        const routeLinkChat = '{{ route('messagePrivate', $userReceive->id) }}';
    </script>
@vite( 'resources/js/seller/chat-private.js')
@endsection
