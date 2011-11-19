$(document).ready(function() {
	stopAutomaticUpload = false;
	
	var URL = window.location.href;
	
	$(".upAvatar").click(function() {
		$("#file").click();
	});

	var website   = $("#website").attr("href");
	
	if(website == "") {
		website = "http://";
	}
	
	var twitter   = $("#twitter").attr("title");
	if(twitter == null) {
		twitter = "";
	}
	var imgtwt 	  = $("#twitter img").attr("src");
	var facebook  = $("#facebook").attr("title");
	if(facebook == null) {
		facebook = "";
	}
	var imgfb 	  = $("#facebook img").attr("src");
	var linkedin  = $("#linkedin").attr("title");
	if(linkedin == null) {
		linkedin = "";
	}
	var imgin 	  = $("#linkedin img").attr("src");
	var google 	  = $("#google").attr("title");
	if(google == null) {
		google = "";
	}
	var imgplus   = $("#google img").attr("src");
	var name 	  = $("#name").text();
	var gender    = $("#gender").text();
	var birthday  = $("#birthday").text();
	var company   = $("#company").text();
	var country   = $("#country").text();
	var district  = $("#district").text();
	var town 	  = $("#town").text();
	var telephone = $("#telephone").text();
	var sign 	  = $("#sign").html();

	$('.information p').hide();
	$('#personalhide').css("display","none");
	$('#statshide').css("display","none");
	$('#ubihide').css("display","none");
	$('#socialhide').css("display","none");
	$('.principal p').show();
	
	$('.maintop').toggle(function() {
		$('.principal p').show();
		$('#mainhide').css("display","block");
	}, function() {
		$('.principal p').hide();
		$('#mainhide').css("display","none");
	});
	
	$('.private').toggle(function() {
		$('.personal p').show();
		$('#personalhide').css("display","block");
	}, function() {
		$('.personal p').hide();
		$('#personalhide').css("display","none");
	});
	
	$('.stats').toggle(function() {
		$('.statistics p').show();
		$('#statshide').css("display","block");
	}, function() {
		$('.statistics p').hide();
		$('#statshide').css("display","none");
	});
	
	$('.location').toggle(function() {
		$('.ubication p').show();
		$('#ubihide').css("display","block");
	}, function() {
		$('.ubication p').hide();
		$('#ubihide').css("display","none");
	});
	
	$('.other').toggle(function() {
		$('.socialmedia p').show();		
		$('#socialhide').css("display","block");
		$("#sclntw").hide();
	}, function() {
		$('.socialmedia p:first').hide();
		$('#socialhide').css("display","none");
	});
	
	$(".editData").toggle(function() {
		stopAutomaticUpload = true;
		
		inputs = $(".removable").clone();
		$(".removable").remove();
		
		var lang = $(this).attr("name");
		
		if(lang == "es") {
			$(this).val("Cancelar");
		} else { 
			if(lang == "en") {
				$(this).val("Cancel");
			}
		}	
		
		openAll();	
		
		$("#website").remove();
		$("#name").remove();
		$("#gender").remove();
		$("#birthday").remove();
		$("#company").remove();
		$("#country").remove();
		$("#district").remove();
		$("#town").remove();
		$("#telephone").remove();
		$("#sign").remove();
		
		$(".website strong").show();
		$('.twitter').show();
		$('.facebook').show();
		$('.linkedin').show();
		$('.google').show();
		$(".name strong").show();
		$(".gender strong").show();
		$(".birthday strong").show();
		$(".company strong").show();
		$(".country strong").show();
		$(".district strong").show();
		$(".town strong").show();
		$(".telephone strong").show();
		$(".sign strong").show();
		$("#other").show();
		$("#location").show();
		
		
		switch(lang) { 
			case "es": 
				$('<input title="Ingresa la URL de tu sitio web." type="text" value="'+website+'" name="website" class="removable web" />').insertAfter(".website").tooltip({position: "center right", offset: [0, 10], effect: "fade",	opacity: 0.7});
				$('<input title="Ingresa tu usuario de Twitter" type="text" value="'+twitter+'" name="twitter" class="removable" />').insertAfter(".twitter").tooltip({position: "center right", offset: [0, 10], effect: "fade",	opacity: 0.7});
				$('<input title="Ingresa tu usuario de Facebook, si no te lo sabes, configuralo en tu cuenta de Facebook" type="text" value="'+facebook+'" name="facebook" class="removable" />').insertAfter(".facebook").tooltip({position: "center right", offset: [0, 10], effect: "fade",	opacity: 0.7});
				$('<input title="Ingresa tu número de perfil de Google+, es el que está en la URL de tu perfil" type="text" value="'+google+'" name="google" class="removable" />').insertAfter(".google").tooltip({position: "center right", offset: [0, 10], effect: "fade", opacity: 0.7});
				$('<input title="Ingresa tu nombre completo" type="text" value="'+name+'" name="name" class="removable" />').insertAfter(".name").tooltip({position: "center right", offset: [0, 10], effect: "fade",	opacity: 0.7});
				break;
			case "en":
				$('<input title="Your website\'s URL" type="text" value="'+website+'" name="website" class="removable" />').insertAfter(".website").tooltip({position: "center right", offset: [0, 10], effect: "fade",	opacity: 0.7});
				$('<input title="Your Twitter\'s user" type="text" value="'+twitter+'" name="twitter" class="removable" />').insertAfter(".twitter").tooltip({position: "center right", offset: [0, 10], effect: "fade",	opacity: 0.7});
				$('<input title="Your Facebook\'s user, if you don\'t know it, configure it at your Facebook account" type="text" value="'+facebook+'" name="facebook" class="removable" />').insertAfter(".facebook").tooltip({position: "center right", offset: [0, 10], effect: "fade",	opacity: 0.7});
				$('<input title="Your Google+\'s perfil number, it is at the profile URL" type="text" value="'+google+'" name="google" class="removable" />').insertAfter(".google").tooltip({position: "center right", offset: [0, 10], effect: "fade", opacity: 0.7});
				$('<input title="Your full name" type="text" value="'+name+'" name="name" class="removable" />').insertAfter(".name").tooltip({position: "center right", offset: [0, 10], effect: "fade",	opacity: 0.7});
				break;
		}
		
		switch(lang) {
			case "es":
				switch(gender) {
					case "":
						$('<select id="gender" name="gender" class="removable select"><option selected="selected" value="'+null+'">Selecciona un género</option><option value="Male">Masculino</option><option value="Female">Femenino</option></select>').insertAfter(".gender");
						break;
					case "Masculino":
						$('<select id="gender" name="gender" class="removable select"><option value="Male" selected="selected">Masculino</option><option value="Female">Femenino</option></select>').insertAfter(".gender");
						break;
					case "Femenino":
						$('<select id="gender" name="gender" class="removable select"><option value="Male">Masculino</option><option value="Female" selected="selected">Femenino</option></select>').insertAfter(".gender");
					break;
				}
				break;
			case "en":
				switch(gender) {
					case "":
						$('<select id="gender" name="gender" class="removable select"><option selected="selected" value="'+null+'">Select a Gender</option><option value="Male">Male</option><option value="Female">Female</option></select>').insertAfter(".gender");
						break;
					case "Male":
						$('<select id="gender" name="gender" class="removable select"><option value="Male" selected="selected">Male</option><option value="Female">Female</option></select>').insertAfter(".gender");
						break;
					case "Female":
						$('<select id="gender" name="gender" class="removable select"><option value="Male">Male</option><option value="Female" selected="selected">Female</option></select>').insertAfter(".gender");
					break;
				}
				break;
		}
		
		
		$('<input type="text" value="'+linkedin+'" name="linkedin" class="removable" />').insertAfter(".linkedin");		
		$('<input type="text" value="'+birthday+'" id="datepicker" name="birthday" class="removable" />').insertAfter(".birthday");
		$('<input type="text" value="'+company+'" name="company" class="removable" />').insertAfter(".company");
		$('<input type="text" value="'+country+'" name="country" class="removable" />').insertAfter(".country");
		$('<input type="text" value="'+district+'" name="district" class="removable" />').insertAfter(".district");
		$('<input type="text" value="'+town+'" name="town" class="removable" />').insertAfter(".town");
		$('<input type="text" value="'+telephone+'" name="telephone" class="removable" />').insertAfter(".telephone");
		$('<textarea id="editor" name="sign" tabindex="2" class="removable signature">'+sign+'</textarea>').insertAfter(".sign");
		tinyMCE.init({mode : "exact", elements : "editor", theme : "simple", editor_selector : "mceSimple"});
		
		$("#datepicker").datepicker({
			'changeYear':true,
			'yearRange':'1960:1999',
			'showAnim':'explode',
			'dateFormat':'dd/mm/yy'
		});
		
		switch(lang) { 
			case "es": 
				$('<input type="submit" value="Guardar" name="edit" class="submit" />').insertAfter(".editData");
				$('<p id="removable" class="buttoncenter"><input type="submit" value="Guardar" name="edit" class="buttonbottom" />').insertAfter(".information:last");
				$('<input id="cancelbottom" type="button" value="Cancelar" name="'+lang+'" class="buttonbottom" /></p>').appendTo(".buttoncenter");				
				
				$("#cancelbottom").click(function() {
					$(".editData").click();
				});
				
				break;
			case "en":
				$('<input type="submit" value="Save" name="edit" class="submit" />').insertAfter(".editData");
				$('<p id="removable" class="buttoncenter"><input type="submit" value="Save" name="edit" class="buttonbottom" />').insertAfter(".clear:last");
				$('<input id="cancelbottom" type="button" value="Cancel" name="'+lang+'" class="buttonbottom" /></p>').appendTo(".buttoncenter");
				break;
		}
				
	}, function() {
		cURL = URL.replace("#","");
		location.href = cURL;
	});
	
});

function doUpload() {
	if(stopAutomaticUpload == false) {
		$('<input type="submit" style="opacity:0; z-index:-1500;" value="Editar!" name="edit" class="subImage" />').insertAfter(".editData");
		$(".subImage").click();
	}
};

function openAll() {
	$('.principal p').show();
	$('#mainhide').css("display","block");
	$('.personal p').show();
	$('#personalhide').css("display","block");
	$('.statistics p').show();
	$('#statshide').css("display","block");
	$('.ubication p').show();
	$('#ubihide').css("display","block");
	$('.socialmedia p').show();
	$("#sclntw").show();
	$('#socialhide').css("display","block");
};

function closeAll() {
	$('.personal p').hide();
	$('#personalhide').css("display","none");
	$('.statistics p').hide();
	$('#statshide').css("display","none");
	$('.ubication p').hide();
	$('#ubihide').css("display","none");
	$('.socialmedia p:first').hide();
	$('#socialhide').css("display","none");
};
