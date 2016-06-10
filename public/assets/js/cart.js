$(document).ready(function(){
    $(document).on("click",".deleteFromCart",function() {
        var $id = $(this).attr('delete-id');
        var $count = $(this).attr('count');
        var $url = "/market/cart/remove";
        $.ajax({
            type: "POST",
            url: $url,
            data: {
                
                id: $id,
                _token: $("input[name=_token]").val(),
                count: $count
            },
            success: function(data) {
                if(data.success == true){
                    $("tr#main-div-" + $id).hide( "slow", function() {});
                };
                
                $(".total").text("Total price: " + data.total + "$");
                $(".count").text("Products in cart: " + data.count);
            }
        })
    });


    $(document).on('click', '#buyButton', function () {
        var $array = [];
        $("input:checked").each(function(){
            $array.push($(this).val());
        });
    })
});