<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messenger UI</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
        }

        .messenger {
            width: 100%;
            max-width: 1100px;
            height: 100%;
            overflow:auto;
            margin:;
            background: #fff;
            display: flex;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.12);
        }

        /* =========================
           LEFT SIDE
        ========================= */

        .sidebar {
            width: 330px;
            border-right: 1px solid #ddd;
            background: #fff;
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        .search {
            margin: 0 15px 15px;
        }

        .search input {
            width: 100%;
            border: none;
            outline: none;
            background: #f0f2f5;
            padding: 12px 15px;
            border-radius: 20px;
            font-size: 14px;
        }

        .user-list {
            overflow-y: auto;
            flex: 1;
        }

        .user {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            cursor: pointer;
            transition: 0.2s;
        }

        .user:hover {
            background: #f0f2f5;
        }

        .user.active {
            background: #e7f3ff;
        }

        .avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #1877f2;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            flex-shrink: 0;
        }

        .user-info {
            min-width: 0;
        }

        .user-id {
            font-size: 16px;
            font-weight: 600;
        }

        .last-message {
            color: #65676b;
            font-size: 13px;
            margin-top: 4px;

            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* =========================
           CHAT AREA
        ========================= */

        .chat {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .chat-header {
            height: 70px;
            border-bottom: 1px solid #ddd;
            display: flex;
            align-items: center;
            padding: 10px 20px;
            gap: 12px;
        }

        .chat-header .avatar {
            width: 42px;
            height: 42px;
        }

        .chat-user-id {
            font-weight: bold;
            font-size: 16px;
        }

        .messages {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 8px;
            background: #fff;
        }

        .message {
            max-width: 65%;
            padding: 0px 14px;
            border-radius: 18px;
            font-size: 14px;
            line-height: 1.4;
        }

        .message.received {
            align-self: flex-start;
            background: #e4e6eb;
            color: #050505;
            border-bottom-left-radius: 5px;
        }

        .message.sent {
            align-self: flex-end;
            background: #0084ff;
            color: white;
            border-bottom-right-radius: 5px;
        }

        /* =========================
           INPUT
        ========================= */

        .message-input {
            min-height: 65px;
            border-top: 1px solid #ddd;
            padding: 10px 15px;
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .message-input input {
            flex: 1;
            border: none;
            outline: none;
            background: #f0f2f5;
            padding: 12px 16px;
            border-radius: 22px;
        }

        .send-btn {
            width: 45px;
            height: 45px;
            border: none;
            border-radius: 50%;
            background: #0084ff;
            color: white;
            cursor: pointer;
            font-size: 18px;
        }

        .send-btn:hover {
            background: #0073e6;
        }

        /* =========================
           MOBILE
        ========================= */

        @media (max-width: 700px) {

            .messenger {
                margin: 0;
                height: 100vh;
                border-radius: 0;
            }

            .sidebar {
                width: 100%;
            }

            .chat {
                display: none;
                width: 100%;
            }

            .messenger.chat-open .sidebar {
                display: none;
            }

            .messenger.chat-open .chat {
                display: flex;
            }

            .back-btn {
                display: block !important;
            }
        }

        .back-btn {
            display: none;
            border: none;
            background: none;
            font-size: 22px;
            cursor: pointer;
        }
              <link rel="stylesheet" href="{{ asset('public/css/Admin/Common.css') }}">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    </style>
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

        <div class="user-list">

            <!-- USER 12 -->
            <div class="user active"
                 onclick="openChat(12, 'Hello, how are you?')">

                <div class="avatar">
                    12
                </div>

                <div class="user-info">
                    <div class="user-id">
                        User ID: 12
                    </div>

                    <div class="last-message">
                        Hello, how are you?
                    </div>
                </div>

            </div>


            <!-- USER 25 -->
            <div class="user"
                 onclick="openChat(25, 'Where is my order?')">

                <div class="avatar">
                    25
                </div>

                <div class="user-info">
                    <div class="user-id">
                        User ID: 25
                    </div>

                    <div class="last-message">
                        Where is my order?
                    </div>
                </div>

            </div>


            <!-- USER 30 -->
            <div class="user"
                 onclick="openChat(30, 'When will I receive it?')">

                <div class="avatar">
                    30
                </div>

                <div class="user-info">
                    <div class="user-id">
                        User ID: 30
                    </div>

                    <div class="last-message">
                        When will I receive it?
                    </div>
                </div>

            </div>


            <!-- USER 45 -->
            <div class="user"
                 onclick="openChat(45, 'I need help')">

                <div class="avatar">
                    45
                </div>

                <div class="user-info">
                    <div class="user-id">
                        User ID: 45
                    </div>

                    <div class="last-message">
                        I need help
                    </div>
                </div>

            </div>

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
                    User ID: 12
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
  

<script>

    function openChat(userId, lastMessage) {

        // Header change
        document.getElementById('chatUserId').innerText =
            'User ID: ' + userId;

        document.getElementById('chatAvatar').innerText =
            userId;

        // Example conversation
        document.getElementById('messages').innerHTML = `
            
            <div class="message received">
                ${lastMessage}
            </div>

            <div class="message sent">
                Hello! How can I help you?
            </div>

        `;

        // Active user
        document.querySelectorAll('.user').forEach(user => {
            user.classList.remove('active');
        });

        event.currentTarget.classList.add('active');

        // Mobile
        document
            .getElementById('messenger')
            .classList.add('chat-open');
    }


    function backToUsers() {

        document
            .getElementById('messenger')
            .classList.remove('chat-open');

    }


    function sendMessage() {

        const input =
            document.getElementById('messageInput');

        const message = input.value.trim();

        if (message === '') {
            return;
        }

        const messageBox =
            document.getElementById('messages');

        const div =
            document.createElement('div');

        div.className = 'message sent';

        div.innerText = message;

        messageBox.appendChild(div);

        input.value = '';

        messageBox.scrollTop =
            messageBox.scrollHeight;
    }


    // Enter চাপলে message send
    document
        .getElementById('messageInput')
        .addEventListener('keydown', function(e) {

            if (e.key === 'Enter') {
                sendMessage();
            }

        });

</script>

</body>
</html>