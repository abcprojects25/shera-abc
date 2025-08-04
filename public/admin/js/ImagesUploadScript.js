$(document).ready(function() {
    $(".card img, .card video").click(function() {
        const $checkbox = $(this).siblings('.image-checkbox');
        $checkbox.prop('checked', !$checkbox.prop('checked')).trigger('change');
    });

    function resetDetailsToDefault() {
        // Set the default placeholder image
        $("#selectedImage").html(
            '<img src="https://static.vecteezy.com/system/resources/previews/005/260/680/non_2x/photo-editing-icon-free-vector.jpg" alt="Placeholder" style="width:150px; height:150px;">'
        );
        // Clear all the other details
        $("#fileName, #fileType, #uploadDate, #imageResolution, #fileSize").text("");
    }

    $(".image-checkbox").change(function() {
        // Uncheck other checkboxes
        $(".image-checkbox").not(this).prop('checked', false);
        $("img.img-fluid, video").removeClass("blue-border");

        if ($(".image-checkbox:checked").length == 0) {
            resetDetailsToDefault();
            return;
        }

        const $card = $(this).closest('.card');
        // -------------------Input feilds auto insert-------------
        var module_id =  $card.find("input[name=module_id]").val();
        var module_title =  $card.find("input[name=module_title]").val();
        var module_alt =  $card.find("input[name=module_alt]").val();
        var module_url =  $card.find("input[name=module_url]").val();
        var module_disc =  $card.find("input[name=module_disc]").val();
        $("#dataid").val(module_id);
        $("#inputTitle").val(module_title);
        $("#inputAlt").val(module_alt);
        $("#inputUrl").val(module_url);
        $("#inputDescription").val(module_disc);
        // -------------------Input feilds auto insert end-----------------------

        const fileType = $card.find('video').length ? "video" : "image";
        const $image = fileType === "video" ? $card.find('video source') : $card.find('img');
        const imageUrl = $image.attr("src");
        const imageName = imageUrl.split("/").pop();
        const imageExtension = imageName.split(".").pop();
        if ($(this).is(":checked")) {
            $card.find("img, video").addClass("blue-border");

            if (fileType === "video") {
                // If it's a video, replace the image with a video player
                $("#selectedImage").html(`
                    <video width="100%" height="auto" autoplay loop muted>
                        <source src="${imageUrl}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>`
                );
                // Get video resolution once its metadata is loaded
                $("#selectedImage video").on('loadedmetadata', function() {
                    const videoWidth = this.videoWidth;
                    const videoHeight = this.videoHeight;
                    $("#imageResolution").text(`${videoWidth}x${videoHeight}`);
                });
            } else {
                // If it's an image, display the image
                $("#selectedImage").html(
                    `<img src="${imageUrl}" alt="Selected Image"  style="width:max-content; height:max-content;">`
                );
            }

            // Common details for both images and videos
            $("#fileName").text(imageName);
            $("#fileType").text(imageExtension);

            fetch(imageUrl).then(response => response.headers.get('Last-Modified')).then(dateTime => {
                $("#uploadDate").text(new Date(dateTime).toLocaleString());
            });
            fetch(imageUrl).then(response => response.blob()).then(blob => {
                const fileSize = (blob.size / 1024).toFixed(2) + ' KB';
                $("#fileSize").text(fileSize);
            });

            // Additional logic for images (resolution)
            if (fileType === "image") {
                const newImg = new Image();
                newImg.onload = function() {
                    $("#imageResolution").text(`${this.width}x${this.height}`);
                };
                newImg.src = imageUrl;
            }

        } else {
            resetDetailsToDefault();
        }
    });
});

// Form Update image details
$(document).ready(function() {
	$('#submitModule').on('click', function () {
		var dataid =$("#dataid").val();
		var inputTitle =$("#inputTitle").val();
		var inputAlt =$("#inputAlt").val();
		var inputUrl =$("#inputUrl").val();
		var inputDescription =$("#inputDescription").val();
		var _token =$("#_token").val();
        var module_name = $("#module_name").val();
        var _urls = "/admin/"+module_name+"/edit-images";

		if(dataid !== ''){
			$.ajax({
				type: "POST",
				url: _urls,
				data: {
					_token:_token,
					moduleid:dataid,
					inputTitle:inputTitle,
					inputAlt:inputAlt,
					inputUrl:inputUrl,
					inputDescription:inputDescription
				},
				beforeSend: function() {
					$('#loading').css("display", "block");
				},
				success: function (res) {
					$('#loading').css("display", "none");
				}
			});
		}else{
			alert('wrong');
		}
			
	});

    $('#deletePermanent').on('click', function () {
        var dataid =$("#dataid").val();
        var inputUrl =$("#inputUrl").val();
		var _token =$("#_token").val();
        var module_name = $("#module_name").val();
        var _urls = "/admin/"+module_name+'/delete-'+module_name+'-photo';

        if(dataid !== ''){
            if (confirm('Are you sure you want to delete this?')) {
                $.ajax({
                    type: "post",
                    url: _urls,
                    data: {
                        _token:_token,
                        moduleid:dataid,
                        inputUrl:inputUrl
                    },
                    success: function (res) {
                        location.reload();
                    }
                });
            }
        }else{
            alert("Please Select Image");
        }

    });

	$('#clearForm').on('click', function () {
		$("#module_form")[0].reset();
	});
});	