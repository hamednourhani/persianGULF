define([
        "app",
        "jquery",
        "backbone",
        "core/core_functions",
        ],
         function(persianGULF,$,Backbone,coreFuncs){
        "use strict"
  
  console.log('entities is running');

  persianGULF.module("Entities", function(Entities, persianGULF,
   Backbone, Marionette, $, _){

    Entities.homeUrl = $("link[rel~='https://github.com/WP-API/WP-API']").attr('href');
     //Entities.jsonUrl = Entities.homeUrl + '/wp-json/posts';
    Entities.jsonUrl = Entities.homeUrl + '/posts';
    console.log(Entities.homeUrl,Entities.jsonUrl);

    var API = {
       
       options : {},
       
       getPostEntities: function(ObjParams){
           API.options.req_params = coreFuncs.convertParams(ObjParams); 
           var defer = $.Deferred();
           var posts = new Entities.postCollection(API.options);
            
            setTimeout(function(){
                posts.fetch({
                  success: function(data){
                    console.log(data);
                    defer.resolve(data);
                  }
                });
            }, 2000);
            return defer.promise();
        }, /*getPostEntities*/

        getCommentEntities: function(post_id){
           API.options.post_id = post_id; 
           var defer = $.Deferred();
           var comments = new Entities.commentCollection(API.options);
            
            setTimeout(function(){
                comments.fetch({
                  success: function(data){
                    console.log(data);
                    defer.resolve(data);
                  }
                });
            }, 2000);
            return defer.promise();
        }, /*getPostEntities*/
             
      }; /*API*/

    /************************************************
    *------------------ Posts-----------------------*
    ************************************************/

     Entities.post = Backbone.Model.extend({});
        
     Entities.postCollection = Backbone.Collection.extend({
       
       url : function(){

          console.log("this.req_params :"+this.options.req_params);
          return Entities.jsonUrl+'?'+this.options.req_params;
        },

       model: Entities.post,
       //comparator: "title",
       
       initialize: function (options) {
                   
          this.options = options || {};
                            
        }, /*initialize*/
     }); /*Entities.postCollection*/

     
    persianGULF.reqres.setHandler("post:entities", function(ObjParams){
      return API.getPostEntities(ObjParams);
    });


    /************************************************
    *-------------- Comments------------------------*
    ************************************************/

    Entities.comment = Backbone.Model.extend({});

    Entities.commentCollection = Backbone.Collection.extend({
       
       url : function(){

          console.log("this.options.post_id :"+this.options.post_id);
          return Entities.jsonUrl+'/'+this.options.post_id+'/comments';
        },

       model: Entities.comment,
       //comparator: "title",
       
       initialize: function (options) {
                   
          this.options = options || {};
                            
        }, /*initialize*/
     }); /*Entities.postCollection*/

    persianGULF.reqres.setHandler("comment:entities", function(post_id){
      return API.getCommentEntities(post_id);
    });


  }); /*Entities*/

  return persianGULF.Entities;  
}); /*requireJS define*/