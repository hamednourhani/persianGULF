define([
	"app",
	'apps/index/index_layout',
	"apps/comment/comment_view",
	"common/common_views",
	"jquery"
	], function(persianGULF,Index,List,commonViews,$){

 "use strict" 
  console.log('comment_controller is running');

	persianGULF.module("Comment.List", function(List, persianGULF,
	 Backbone, Marionette, $, _){
	   
	   List.Controller = {
	     
	     listComments: function(post_id){
            
            /* Show Loading Spinner in primaryRegion */
            var loadingView = new commonViews.Loading();
            Index.indexLayout.commentArea.show(loadingView);
            
            /* Show the content in postRegion*/
            
            this.prepareComments(post_id);
              
            
          }, /*listComments*/
                     
          prepareComments : function(post_id) {

              var fetchComments = persianGULF.request("comment:entities",post_id);
               
               $.when(fetchComments).done(function(comments){
                  List.Controller.showComments(comments);
               });
          },/*prepareComments*/

          showComments : function(comments){
                           //Posts List View 
            if(comments.length !== 0){
                                               
	              var commentsListView = new List.comments({
	                collection: comments
	              });
	            
	              //Posts List Show
	              Index.indexLayout.commentArea.show(commentsListView);
	              
            } else {

            	var noComment = new List.comment({
            		template : "#no-comment-found"
            	});
            	Index.indexLayout.commentArea.show(noComment);
            }       
                    
          }, /*showComments*/
	     

	   } /*List.Controller*/
	 }); /*persianGULF*/
	return persianGULF.Comment.List.Controller;
}); /*requireJS define*/