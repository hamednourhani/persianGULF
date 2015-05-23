define([
        "app",
        "marionette",
        "core/core_functions",
        'apps/index/index_layout',
         "common/common_views",
        ],
         function(persianGULF,Marionette,coreFuncs,Index,commonViews){
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

       onBeforeDestroy: function(){
           var emptyView = new commonViews.Empty();
           Index.indexLayout.commentArea.show(emptyView);
        },
           
	    });/*Single.Post*/
	    
	    
	}); /*persianGULF*/

	return persianGULF.PostsApp.Single;

}); /*requireJS define*/