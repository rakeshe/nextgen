(function(){
	$('#btn-register').click(function(e){
        var travelAgencyName = $("#TA_NAME").val();
        var name = $("#FNAME").val();
        var travelAgentId = $("#TA_ID").val();
        var email = $("#EMAIL").val();
        var telephone = $("#telephone").val();

		$('#error-message-val').empty();//empty the php error
		$('.error-message').empty();//empty the js error
		$('input').removeClass("error");
		if(travelAgencyName == ''){
			$('#TA_NAME').addClass("error");
			$('.error-message').append('Travel agency name is required');
			$('#TA_NAME').focus();
			return false;
		}
		else if(name == ''){
			$('#FNAME').addClass("error");
			$('.error-message').append('Name is required');
			$('#FNAME').focus();
			return false;
		}
		else if(travelAgentId == ''){
			$('#TA_ID').addClass("error");
			$('.error-message').append('Travel agency id is required');
			$('#TA_ID').focus();
			return false;
		}
		else if(email == ''){
			$('#EMAIL').addClass("error");
			$('.error-message').append('Email address is required');
			$('#EMAIL').focus();
			return false
		}
        //validate email
        if(!validateEmail(email)){
            $('#EMAIL').addClass("error");
            $('.error-message').append('Email address is not valid');
            $('#EMAIL').focus();
            return false;
        }
        else if(telephone == ''){
			$('#telephone').addClass("error");
			$('.error-message').append('Phone number is required');
			$('#telephone').focus();
			return false;
		}
		//validate phone
		if(!validatePhone(telephone)){
			$('#telephone').val('');
			$('#telephone').addClass("error");
			$('.error-message').append('Phone number is not valid');
			$('#telephone').focus();
			return false;
		}
		return true;
	});
    $('#activeModel').click(function(e){
        e.preventDefault();
        var docHeight = $(document).height();
        $('#popup-model').css('display','block');
        $("body").append("<div id='overlay'></div>");
        $("#overlay")
            .height(docHeight)
            .css({
                'opacity' : 0.8,
                'position': 'absolute',
                'top': 0,
                'left': 0,
                'background-color': 'black',
                'width': '100%',
                'z-index': 200
            });
        $(".modal-wrapper").css({
            //'position': 'absolute',
            'top': '16%',
            'left': '10%',
            'z-index': 999
        });
    });

    $('.cancel-action').click(function(){
        $("#popup-model").css('display','none');
        $("#overlay").remove();
    });
})();

//validating email
function validateEmail(email) {
	var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if (filter.test(email)) {
		return true;
	}
	else {
		return false;
	}
}//validateEmail

//validating phone
function validatePhone(phone) {
	var filter = /^[0-9-+]+$/;
    if (filter.test(phone)) {
        return true;
    }
    else {
        return false;
    }
}//validatePhone