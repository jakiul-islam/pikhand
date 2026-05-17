<style>
  .buttonText{
    background: none;
    border:none;
  }
</style>

<!-- model section -->
     <!-- Email model -->
        <div class="modal fade" id="name" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <img src="/storage/{{$webInfo->logo}}" alt="Picklet Logo" class='logosvg' >
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="">
                  <lavel>Enter email </lavel><br>
                  <input type="email" id="emailInsput" oninput="emailchack();" class="form-control " placeholder="prodect-name" aria-label="Username" aria-describedby="addon-wrapping">
                  <span id='emailerror'></span>
                </div>
                <br>
                <button type="submit" class="btn btn-primary" id='Emailset' disabled onclick="emailinsert()">send otp</button>
                <br>
              </div>
              <div id="otpchack">

              </div>
              <div class="modal-footer">
                <button type="button" id="insertclose" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" style='display:none;' disabled id='EmailOtpChack' >send otp</button>
              </div>
            </div>
          </div>
        </div>
      <!-- /end/ Email model -->

      <!-- name model -->
        <div class="modal fade" id="nameinfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <img src="/storage/{{$webInfo->logo}}" alt="Picklet Logo" class='logosvg' >
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="">
                  <lavel>Enter name </lavel><br>
                  <input type="text" id="nameInput" oninput="namebutton();"
                  class="form-control " placeholder="What is your name" aria-label="Username"
                  aria-describedby="addon-wrapping">
                </div>
                <br>
                <div class="">
                  <lavel>Enter date of birth </lavel><br>
                  <input type="date" id="timeInput" oninput="namebutton();" class="form-control " placeholder="what are you old"  aria-label="Username" aria-describedby="addon-wrapping">
                </div>
                <br>
                <div class="">
                  <lavel onclick="fetchUserinfo()">Enter gender </lavel><br>

                  <select id="genderInput"
                  class="form-control " placeholder="What is your gender"
                  aria-label="Username"
                  aria-describedby="addon-wrapping">
                    <option onclick="namebutton();" value="male">male</option>
                    <option onclick="namebutton();" value="male">female</option>
                  </select>
                </div>
                <br>
              </div>
              <div class="modal-footer">
                <button type="button" id="insertclose" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" disabled id='namesavebutton'
                onclick="insertUserinfo();" >Save</button>
              </div>
            </div>
          </div>
        </div>
      <!-- /end/ Email model -->
      <!-- all addressbook -->

       <!-- address 1 model -->
        <div class="modal fade" id="address1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <img src="/storage/{{$webInfo->logo}}" alt="Picklet Logo" class='logosvg' >
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="">
                  <lavel>name </lavel><br>
                  <input type="text" id="addressname"   class="form-control " placeholder="What is your name" aria-label="Username" aria-describedby="addon-wrapping">
                </div>
                <div class="">
                  <lavel>phone </lavel><br>
                  <input type="number" id="addressphone"   class="form-control "
                  placeholder="What is phone number" aria-label="Username"
                  aria-describedby="addon-wrapping">
                </div>
                <div class="">
                  <lavel>distric </lavel><br>
                  <input type="text" id="a1" oninput="addressB(1);"
                  class="form-control " placeholder="Where are your distric" aria-label="Username"
                  aria-describedby="addon-wrapping">
                </div>
                <div class="">
                  <lavel>House No, Road No</lavel><br>
                  <input type="text" id="b1" oninput="addressB(1);"
                  class="form-control " placeholder="House No, Road No"  aria-label="Username"
                  aria-describedby="addon-wrapping">
                </div>
                <div class="">
                  <lavel>Nearby Landmark </lavel><br>
                  <input type="text" id='c1' oninput="addressB(1);"  class="form-control " placeholder="Nearby Landmark" aria-label="Username" aria-describedby="addon-wrapping">
                </div>
                <lavel>
                  <input type="radio" name="home_office" id='home_office'
                  value="home">
                  Home
                </lavel>
                <lavel>
                  <input type="radio" name="home_office" id='home_office'
                  value="Office">
                  Office
                </lavel>
              </div>
              <div class="modal-footer">
                <button type="button" id="insertclose" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button onclick="insertaddress();" class="btn btn-primary" disabled id='Address1' >Save</button>
              </div>
            </div>
          </div>
        </div>


      <!-- /end/ all Secirty -->
      <div class="modal fade" id="changepassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <img src="/storage/{{$webInfo->logo}}" alt="Picklet Logo" class='logosvg' >
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" id='showallpassfild'>
                <div class="input-group mb-3">
                  <input type="password" id="userchangepassword"
                  oninput="oldpasswordinput()" class="form-control"
                  placeholder="enter your confirm password" aria-label="Recipient’s
                  username" aria-describedby="basic-addon2">
                  <span class="input-group-text" onclick="eye('userchangepassword','changeicone')" id="basic-addon2"><i class="bi
                  bi-eye" id='changeicone'></i></span>
                </div>
                <br>

              </div>
              <div class="modal-footer">
                <button type="button" id="insertclose" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <div id="chackpasswordbutton">
                  <button class="btn btn-primary"  id='submitChangbutton'
                  onclick="showallpassfild()" disabled>chack password</button>
                </div>
              </div>
            </div>
          </div>
        </div>

