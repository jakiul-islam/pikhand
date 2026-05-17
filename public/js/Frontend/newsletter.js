  function fetchnewsletter(){
      
    const newstitle =document.getElementById("newstitle");
    const newssubtitle =document.getElementById("newssubtitle");
    const newssubtitle_2 =document.getElementById("newssubtitle_2");
      
    $.ajax({
      url : '/newsletter/index',
      type :'POST',
      processData: false,
      contentType: false,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      success:function(response){
        newstitle.innerHTML         = `${response.title}`;
        newssubtitle.innerHTML      = `${response.subtitle}`;
        newssubtitle_2.innerHTML    = `${response.subtitle_2}`;
      },
      error:function(xhr,status,error){
      }
    });
  }
  fetchnewsletter();