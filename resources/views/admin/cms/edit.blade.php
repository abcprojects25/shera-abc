@extends('admin.layouts.app')
@section('content')
<?php use App\Http\Controllers\CommonController; ?>

<!-- ===== ===== --> 

	<div class="main-content side-content pt-0">
		<div class="container-fluid">
			<div class="inner-body">
				<!-- Page Header -->
				<div class="page-header">
					<div>
						<h2 class="main-content-title tx-24 mg-b-5"> Edit Page </h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item"><a href="#">CMS Pages</a></li>
							<li class="breadcrumb-item active" aria-current="page">Edit Page</li>
						</ol>
					</div>
					<div class="d-flex">
						<div class="justify-content-center">
							 
						</div>
					</div>
				</div>
				<!-- End Page Header -->
				
				
				<!--Row-->
				<div class="row row-sm">
					<div class="col-sm-12">
						<div class="card custom-card overflow-hidden">
							<div class="card-header border-bottom-0">
								<div class="row">
									<div class="col-sm-6">
										@if ($message = Session::get('error'))
											<div class="alert alert-danger">
												<button type="button" class="close" data-dismiss="alert">×</button>
												<strong>{{ $message }}</strong>
											</div>
										@endif

										@if ($message = Session::get('success'))
											<div class="alert alert-success alert-block">
												<button type="button" class="close" data-dismiss="alert">×</button>
												<strong>{{ $message }}</strong>
											</div>
										@endif
									</div>
								</div> 
							</div> 
							<div class="card-body pt-0">
								<div class="">
									<form method="POST" class="row justify-content-md-center" action="/admin/cms/cms-update" 
									enctype="multipart/form-data" >	
									<div class="col-xl-9 col-lg-9 col-md-9">
										@csrf						
										<input type="hidden" name="id" value="{{ $data->id }}">			
										<div class="card shade">
											<div class="row">
												<div class="col-lg-6 col-md-8 form-group">
													<label>Page Name : <span>*</span></label>
													<input name="name" value="{{ $data->page_name }}" required="" class="form-control" placeholder="Page Name..." maxlength="255" type="text" id="name" onkeypress="ArticleNameurl();"   onblur="ArticleNameurl();">
												</div>		
												<div class="col-lg-6 form-group">
													<label>Page URL : <span>*</span></label>
													<input name="page_url" value="{{ $data->page_url }}" required="" class="form-control"  maxlength="255" type="text" id="page_url" >
												</div>
												<div class="col-lg-6 col-md-6 form-group">
													<label>Select Categories </label>
													<select name="category_id" id="category_id" class="custom-select w-100" required="">
														<option value="" selected disabled>-- Select Categories -- </option>
														@foreach ($Categories as $item)
															<option value="{{$item->id}}" {{ $item->id == $data->category_id ? 'selected' : '' }}> {{$item->name}} </option> 
														@endforeach
													</select>
												</div>
												<div class="col-lg-6 col-md-6 form-group">
													<label>Select Sub-Categories </label>
													<select name="sub_category_id" id="sub_category_id" class="custom-select w-100" required="">
														
													</select>
												</div>
											</div>
											
											 <div class="form-group">
												<label for="description">Page Content </label>
												<textarea name="description" class="form-control content" cols="10" rows="2" id="description">{!! $data->contents  !!} </textarea>
											</div> 
											 
										</div>
									</div>
										<div class="col-xl-3 col-lg-3 col-md-3">											
											<!--<div class="card shade"> 
												<div class="form-group">
													<label class="form-label" for="customFile"> Upload image for content. </label>
													<input type="file" class="form-control" id="customFile" />
												</div> 
												<ul class="pd-0">
													<li class="d-flex"> 
														<div class="clipboard">
															<input type="text" class="copy-input" name="myvalue" id="myvalue" value="http://dev.indiangold-smartbuy.in/" readonly  />
															<button class="copy-btn clipboard" onclick="copyToClipboard()"><i class="far fa-copy"></i> </button>
														</div>
														
													</li> 
													<li class="d-flex"> 
														<div class="clipboard">
															<input type="text" class="copy-input" name="myvalue" id="myvalue" value="http://dev.indiangold-smartbuy.in/" readonly  />
															<button class="copy-btn clipboard" onclick="copyToClipboard()"><i class="far fa-copy"></i> </button>
														</div>
														
													</li> 
												</ul> 
											</div>  -->
											
											<div class="card shade">
												<h5> Search engine listing </h5>
												
												<div class="row">
													<div class="col-md-12 form-group">
														<label>Page Title : <span>*</span></label>
														<input name="page_title" value="{{ $data->page_title }}"  class="form-control" placeholder="Page Title..." maxlength="255" type="text" id="title">
														<small> 0 of 70 characters used </small>
													</div>
													<div class="col-md-12 form-group">
														<label>Meta Keywords : <span>*</span></label>
														<input name="meta_keywords" value="{{ $data->meta_keywords }}"  class="form-control" placeholder="Meta Keywords..." maxlength="255" type="text" id="meta_keywords">
														<small> 100 to 255 Keywords used </small>
													</div>
												</div>
												<div class="form-group">
													<label for="BookDescription">Meta Description </label>
													<textarea name="meta_description" class="form-control" cols="10" rows="2" id="meta_description" placeholder="Meta Description...">{!! $data->meta_description  !!} </textarea>
													<small> 0 of 320 characters used </small>
												</div> 
											</div> <!-- -->
											
											<div class="card shade">
												<div class="form-group">
													<label>Status </label>
													<select name="is_active" class="custom-select w-100">
														<option value="1" @if($data->status == 1) Selected @endif>Active</option>
														<option value="0" @if($data->status == 0) Selected @endif>In Active</option>
													</select>
												</div> 
											</div> <!-- -->
										</div> <!-- --> 
										<div class="col-lg-12">
											<br />
											<div class="submit">
												 <input class="btn btn-primary w-100" type="submit" value="Edit Now"> 
											
											</div> 
										</div> <!-- -->
									</form> 
								</div>
							</div>
						</div>
					</div>
					<!-- col end -->
				</div>
				<!-- Row end -->
			</div>
		</div>
	</div>	
<!-- End Main Content-->

<!-- ===== ===== --> 
 
 <!-- Croper Model  -->
<div class="modal fade" id="myModal121" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<!-- Modal content-->
		<div class="modal-content"> 
			<div class="modal-body text-center">
				<button type="button" style=" "class="close" data-dismiss="modal">&times;</button>
				<div id="upload-demo" ></div>
				<button class="btn btn-success upload-result" data-dismiss="modal">Crop</button>
			</div>
		</div>
	</div>
</div>


@include('admin.layouts.footer')

 
<link href="/admin/css/richtext.min.css" rel="stylesheet">
<script src="/admin/js/jquery.richtext.js"></script>
<script>
	$(document).ready(function() {
		$('.content').richText();
		$('form textarea').attr('required', '');
	});

	function ArticleNameurl(){
			  // alert(s_data.length);
			  s_name = document.getElementById("name").value;
			  // $('#ArticleName').val();
			  dlenth = s_name.length;
				//alert(s_name);
				var seourl = s_name.toString()               // Convert to string
				seourl = seourl.normalize('NFD')               // Change diacritics
				seourl = seourl.replace(/[\u0300-\u036f]/g,'') // Remove illegal characters
				seourl = seourl.replace(/\s+/g,'-')            // Change whitespace to dashes
				seourl = seourl.toLowerCase()                  // Change to lowercase
				seourl = seourl.replace(/&/g,'-and-')          // Replace ampersand
				seourl = seourl.replace(/[^a-z0-9\-]/g,'')     // Remove anything that is not a letter, number or dash
				seourl = seourl.replace(/-+/g,'-')             // Remove duplicate dashes
				seourl = seourl.replace(/^-*/,'')              // Remove starting dashes
				seourl = seourl.replace(/-*$/,''); 
				//alert(seourl);

				document.getElementById("page_url").value = seourl;	

			 }


	$(document).ready(function () {
		$('#sub_category_id').html('<option selected disabled>-- Select Sub-Categories --</option>');
		$('#category_id').on('change', function () {
			var idCategory = this.value;
			$.ajax({
				url: "{{url('sub-category-list-fetch')}}",
				type: "POST",
				data: {
					_token: '{{csrf_token()}}',
					idCategory: idCategory
				},
				dataType: "json",
				success: function (res) {
					$("#sub_category_id").empty();
					$('#sub_category_id').html('<option selected disabled>-- Select Sub-Categories --</option>');
					$.each(res['result'], function (key, value) {
						$("#sub_category_id").append('<option value="' + value
									.id + '">' + value.name + '</option>');
							});
						}
					});
			});
		});
</script>
<style>
.richText .richText-editor { height:500px; }
</style>
 

<!--Include the JS & CSS-->
<!--
<link rel="stylesheet" href="/richtexteditor/rte_theme_default.css" />
<script type="text/javascript" src="/richtexteditor/rte.js"></script>
<script type="text/javascript" src='/richtexteditor/plugins/all_plugins.js'></script>
<script>
	$(document).ready(function() {
		var editor1 = new RichTextEditor("#div_editor1");
		//editor1.setHTMLCode("Use inline HTML or setHTMLCode to init the default content.");
	});
</script>
 --> 
@endsection
