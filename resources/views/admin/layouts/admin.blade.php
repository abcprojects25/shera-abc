<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHERA ADMIN PANEL</title>
    <link rel="stylesheet" href="/admin/master.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="/admin/style.css">

</head>

<body>
    <!-- <div class="sidebar">
        <h2 class="text-center mb-4">Admin Panel</h2>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <span class="shape1"></span><span class="shape2"></span>
                    <i class="ti-home sidemenu-icon"></i>
                    <span class="sidemenu-label"> Dashboard </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link with-sub" href="#">
                    <span class="shape1"></span><span class="shape2"></span>
                    <i class="ti-layers-alt sidemenu-icon"></i>
                    <span class="sidemenu-label"> Products </span>
                    <i class="angle fe fe-chevron-right"></i>
                </a>
                <ul class="nav-sub">
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="/admin/products/products_lists">All Products</a>
                    </li>
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="/admin/products/add_products">Add New</a>
                    </li>
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="/admin/products/product_categories">Categories</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="ti-power-off sidemenu-icon"></i>
                    <span class="sidemenu-label"> Logout </span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div> -->

    <div class="sidebar">
        <div class="logo-details">
            <i class="bx bxl-c-plus-plus"></i>
            <span class="logo_name">
                <img src="/admin/img/logo-alt.png" alt="">
            </span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="#" class="active" href="{{ route('admin.dashboard') }}">
                    <i class="bx bx-grid-alt"></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="/admin/products/products_lists">
                    <i class="bx bx-box"></i>
                    <span class="links_name">All Product</span>
                </a>
            </li>
            <li>
                <a href="/admin/products/product_categories">
                    <i class="bx bx-list-ul"></i>
                    <span class="links_name">Categories</span>
                </a>
            </li>

            <li class="log_out">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="ti-power-off sidemenu-icon"></i>
                    <span class="sidemenu-label"> Logout </span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>

    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class="fas fa-bars sidebarBtn"></i>
                <span class="dashboard">Dashboard</span>
            </div>
            <div class="search-box">
                <input type="text" placeholder="Search..." />
                <i class="bx bx-search"></i>
            </div>
            <div class="profile-details">
                <i class="fas fa-users"></i>
                <span class="admin_name">Shera Admin</span>
                <i class="fas fa-angle-down"></i>
            </div>
        </nav>
        <!-- Main Content -->
        <div class="main_content">
            @yield('content')
        </div>
    </section>

    <!-- SweetAlert success message -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        sidebarBtn.onclick = function () {
            sidebar.classList.toggle("active");
            if (sidebar.classList.contains("active")) {
                sidebarBtn.classList.replace("fa-bars", "fas fa-ellipsis-v-alt");
            } else
                sidebarBtn.classList.replace("fas fa-ellipsis-v-alt", "fa-bars");
        }

    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 2500,
                showConfirmButton: false
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: '{{ session('error') }}',
            });
        </script>
    @endif

</body>

</html>