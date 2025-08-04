<!-- Main Header-->
<div class="main-header side-header sticky sticky-pin" style="margin-bottom: -64px;">
	<div class="container-fluid">
		<div class="main-header-left"> <a class="main-header-menu-icon" href="#"
				id="mainSidebarToggle"><span></span></a> </div>

		<div class="main-header-right">
			<div class="dropdown d-md-flex">
				<a class="nav-link icon full-screen-link" href=""> <i
						class="fe fe-maximize fullscreen-button fullscreen header-icons"></i> <i
						class="fe fe-minimize fullscreen-button exit-fullscreen header-icons"></i> </a>
			</div>
			<div class="dropdown main-profile-menu">
				<a class="d-flex" href=""> <span class="main-img-user"><img alt="avatar" src="/img/logo.png"></span>
				</a>
				<div class="dropdown-menu">
					<div class="header-navheading pb-0">
						<h6 class="main-notification-title">AAPL</h6>
						<hr />
					</div>

					<a class="dropdown-item" href="{{ route('adminLogout') }}"
						onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
						<i class="fe fe-power"></i> {{ __('Logout') }}
					</a>

					<form id="logout-form" action="{{ route('adminLogout') }}" method="POST" class="d-none">
						@csrf
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- End Main Header-->