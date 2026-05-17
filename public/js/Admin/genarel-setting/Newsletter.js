
      function insertnewsletter(){
        let formData = new FormData();
          formData.append('News_title', $('#News_title').val());
          formData.append('newssubtitle', $('#newssubtitle').val());
          formData.append('newssubtitle_2', $('#newssubtitle_2').val());
          
          sendDataAjax('/admin/newsletter/update',formData,'post','newsletterindex','Nan','insetnewsletterbutton','Update','newsletter');
      }
      //fetch notise
      function newsletterindex(){
        fetchDataAjax('/admin/newsletter/index','post','newsletterdata','Nan');
      }
      
      function newsletterdata( response ){
      //  if( response > 0 ){
          let  insetnewsletterbutton = document.getElementById('insetnewsletterbutton');
          
          insetnewsletterbutton.innerHTML = 'Update';
            
          const News_title =document.getElementById("News_title");
          const newssubtitle =document.getElementById("newssubtitle");
          const newssubtitle_2 =document.getElementById("newssubtitle_2");
        
          const newstitleshow =document.getElementById("newstitleshow");
          const newssubtitleshow  = document.getElementById('newssubtitleshow');
          const newssubtitle_2show  = document.getElementById('newssubtitle_2show');
        
          News_title.value          = `${response.title}`;
          newssubtitle.value        = `${response.subtitle}`;
          newssubtitle_2.value      = `${response.subtitle_2}`;
        
          newstitleshow.innerHTML         = `${response.title}`;
          newssubtitleshow.innerHTML      = `${response.subtitle}`;
          newssubtitle_2show.innerHTML    = `${response.subtitle_2}`;
       // }
      }
      newsletterindex();
    