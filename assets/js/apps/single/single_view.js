define([
        "app",
        "marionette",
        "core/core_functions"
        ],
         function(persianGULF,Marionette,coreFuncs){
 "use strict" 
  console.log('single_view is running');

	persianGULF.module("PostsApp.Single", function(Single, persianGULF,
		 Backbone, Marionette, $, _){
		   
	    
	    Single.Post = Marionette.ItemView.extend({
	     template: "#article-content", 

	     events: {
             "click a": "showClicked",
          },
	     
       showClicked: function(e){
          coreFuncs.showClicked(e,this);
         }, /*showClicked*/
           
	    });/*Single.Post*/
	    
	    
	}); /*persianGULF*/

	return persianGULF.PostsApp.Single;

}); /*requireJS define*/