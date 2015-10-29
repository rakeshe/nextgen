(function() {
    
	var hc_getCookie = function(cname) {
	    var name = cname + "=";
	    var ca = document.cookie.split(';');
	    for(var i=0; i<ca.length; i++) {
	        var c = ca[i];
	        while (c.charAt(0)==' ') c = c.substring(1);
	        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
	    }
	    return "";
	};
	
	
	if (__gaTracker){__gaTracker("send", "event", "cookie-test-event", hc_getCookie("anon"));}
	

})(this);