(function($) {
	var transform = function(dcs, o) {
		var e = o['event'] || {};
		var el = o['element'] || {};
		var forms = o.element.form;
		var $ele = $(el);
		var tiVal = $ele.attr("data-wt-ti"); // OWW add: custom attribute tracking for WT.ti
		var uri;
		var ttl;
		if (forms) {
			uri = forms.action || window.location.pathname;
			ttl = tiVal || forms.id || forms.name || forms.className || el.name || "Unknown";
		} else {
			uri = window.location.pathname;
			ttl = tiVal || el.name || el.id || "Unknown";
		}
		var mtVal = $ele.attr("data-wt-mt"); // OWW add: custom attribute for multitrack tags.
		var multiTrackArgs = "";
		if (mtVal) {
			multiTrackArgs = mtVal;
		}
		var defaultValues = "";
		if (multiTrackArgs) {
			defaultValues = multiTrackArgs.split(/\s*,\s*/);
		}
		o["argsa"].push(
				"DCS.dcsuri", uri, 
				"WT.ti", "FormButton:" + ttl, 
				"WT.dl", "2",
				"WT.nv", dcs.dcsNavigation(e, dcs.navigationtag));
		var len = defaultValues.length;
		for (var i = 0; i < len; i++) {
			o['argsa'].push(defaultValues[i]);
		}
	}, 
	methods = {
		"transform": transform
	};
	
	var doButtonClick = function(dcs, options) {
		dcs.addSelector("INPUT[type='button']", methods);
		dcs.addSelector("INPUT[type='submit']", methods);
	};

	// This plugin is used to track the Submit/Button clicks with the selector INPUT[type='button']/INPUT[type='submit']
	Webtrends.registerPlugin("buttonClick", doButtonClick);
})(jQuery);
