define([
		"app",
		"apps/index/index_layout",
		"core/core_functions",
		'apps/archive/archive_controller'
		],
		function(persianGULF,Index,coreFuncs,ListController){
		"use strict" 

	persianGULF.module("Index", function(Index, persianGULF,
   	Backbone, Marionette, $, _){

		Index.Controller = {

			ownLayout : function(){
				
				
				Index.indexLayout.on("childview:change:area",function(childView, options){
					
					console.log('some areas requested change : '+childView+" ,with options : "+options);
				    Index.Controller.changeArea(options);
				});
				
				Index.indexLayout.render();

			}, /*ownLayout*/

			fillAreas : function(options){	
										
				var params = coreFuncs.retrieveParams(options.route);
	         
	            $.when(params).done(function(params){
	               ListController.listPosts(params);
	            });
							
			}, /*fillAreas*/

			changeArea : function(options){
				
				if(options.area){
					switch(options.area){
					 	
					case "postArea" :
						ListController.listPosts(options.params);
						break;

					default :
						break;

					} /*switch*/
				} /*endif*/
			},
		};

	});

	return persianGULF.Index;
	

}); /*requireJS define*/