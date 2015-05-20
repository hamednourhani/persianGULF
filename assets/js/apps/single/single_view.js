define(["app","marionette"], function(persianGULF,Marionette){
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
                          
             if(persianGULF.isExternalStringReplace(e.target.href)){
                  window.open(e.target.href, '_blank');
             } else {
                  if(element.hasClass('post-link')){
                    console.log('model will shown');
                    this.trigger("post:show", this.model);
                    persianGULF.navigate(this.model.attributes.title);
                  } else{
                    var params = persianGULF.retrieveParams(e.target.pathname);
              
                      $.when(params).done(function(params){
                        console.log("params done :"+params);
                        persianGULF.PostsApp.List.Controller.listPosts(params);
                        persianGULF.navigate(e.target.pathname);
                      });
                  }
              }

        }, /*showClicked*/


           
	    });/*Single.Post*/
	    
	    
	}); /*persianGULF*/

	return persianGULF.PostsApp.Single;

}); /*requireJS define*/