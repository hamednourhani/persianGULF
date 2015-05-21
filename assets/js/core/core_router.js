define([
		'marionette',
		'jquery',
		'app',
		'core/core_functions',
		'core/core_controller'
		],
		 function(Marionette,$,persianGULF,coreFuncs,coreController){
		
		"use strict" 
	
	persianGULF.module("Core.coreRouter", function(coreRouter, persianGULF,
	  Backbone, Marionette, $, _){
	    

	    coreRouter.Router = Marionette.AppRouter.extend({
	      
	      appRoutes: {
	        "": "makeLayout",
	        "*route" : "makeLayout",
	        
	      },

	       onRoute : function(name, path, args) {
		        // this route is being called. This works
		    }
	    }); /*PostsApp.Router*/
	        
	    var API = {
	     
		     options : {},
		     makeLayout : function(route){
		     	
		     	if(route === undefined) 
		     		var route = "";
		     	 
		     	 this.options.route = route;
		     	 coreController.Funcs.makeLayout(this.options);
		     },
		     /*showFirst: function(route){
		     		     	
		     	var params = "";
	            PostsApp.List.Controller.listPosts(params);
			    
		     }, 

		     showPosts: function(route){
		     		     	
		     	var params = coreFuncs.retrieveParams(route);
	            
	            $.when(params).done(function(params){
	            	PostsApp.List.Controller.listPosts(params);
			    });
		     }, */
 	 	}; /*API*/
	      
	  persianGULF.on("before:start",function(){
	  	console.log('coreRouter is running');
	     new coreRouter.Router({
	      controller: API
	    });
	  }); /*before:start*/

	 }); /*PostsApp*/

	return persianGULF.Core.coreRouter;	
}); /*requireJS Define*/