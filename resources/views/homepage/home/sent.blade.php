<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forever Alone</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style type="text/css" media="screen">
        #messages {
            color: #1abc9c;
        }

        #messages li {
            max-width: 50%;
            margin-bottom: 10px;
            border-color: #34495e;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="content">
            <h1>Pusher:</h1>

            <div>
                <h2>Chat</h2>
                <ul id="messages" class="list-group"></ul>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
    <script>
        $(document).ready(function() {
            var pusher = new Pusher('d58f7b9492ee942fc4b3', {
                cluster: 'ap3',
                encrypted: true
            });
            var channel = pusher.subscribe('my-chanel');
            channel.bind('App\Events\AloneEvent', addMessageDemo);
        });

        function addMessageDemo(data) {
            var liTag = $("<li class='list-group-item'></li>");
            console.log(data.message)
            liTag.html(data.message);
            $('#messages').append(liTag);
        }

        Echo.channel('my-channel')
        .listen('AloneEvent', (e) => {
            console.log(e);
        });
    </script>
</body>

</html>
