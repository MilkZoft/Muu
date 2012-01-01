$(document).ready(function() {
	var count = 0;
	$('#addImg').live('click', function() {
		if(count < 4) {
			$(this).after('<input name="files[]" type="file" tabindex="4" class="addImg input required" />');
			var newPlus = $(this).clone();
			$('input[type=file]:last').after(newPlus);
			$(this).remove();
			count++;
			
			if(count === 4) {
				$('#addImg').remove();
			}				
		} else { 
			return false;
		}
	});

});
