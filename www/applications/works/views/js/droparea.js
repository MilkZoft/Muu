$('.droparea').droparea({
	'post' : PATH + '/ajax/upload',
	
	'init' : function(r){
		
	},
	'start' : function(r){
		
	},
	'error' : function(r){
		
	},
	'complete' : function(r){
		alert(r);
	}
});
