// RequireJS Config file.
"use strict" 
if (typeof jQuery === 'function' ) {
  define('jquery', function () { return jQuery; });
} // load jquery from wordpress core.
if (typeof window._ === 'function' ) {
  define('underscore', function () { return window._; });
} // load underscore from wordpress core.
if (typeof window.Backbone === 'object' ) {
  define('backbone', function () { return window.Backbone; });
} // load backbone from wordpress core.
/*if (typeof window.UrlHelper === 'object'){
  console.log('window.UrlHelper is running');
  define('urlhelper',function() {return window.UrlHelper;});
}*/



requirejs.config({
//  baseUrl: "",
  paths: {
    json2: "vendor/json2",
    marionette: "vendor/backbone.marionette.min",
    babysitter : "vendor/backbone.babysitter.min",
    urlhelper : "common/pG_url_helper"
       
  },

  shim: {
    jquery :{
      exports : "$"
    },
    underscore: {
      exports: "_"
    },
    backbone: {
      deps: ["jquery", "underscore", "json2"],
      exports: "Backbone"
    },
    marionette: {
      deps: ["backbone"],
      exports: "Marionette"
    },
    urlhelper : {
      deps :["jquery"],
      exports : "UrlHelper"
    }
    

    
  }
}); /*requirejs.config*/

require(['core','core/core_router','jquery'], function(persianGULF,PostsApp,$){
  
    
  persianGULF.on("start", function(){
   if(Backbone.history){
     Backbone.history.start({
      root : '',
      pushState : true,
      hashChange : false
      //silent: true,
      //root: ""
     });
       
     if(this.getCurrentRoute() === ""){
       this.navigate("");
       
     } else {
      var currentRoute = this.getCurrentRoute();
      this.navigate(currentRoute);
     }
   }
  }); /*on before:start*/ 
  
  $('document').ready(function(){
    persianGULF.start();
    
  });

}); /*require*/
