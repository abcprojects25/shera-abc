<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px;
            border-radius: 5px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            flex: 1;
            padding: 20px;
            background: #f8f9fa;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
    <h2 class="text-center mb-4">Admin Panel</h2>
    <ul class="nav">
        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <span class="shape1"></span><span class="shape2"></span>
                <i class="ti-home sidemenu-icon"></i>
                <span class="sidemenu-label"> Dashboard </span>
            </a>
        </li>

        <!-- Products Section -->
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

        <!-- Logout -->
        <li class="nav-item">
            <a class="nav-link " href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="ti-power-off sidemenu-icon"></i>
                <span class="sidemenu-label"> Logout </span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</div>


    <!-- Main Content -->
    <div class="content">
        @yield('content')
    </div>

    <!-- SweetAlert success message -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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