(function($, HB){

    HB.registerHelper('split', function( value, type ) {

        var v = value.split('::');

        if (typeof type == 'number') {
            return new Handlebars.SafeString( v[ type -1 ] );
        }

        return new Handlebars.SafeString( v[0] );

    });

    HB.registerHelper('safeSting', function( value ) {

        return new Handlebars.SafeString( value );
    });

    var App = {

        lang : "en_au",

        defaultLang :"en_au",

        AjaxNotFound : false,

        data : false,

        init : function () {

            var self = this;
            this.request( this.lang )
                .success(function(data){

                    //self.data = data;
                    //self.applyTranslations(data);
                    self.executeTemplates(data);
                })
                .error(function(jqXHR, textStatus, errorThrown){

                    if (jqXHR.status == '404' && self.defaultLang !== self.lang && self.AjaxNotFound === false) {

                        self.AjaxNotFound = true;
                        self.lang = self.defaultLang;
                        self.init();
                    }
                });

            //this.executeTemplates();
        },

        request : function(lang) {
			/*$.urlParam = function(name){
				var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
				return results[1] || 0; 
			}
			lang = $.urlParam('locale');*/
			$.urlParam = function(name){
				var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
				if (results==null){	return null; }
				else{ return results[1] || 0; }
			}
			if(($.urlParam('locale'))!=null){ lang = $.urlParam('locale').split("?")[0]; }
            return $.ajax({
                type : 'POST',
                dataType : 'json',
                //url : 'data/data_' + lang + '.json'
                url : '/n/api/migrate/page/' + lang
            });
        },

        applyTranslations : function( data ) {

            var $self = this;

            $.each(data.translations, function(index, value) {


                $.each(value, function(i, v) {

                    var link = /(link:)/i,
                        src = /(src:)/i;

                    if (i.match(link) !== null) {

                        $self.setLink(i, v);

                    } else if (i.match(src) !== null) {

                        $self.setSrc(i, v);

                    } else {
                        //$self.setText(i, v);
                        $('*[data-t-' + index + '-' + i + '=""]').html(v)
                    }

                });
            });

        },

        setText : function( key, data ) {

        },
        setLink : function ( key, data ) {

        },
        setSrc : function ( key, data ) {

        },

        executeTemplates : function( data ) {

            this.displayHeader( data['translations']['header'] );
            this.displayBannerSection( data['translations']['banner'] );
            this.displayArticleSection( data['translations']['article'] );
        },

        displayHeader : function( trans ) {
            var template = HB.compile( $("#header-template").html() );
            $('.container #header').html( template({ trans : trans }) );
        },

        displayBannerSection : function( trans ) {
            var template = HB.compile( $("#banner-template").html() );
            $('.container #banner').html( template({ trans : trans }) );
        },
        displayArticleSection : function( trans ) {

            var template = HB.compile( $("#article-template").html() );
            $('.container #article').html( template({ trans : trans }) );
        }
    };

    App.init();

})(jQuery, Handlebars);