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









<style>


/* পুরো Chat এর Body */
.parandDiv{
    position: relative !important;
    height: 100vh;
    padding-bottom: 80px; /* input এর জন্য জায়গা ছাড়া */
   
}

/* তোমার Input Section - এখন toast এর মতো নিচে থাকবে */
.send-massage{
    position: fixed;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    width: 85%;
    margin-left:5px;
    max-width: 600px;
    display: flex;
    align-items: center;
    gap: 0px;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 30px;
    padding: 8px 15px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.15); /* toast এর মতো shadow */
    z-index: 999;
}

.massage-input-div{
    flex: 1;
}

.massage-input{
    border: none !important;
    width: 100%;
    background: transparent;
}
.massage-input:focus{
    outline: none;
    box-shadow: none !important;
}

.custom-file-upload, .massage-submit{
    width: 38px;
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    cursor: pointer;
    border: none;
    flex-shrink: 0;
    
}
.massage-submit, .custom-file-upload{
    background: #091b80;
    color: #ffffff;
  }



  
</style>




    <div class="chat">
      <div class="c-chat">
        
        <button type="button" style="font-size:2rem; color:#FFFFFF;" class="text-button"  id="liveToastBtn">
          <i class="bi bi-chat-left" style="font-size:2rem; color:#FFFFFF;"></i>
        </button>
        
          <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
             
              
              <div class="toast-header bg-info">
                <div class="rounded me-2">
                  <i class="bi bi-chat-fill" style="font-size:1.3rem;"></i>
                </div>
                <strong class="me-auto"><p class="text-center">text-center</p></strong>
                <small>11 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
              
              <div class="toast-body" >
                <div class='parandDiv'>
                  <div>
                   <span style=" margin: none;background-color: #B656FF; color:black; padding:8px; clip-path: inset(0 0 0 0 round 8px);">hallo how can I halp you</span>
                </div>


    
                  <div class="send-massage">
                    <label for="fileInput" class="custom-file-upload">
                      <i class="bi bi-folder2-open"></i>
                    </label>
                    <input type="file" id="fileInput" style="display: none;" />
                    <div class="massage-input-div">
                        <input class="form-control shadow-none massage-input" type="text" placeholder="Iam looking for..." aria-label="default input example">
                    </div>
                    <button type="submit" class="massage-submit" id='messageSubmitButton'><i class="bi bi-send-fill"></i></button>
                  </div>



                </div>
              </div>
            </div>
          </div>
      </div>
    </div>














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
