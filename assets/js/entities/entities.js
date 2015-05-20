define(["core","jquery","backbone"], function(persianGULF,$,Backbone){
  "use strict"
  console.log('entities is running');

  persianGULF.module("Entities", function(Entities, persianGULF,
   Backbone, Marionette, $, _){

     Entities.post = Backbone.Model.extend({});

     Entities.homeUrl = $('meta#siteUrl').attr('content');
     Entities.jsonUrl = Entities.homeUrl + '/wp-json/posts';
          console.log(Entities.homeUrl,Entities.jsonUrl);
   
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

                
     var API = {
       
       options : {},
       
       getPostEntities: function(ObjParams){
           API.options.req_params = persianGULF.convertParams(ObjParams); 
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

             
      }; /*API*/
     

    persianGULF.reqres.setHandler("post:entities", function(ObjParams){
      return API.getPostEntities(ObjParams);
    });


  }); /*Entities*/

  return persianGULF.Entities;  
}); /*requireJS define*/