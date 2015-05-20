define(["core"], function(persianGULF){
	"use strict" 

	persianGULF.module("Index.Layout", function(Layout, persianGULF,
   Backbone, Marionette, $, _){

		var AppLayoutView = Backbone.Marionette.LayoutView.extend({
		  template: "#layout-view-template",

		  regions: {
		    menu: "#menu",
		    content: "#content"
		  }
		});

		/*var layoutView = new AppLayoutView();
		layoutView.render();*/

	});

	return persianGULF.Index.Layout;
	

}); /*requireJS define*/