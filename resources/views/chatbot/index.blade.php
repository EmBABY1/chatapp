<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Chat with our bot</h1>
    <div id="chatbox">
        <div id="messages"></div>
        <input type="text" id="user-message" placeholder="Type a message...">
        <button id="send-message">Send</button>
    </div>

    <script>
        $('#send-message').click(function() {
            var message = $('#user-message').val();
            $.ajax({
                url: '/chatbot',
                type: 'POST',
                data: {
                    message: message,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#messages').append('<div><strong>You:</strong> ' + message + '</div>');
                    $('#messages').append('<div><strong>Bot:</strong> ' + response.response + '</div>');
                    $('#user-message').val('');
                }
            });
        });
    </script>
</body>
</html>
