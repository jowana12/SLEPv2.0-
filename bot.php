<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SLEP: Chatbot</title>
    <link rel="stylesheet" href="css/bot.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <a href="includes/student-leaders-dashboard.inc.php">
        <img src="images/sleplogonoBG.png" alt="" style="height: 100px; float: left;">
    </a>
    

        <div class="wrapper">
        <div class="title" style="background: #ffd028; color: black; border-bottom: 3px solid black;">Frequently Asked Questions Bot</div>
        <div class="form">
            <div class="bot-inbox inbox">
                <div class="icon" style="background: #ffd028;">
                    <i class="fas fa-user" style="color: black;"></i>
                </div>
                <div class="msg-header">
                    <p style="background: #ffd028; color: black;">Hello there, how can I help you?</p>
                </div>
            </div>
        </div>
        <div class="typing-field">
            <div class="input-data">
                <input style="border-color: black;" id="data" type="text" placeholder="Type something here.." required>
                <button id="send-btn" style="background: #ffd028; color: black; border-color: black;">Send</button>
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function(){
            $("#send-btn").on("click", function(){
                $value = $("#data").val();
                $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ $value +'</p></div></div>';
                $(".form").append($msg);
                $("#data").val('');
                
                // start ajax code
                $.ajax({
                    url: 'message.php',
                    type: 'POST',
                    data: 'text='+$value,
                    success: function(result){
                        $replay = '<div class="bot-inbox inbox"><div class="icon" style="background: #ffd028;"><i class="fas fa-user" style="color: black;"></i></div><div class="msg-header"><p style="background: #ffd028; color: black;">'+ result +'</p></div></div>';
                        // <div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>'+ result +'</p></div></div>';
                        $(".form").append($replay);
                        // when chat goes down the scroll bar automatically comes to the bottom
                        $(".form").scrollTop($(".form")[0].scrollHeight);
                    }
                });
            });
        });
    </script>
    
</body>
</html>