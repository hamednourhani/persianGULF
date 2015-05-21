define(["app"], function(persianGULF){
	"use strict" 
	
	persianGULF.module("coreController", function(coreController, persianGULF,
        Backbone, Marionette, $, _){

		coreController.Controller = {
			makeLayout : function(){
				Index.controller.ownLayout();
			},
		};
	
	}); /*persianGULF.Core.Controller*/

	return persianGULF.coreController;

}); /*requireJS define*/