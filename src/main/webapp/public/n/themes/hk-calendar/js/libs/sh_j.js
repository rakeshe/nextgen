/*
 *  Sharecow - DIY sharing for attaching to buttons!
 *  Version: 2.1.0
 *  Author: Pete Wailes
 *  Email: pete@gadg3t.com
 *  http://gadg3t.com/sharecow/
 *  License: MIT http://en.wikipedia.org/wiki/MIT_License or GPLv2 http://en.wikipedia.org/wiki/GNU_General_Public_License
 */
var sharecow = function(options){
    this.options = {};
    $.extend(this.options, options);
    this.values = {
        Facebook: 0,
        Twitter: 0,
        GooglePlusOne: 0,
        LinkedIn: 0,
        Pinterest: 0
    };
    this.queried = 0;
    this.renderOutput();
    this.selector = this.selector || '.socialbar';
}


sharecow.prototype = {

    renderOutput: function() {
        var self = this;
        var outputHtml = '';

        for (var siteName in self.values) {
            var link = document.location.href;

            if (self.options.share[siteName] == true) {
                var site = (siteName == 'GooglePlusOne') ? 'googleplus' : siteName.toLowerCase();

                outputHtml += self.parseData(0, link, site);
            }
        }

        if($(self.options.selector)) {
            $(self.options.selector).append(outputHtml);

            //whereas this will only cause 1 loop
            $(self.options.selector+' a').each(function() {
                $(this).click(function(event) {
                    event.preventDefault();
                    self.openwin($(this).attr('data-site'));
                });
            });
        }
    },

    parseData: function(count, url, site) {
        if (site == 'googleplus') {
            var output = '<div id="googleplus"> <div class="social '+ site +'"><a class="share" href="#" data-site="'+site+'"></a></div></div>';
        } else {
            var output = '<div id="'+ site +'"><div class="social '+ site +'"><a class="share" href="#" data-site="'+site+'"></a></div></div>';
        }

        return output;
    },

    openwin: function(site) {
        /* Feel free to add to these as you wish */
        
        var shareUrl = document.location.href;
        var shareHashUrl =  shareUrl.replace("interactive/month", "interactive#month");
        var site = site;

        var shareTitle = this.options.title;
        var shareTitleTw = this.options.titleTwitter;
        var shareTitlePin = this.options.titlePinterest;
        var encUrl = this.options.thisUrl ? encodeURIComponent(this.options.thisUrl) : encodeURIComponent(shareHashUrl);
        var encTitle = encodeURIComponent(shareTitle);
        var encTitleTw = encodeURIComponent(shareTitleTw);
        //var pinterestImg = encodeURIComponent('//jobs.telegraph.co.uk/customcontent/women-in-space/'+this.options.img);

        var socialSites = {
            "facebook": {
                "url": 'http://www.facebook.com/sharer/sharer.php?s=100u=' + encUrl + '&t=' + encTitle,
                "spec": 'toolbar=0, status=0, width=900, height=500',
            },
            "twitter": {
                "url": 'https://twitter.com/intent/tweet?text=' + encTitleTw + '&url=' + encUrl,
                "spec": 'toolbar=0, status=0, width=650, height=360',
            },
            "googleplus": {
                "url": 'https://plus.google.com/share?url=' + encUrl,
                "spec": 'toolbar=0, status=0, width=900, height=500',
            },
            "linkedin": {
                "url": 'https://www.linkedin.com/cws/share?url=' + shareUrl + '&token=&isFramed=true',
                "spec": 'toolbar=no, width=550, height=550',
            }
            // "pinterest": {
            //     "url": 'http://pinterest.com/pin/create/button/?url=&' + shareUrl + '&description=' + shareTitlePin + '&media=' + pinterestImg + '&token=&isFramed=true',
            //     "spec": 'toolbar=no, width=700, height=300'
            // }
        };
        window.open(socialSites[site]['url'], "", socialSites[site]['spec']);
    }
};