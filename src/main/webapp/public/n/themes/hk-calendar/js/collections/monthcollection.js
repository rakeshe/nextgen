var app = app || {};

app.monthCollection = Backbone.Collection.extend({

    model: app.Month,

    initialize: function () {

        var self = this;

        window.eventData.forEach(function (o) {
            self.add(o);
        });
    }

});

app.eventCollection = Backbone.Collection.extend({

    model: app.Event

});