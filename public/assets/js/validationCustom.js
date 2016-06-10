$(document).ready(function (){

    (function ($) {
        
        $.fn.valid = function(event,$formSelector) {
            
            var $re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            var $error = false;
            var $id = $(event.target).closest($formSelector);
            var $input = $id.find("input:not([name='_token']):not([id='hidden']), textarea, select");//or not:([],[])
            $.each($input, function(key, value){
                //if all value is true each return $error = true else false
                var $alert = value.name;
                console.log($alert);
                var $errorDiv = $("div[data-id=" + $alert + "]");
                if (value.value === "") {
                    
                    $error = true;
                    $errorDiv.text($alert + " is empty");
                    $errorDiv.show();

                } else if(value.type === 'email' && ($re.test(value.value) === false)){
                    
                    $errorDiv.text($alert + " is not email");
                    $errorDiv.show();
                    $error = true;
                }else {

                    $errorDiv.hide();
                }
            });
            
            return $error;
            
        };//add
    }(jQuery));
});


