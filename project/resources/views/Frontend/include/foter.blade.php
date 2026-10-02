  <style>
    @media (max-width: 500px){
        .ros{
            height: 50px;
            width: 100%;
            background-color: #EAEAEA;
            position: fixed;
            bottom: 0px;
            display: flex;
            z-index: 16;
        }

        .col{
            display: inline-block;
            width: 30%;
            padding-top: 5px;
        }

        .divaid{
            display: inline-block;
            border-left: 1px solid black;
            height: 100%;
        }
    }
    @media (min-width: 500px) {
        .ros{
            display:none;
        }
    }
    .chat{
        height: 60px;
        width: 60px;
        background-color: #35239B;
        border: 0px;
        border-radius: 50%;
        display:flex;
        position: fixed;
        bottom: 40px;
        right: 5px;
        z-index: 2000;
     
    }

    .c-chat{
        margin-left: 15px;
        margin-top: 15px;
        color: #FFFFFF;
    }

    .home-link{
        color: black;
    }
  

    .toast-container{
      height:80%;
    }

    
  </style>




<!-- Bootstrap CSS -->
<link
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
  rel="stylesheet"
/>

<!-- Bootstrap Icons -->
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
/>

<style>
  * {
    box-sizing: border-box;
  }

  body {
    margin: 0;
    min-height: 100vh;
    background: linear-gradient(135deg, #171321, #28183d);
    font-family: Arial, sans-serif;
  }

  /* Floating Chat Button */
  .chat {
    position: fixed;
    right: 25px;
    bottom: 25px;
    z-index: 9999;
  }

  .c-chat {
    position: relative;
  }

  .text-button {
    width: 62px;
    height: 62px;
    border: none;
    border-radius: 50%;
    background: linear-gradient(135deg, #9b4dff, #c86cff);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 10px 30px rgba(159, 73, 255, 0.45);
    transition: 0.25s ease;
  }

  .text-button:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 14px 35px rgba(159, 73, 255, 0.6);
  }

  /* Chat Window */
  .toast-container {
    padding: 0 !important;
    right: 20px !important;
    bottom: 100px !important;
  }

  .toast {
    width: 380px;
    max-width: calc(100vw - 30px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 22px;
    overflow: hidden;
    background: #17131f;
    color: white;
    box-shadow: 0 25px 70px rgba(0, 0, 0, 0.45);
  }

  /* Header */
  .toast-header {
    height: 75px;
    padding: 12px 16px;
    border: none;
    background: linear-gradient(135deg, #9b4dff, #bd68ff) !important;
    color: white;
  }

  .chat-avatar {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 21px;
  }

  .chat-title {
    display: flex;
    flex-direction: column;
    margin-left: 10px;
    line-height: 1.2;
  }

  .chat-title strong {
    font-size: 15px;
  }

  .chat-status {
    font-size: 11px;
    opacity: 0.9;
    margin-top: 3px;
  }

  .online-dot {
    width: 7px;
    height: 7px;
    background: #62ff9b;
    display: inline-block;
    border-radius: 50%;
    margin-right: 4px;
  }

  .btn-close {
    filter: brightness(0) invert(1);
    opacity: 0.9;
  }

  /* Chat Body */
  .parandDiv {
    padding: 18px;
    height: 420px;
    display: flex;
    flex-direction: column;
    background:
      radial-gradient(
        circle at top right,
        rgba(182, 86, 255, 0.08),
        transparent 35%
      ),
      #17131f;
  }

  .messages {
    flex: 1;
    overflow-y: auto;
    padding: 5px 2px 15px;
  }

  .messages::-webkit-scrollbar {
    width: 4px;
  }

  .messages::-webkit-scrollbar-thumb {
    background: #70408d;
    border-radius: 10px;
  }

  /* Bot message */
  .bot-message {
    display: flex;
    align-items: flex-start;
    gap: 8px;
    margin-bottom: 15px;
  }

  .bot-mini-avatar {
    width: 28px;
    height: 28px;
    min-width: 28px;
    border-radius: 50%;
    background: #b656ff;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 13px;
  }

  .bot-bubble {
    max-width: 78%;
    background: #292331;
    color: #f4eff8;
    padding: 11px 14px;
    border-radius: 5px 16px 16px 16px;
    font-size: 14px;
    line-height: 1.5;
  }

  /* User message */
  .user-message {
    display: flex;
    justify-content: flex-end;
    margin-bottom: 15px;
  }

  .user-bubble {
    max-width: 78%;
    background: linear-gradient(135deg, #b656ff, #9340df);
    color: white;
    padding: 11px 14px;
    border-radius: 16px 5px 16px 16px;
    font-size: 14px;
    line-height: 1.5;
  }

  /* Time */
  .message-time {
    display: block;
    font-size: 9px;
    opacity: 0.55;
    margin-top: 5px;
  }

  /* Input Area */
  .send-massage {
    display: flex;
    align-items: center;
    gap: 7px;
    padding: 8px;
    background: #211c29;
    border: 1px solid #372d42;
    border-radius: 16px;
  }

  .custom-file-upload {
    width: 38px;
    height: 38px;
    flex-shrink: 0;
    border-radius: 11px;
    background: #30273a;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #bfb5ca;
    cursor: pointer;
    transition: 0.2s;
  }

  .custom-file-upload:hover {
    color: white;
    background: #40334c;
  }

  .massage-input-div {
    flex: 1;
  }

  .massage-input {
    height: 40px;
    border: none !important;
    outline: none !important;
    background: transparent !important;
    color: white !important;
    padding: 5px 3px;
    font-size: 14px;
  }

  .massage-input::placeholder {
    color: #84798e;
  }

  .massage-submit {
    width: 40px;
    height: 40px;
    flex-shrink: 0;
    border: none;
    border-radius: 12px;
    background: linear-gradient(135deg, #b656ff, #9137df);
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.2s;
  }

  .massage-submit:hover {
    transform: scale(1.06);
  }

  .massage-submit:active {
    transform: scale(0.95);
  }

  /* Mobile */
  @media (max-width: 480px) {
    .chat {
      right: 15px;
      bottom: 15px;
    }

    .toast-container {
      right: 10px !important;
      bottom: 90px !important;
    }

    .toast {
      width: calc(100vw - 20px);
      border-radius: 18px;
    }

    .parandDiv {
      height: 400px;
    }
  }
</style>


<!-- ================= CHATBOT ================= -->

<div class="chat">
  <div class="c-chat">

    <!-- Floating Button -->
    <button
      type="button"
      class="text-button"
      id="liveToastBtn"
      aria-label="Open chat"
    >
      <i class="bi bi-chat-left-dots-fill"></i>
    </button>


    <!-- Chat Window -->
    <div class="toast-container position-fixed">

      <div
        id="liveToast"
        class="toast"
        role="alert"
        aria-live="assertive"
        aria-atomic="true"
      >

        <!-- Header -->
        <div class="toast-header">

          <div class="chat-avatar">
            <i class="bi bi-robot"></i>
          </div>

          <div class="chat-title me-auto">

            <strong>AI Assistant</strong>

            <span class="chat-status">
              <span class="online-dot"></span>
              Online
            </span>

          </div>

          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="toast"
            aria-label="Close"
          ></button>

        </div>


        <!-- Chat Body -->
        <div class="parandDiv">

          <div class="messages" id="messages">

            <!-- Bot Message -->
            <div class="bot-message">

              <div class="bot-mini-avatar">
                <i class="bi bi-robot"></i>
              </div>

              <div class="bot-bubble">
                👋 Hello! How can I help you today?

                <span class="message-time">
                  Just now
                </span>
              </div>

            </div>


            <!-- Example User Message -->
            <div class="user-message">

              <div class="user-bubble">
                I'm looking for some information.

                <span class="message-time text-end">
                  Just now
                </span>
              </div>

            </div>


            <!-- Bot Message -->
            <div class="bot-message">

              <div class="bot-mini-avatar">
                <i class="bi bi-robot"></i>
              </div>

              <div class="bot-bubble">
                Sure! 😊 Tell me what you're looking for and I'll help you.

                <span class="message-time">
                  Just now
                </span>
              </div>

            </div>

          </div>


          <!-- Input -->
          <form class="send-massage" id="chatForm">

            <label
              for="fileInput"
              class="custom-file-upload"
              title="Attach file"
            >
              <i class="bi bi-paperclip"></i>
            </label>

            <input
              type="file"
              id="fileInput"
              hidden
            />

            <div class="massage-input-div">

              <input
                class="form-control shadow-none massage-input"
                id="messageInput"
                type="text"
                placeholder="Type a message..."
                autocomplete="off"
              />

            </div>

            <button
              type="submit"
              class="massage-submit"
              id="messageSubmitButton"
              aria-label="Send message"
            >
              <i class="bi bi-send-fill"></i>
            </button>

          </form>

        </div>

      </div>

    </div>

  </div>
</div>


<!-- Bootstrap JS -->
<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


<script>
  const chatButton = document.getElementById("liveToastBtn");
  const toastElement = document.getElementById("liveToast");

  const toast = new bootstrap.Toast(toastElement, {
    autohide: false
  });

  // Open chat
  chatButton.addEventListener("click", () => {
    toast.show();
  });


  // Send message
  const chatForm = document.getElementById("chatForm");
  const messageInput = document.getElementById("messageInput");
  const messages = document.getElementById("messages");

  chatForm.addEventListener("submit", function (e) {
    e.preventDefault();

    const message = messageInput.value.trim();

    if (!message) return;

    // User message
    const userMessage = document.createElement("div");

    userMessage.className = "user-message";

    userMessage.innerHTML = `
      <div class="user-bubble">
        ${escapeHTML(message)}
        <span class="message-time text-end">
          Just now
        </span>
      </div>
    `;

    messages.appendChild(userMessage);

    messageInput.value = "";

    scrollToBottom();


    // Demo bot reply
    setTimeout(() => {

      const botMessage = document.createElement("div");

      botMessage.className = "bot-message";

      botMessage.innerHTML = `
        <div class="bot-mini-avatar">
          <i class="bi bi-robot"></i>
        </div>

        <div class="bot-bubble">
          Thanks for your message! 🤖
          <span class="message-time">
            Just now
          </span>
        </div>
      `;

      messages.appendChild(botMessage);

      scrollToBottom();

    }, 700);
  });


  function scrollToBottom() {
    messages.scrollTop = messages.scrollHeight;
  }


  // Prevent HTML injection
  function escapeHTML(text) {
    const div = document.createElement("div");
    div.textContent = text;
    return div.innerHTML;
  }
  </script>















    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!--  <script src="https://kit.fontawesome.com/aa8d5355f9.js" crossorigin="anonymous"></script> -->
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- swiper -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
      <script src="{{ asset('public/js/Frontend/preloader.js') }}"></script>
  <script src="{{ asset('public/js/Frontend/common/common.js') }}"></script>
  <script src="{{ asset('public/js/Frontend/user/show-user-order.js') }}"></script>
  <script src="{{ asset('public/js/Frontend/carts/header-cart.js') }}"></script>
  <script src="{{ asset('public/js/Frontend/carts/geastCartDataInsert.js') }}"></script>
  <script src="{{ asset('public/js/Frontend/search.js') }}"></script>
    
  <script src="{{ asset('public/js/Frontend/user/header-user-setting.js') }}"></script>
  <script src="{{ asset('public/js/Frontend/user/user-sign_up.js') }}"></script>
  <script src="{{ asset('public/js/Frontend/user/user-login.js') }}"></script>
  <script src="{{ asset('public/js/Frontend/user/user-dashboard.js') }}"></script>
  <script src="{{ asset('public/js/Frontend/user/user-forgot-password.js') }}"></script>
  <script src="{{ asset('public/js/Frontend/voucher.js') }}"></script>
  
  <script src="{{ asset('public/js/Frontend/user/user-profile-setting.js') }}"></script>
  <script src="{{ asset('public/js/Frontend/user/user-info.js') }}"></script>
  <script src="{{ asset('public/js/Frontend/user/set-user-email.js') }}"></script>
  <script src="{{ asset('public/js/Frontend/alert.js') }}"></script>
  <script src="{{ asset('public/js/Frontend/SMS/message.js') }}"></script>


  <script>
      const toastTrigger = document.getElementById('liveToastBtn')
      const toastLiveExample = document.getElementById('liveToast')
      if (toastTrigger) {
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
        toastTrigger.addEventListener('click', () => {
          toastBootstrap.show()
        })
      }

      let mediaRecorder;
      let audioChunks = [];

      const inputField = document.getElementById('inputRecord');
      const audioPlayback = document.getElementById('audioPlayback');
      if(inputField){
        inputField.addEventListener('click', async () => {
          if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
            alert('Your browser does not support audio recording');
            return;
          }

          try {
            // Request microphone access
            const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
            // Create a new MediaRecorder instance
            mediaRecorder = new MediaRecorder(stream);
            // Collect audio data when available
            mediaRecorder.addEventListener('dataavailable', event => {
              audioChunks.push(event.data);
            });
            // When recording stops, create and play the audio
            mediaRecorder.addEventListener('stop', () => {
              const audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
              const audioUrl = URL.createObjectURL(audioBlob);
              audioPlayback.src = audioUrl;
            });

            // Start recording
            mediaRecorder.start();
            inputField.placeholder = "Recording...";

            // Stop recording after 5 seconds (for demo purposes)
            setTimeout(() => {
              mediaRecorder.stop();
              inputField.placeholder = "Click to start recording";
            }, 5000);
          } catch (error) {
            console.error('Error accessing microphone:', error);
          }
        });
      }
    </script>
