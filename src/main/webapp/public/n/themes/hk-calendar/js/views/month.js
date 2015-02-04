var app = app || {};

app.evCollect = '';

app.MonthView = Backbone.View.extend({

    el: 'section.month article',
    
    template: _.template($('#tplMonth').html()),
    
    render: function () {
    	var itemModel = this.model.toJSON();
        var index = collect.indexOf(this.model);

        if(collect.at(index-1)){
            itemModel.prev = collect.at(index-1).get('name').split(" ").join('/');
        }
        if(collect.at(index+1)){
            itemModel.next = collect.at(index+1).get('name').split(" ").join('/');
        }
        var html = this.template(
            itemModel
        );

        var events = this.model.get('events');
        var image = 'themes/hk-calendar/' + this.model.get('image');


        //console.log(itemModel);

        app.evCollect = new app.eventCollection();
        app.evCollect.reset();

        _.each(events, function(obj, num){
        	var model = new app.Event(obj);
        	app.evCollect.add(model);
        })

        var ev = new app.EventView({
        	collection: app.evCollect
        })

        ev.render()

        $('.month').animate({opacity: 0.5},300, function(){
          $('.month').css('background-image', 'url('+image+')');
          $('.month').animate({opacity: 1},200) 
        })
        
        

        $(this.el).html(html);
    }
});