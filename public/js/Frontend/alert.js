  function showalert( alert1, color, id ){

    const Inputerror =document.getElementById(id);
    Inputerror.style = `
      position: fixed;
      bottom: 70px;
      z-index: 1300;
      background-color: rgba(0, 0, 0, 0.6);
      left:50%;
      transform: translateX(-50%);
      border-radius: 30px;
      display: block;
      padding-bottom: -10px;
    `;
    Inputerror.innerHTML=`
    <style>
      .alert{
        margin-bottom:-10px;
        margin-top:-7px;
      }
    </style>
    <div id="alert" style='color:${color};' class="alert">
      ${alert1}
    </div>
    `;
    
    
    setTimeout(() => {
      Inputerror.style.display = 'none';
    }, 3000);
  }
  