<div class="main-sidebar main-sidebar-sticky side-menu ps ps--active-y">
	<div class="sidemenu-logo">
		<a class="main-logo" href="#">
			<img src="/img/logo.png" class="header-brand-img desktop-logo" alt="logo" style="width:120px;">
			<img src="/img/logo.png" class="header-brand-img icon-logo" alt="logo" style="width:20px;">
		</a>
	</div>
	<div class="main-sidebar-body">
		@include('admin.layouts.navigation')
	</div>
	<div class="ps__rail-x" style="left: 0px; top: 0px;">
		<div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
	</div>
	<div class="ps__rail-y" style="top: 0px; height: 754px; right: 0px;">
		<div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 519px;"></div>
	</div>
</div> 
<!-- End Sidemenu -->

@include('admin.layouts.top_header')
@include('sweetalert::alert')
