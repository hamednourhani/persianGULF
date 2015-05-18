define(["marionette",'jquery'], function(Marionette,$){
	"use strict" 
	console.log('apps is running');
	
	var persianGULF = new Marionette.Application();

	persianGULF.addRegions({
	    primaryRegion: "#primary",
	    postRegion : "#post-area"
	});

	persianGULF.navigate = function(route, options){
	    options || (options = {});
	    
	    Backbone.history.navigate(route, options);
	 };
 
	 persianGULF.getCurrentRoute = function(){
	   return Backbone.history.fragment;
	   console.log("fragment"+Backbone.history.fragment);
	 };

	 persianGULF.isExternalStringReplace = function(url) {
	      function domain(url) {
	          return url.replace('http://','').replace('https://','').split('/')[0];
	      };
	  
	      return domain(location.href) !== domain(url);
    };
    
	 persianGULF.retrieveParams = function(currentRoute){
     	
          var req_defer = $.Deferred();
          var req_options = {requested_uri:currentRoute};
          
  
          console.log('req_optoins : '+ JSON.stringify(req_options));
          
      require(['urlhelper'],function(UrlHelper){
         $.when(UrlHelper.req_query_vars(req_options)).then(function(response){
            console.log('UrlHelper.query_vars : '+ response);
            response = response;
            req_defer.resolve(response);
          },function(ajax_err){
            ajax_err['d']='404';
            console.log('there was a problem in url parsing. Error : '+ ajax_err);
            req_defer.resolve(ajax_err);
          });
      });
          return req_defer.promise();
    
    }; /*retrieveParams*/

     persianGULF.convertParams = function(ObjParams){
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
        }; /*convertParams*/
	 
 	
 	return persianGULF;

}); /*requireJS define*/
