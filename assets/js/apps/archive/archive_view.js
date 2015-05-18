define(["apps","marionette"], function(persianGULF,Marionette){
  "use strict" 
  console.log('list_view is running');
  
  persianGULF.module("PostsApp.List", function(List, persianGULF,
   Backbone, Marionette, $, _){
             
       

       List.post = Marionette.ItemView.extend({
         tagName: "article",
         template: "#article-excerpt",


          events:{
            "click a": "showClicked",
          },
 
          // highlightName event handler
   
           showClicked: function(e){
             var element = $(e.target);
             e.preventDefault();
             e.stopPropagation();
             var pageData = {};
             
             if(persianGULF.isExternalStringReplace(e.target.href)){
                  window.open(e.target.href, '_blank');
             } else {
                  if(element.hasClass('post-link')){
                  
                    this.trigger("post:show", this.model);
                    var newRoute = this.model.attributes.link.replace(/^.*\/\/[^\/]+/, '');
                    persianGULF.navigate(newRoute);
                  
                  } else {
                    
                    var params = persianGULF.retrieveParams(e.target.pathname);
              
                    $.when(params).done(function(params){
                      console.log("params done :"+params);
                      persianGULF.PostsApp.Single.Controller.showPost(params);
                      persianGULF.navigate(e.target.pathname);
                     });
                    
                  }
              }

           }, /*showClicked*/


            
       });/*List.post*/
      
      
       
       List.posts = Marionette.CollectionView.extend({
         tagName: "div", 
         className : "primary-inner",     
         itemView: List.post,
         childView : List.post
       });/*List.posts*/
   }); /*postsApp.List*/

  
}); /*requireJS define*/