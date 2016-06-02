$(document).ready(function() {

   $("#comment_send").on("click", function (event) {
      $error = $("#comment_send").valid(event,'#form_block');//first argument is event, second is parent form or div
      if($error == false) {
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

});