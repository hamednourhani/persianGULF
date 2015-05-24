define(["app",'jquery','backbone'], function(persianGULF,$,Backbone){
  "use strict" 

    persianGULF.module("Core.coreFuncs", function(coreFuncs, persianGULF,
        Backbone, Marionette, $, _){

      coreFuncs.navigate = function(route, options){
      	    options || (options = {});
      	    
      	    Backbone.history.navigate(route, options);
      	 };
       
      coreFuncs.getCurrentRoute = function(){
      	   return Backbone.history.fragment;
      	   console.log("fragment"+Backbone.history.fragment);
      	 };

      coreFuncs.isExternalStringReplace = function(url) {
      	      function domain(url) {
      	          return url.replace('http://','').replace('https://','').split('/')[0];
      	      };
      	  
      	      return domain(location.href) !== domain(url);
          };
          
      coreFuncs.retrieveParams = function(currentRoute){
           	
                var req_defer = $.Deferred();
                var req_options = {requested_uri:currentRoute};
                
        
                console.log('req_optoins : '+ JSON.stringify(req_options));
                
                var queryVars = this.reqQueryVars(req_options);
               
               $.when(queryVars).then(function(response){
                  console.log('reponse : '+ response);
                  response = response;
                  req_defer.resolve(response);
                },function(ajax_err){
                  ajax_err['d']='404';
                  console.log('there was a problem in url parsing. Error : '+ ajax_err);
                  req_defer.resolve(ajax_err);
                });
            
                return req_defer.promise();
          
          }; /*retrieveParams*/

        coreFuncs.convertParams = function(ObjParams){
                if (!_.isEmpty(ObjParams)){
                  
                  var req_params = "";
                  var param_count = 0;
                  var param_char = "";
                  var enable_params =['m','p','posts','w','cat','withcomments','withoutcomments','s','search','exact','sentence','calendar','page','paged','more','tb','pb','author','order','orderby','year','monthnum','day','hour','minute','second','name','category_name','tag','feed','author_name','static','pagename','page_id','error','comments_popup','attachment','attachment_id','subpost','subpost_id','preview','robots','taxonomy','term','cpage','post_type','posts_per_page'];

                  var param_keys = _.keys(ObjParams);
                  console.log("param_keys : "+param_keys);
                  
                  _.each(param_keys,function(param_key){
                    
                    if(_.indexOf(enable_params,param_key) !== -1){
                      req_params += param_char+
                      'filter['+param_key+']='+ObjParams[param_key];
                      
                      param_count++;
                      
                      if(param_count > 0)
                          param_char = "&";
                     
                      console.log("request_params : "+req_params);
                    }

                  },this); /*.each*/

                } else {
                  req_params = "";
                }
                return req_params;
              }, /*convertParams*/

      coreFuncs.reqQueryVars = function(options){

            var ajax_defer = $.Deferred();
            var options = options || {};
            var ajax_err = {};
            var ajaxurl = $('#ajax-param-helper').attr('data-url');
            var ajaxnonce = $('#ajax-param-helper').attr('data-nonce');
            var requested_uri = options.requested_uri;
            console.log('options.requested_uri :'+requested_uri);
           
              


            $.ajax({
                     method: "post",
                     dataType:"json",
                     url: ajaxurl,
                     //success: UrlHelper.renderData,
                     //error : UrlHelper.logError,
                     data : {
                           action: "persianGULF_param_helper",
                           requested_uri : requested_uri,
                           nonce: ajaxnonce
                     }
               
            }).done(function(response){
                
                if(response.error === '404') {
                
                    console.log('url was not found',response);
                    ajax_err['notfound'] = '404';
                    ajax_defer.reject(ajax_err);
                
                } else {
                    console.log('response : ' + JSON.stringify(response));
                    ajax_defer.resolve(response);

                }
                            
              }).fail(function(XMLHttpRequest, textStatus, errorThrown) { 
                      console.log("Status: " + textStatus + " Error: " + errorThrown); 
                      ajax_err = {
                        textStatus : textStatus,
                        errorThrown : errorThrown
                      };
                      ajax_defer.reject(ajax_err);
                      
              });
            
            return ajax_defer.promise();
         }; /*reqQueryVars*/

         coreFuncs.reqPermalink = function(options){

            var ajax_p_defer = $.Deferred();
            var options = options || {};
            var ajax_err = {};
            var ajaxurl = $('#ajax-permalink-helper').attr('data-url');
            var ajaxnonce = $('#ajax-permalink-helper').attr('data-nonce');
            var permalink_type = options.permalink_type;
            var permalink_id = options.permalink_id;
            console.log('options.permalink_type :'+permalink_type);
           
            $.ajax({
                     method: "post",
                     dataType:"json",
                     url: ajaxurl,
                     data : {
                           action: "persianGULF_permalink_helper",
                           permalink_type : permalink_type,
                           permalink_id : permalink_id,
                           nonce: ajaxnonce
                     }
               
            }).done(function(response){
                   console.log('response : ' + JSON.stringify(response));
                    ajax_p_defer.resolve(response.permalink);
                                           
              }).fail(function(XMLHttpRequest, textStatus, errorThrown) { 
                      console.log("Status: " + textStatus + " Error: " + errorThrown); 
                      ajax_err = {
                        textStatus : textStatus,
                        errorThrown : errorThrown
                      };
                     ajax_p_defer.reject(ajax_err);
              });
            
            return ajax_p_defer.promise();
         }; /*reqPermalink*/

         
         coreFuncs.removeDomain = function(url){
           return url.replace(/^.*\/\/[^\/]+/, '');
         }; /*removeDomain*/

         coreFuncs.showClicked =function(e,currentView){
             var element = $(e.target);
             e.preventDefault();
             e.stopPropagation();
             var pageData = {};
             
                 if(coreFuncs.isExternalStringReplace(e.target.href)){
                      window.open(e.target.href, '_blank');
                 } else {
                      
                      if(element.hasClass('post-link') || element.hasClass('data-date') || element.hasClass('data-comment')){
                      
                        currentView.trigger("post:show", currentView.model);
                        var newRoute = coreFuncs.removeDomain(currentView.model.attributes.link);
                        
                      
                      } else {

                            if(element.hasClass('data-author')){
                              var params = {author : element.attr('data-author-id'),is_singular : false};
                              var newRoute = coreFuncs.reqPermalink({permalink_type : "author", permalink_id : element.attr('data-author-id')});
                              
                            } else if(element.hasClass('data-cat')){
                               var params = {category_name : element.attr('data-cat'),is_singular : false};
                               var newRoute = element.attr('href');
                            
                            } else if(element.hasClass('data-tag')){
                               var params = { tag : element.attr('data-tag'),is_singular : false};   
                               var newRoute = element.attr('href');
                            
                            }else{
                              var params = coreFuncs.retrieveParams(e.target.pathname);
                              var newRoute = e.target.pathname;
                            }
                            var currentView = currentView;
                            $.when(params).done(function(params){
                                console.log("params done :"+params);
                                var options = {
                                          params : params,
                                          area : "postArea",
                                    };
                                currentView.triggerMethod("change:area", options);
                            });
                      }
                      $.when(newRoute).done(function(newRoute){
                          newRoute = coreFuncs.removeDomain(newRoute);
                          coreFuncs.navigate(newRoute);
                        })
              }
           }; /*showClicked*/

      
   }); /*persianGULF.coreFuncs*/

        return persianGULF.Core.coreFuncs;

}); /*requireJs define*/