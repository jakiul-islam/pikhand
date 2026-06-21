  window.FetchCarts = function(){
  
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
      countcarts.innerText= cart.length;
      if(cart.length > 0){
        cart.forEach(function(carts) {
            
          let cartPrice  =`${carts.price }`;
          let cartid     =`${carts.id}`;
          let quantity   =`${carts.quantity}`;
          //কষকদকদ

          //cart product show
          let formData = new FormData();
          formData.append('productId',carts.id);
          formData.append('cartPrice',carts.price);
          formData.append('cartQuantity',carts.quantity);
            
          sendDataAjax('/cart/create',formData,'post','FetchCarts','Nan','Nan','Nan','Nan');

        })
      }
}