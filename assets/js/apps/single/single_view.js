define([
        "app",
        "marionette",
        "core/core_functions"
        ],
         function(persianGULF,Marionette,coreFuncs){
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
             persianGULF.tempLink = "";
             var element = $(e.target);
             e.preventDefault();
             e.stopPropagation();
                          
             if(coreFuncs.isExternalStringReplace(e.target.href)){
                  window.open(e.target.href, '_blank');
             } else {
                  if(element.hasClass('post-link') || element.hasClass('data-date') || element.hasClass('data-comment')){
                      
                        var newRoute = this.model.attributes.link.replace(/^.*\/\/[^\/]+/, '');
                        coreFuncs.navigate(newRoute);
                      
                      } else {

                            if(element.hasClass('data-author')){
                              var params = {author : element.attr('data-author-id')};

                            } else if(element.hasClass('data-cat')){
                               var params = {category_name : element.attr('data-cat')};
                            
                            } else if(element.hasClass('data-tag')){
                               var params = {tag : element.attr('data-tag')};   
                            
                            }else{
                              var params = coreFuncs.retrieveParams(e.target.pathname);
                              coreFuncs.navigate(e.target.pathname);
                            }
                            var currentView = this;
                            $.when(params).done(function(params){
                                console.log("params done :"+params);
                                currentView.trigger("params:show", params);
                            });
                  }
              }

        }, /*showClicked*/


           
	    });/*Single.Post*/
	    
	    
	}); /*persianGULF*/

	return persianGULF.PostsApp.Single;

}); /*requireJS define*/