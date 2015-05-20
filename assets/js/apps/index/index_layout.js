define(["app"], function(persianGULF){
	"use strict" 

	persianGULF.module("Index.Layout", function(Layout, persianGULF,
   Backbone, Marionette, $, _){

		var indexLayout = Backbone.Marionette.LayoutView.extend({
		  template: "#main-layout",

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