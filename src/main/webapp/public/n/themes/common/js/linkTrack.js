(function($) {
	var transform = function(dcs, o) {
		var e = o['event'] || {};
		var el = o['element'] || {};
		// OWW add: custom attribute tracking for WT.ti
		var $ele = $(el);
		var ttl = $ele.attr("data-wt-ti") || $ele.text().replace(/^\s+/, '').replace(/\s+$/, '') || "";
		dcs._autoEvtSetup(o);
		var res = dcs.getURIArrFromEvent(el);
		var multiTrackArgs = ""; // OWW add: custom attribute for multitrack tags.
		var mtVal = $ele.attr("data-wt-mt");
		if (mtVal) {
			multiTrackArgs = mtVal;
		}
		var defaultValues = "";
		if (multiTrackArgs) {
			defaultValues = multiTrackArgs.split(/\s*,\s*/);
		}
		o['argsa'].push(
			"DCS.dcssip", res.dcssip,
			"DCS.dcsuri", res.dcsuri + o['element'].hash,
			"DCS.dcsqry", res.dcsqry,
			"WT.ti", "Link:" + ttl,
			"WT.nv", dcs.dcsNavigation(e, dcs.navigationtag),
			"WT.dl", "1");
		var len = defaultValues.length;
		for (var i = 0; i < len; i++) {
			o['argsa'].push(defaultValues[i]);
		}
		dcs._autoEvtCleanup(o);
	}, 
	methods = {
		"transform": transform
	};
	
	var doLinkTrack = function(dcs, options) {
		dcs.addSelector('a', methods);
	};
	
	// This plugin is used to track the link clicks with the selector <a>
	Webtrends.registerPlugin("LinkTrack", doLinkTrack);
})(jQuery);
