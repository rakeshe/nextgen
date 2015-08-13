jQuery.sharedCount = function(url, fn) {
	    url = encodeURIComponent(url || location.href);
	    var domain = "//free.sharedcount.com/"; /* SET DOMAIN */
	    var apikey = "09becade41658160e0216989ad661998591bff83" /*API KEY HERE*/
	    var arg = {
	      data: {
	        url : url,
	        apikey : apikey
	      },
	        url: domain,
	        cache: true,
	        dataType: "json"
	    };
	    if ('withCredentials' in new XMLHttpRequest) {
	        arg.success = fn;
	    } else {
	        var cb = "sc_" + url.replace(/\W/g, '');
	        window[cb] = fn;
	        arg.jsonpCallback = cb;
	        arg.dataType += "p";
	    }
	    return jQuery.ajax(arg);
	};
	
	$(document).ready(function(){
    	$.sharedCount(location.href, function(data){
        $('#gplus-count')
			.html(d.GooglePlusOne);
		$('#facebook-count')
			.html(d.Facebook.share_count);
		$('#twitter-count')
			.html(d.Twitter);
 		});
		var longUrl = '';
		var shortUrl = '//fast.wistia.net/embed/iframe/zrf26pokaj';
		$('.ll-switch').click(function(){
			$(this).toggleClass('active');
			if ($(this).hasClass('active')){
				$('#video-frame')
					.attr('src',longUrl);
			}else{
				$('#video-frame')
					.attr('src',shortUrl);
			}
		});
	});