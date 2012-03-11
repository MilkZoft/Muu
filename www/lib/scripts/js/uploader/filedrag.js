(function() {
	function $id(id) {
		return document.getElementById(id);
	}

	function output(msg) {
		var m = $id("response");
		
		m.innerHTML = msg + m.innerHTML;
	}

	function fileDragHover(e) {
		e.stopPropagation();
		e.preventDefault();
		e.target.className = (e.type == "dragover" ? "hover" : "");
	}

	function fileSelectHandler(e) {
		fileDragHover(e);

		var files = e.target.files || e.dataTransfer.files;

		for(var i = 0, f; f = files[i]; i++) {
			parseFile(f);
			uploadFile(f);
		}
	}

	function rename(str) {
		console.log(str);
		if(str.length > 15) {
			return str.substring(0, 15) + '...';
		} else {
			return str;
		}
	}

	function parseFile(file) {
		if(file.type.indexOf("image") == 0) {
			var reader = new FileReader();
			
			reader.onload = function(e) {
				output(
					'<div style="width: 250px; height: 370px; padding: 5px; margin-bottom: 10px; float: left; text-align: center;">' +
						'<strong>' + rename(file.name) + ':</strong>' +
						'<img style="max-width: 220px; max-height: 270px; padding: 2px; border: 1px solid #00B4FF;" src="' + e.target.result + '" /> <br />' +
						'<span class="field">» Título</span>' +
						'<br />' +
						'<input class="span3 required" type="text" name="title" value="' + file.name + '">' +
						'<br /><span class="field">» Descripción</span>' +
						'<br />' +
						'<textarea id="editor" class="span3 required" name="description"></textarea>' +
					'</div>'
				);
			}

			reader.readAsDataURL(file);
		}

		if(file.type.indexOf("text") == 0) {
			var reader = new FileReader();
			
			reader.onload = function(e) {
				output(
					"<p><strong>" + file.name + ":</strong></p><pre>" +
					e.target.result.replace(/</g, "&lt;").replace(/>/g, "&gt;") +
					"</pre>"
				);
			}
			
			reader.readAsText(file);
		}

	}

	function uploadFile(file) {
		if(location.host.indexOf("sitepointstatic") >= 0) {
			return;
		}

		var xhr = new XMLHttpRequest();

		if(xhr.upload) {
			var o = $id("progress");

			var progress = o.appendChild(document.createElement("p"));
			
			progress.appendChild(document.createTextNode(file.name));

			xhr.upload.addEventListener("progress", function(e) {
				var pc = parseInt(100 - (e.loaded / e.total * 100));
				
				progress.style.backgroundPosition = pc + "% 0";
			}, false);

			xhr.onreadystatechange = function(e) {
				if(xhr.readyState == 4) {
					progress.className = (xhr.status == 200 ? "success" : "failure");
				}
			};

			xhr.open("POST", $id("upload").value + "/" + file.size + "/", true);
			xhr.setRequestHeader("X_FILENAME", file.name);
			xhr.send(file);
		}
	}

	function init() {
		var fileselect   = $id("fileselect"),
			filedrag     = $id("filedrag"),
			submitbutton = $id("submitbutton");

		fileselect.addEventListener("change", fileSelectHandler, false);

		var xhr = new XMLHttpRequest();
		
		if(xhr.upload) {
			filedrag.addEventListener("dragover", fileDragHover, false);
			filedrag.addEventListener("dragleave", fileDragHover, false);
			filedrag.addEventListener("drop", fileSelectHandler, false);
			filedrag.style.display = "block";

			//submitbutton.style.display = "none";
		}
	}

	if(window.File && window.FileList && window.FileReader) {
		init();
	}
})();