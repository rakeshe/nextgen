var app = app || {};

// app.Event = Backbone.RelationalModel.extend({
//     idAttribute: 'id',
// });

// app.Month = Backbone.RelationalModel.extend({
//     idAttribute: 'id',
//     relations: [{
//         type: Backbone.HasMany,
//         key: 'events',
//         relatedModel: 'app.Event',
//         reverseRelation: {
//             key: 'month',
//             includeInJSON: 'id',
//         },
//     }]
// });

app.Month = Backbone.Model.extend({

});

app.Event = Backbone.Model.extend({
    idAttribute: 'id'
});
