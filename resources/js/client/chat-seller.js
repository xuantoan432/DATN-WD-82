import '../bootstrap.js';

const chatSeller = $('#chat-seller')
const actionChatClose = $('#action_menu_btn');
actionChatClose.on('click', (e) => {
    $('.chat-position-fixed').css('display', 'none');
})
chatSeller.on('click', (e) =>{
    $('.chat-position-fixed').css('display', 'block');
    const btnSend = $('#send_btn');
    const message = $('#chat-message');
    $.ajax({
        url: routeListMessage,
        data: {
            'userSendId': userSend,
            'userReceiverID': userReceiver,
        },
        method: 'GET',
        success: function (data) {
            let listMessage = $('.msg_card_body');
            listMessage.empty();
            console.log(data)
            data.reverse().forEach(e => {
                let isSender = e.user_send_id ==  userSend;
                let avata;
                if (e.sender.avatar){
                    avata = '/storage/' + e.sender.avatar
                }else{
                    avata = '/theme/client/assets/images/logos/avatar.jpg';
                }
                let UI = `
                <div class="d-flex justify-content-${isSender ? 'end' : 'start'} mb-4">
                    <div class="img_cont_msg">
                        <img src="${avata}" class="rounded-circle user_img_msg">
                    </div>
                    <div class="msg_cotainer">
                        ${e.message}
                        <span class="msg_time">${e.formatted_created_at}</span>
                    </div>
                </div>
            `;

                listMessage.append(UI);
            });
            listMessage.scrollTop(listMessage[0].scrollHeight);
        },
        error: function (e) {
            console.log(e)
        }
    });
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
})
Echo.private(`chat.private.${ userSend }.${ userReceiver }`)
    .listen('ChatPrivate',e => {
        let listMessage = $('.msg_card_body')
        let UI = `
                    <div class="d-flex justify-content-end mb-4">
                        <div class="img_cont_msg">
                            <img src="${e.userSend.avata}" class="rounded-circle user_img_msg">
                        </div>
                        <div class="msg_cotainer">
                            ${e.message}
                            <span class="msg_time">${e.created_at}</span>
                        </div>
                    </div>
                `;
        listMessage.append(UI);
        listMessage.scrollTop(listMessage[0].scrollHeight);
    })
Echo.private(`chat.private.${ userReceiver }.${ userSend }`)
    .listen('ChatPrivate',e => {
        let listMessage = $('.msg_card_body')
        let UI = `
                    <div class="d-flex justify-content-start mb-4">
                        <div class="img_cont_msg">
                            <img src="${e.userSend.avata}" class="rounded-circle user_img_msg">
                        </div>
                        <div class="msg_cotainer">
                            ${e.message}
                            <span class="msg_time">${e.created_at}</span>
                        </div>
                    </div>
                `;
        listMessage.append(UI);
        listMessage.scrollTop(listMessage[0].scrollHeight);
    })
