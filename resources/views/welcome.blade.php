<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   

</head>

<body>
    <div class="container">
        <div id="data-message" style="width: 400px; height:400px; border:2px solid black"></div>
        <div class="row mt-3">
            <input type="text" placeholder="Name" id="name" class="form-control"><br>
            <div>
                <textarea name="" id="message" placeholder="Message" cols="30" rows="5"></textarea>
            </div><br>
            <div>
                <button class="btn btn-success button">Send</button>

            </div>
        </div>
    </div>


</body>

</html>
<script src="{{ url('js/app.js') }}"></script>
<script>
    $(document).ready(function() {

        $(function() {
            const Http = window.axios;
            const Echo = window.Echo;
            const name = $('#name');
            const message = $('#message');
            $('.button').click(function() {
                Http.post("{{ url('send') }}", {
                    name: name.val(),
                    message: message.val()

                }).then(() => {
                    message.val('')
                })
            });

            let channel = Echo.channel('channel-chat')
            channel.listen('ChatEvent', function(data) {
                $('#data-message').append(`<strong>${data.message.name}</strong> : ${data.message.message} <br>`)
            })
        })
    })
</script>