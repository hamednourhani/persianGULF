define([
        "jquery",
        "apps",
        "entities/entities",
        "apps/archive/archive_view",
        "common/common_views",
        "apps/single/single_view",
        "apps/single/single_controller"
        
        ], function($,persianGULF){
 
 "use strict" 
  
  persianGULF.module("PostsApp.List", function(List, persianGULF,
    Backbone, Marionette, $, _){
        
       List.Controller = {
          listPosts: function(ObjParams){
            
            /* Show Loading Spinner in primaryRegion */
            var loadingView = new persianGULF.Common.Views.Loading();
            persianGULF.postRegion.show(loadingView);

            
            /* Show the content in postRegion*/
                 
            var fetchPosts = persianGULF.request("post:entities",ObjParams);
            
            
              $.when(fetchPosts).done(function(posts){
                           //Posts List View 
                if(posts.length > 1){
                  
                    var postsListView = new List.posts({
                      collection: posts
                    });
                    postsListView.on("childview:post:show",function(childView, model){
                      //$('primary div.list-view').fadeOut();
                      persianGULF.PostsApp.Single.Controller.showPost(model);
                      
                    });

                    postsListView.on("childview:params:show",function(childView, params){
                      //$('primary div.list-view').fadeOut();
                      persianGULF.PostsApp.List.Controller.listPosts(params);
                      
                    });

                    //Posts List Show
                   persianGULF.postRegion.show(postsListView);
                 
                  } else if(posts.length === 1) {
                                  
                         persianGULF.PostsApp.Single.Controller.showPost(posts.models[0]);
                       
                  } else {
                        persianGULF.PostsApp.Single.Controller.show404();
                      
                  }

              }); /*$.when.done(fetchPosts)*/
        }, /*listposts*/
         
                
       } /*List.Controller*/
   }); /*postsApp.List*/
    return persianGULF.PostsApp.List.Controller;
}); /*requireJS.define*/

