define(["app","apps/index/index_controller"], function(persianGULF,Index){
	"use strict" 
	
	persianGULF.module("Core.coreController", function(coreController, persianGULF,
        Backbone, Marionette, $, _){

		coreController.Funcs = {
			options : {},
			
			makeLayout : function(options){
			
				this.options = options;
				
				Index.Controller.ownLayout();
				
				Index.Controller.fillAreas(this.options);
			},
		};
	
	}); /*persianGULF.Core.Controller*/

	return persianGULF.Core.coreController;

}); /*requireJS define*/