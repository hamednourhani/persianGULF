define(["app"], function(persianGULF){
	"use strict" 

	persianGULF.module("Index", function(Index, persianGULF,
   Backbone, Marionette, $, _){

		Index.IndexLayout = Backbone.Marionette.LayoutView.extend({
		  template: false,
		  el : "#app-body",

		  regions: {
		    header: "#app-header",
		    luncher: "#app-luncher",
		    postArea : "#app-post-area",
		    sidebar : "#app-sidebar",
		    footer : "#app-footer",
		  }
		});

		/*var layoutView = new AppLayoutView();
		layoutView.render();*/

	});

	return persianGULF.indexLayout;
	

}); /*requireJS define*/