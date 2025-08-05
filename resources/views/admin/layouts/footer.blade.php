<!-- Main Footer-->
<div class="main-footer text-center">
  <div class="container">
    <div class="row row-sm">
      <div class="col-md-12"> <span>Copyright ©
          <script>document.write(new Date().getFullYear())</script> <strong> AAPL </strong>. All rights reserved.
        </span> </div>
    </div>
  </div>
</div>
<!--End Footer-->

<link href="/admin/css/richtext.min.css" rel="stylesheet">
<script src="/admin/js/jquery.richtext.js"></script>
<script>
  $(document).ready(function () {
    $('.content').richText(); $('.content1').richText(); $('.content2').richText(); $('.content3').richText(); $('.content4').richText();
    $('form textarea').attr('required', '');
  });
</script>
<!-- Tags Input -->
<link href="/admin/css/tagsinput.css" rel="stylesheet" type="text/css">
<script src="/admin/js/typeahead.bundle.min.js"></script>
<script src="/admin/js/tagsinput.js"></script>

<script src="/js/jquery.fancybox.min.js"></script>
<link rel="stylesheet" href="/css/jquery.fancybox.min.css" />
<script>
  // Fancybox Config
  $('[data-fancybox="gallery"]').fancybox({
    buttons: [
      "slideShow",
      "thumbs",
      "zoom",
      "fullScreen",
      "close"
    ],
    loop: false,
    protect: true
  });
</script>
<script>
  $(".text-box p").text(function (index, currentText) {
    var maxLength = $(this).parent().attr('data-maxlength');
    if (currentText.length >= maxLength) {
      return currentText.substr(0, maxLength) + "...";
    } else {
      return currentText
    }
  });
</script>


<!-- jQuery UI CDN Link Make Table Dragable -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/jquery-ui.min.js"></script>
<!--
<script src="https://cdn.tiny.cloud/1/u3rzi7rruax7gl29tyuamwrhv2zeko24m6rym5ezxjfjs6sg/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
      selector: '#TinyEditor',
      plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ],
      ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
    });
</script> 
-->

@include('admin.layouts.server_images')
@include('admin.layouts.banner_images')
@include('admin.layouts.event_images')