App = Ember.Application.create();

App.Router.map(function() {
  // put your routes here
});

App.IndexRoute = Ember.Route.extend({
  model: function() {
    return jQuery.getJSON('../../pro_british_soccer/code/print.php');
  }
});
