define([
        "core",
        "marionette",
        ],
         function(persianGULF,Marionette){
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
                      
                      if(element.hasClass('post-link') || element.hasClass('data-date') || element.hasClass('data-comment')){
                      
                        this.trigger("post:show", this.model);
                        var newRoute = this.model.attributes.link.replace(/^.*\/\/[^\/]+/, '');
                        persianGULF.navigate(newRoute);
                      
                      } else {

                            if(element.hasClass('data-author')){
                              var params = {author : element.attr('data-author-id')};

                            } else if(element.hasClass('data-cat')){
                               var params = {category_name : element.attr('data-cat')};
                            
                            } else if(element.hasClass('data-tag')){
                               var params = {tag : element.attr('data-tag')};   
                            
                            }else{
                              var params = persianGULF.retrieveParams(e.target.pathname);
                              persianGULF.navigate(e.target.pathname);
                            }
                            var currentModel = this;
                            $.when(params).done(function(params){
                                console.log("params done :"+params);
                                currentModel.trigger("params:show", params);
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

  return persianGULF.PostsApp.List;
}); /*requireJS define*/