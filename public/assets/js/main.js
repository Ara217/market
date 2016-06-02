$(document).ready(function(){

    $(document).on("click", ".delete-product", function () {
        var id = $(this).attr('data-id');
        $('.confirm-delete-product').attr('data-id',id);
        $(".shadow").show();
    });

    $(document).on("click", ".confirm-delete-product-no", function () {
        $(".shadow").hide();
    });

    $(document).on("click",".confirm-delete-product",function() {
        var id = $(this).attr('data-id');
        var url = "/market/" + id;
        $.ajax({
            type: "DELETE",
            url: url,
            data: {
                _token: $("input[name=_token]").val()
            },
            success: function(data) {
                if(data.success == true){    
                    $("tr#main_div_" + id).hide( "slow", function() {});
                    $(".shadow").hide();

                }
            }
        })
    });
})