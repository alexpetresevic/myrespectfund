<script>
    var $messageTextarea = $('#message-content');
    var $modal = $('#message-modal');
    var $sendMessageButton = $('#send-message');
    var $funeralHome = $('#funeral-home');
    var $campaignUser = $('#campaign-user');
    //    var conversation = $('#conversation');
    
    $messageTextarea.on('keydown', function (e){
        if (e.keyCode === 13) {
            e.preventDefault();
            $sendMessageButton.click();
        }
    });
    
    $('#message-button').on('click', function (){
        if ($(document).find('.active').length > 0) {
            $('.active').removeClass('active');
            $(this).parent('li').addClass('active');
        }
        setTimeout(function (){
            $messageTextarea.focus()
        }, 200);
    });
    
    function validMessage()
    {
        var $messageText = $messageTextarea.val();
        
        if ($messageText !== '') {
            return true;
        }
        $('.message-error').remove();
        $messageTextarea.after('<p class="message-error">Message is empty!</p>');
        return false;
    }
    
    //    modal.on('shown.bs.modal', function (e){
    //        getMessages(conversation.val());
    //    });
    
    //    modal.on('hidden.bs.modal', function () {
    //        $('.all-messages').remove();
    //    });
    
    $sendMessageButton.on('click', function (e){
        e.preventDefault();
        if (validMessage()) {
            sendMessage($messageTextarea.val());
        }
    });
    
    function sendMessage(message)
    {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        
        var data = {
            _token: CSRF_TOKEN, message: message, user: $campaignUser.val(), partner: $funeralHome.val()
        };
        
        $.ajax({
            type: "POST", url: '/message/store', data: data, success: function (response){
                $messageTextarea.val('');
                $('#message-block').before($('<div class="message-box">' + '<div class="message-me">' + '<p>' + response.message + '</p>' + '<span>Just now</span>' + '</div>' + '</div>').hide().fadeIn(1000));
                //                $modal.modal('hide');
                //                siteMessage('Message sent', '#footer');
            }
        });
    }
    
    //    function getMessages(conversationId)
    //    {
    //        $.ajax({
    //            type: "GET", url: '/message/get-messages/' + conversationId, success: function (response){
    //                for (var i in response) {
    //                    $('#message-block').before('<p class="all-messages">' + response[i].message + '</p>')
    //                }
    //            }
    //        });
    //    }
    $(document).keydown(function (e){
        if (e.keyCode === 27) {
            $('#event-modal').modal('hide');
            $('#message-modal').modal('hide');
        }
    });
</script>