var app = app || {};

app.EventView = Backbone.View.extend({

	el: '.container',

	template: _.template($('#tplEvent').html()),

	render: function(){
		//console.log(this.collection.toJSON());

		var coll = this.collection.models;
		
		//console.log('coll', coll);

		var self = this;

		$(self.el).html('');

		_.each(coll, function(model, index){
			var mod = model.toJSON();
			//console.log('collmod', mod);
			var str = Backbone.history.fragment;
			var regexp = /(month\/[a-z]+\/\d+)/gi;
			var match = str.match(regexp);
			mod.history = match[0];
			
			var modRen = self.template(mod)

			$(self.el).append(modRen);

			return
		})
		
	},

	events: {
		'click .item' : 'show'
	},

	show: function(e){
		$(e.currentTarget).addClass('selected');
		var o = $(e.currentTarget).find('a').attr('href');
		var oS = o.split('#');
		route.navigate(oS[1],{trigger:true});
	}

})