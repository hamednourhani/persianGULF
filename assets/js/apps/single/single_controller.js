define([
	"app",
	"apps/comment/comment_controller",
	'apps/index/index_layout',
	"apps/single/single_view",
	"common/common_views",
	
	], function(persianGULF,commentListController,Index){

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

	       	Index.indexLayout.postArea.show(singleView);
	       	commentListController.listComments(model.attributes.ID);

                                      
	     }, /*showPost*/

	     show404 : function(){
	     	var singleView = new Single.Post({
	     		template : "#article-404",
	     	});
	     	
	     	Index.indexLayout.postArea.show(singleView);
            	     	
	     },


	   } /*Single.Controller*/
	 }); /*persianGULF*/
	return persianGULF.PostsApp.Single.Controller;
}); /*requireJS define*/