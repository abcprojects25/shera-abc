$(document).ready(function() {
    $(".card1 img, .card1 video").click(function() {
        const $checkbox = $(this).siblings('.image-checkbox2');
        $checkbox.prop('checked', !$checkbox.prop('checked')).trigger('change');
    });

    function resetDetailsToDefault() {
        // Set the default placeholder image
        $("#selectedEventImage").html(
            '<img src="https://static.vecteezy.com/system/resources/previews/005/260/680/non_2x/photo-editing-icon-free-vector.jpg" alt="Placeholder" style="width:150px; height:150px;">'
        );
        // Clear all the other details
        $("#fileName2, #fileType2, #uploadDate2, #imageResolution2, #fileSize2").text("");
    }

    $(".image-checkbox2").change(function() {
        // Uncheck other checkboxes
        $(".image-checkbox2").not(this).prop('checked', false);
        $("img.img-fluid, video").removeClass("blue-border");

        if ($(".image-checkbox2:checked").length == 0) {
            resetDetailsToDefault();
            return;
        }

        const $card1 = $(this).closest('.card1');
        // -------------------Input feilds auto insert-------------
        var module_id2 =  $card1.find("input[name=module_id2]").val();
        var module_image =  $card1.find("input[name=module_image]").val();
        $("#dataid2").val(module_id2);
        $("#inputImage2").val(module_image);
        // -------------------Input feilds auto insert end-----------------------

        const fileType2 = $card1.find('video').length ? "video" : "image";
        const $image1 = fileType2 === "video" ? $card1.find('video source') : $card1.find('img');
        const imageUrl = $image1.attr("src");
        const imageName = imageUrl.split("/").pop();
        const imageExtension = imageName.split(".").pop();
        if ($(this).is(":checked")) {
            $card1.find("img, video").addClass("blue-border");

            if (fileType2 === "video") {
                // If it's a video, replace the image with a video player
                $("#selectedEventImage").html(`
                    <video width="100%" height="auto" autoplay loop muted>
                        <source src="${imageUrl}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>`
                );
                // Get video resolution once its metadata is loaded
                $("#selectedEventImage video").on('loadedmetadata', function() {
                    const videoWidth = this.videoWidth;
                    const videoHeight = this.videoHeight;
                    $("#imageResolution2").text(`${videoWidth}x${videoHeight}`);
                });
            } else {
                // If it's an image, display the image
                $("#selectedEventImage").html(
                    `<img src="${imageUrl}" alt="Selected Image"  style="width:max-content; height:max-content;">`
                );
            }

            // Common details for both images and videos
            $("#fileName2").text(imageName);
            $("#fileType2").text(imageExtension);

            fetch(imageUrl).then(response => response.headers.get('Last-Modified')).then(dateTime => {
                $("#uploadDate2").text(new Date(dateTime).toLocaleString());
            });
            fetch(imageUrl).then(response => response.blob()).then(blob => {
                const fileSize = (blob.size / 1024).toFixed(2) + ' KB';
                $("#fileSize2").text(fileSize);
            });

            // Additional logic for images (resolution)
            if (fileType2 === "image") {
                const newImg = new Image();
                newImg.onload = function() {
                    $("#imageResolution2").text(`${this.width}x${this.height}`);
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
    $('#deletePermanent2').on('click', function () {
        var dataid2 =$("#dataid2").val();
        var inputImage2 =$("#inputImage2").val();
		var _token2 =$("#_token2").val();
        var module_name2 = $("#module_name1").val();
        var _urls = "/admin/"+module_name2+'/delete-'+module_name2+'-photo';
        if(dataid2 !== ''){
            if (confirm('Are you sure you want to delete this?')) {
                $.ajax({
                    type: "post",
                    url: _urls,
                    data: {
                        _token:_token2,
                        moduleid:dataid2,
                        inputImage:inputImage2
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