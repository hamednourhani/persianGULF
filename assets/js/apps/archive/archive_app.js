define(['marionette','apps','apps/archive/archive_controller'], function(Marionette,persianGULF){
	"use strict" 
	
	

	persianGULF.module("PostsApp", function(PostsApp, persianGULF,
	  Backbone, Marionette, $, _){
	    

	    PostsApp.Router = Marionette.AppRouter.extend({
	      
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
		     		     	
		     	var params = persianGULF.retrieveParams(route);
	            
	            $.when(params).done(function(params){
	            	PostsApp.List.Controller.listPosts(params);
			    });
		     }, /*listPosts*/
 	 	}; /*API*/
	      
	  persianGULF.on("before:start",function(){
	  	console.log('contacts_app is running');
	     new PostsApp.Router({
	      controller: API
	    });
	  }); /*before:start*/

	 }); /*PostsApp*/

	
}); /*requireJS Define*/