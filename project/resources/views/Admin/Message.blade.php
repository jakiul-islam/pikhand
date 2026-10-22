<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messenger UI</title>

     <link rel="stylesheet" href="{{ asset('public/css/Admin/Common.css') }}">
       <link rel="stylesheet" href="{{ asset('public/css/Admin/Message.css') }}">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

</head>

<body>
   @include("Admin.Include.Header")
<div class="messenger" id="messenger">

    <!-- =========================
         USER LIST
    ========================== -->

    <div class="sidebar">

        <div class="sidebar-header">
            Messages
        </div>

        <div class="search">
            <input type="text" placeholder="Search messages...">
        </div>

        <div class="user-list" id='userList'>

            
        </div>
    </div>


    <!-- =========================
         CHAT
    ========================== -->

    <div class="chat">

        <div class="chat-header">

            <button class="back-btn" onclick="backToUsers()">
                ←
            </button>

            <div class="avatar" id="chatAvatar">
                12
            </div>

            <div>
                <div class="chat-user-id" id="chatUserId">
                    User
                </div>

                <small style="color:#65676b;">
                    Active now
                </small>
            </div>

        </div>


        <!-- MESSAGES -->

        <div class="messages" id="messages">

            <div class="message received">
                Hello, how are you?
            </div>

            <div class="message sent">
                I'm good. How can I help you?
            </div>

            <div class="message received">
                I want to know about my order.
            </div>

            <div class="message sent">
                Sure, I will check it for you.
            </div>

        </div>


        <!-- MESSAGE INPUT -->

        <div class="message-input">

            <input
                type="text"
                id="messageInput"
                placeholder="Type a message..."
            >

            <button
                class="send-btn"
                onclick="sendMessage()">
                ➤
            </button>

        </div>

    </div>

</div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="{{ asset('public/js/Admin/common.js') }}"></script>
    <script src="{{ asset('public/js/Admin/Message.js') }}"></script>

<script>

    
</script>

</body>
</html>