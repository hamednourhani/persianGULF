define(["marionette"], function(Marionette){
	"use strict" 
	console.log('apps is running');
	
	var persianGULF = new Marionette.Application();

	
	persianGULF.addRegions({
	    primaryRegion: "#primary",
	    postRegion : "#post-area"
	});

	
	return persianGULF;

}); /*requireJS define*/
