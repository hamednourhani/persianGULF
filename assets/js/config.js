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
    marionette: "vendor/backbone.marionette.min",
    babysitter : "vendor/backbone.babysitter.min",
           
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
    
    

    
  }
}); /*requirejs.config*/

require(['app','core/core_functions','core/core_router','jquery'], function(persianGULF,coreFuncs,coreRouter,$){
    
  persianGULF.on("start", function(){
     if(Backbone.history){
       Backbone.history.start({
        root : '',
        pushState : true,
        hashChange : false
        //silent: true,
        //root: ""
       });
         
       if(coreFuncs.getCurrentRoute() === ""){
         coreFuncs.navigate("");
         
       } else {
        var currentRoute = coreFuncs.getCurrentRoute();
        coreFuncs.navigate(currentRoute);
       }
     }
    }); /*on before:start*/ 

  $('document').ready(function(){
    persianGULF.start();
    
  });

}); /*require*/
