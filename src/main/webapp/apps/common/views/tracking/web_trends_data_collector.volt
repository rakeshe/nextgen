<!-- START OF SmartSource Data Collector TAG v10.2.0 -->
<!-- Copyright (c) 2012 Webtrends Inc.  All rights reserved. -->
<script>
    // WebTrends SmartSource Data Collector Tag v10.2.0
    // Copyright (c) 2012 Webtrends Inc.  All rights reserved.
    // Tag Builder Version: 4.0.170.0
    // Created: 5/8/2012 4:28:58 PM
    var hostName = window.location.hostname;
    var indexOfDot = hostName.indexOf('.');
    var lengthOfHostName = hostName.length;
    var fpcdom;
    if (indexOfDot == -1) {
        fpcdom = hostName;
    } else {
        fpcdom = hostName.slice(indexOfDot, lengthOfHostName);
    }

    window.webtrendsAsyncInit = function () {
        var dcs = new Webtrends.dcs().init({
            dcsid: "{{ wtDataCollectorData['dcsid'] }}",
            domain: "{{ wtDataCollectorData['domain'] }}",
            timezone: -6,
            i18n: false,
            navigationtag: "div,span",
            FPCConfig: {
                enabled: true,
                domain: fpcdom
            },
            plugins: {
                LinkTrack: {src: "/n/themes/common/js/linkTrack.js", DivList: ".*"},
                buttonClick: {src: "/n/themes/common/js/buttonClick.js"}

            }
        }).track({
            // Everything here overrides plugins.
            filter: function (dcs, options) {
            },
            transform: function (dcs, options) {
            },
            finish: function (dcs, options) {
                dcs.dcsCleanUp("DCSext.pos", dcs.DCSext['pos']);

                if(typeof dcs.dcsVar === 'function')
                    dcs.dcsVar();
            }
        });
    };
    (function () {
        var s = document.createElement("script");
        s.async = true;
        s.src = "/n/themes/common/js/webtrends.min.js?2-1-1";
        var s2 = document.getElementsByTagName("script")[0];
        s2.parentNode.insertBefore(s, s2);
    }());


</script>
<noscript><img alt="dcsimg" id="dcsimg" width="1" height="1"
               src="//{{ wtDataCollectorData['domain'] }}/{{ wtDataCollectorData['dcsid'] }}/dcs.gif?dcsuri=/nojavascript&amp;WT.js=No&amp;WT.tv=10.2.0&amp;WT.dl=0"/>
</noscript>
<!-- END OF SmartSource Data Collector TAG v10.2.0 -->