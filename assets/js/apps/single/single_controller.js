define([
	"app",
	"entities/entities",
	"apps/single/single_view",
	"common/common_views"
	], function(persianGULF){

 "use strict" 
  console.log('single_controller is running');

	persianGULF.module("PostsApp.Single", function(Single, persianGULF,
	 Backbone, Marionette, $, _){
	   
	   Single.Controller = {
	     
	     showPost: function(model){
		    
		       
            //Posts single View 
            var singleView = new Single.Post({
	            model: model
	        });

          	require(['apps/index/index_layout'],function(Index){
                      Index.indexLayout.postArea.show(singleView);
            });        
            
	     }, /*showPost*/
	     show404 : function(){
	     	var singleView = new Single.Post({
	     		template : "#article-404",
	     	});
	     	
	     	require(['apps/index/index_layout'],function(Index){
                      Index.indexLayout.postArea.show(singleView);
            });
	     	
	     },

	   } /*Single.Controller*/
	 }); /*persianGULF*/
	return persianGULF.PostsApp.Single.Controller;
}); /*requireJS define*/