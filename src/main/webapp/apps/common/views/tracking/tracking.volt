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
        fpcdom = hostName.slice(indexOfDot,lengthOfHostName);
    }

    window.webtrendsAsyncInit=function(){
        var dcs=new Webtrends.dcs().init({
            dcsid:"dcscfchfzvz5bdrpz13vsgjna_9r8u"
            ,domain:"ctix8.cheaptickets.com"
            ,timezone:-6
            ,i18n: false
            ,navigationtag: "div,span"
            ,FPCConfig: {
                enabled: true,
                domain: fpcdom
            }
            ,plugins:{
                LinkTrack: { src: "/n/themes/common/js/linkTrack.js", DivList: ".*" }
                ,buttonClick:{ src:"/n/themes/common/js/buttonClick.js" }

            }
        }).track({
            // Everything here overrides plugins.
            filter: function(dcs, options) { },
            transform: function(dcs, options) { },
            finish: function(dcs, options) {
                dcs.dcsCleanUp("DCSext.pos", dcs.DCSext['pos']);
                dcs.dcsVar();
            }
        });
    };
    (function(){
        var s=document.createElement("script"); s.async=true; s.src="/n/themes/common/js/webtrends.min.js";
        var s2=document.getElementsByTagName("script")[0]; s2.parentNode.insertBefore(s,s2);
    }());


</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<noscript><img alt="dcsimg" id="dcsimg" width="1" height="1" src="//ctix8.cheaptickets.com/dcscfchfzvz5bdrpz13vsgjna_9r8u/dcs.gif?dcsuri=/nojavascript&amp;WT.js=No&amp;WT.tv=10.2.0&amp;WT.dl=0"/></noscript>
<!-- END OF SmartSource Data Collector TAG v10.2.0 -->



<!--
Start of DoubleClick Floodlight Tag: Please do not remove
Activity name of this tag: Summer Sale 2013
URL of the webpage where the tag is expected to be placed: http://www.hotelclub.com/Summer-Sale
Creation Date: 12/18/2014
-->
<script type="text/javascript">
    var axel = Math.random() + "";
    var a = axel * 10000000000000;
    document.write('<iframe src="http://4147732.fls.doubleclick.net/activityi;src=4147732;type=sprin024;cat=summe289;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
</script>
<noscript>
    <iframe src="http://4147732.fls.doubleclick.net/activityi;src=4147732;type=sprin024;cat=summe289;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
</noscript>
<!-- End of DoubleClick Floodlight Tag: Please do not remove -->