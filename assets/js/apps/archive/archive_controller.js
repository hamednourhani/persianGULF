define([
        "jquery",
        "app",
        'apps/index/index_layout',
        'core/core_functions',
        "entities/entities",
        "apps/archive/archive_view",
        "common/common_views",
        "apps/single/single_view",
        "apps/single/single_controller",
                
        ], function($,persianGULF,Index,coreFuncs){
 
 "use strict" 
  
  persianGULF.module("PostsApp.List", function(List, persianGULF,
    Backbone, Marionette, $, _){
        
       List.Controller = {
          
          listPosts: function(params){
            
            /* Show Loading Spinner in primaryRegion */
            var loadingView = new persianGULF.Common.Views.Loading();
            Index.indexLayout.postArea.show(loadingView);
            
            
            /* Show the content in postRegion*/
            
            this.preparePosts(params);
              
            
          }, /*listPosts*/
                     
          preparePosts : function(ObjParams) {

              var fetchPosts = persianGULF.request("post:entities",ObjParams);
               
               $.when(fetchPosts).done(function(posts){
                  List.Controller.showPosts(posts,ObjParams);
               });
          },/*preparePosts*/

          showPosts : function(posts,ObjParams){
                           //Posts List View 
            if(posts.length !== 0){
                  
                  
                  if(ObjParams.is_singular === false ){
                    //s,search,cat,author_name,term,taxonomy
                    
                      var postsListView = new List.posts({
                        collection: posts
                      });
                      postsListView.on("childview:post:show",function(childView, model){
                        //$('primary div.list-view').fadeOut();
                        persianGULF.PostsApp.Single.Controller.showPost(model);
                        
                      });

                      //Posts List Show
                      Index.indexLayout.postArea.show(postsListView);
                      
                   
                    } else {
                                    
                           persianGULF.PostsApp.Single.Controller.showPost(posts.models[0]);
                    }
                     
              } else {
                    persianGULF.PostsApp.Single.Controller.show404();
                  
              }

          }, /*showPosts*/
         
                
       } /*List.Controller*/
   }); /*postsApp.List*/
    return persianGULF.PostsApp.List.Controller;
}); /*requireJS.define*/

