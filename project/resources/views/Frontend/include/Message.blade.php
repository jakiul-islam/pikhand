    <div class="chat">
      <div class="c-chat">
        
        <button type="button" onclick='indexMessage()' style="font-size:2rem; color:#FFFFFF;" class="text-button"  id="liveToastBtn">
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
                <div class='parandDiv' id='parandDiv'>
                  <div id="chatBox" class="chatBoxformessage" >
                 </div>
                    <br class="d-lg-none d-md-none">
                    <br class="d-lg-none d-md-none">
                    <br class="d-lg-none d-md-none">

                  <div class='massage-footer'>
                    <div class="send-massage">
                    <label for="fileInput" class="custom-file-upload">
                      <i class="bi bi-folder2-open"></i>
                    </label>
                    <input type="file" id="fileInput" style="display: none;" />
                    <div class="massage-input-div">
                        <textarea id="messageInput" class="form-control shadow-none massage-input" type="text" placeholder="Iam looking for..." aria-label="default input example"></textarea>
                    </div>
                    <button type="submit"  class="massage-submit" id='messageSubmitButton'><i class="bi bi-send-fill"></i></button>
                  </div>
                  </div>
            

                </div>
              </div>
            </div>
          </div>
      </div>
    </div>


