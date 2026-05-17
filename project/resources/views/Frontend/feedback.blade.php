<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}"> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Feedback - picklet</title>
 <link rel="stylesheet" href="{{  asset('css/Feedback.css')  }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css"/>
  
</head>
<body>
 
 @if( session()->has('number') )
 
  <!--session()->has('number')-->
  <div class="container" >
    <div id="ShowFeedbackForm">
      <a href="/home" class="nav-link"><i class="bi bi-arrow-left"></i></a>
        <img src="/storage/{{$webInfo->logo}}" alt="Picklet Logo" class='logo' >
      <h1 class="feedbackHeader">We Value Your Feedback</h1>
      <p class="Feedbackparagriph">Your opinion helps us improve our products and services. Please take a moment to share your thoughts.</p>

      <label for="name">Your Name</label>
      <input type="text" id="name" name="name" placeholder="Enter your name" required>

      <label for="email">Your Email</label>
      <input type="email" id="email" name="email" placeholder="Enter your email" required>

      <label>Overall Experience</label>
      <div class="rating">
        <i onmouseover="starFill( '1' )" id="star_1" class="bi bi-star"></i>
        <i onmouseover="starFill( 2 )" id="star_2" class="bi bi-star"></i>
        <i onmouseover="starFill( 3 )" id="star_3" class="bi bi-star"></i>
        <i onmouseover="starFill( 4 )" id="star_4" class="bi bi-star"></i>
        <i onmouseover="starFill( 5 )" id="star_5" class="bi bi-star"></i>
      </div>
      <span id='showRattingNumber' class="showRatingNumber"></span>
      <input type="hidden" id="star">
      <label for="message">Your Feedback</label>
      <textarea id="message" name="message" placeholder="Tell us what you liked or what we can improve..." required></textarea>

      <button onclick="insertFeedback();" id="Feedbackbutton" >Submit Feedback</button>
    </div>
    <div id='ShowAllFeedback'>
       <a href="/home" class="nav-link"><i class="bi bi-arrow-left"></i></a> <br>
      <button class="loginbutton" id="editFeedbackButton" onclick="editFeedback()">Edit your feedback</button>
      <div class="showFeedback row" style="">
        
      </div>
    </div>
  </div>
@else
  <div class="container">
    <a href="/home"  class="nav-link"><i class="bi
    bi-arrow-left"></i></a> 
      <img align='center' src="/storage/{{$webInfo->logo}}" alt="Picklet Logo" class='logo' >
 
    <h1 align='center'>Your are not login</h1>
    <button class="loginbutton" data-bs-toggle="modal" data-bs-target="#name">login</button>
    <div id='ShowAllFeedback12'>
      <div class="loginshowFeedback row" >
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="name" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
           <img align='center' src="/storage/{{$webInfo->logo}}" alt="Picklet
           Logo" class='logomodel' >
 
        
        </div>
        <div class="modal-body">
       <!--    <div id='showform'> -->
                <label>Phone number</label>
              <div class="input-group" >
                <input type='number' id='login_number' oninput='logininput();'
                style="width:40px;"
                class='form-control w-100' placeholder='Enter your phone number'>
                
              </div>
                <label>Password</label>
                <div class="input-group mb-3">
                  <input type="password" id='password' oninput='logininput();' class="form-control" placeholder="Enter your password" aria-label="Recipient’s username" aria-describedby="basic-addon2">
                  <span class="input-group-text" id="basic-addon2"
                  onclick='eyechange(11);'><i class="bi bi-eye" id='icone'></i></span>
                </div>            
                <p id="message" style="color: red; font-size: 14px;
                line-height:0;"></p>
                <button id='LoginSubmit' onclick='feedbackuserLOgin();' class='form-control' disabled>LOGIN</button>
                <div class="row">
                  <div class="col-5"><hr></div>
                  <div class="col-2">or</div>
                  <div class="col-5"><hr></div>
                </div>
                
                <div class="googleloginbutton">
                  <button class="btn btn-success "> 🌐  Login with google</button>
                  <button class="btn btn-success ">  🅵 Login with facebook</button>
                </div>
                <br>
         
         
<!--             </div>
           -->
        </div>
        <div class="modal-footer">
          <button type="button" id="insertclose" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
@endif
<div id='showallalert' style="display:none;" class="alartdiv text-center"></div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="{{ asset('js/Feedback.js')  }}"></script>
  <script src="{{ asset('js/headerUserSetting.js')  }}"></script>
  <script src="{{ asset('js/Userlogin.js')  }}"></script>
  <script src="{{ asset('js/Alert.js')  }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 </body>
</html>