<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Pikhand admin massanger </title>
  <!-- All css link add section --> 
    <link rel="stylesheet" href="{{ asset('public/css/Admin/Common.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/Admin/Message.css') }}">
  <!-- bootstrap link add section --> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- ajax link add section--> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
</head>
<body>
  @include("Admin.Include.Header")

    <div class='massanger row'>
      <div class='col-md-5 col-lg-5 user-container' id='user-container'>
        <div class="user-header">
          <div class="header-name">
              Messages
          </div>
          <div class="search">
              <input type="text" id='messagesUserSearch' oninput='indexAllUser()' placeholder="Search messages...">
          </div>
        </div>
        <div class="user-list"  >
        
          <div id='userList'></div>
          <div style='height: 100px ; '></div>
        </div>
      </div>
      <!-- message section  -->
      <div class='col-md-7 col-lg-7 message-contaner'id='message-contaner'>
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
        <div class="message-body">
          <div  id="messages">
        
          </div>
          <div style='height:200px;'>
            
          </div>
        </div>


        <!-- MESSAGE INPUT -->
        <div class="message-input">
          <input type="hidden" id="hiddenInput" >
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



  

  
    <!-- bootstrap script link -->
      <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- script link  -->
      <script src="{{ asset('public/js/Admin/common.js') }}"></script>
      <script src="{{ asset('public/js/Admin/Message.js') }}"></script>
</body>
</html>