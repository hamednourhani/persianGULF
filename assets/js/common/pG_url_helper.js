define(['jquery'],function($){
"use strict"

   var UrlHelper =  UrlHelper || {};
   

   UrlHelper.req_query_vars = function(options){

      var ajax_defer = $.Deferred();
      var options = options || {};
      var ajax_err = {};
      var ajaxurl = $('#ajax-helper').attr('data-url');
      var ajaxnonce = $('#ajax-helper').attr('data-nonce');
      var requested_uri = options.requested_uri;
      console.log('options.requested_uri :'+requested_uri);
     
        


      $.ajax({
               method: "post",
               dataType:"json",
               url: ajaxurl,
               //success: UrlHelper.renderData,
               //error : UrlHelper.logError,
               data : {
                     action: "persianGULF_url_helper",
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
   };

   
   return UrlHelper;
});


  

   
