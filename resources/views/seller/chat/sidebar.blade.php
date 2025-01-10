<div class="chat-sidebar">
    <div class="chat-sidebar-content">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-Chats">
                <div class="chat-list">
                    <div class="list-group list-group-flush">
                        @foreach($senderUsers as $chat)
                            @php($user = $chat->sender)
                            <a href="{{ route('seller.chatPriavte', $user->id) }}" class="list-group-item">
                                <div class="d-flex">
                                    <div class="chat-user-online">
                                        <img src="{{ $user->avatar ? \Storage::url($user->avatar) : asset('theme/client/assets/images/logos/avatar.jpg') }}" width="42" height="42" class="rounded-circle" alt="" />
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-0 chat-title">{{ $user->name }}</h6>
{{--                                        <p class="mb-0 chat-msg">You just got LITT up, Mike.</p>--}}
                                    </div>
{{--                                    <div class="chat-time">9:51 AM</div>--}}
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
