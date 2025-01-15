import '../bootstrap.js';
Echo.private(`chat.private.${ userSend }.${ userReceiver }`)
    .listen('ChatPrivate',e => {
        let listMessage = $('.chat-content')
        let UI;
        if (userSend == e.userSend.id){
            UI = `
                <div class="chat-content-rightside">
                    <div class="d-flex ms-auto">
                        <div class="flex-grow-1 me-2">
                            <p class="mb-0 chat-time text-end">${ e.created_at }</p>
                            <p class="chat-right-msg">${ e.message }</p>
                        </div>
                    </div>
                </div>
            `;
        }else{
            UI = `
                <div class="chat-content-leftside">
                    <div class="d-flex">
                        <img src="${ e.userSend.avata }" width="48" height="48"
                             class="rounded-circle" alt=""/>
                        <div class="flex-grow-1 ms-2">
                            <p class="mb-0 chat-time">${ e.created_at }</p>
                            <p class="chat-left-msg">${ e.message }</p>
                        </div>
                    </div>
                </div>
            `;
        }
        listMessage.append(UI);
        listMessage.scrollTop(listMessage[0].scrollHeight);
    })
Echo.private(`chat.private.${ userReceiver }.${ userSend }`)
    .listen('ChatPrivate',e => {
        let listMessage = $('.chat-content')
        let UI;
        if (userReceiver == e.userSend.id){
            UI = `
                <div class="chat-content-leftside">
                    <div class="d-flex">
                        <img src="${ e.userSend.avata }" width="48" height="48"
                             class="rounded-circle" alt=""/>
                        <div class="flex-grow-1 ms-2">
                            <p class="mb-0 chat-time">${ e.created_at }</p>
                            <p class="chat-left-msg">${ e.message }</p>
                        </div>
                    </div>
                </div>
            `;

        }else{
             UI = `
                <div class="chat-content-rightside">
                    <div class="d-flex ms-auto">
                        <div class="flex-grow-1 me-2">
                            <p class="mb-0 chat-time text-end">${ e.created_at }</p>
                            <p class="chat-right-msg">${ e.message }</p>
                        </div>
                    </div>
                </div>
            `;
        }
        listMessage.append(UI);
        listMessage.scrollTop(listMessage[0].scrollHeight);
    })

const btnSend = $('#send_btn');
const message = $('#chat-message');
btnSend.on('click', (e) => {
    e.preventDefault();
    $.ajax({
        url: routeLinkChat,
        data: {
            'message': message.val(),
            'userSendId': userSend,
        },
        method: 'POST',
        success: function (data) {
            message.val('')
            console.log(data)
        },
        error: function (e) {
            console.log(e)
        }
    });
})
