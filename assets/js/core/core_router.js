define([
		'marionette',
		'jquery',
		'app',
		'core/core_functions',
		'core/core_controller'
		],
		 function(Marionette,$,persianGULF,coreFuncs){
		
		"use strict" 
	
	persianGULF.module("coreRouter", function(coreRouter, persianGULF,
	  Backbone, Marionette, $, _){
	    

	    coreRouter.Router = Marionette.AppRouter.extend({
	      
	      appRoutes: {
	        "": "showFirst",
	        "*route" : "showPosts",
	        
	      },

	       onRoute : function(name, path, args) {
		        // this route is being called. This works
		    }
	    }); /*PostsApp.Router*/
	        
	    var API = {
	     
		     showFirst: function(route){
		     		     	
		     	var params = "";
	            PostsApp.List.Controller.listPosts(params);
			    
		     }, /*showFirst*/
		     
		     showPosts: function(route){
		     		     	
		     	var params = coreFuncs.retrieveParams(route);
	            
	            $.when(params).done(function(params){
	            	PostsApp.List.Controller.listPosts(params);
			    });
		     }, /*listPosts*/
 	 	}; /*API*/
	      
	  persianGULF.on("before:start",function(){
	  	console.log('contacts_app is running');
	     new coreRouter.Router({
	      controller: API
	    });
	  }); /*before:start*/

	 }); /*PostsApp*/

	return persianGULF.coreRouter;	
}); /*requireJS Define*/