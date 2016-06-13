$(document).ready(function() {

   $("#comment_send").on("click", function (event) {
      $error = $("#comment_send").valid(event,'#form_block');//first argument is event, second is parent form or div selector
      if ($error == false) {
         addComment();
      } else {
         return false;
      }

   });

   function addComment() {

      var $id =$("#hidden").data('value');
      var $url = "/market/comment/" + $id;
      $.ajax ({

         type: "POST",
         url: $url,
         data: {
            _token: $("input[name=_token]").data('value-token'),
            product_id: $id,
            name: $('#name').val(),
            email: $('#email').val(),
            comment: $('#comment').val()
         },
         success: function (data) {

            $('.clean').val("");
            var $data = JSON.parse(data.data);
            $("#commnet_table").prepend("<tr>" + "<td>" + "By: " + $data.name + "<br>" + "Email: " + $data.email + "<br>" + "Comment: " + $data.comment + "</td>" + "</tr>");

         }
      })
   }

   $("#buyButton").on('click', function () {
      var $buyId = $("input[name=id]").val();
      var $buyTitle = $("input[name=title]").val();
      var $buyPrice = $("input[name=price]").val();
      var $buyToken = $('#token').data('value-buy');

      $.ajax({
         type: "POST",
         url: "/market/addToCrat",
         data: {
            id: $buyId,
            title: $buyTitle,
            price: $buyPrice,
            _token: $buyToken
         },
         success: function () {
            $("#buyButton").html("<img src='/assets/images/Site_images/cart.png'>");
            /*$(".buyButtonSpan").css({
                "-webkit-transform" : "translateX(200%)",
               "-moz-transform" : "translateX(200%)",
               "-ms-transform" : "translateX(200%)",
               "transform" : "translateX(200%)"
            });*/
         }
      })
   })

});