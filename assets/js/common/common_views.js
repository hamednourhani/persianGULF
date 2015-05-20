define(["core","marionette"], function(persianGULF,Marionette){	
	"use strict"
	console.log('common views is running');
	persianGULF.module("Common.Views", function(Views, persianGULF,
	  Backbone, Marionette, $, _){
	    Views.Loading = Marionette.ItemView.extend({
	      template: "#loading-view",
	  
	      onShow: function(){
	       	//$("#spinner")
	     	} /*onShow*/
	   }); /*views.Loading*/
	}); /*Common.views*/

	return persianGULF.Common.Views;
}); /*requireJS define*/