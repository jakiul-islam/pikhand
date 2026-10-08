<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messenger UI</title>

   
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