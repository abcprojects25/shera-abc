<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<script type="text/javascript">
	Dropzone.options.dropzone =
	 {
		maxFilesize: 200,
		maxFiles: 10,
		renameFile: function(file) {
			var dt = new Date();
			var time = dt.getTime();
		   return time+file.name;
		},

		acceptedFiles: ".jpeg,.jpg,.png,.gif",
		addRemoveLinks: true,
		timeout: 50000,

		removedfile: function(file)
		{
            var name = file.upload.filename;
            // var talent_id = document.getElementById("talent_id").value;

			$.ajax({
				headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
				type: 'POST',
				url: '{{route("delete-artist-image")}}',

				data: {filename: name},
				success: function (data){
                    console.log(data);
                     $( "#upload_alert" ).text ( "File has been successfully removed!!" ).css("color", "orange");
	                 $('#upload_btn').css('display', 'none');
	                 $('#upload_btn_dis').css('display', 'block');
				},
				error: function(e) {
					console.log(e);
				}});
				var fileRef;
				return (fileRef = file.previewElement) != null ?
				fileRef.parentNode.removeChild(file.previewElement) : void 0;
				
		},

		success: function(file, response)
		{
			console.log(response);
			if(response.status === 'success'){
	 $( "#upload_alert" ).text( "Image Uploaded success fully" ).css("color", "green");
	 $('#upload_btn').css('display', 'block');
	 $('#upload_btn_dis').css('display', 'none');
	 /* $( "#otp" ).css("background-color", "#82f782");
	 $('#upload_btn').attr('readonly', true); */
	}
	 else{
		$( "#upload_alert" ).text( response ).css("color", "red");
	   }
	 },
		error: function(file, response)
		{
			console.log(response);
			if(response === 'Server responded with 500 code.'){
				$( "#upload_alert" ).text('Not uploaded!!! The file size should not exceed 5MB & Image should be less than 10,000 pixels.').css("color", "red");
				$('#upload_btn').css('display', 'none');
				$('#upload_btn_dis').css('display', 'block');
			}
			else if(response.message === ''){
				$( "#upload_alert" ).text('Not uploaded!!! The file size should not exceed 5MB').css("color", "red");
				$('#upload_btn').css('display', 'none');
				$('#upload_btn_dis').css('display', 'block');
			}
			else {
				$( "#upload_alert" ).text('Not uploaded!!!'+response ).css("color", "red");
				$('#upload_btn').css('display', 'none');
				$('#upload_btn_dis').css('display', 'block');
			}
		  // return false;
		}
};
</script>