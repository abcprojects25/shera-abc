<?php
$page = basename($_SERVER['SCRIPT_NAME']);
$page = str_replace('', '', $page);
$page = str_replace('.php', '', $page);

$page_head = $page;
$page_head = str_replace('_', ' ', $page_head);
$page_head = str_replace('.php', '', $page_head);
$page_head = ucwords($page_head);

?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->

<html class="no-js" lang="en"><!--<![endif]-->

<head>
	<title> AAPL Solutions Pvt. Ltd. - Delivering Expert, Integrated Packaging Solutions Worldwide </title>

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5">
	<meta http-equiv='cache-control' content='no-cache'>
	<meta http-equiv='expires' content='0'>
	<meta http-equiv='pragma' content='no-cache'>
	<meta name="theme-color" content="#647AA2" />
	<meta name="robots" content="index, follow">
	<meta name="revisit-after" content="1 month">
	<link rel="icon" type="image/png" href="/img/logo.png" />
	<link rel="apple-touch-icon" href="/img/logo.png" />

	<meta name="description"
		content="A trusted global expert in primary packaging solutions, operating in over 55 countries. With more than 40 years of experience, our deep industry expertise enables us to offer fully integrated solutions—from packaging and raw materials to high-performance machinery.">
	<meta name="keywords"
		content="AAPL Solutions, Engineering Services, Procurement, Commissioning, Project Management, Import Export Business, Detailed Engineering, USA, South America, Middle East, Africa, Far-East Asia, ISO 9001-2008, GMP, Industrial Solutions, Manufacturing, Business Growth, Global Projects, Trusted Partner, Engineering Innovation.">

	<?php
// Fetch the current page URL
$currentUrl = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	?>
	<link rel="canonical" href="<?php echo htmlspecialchars($currentUrl); ?>">

	<!-- Tags for Social Media -->
	<meta property="og:site_name" content="<?php echo htmlspecialchars($currentUrl); ?>" />
	<meta property="og:title"
		content="AAPL Solutions Pvt. Ltd. - Delivering Expert, Integrated Packaging Solutions Worldwide" />
	<meta property="og:description"
		content="A trusted global expert in primary packaging solutions, operating in over 55 countries. With more than 40 years of experience, our deep industry expertise enables us to offer fully integrated solutions—from packaging and raw materials to high-performance machinery." />
	<meta property="og:url" content="<?php echo htmlspecialchars($currentUrl); ?>">
	<meta property="og:type" content="website" />
	<meta property="og:image" content="<?php echo htmlspecialchars($currentUrl); ?>img/display.jpg">

	<!-- Twitter Card Tags -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title"
		content="AAPL Solutions Pvt. Ltd. - Delivering Expert, Integrated Packaging Solutions Worldwide">
	<meta name="twitter:description"
		content="A trusted global expert in primary packaging solutions, operating in over 55 countries. With more than 40 years of experience, our deep industry expertise enables us to offer fully integrated solutions—from packaging and raw materials to high-performance machinery.">
	<meta name="twitter:image" content="<?php echo htmlspecialchars($currentUrl); ?>img/display.jpg">

	<script type="application/ld+json" class="aioseo-schema">
		{"@context":"https:\/\/schema.org","@graph":[{"@type":"WebSite","@id":"https:\/\/aaplsolutions.com\/#website","url":"https:\/\/aaplsolutions.com\/","name":"AAPL Solutions","description":"Quality is the Best Business Plan","inLanguage":"en-US","publisher":{"@id":"https:\/\/aaplsolutions.com\/#organization"},"potentialAction":{"@type":"SearchAction","target":{"@type":"EntryPoint","urlTemplate":"https:\/\/aaplsolutions.com\/?s={search_term_string}"},"query-input":"required name=search_term_string"}},{"@type":"Organization","@id":"https:\/\/aaplsolutions.com\/#organization","name":"AAPL Solutions","url":"https:\/\/aaplsolutions.com\/","logo":{"@type":"ImageObject","@id":"https:\/\/aaplsolutions.com\/#organizationLogo","url":"https:\/\/aaplsolutions.com\/wp-content\/uploads\/2019\/08\/cropped-AA-Icon-Square-512x512px-1.png","width":512,"height":512},"image":{"@id":"https:\/\/aaplsolutions.com\/#organizationLogo"}},{"@type":"BreadcrumbList","@id":"https:\/\/aaplsolutions.com\/#breadcrumblist","itemListElement":[{"@type":"ListItem","@id":"https:\/\/aaplsolutions.com\/#listItem","position":1,"item":{"@type":"WebPage","@id":"https:\/\/aaplsolutions.com\/","name":"Home","description":"Quality is the Best Business Plan","url":"https:\/\/aaplsolutions.com\/"}}]},{"@type":"WebPage","@id":"https:\/\/aaplsolutions.com\/#webpage","url":"https:\/\/aaplsolutions.com\/","name":"AAPL Solutions Pvt. Ltd. | AAPL Solutions","inLanguage":"en-US","isPartOf":{"@id":"https:\/\/aaplsolutions.com\/#website"},"breadcrumb":{"@id":"https:\/\/aaplsolutions.com\/#breadcrumblist"},"datePublished":"2018-07-20T14:36:22+00:00","dateModified":"2022-09-07T15:44:07+00:00"}]}
	</script>

	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
		rel="stylesheet" media="print" onload="this.media='all'">

	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/app.css?ver=<?php echo time(); ?>">

	<!--  
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
	-->
	<script src="/js/jquery-3.6.0.min.js"></script>

</head>

<body>

	<!-- Modal -->
	<div class="modal modal-bg fade order_modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered position-relative">
			<div class="modal-content">
				<img src="/img/icon/close_w.svg" alt="" class="img-fluid ms-auto me-2 close-img"
					data-bs-dismiss="modal">
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-5 col-md-5 col-12 popup_text text-center">
							<div>
								<h1> <span> 40+ Years of Innovation </span> Tailored solutions for business growth and
									success. </h1>
							</div>
						</div>
						<div class="col-lg-7 col-md-7 col-12 popup_form">
							<div class="mx-auto form-box">
								@include('frontend.layout.inquiry')
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div id="smooth-wrapper">
		<div id="smooth-content">

			<!-- Header START -->
			<header class="header-sticky header-absolute">
				<nav class="navbar navbar-expand-xl">
					<div class="container">
						<a class="navbar-brand me-0" href="/">
							<img src="/img/logo_white.png" alt="logo" class="light-mode-item img-fluid" />
							<img src="/img/logo.png" alt="logo" class="dark-mode-item img-fluid" />
						</a>
						<!-- Main navbar START -->
						<div class="navbar-collapse collapse" id="navbarCollapse">
							<ul class="dropdown-hover">
								@include('frontend.layout.nav')
							</ul>
						</div>
					</div>
				</nav>
			</header>

			<div class="clear"></div>
			<nav class="" id="sidebar">
				<div class="container-fluid">
					<ul class="list-unstyled components">
						@include('frontend.layout.navbar')
					</ul>
				</div>
			</nav>

			<div id="content">
				<div class="nav_height"></div>
				<div class="res_btn">
					<div class="row">
						<div class="col-sm-6 col-xs-6">
							<a class="navbar-brand js-scroll-trigger logo" href="/">
								<img src="/img/logo.png" alt="logo" class="img-fluid" />
							</a>
						</div>
						<div class="col-sm-6 col-xs-6 text-right">
							<button type="button" id="sidebarCollapse" class="btn button_container">
								<span class="top"></span><span class="middle"></span><span class="bottom"></span>
							</button>
						</div>
					</div>
				</div>