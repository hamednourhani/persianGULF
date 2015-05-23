define([
        "app",
        "marionette",
        "core/core_functions"
        ],
         function(persianGULF,Marionette,coreFuncs){
          "use strict" 
  
  console.log('list_view is running');
  
  persianGULF.module("Comment.List", function(List, persianGULF,
   Backbone, Marionette, $, _){
             
       

       List.comment = Marionette.ItemView.extend({
         tagName: "article",
         template: "#comment-template",


          events:{
            "click a": "showClicked",
          },
 
          showClicked: function(e){
            coreFuncs.showClicked(e,this);
           }, /*showClicked*/
            
       });/*List.post*/
      
      
       
       List.comments = Marionette.CollectionView.extend({
         tagName: "div", 
         //className : "primary-inner",     
         childView : List.comment
       });/*List.posts*/
   }); /*postsApp.List*/

  return persianGULF.Comment.List;
}); /*requireJS define*/