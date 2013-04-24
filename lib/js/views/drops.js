var DropItApp = window.DropItApp || {};

DropItApp.DropsView = Backbone.View.extend({
    el: '#drops',

    initialize: function( initialDrops ) {
        this.collection = new DropItApp.Drops( initialDrops );
        this.render();
    },

    // render library by rendering each book in its collection
    render: function() {
        this.collection.each(function( item ) {
            this.renderDrop( item );
        }, this );
    },

    // render a book by creating a BookView and DropItAppending the
    // element it renders to the library's element
    renderDrop: function( item ) {
        var dropView = new DropItApp.DropView({
            model: item
        });
        this.$el.append( dropView.render().el );
    }
});
