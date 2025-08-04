$(document).ready(function() {
    $(".card1 img, .card1 video").click(function() {
        const $checkbox = $(this).siblings('.image-checkbox1');
        $checkbox.prop('checked', !$checkbox.prop('checked')).trigger('change');
    });

    function resetDetailsToDefault() {
        // Set the default placeholder image
        $("#selectedBannerImage").html(
            '<img src="https://static.vecteezy.com/system/resources/previews/005/260/680/non_2x/photo-editing-icon-free-vector.jpg" alt="Placeholder" style="width:150px; height:150px;">'
        );
        // Clear all the other details
        $("#fileName1, #fileType1, #uploadDate1, #imageResolution1, #fileSize1").text("");
    }

    $(".image-checkbox1").change(function() {
        // Uncheck other checkboxes
        $(".image-checkbox1").not(this).prop('checked', false);
        $("img.img-fluid, video").removeClass("blue-border");

        if ($(".image-checkbox1:checked").length == 0) {
            resetDetailsToDefault();
            return;
        }

        const $card1 = $(this).closest('.card1');
        // -------------------Input feilds auto insert-------------
        var module_id1 =  $card1.find("input[name=module_id1]").val();
        var module_title1 =  $card1.find("input[name=module_title1]").val();
        var module_alt1 =  $card1.find("input[name=module_alt1]").val();
        var module_url1 =  $card1.find("input[name=module_url1]").val();
        var module_disc1 =  $card1.find("input[name=module_disc1]").val();
        $("#dataid1").val(module_id1);
        $("#inputTitle1").val(module_title1);
        $("#inputAlt1").val(module_alt1);
        $("#inputUrl1").val(module_url1);
        $("#inputDescription1").val(module_disc1);
        // -------------------Input feilds auto insert end-----------------------

        const fileType1 = $card1.find('video').length ? "video" : "image";
        const $image1 = fileType1 === "video" ? $card1.find('video source') : $card1.find('img');
        const imageUrl = $image1.attr("src");
        const imageName = imageUrl.split("/").pop();
        const imageExtension = imageName.split(".").pop();
        if ($(this).is(":checked")) {
            $card1.find("img, video").addClass("blue-border");

            if (fileType1 === "video") {
                // If it's a video, replace the image with a video player
                $("#selectedBannerImage").html(`
                    <video width="100%" height="auto" autoplay loop muted>
                        <source src="${imageUrl}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>`
                );
                // Get video resolution once its metadata is loaded
                $("#selectedBannerImage video").on('loadedmetadata', function() {
                    const videoWidth = this.videoWidth;
                    const videoHeight = this.videoHeight;
                    $("#imageResolution1").text(`${videoWidth}x${videoHeight}`);
                });
            } else {
                // If it's an image, display the image
                $("#selectedBannerImage").html(
                    `<img src="${imageUrl}" alt="Selected Image"  style="width:max-content; height:max-content;">`
                );
            }

            // Common details for both images and videos
            $("#fileName1").text(imageName);
            $("#fileType1").text(imageExtension);

            fetch(imageUrl).then(response => response.headers.get('Last-Modified')).then(dateTime => {
                $("#uploadDate1").text(new Date(dateTime).toLocaleString());
            });
            fetch(imageUrl).then(response => response.blob()).then(blob => {
                const fileSize = (blob.size / 1024).toFixed(2) + ' KB';
                $("#fileSize1").text(fileSize);
            });

            // Additional logic for images (resolution)
            if (fileType1 === "image") {
                const newImg = new Image();
                newImg.onload = function() {
                    $("#imageResolution1").text(`${this.width}x${this.height}`);
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
	$('#submitModule1').on('click', function () {
		var dataid1 =$("#dataid1").val();
		var inputTitle1 =$("#inputTitle1").val();
		var inputAlt1 =$("#inputAlt1").val();
		var inputUrl1 =$("#inputUrl1").val();
		var inputDescription1 =$("#inputDescription1").val();
		var _token1 =$("#_token1").val();
        var module_name1 = $("#module_name1").val();
        var _urls = "/admin/"+module_name1+"/edit-images";

		if(dataid1 !== ''){
			$.ajax({
				type: "POST",
				url: _urls,
				data: {
					_token:_token1,
					moduleid:dataid1,
					inputTitle:inputTitle1,
					inputAlt:inputAlt1,
					inputUrl:inputUrl1,
					inputDescription:inputDescription1
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

    $('#deletePermanent1').on('click', function () {
        var dataid1 =$("#dataid1").val();
        var inputUrl1 =$("#inputUrl1").val();
		var _token1 =$("#_token1").val();
        var module_name1 = $("#module_name1").val();
        var _urls = "/admin/"+module_name1+'/delete-'+module_name1+'-photo';

        if(dataid1 !== ''){
            if (confirm('Are you sure you want to delete this?')) {
                $.ajax({
                    type: "post",
                    url: _urls,
                    data: {
                        _token:_token1,
                        moduleid:dataid1,
                        inputUrl:inputUrl1
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

	$('#clearForm1').on('click', function () {
		$("#module_form1")[0].reset();
	});
});	