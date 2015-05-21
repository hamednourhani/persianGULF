define(["app"], function(persianGULF){
	"use strict" 

	persianGULF.module("Index", function(Index, persianGULF,
   Backbone, Marionette, $, _){

		Index.Controller ={

			ownLayout : function(){

				var indexLayout = new Index.IndexLaout({

				});	
			},
		};

	});

	return persianGULF.Index;
	

}); /*requireJS define*/