define([
        "app",
        "marionette",
        "core/core_functions"
        ],
         function(persianGULF,Marionette,coreFuncs){
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
 
          showClicked: function(e){
            coreFuncs.showClicked(e,this);
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