<style>
    /* Hide all dropdown menus initially */
    .mob-dropdown-menu,
    .mob-dropdown-item {
        display: none;
    }

    /* Show when parent has .active */
    .mob-dropdown.active>.mob-dropdown-menu,
    .mob-dropdown-submenu.active>.mob-dropdown-item {
        display: block;
    }

    .mob-dropdown-submenu {
        padding: 14px 20px;
        color: #333;
        text-transform: uppercase;
        border: 1px solid darkgrey;
        margin-bottom: 10px;
        margin-left: 16px;
        margin-right: 20px;
    }

    .mob-dropdown-item {
        margin-top: 8px;

    }

    .mob-dropdown-item a {
        padding: 10px 20px;
        text-decoration: underline;
    }
</style>


<li>
    <ul class="navbar-nav navbar-nav-scroll">
        <li class="nav-item"><a href="/why-aapl">Why AAPL</a></li>

        <li class="nav-item mob-dropdown">
            <a href="/products/solutions" class="dropdown-toggle" data-bs-toggle="dropdown"
                aria-expanded="false">SOLUTIONS</a>
            <div class="mob-dropdown-menu">
                <div class="mob-dropdown-submenu">
                    <a href="#" class="dropdown-item dropdown-toggle">
                        Packaging Solutions
                    </a>
                    <div class="mob-dropdown-item">
                        <a href="https://aaplsolutions.com/products/pharma-packaging-solutions"
                            class="dropdown-item">
                            Pharma Packaging Solutions
                        </a>

                        <a href="https://aaplsolutions.com/products/alcohol-packaging-solutions"
                            class="dropdown-item">

                            Alcohol Packaging Solutions

                        </a>

                        <a href="https://aaplsolutions.com/products/f-b-packaging-solutions"
                            class="dropdown-item">

                            F&amp;B Packaging Solutions

                        </a>
                    </div>
                </div>

                <div class="mob-dropdown-submenu">
                    <a href="#" class="dropdown-item dropdown-toggle">
                        Raw Material Solutions
                    </a>
                    <div class="mob-dropdown-item">
                        <a href="https://aaplsolutions.com/products/pharma-raw-material-solutions"
                            class="dropdown-item">
                            Pharma
                        </a>

                        <a href="https://aaplsolutions.com/products/alcohol-raw-material-solutions"
                            class="dropdown-item">
                            Alcohol
                        </a>
                    </div>

                </div>

            </div>
        </li>



        <li class="nav-item"><a href="/sustainability">Sustainability</a></li>
        <li class="nav-item"><a href="/trade-shows">Trade Shows</a></li>
        <li class="nav-item"><a href="/contact">Contact us</a></li>
    </ul>
</li>

<li class="nav-item blue_btn">
    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
        GET A QUOTE <img src="/img/icon/arrow.png" class="img-fluid" />
    </a>
</li>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        const mainDropdown = document.querySelectorAll('.mob-dropdown > a');

        mainDropdown.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const parent = link.closest('.mob-dropdown');

                // console.log(parent);


                document.querySelectorAll('.mob-dropdown').forEach(drop => {
                    if (drop !== parent) drop.classList.remove('active');
                });


                parent.classList.toggle('active');
            });
        });


        const submenuToggles = document.querySelectorAll('.mob-dropdown-submenu > a');

        submenuToggles.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const parent = link.closest('.mob-dropdown-submenu');


                const siblings = parent.parentElement.querySelectorAll('.mob-dropdown-submenu');
                siblings.forEach(sib => {
                    if (sib !== parent) sib.classList.remove('active');
                });


                parent.classList.toggle('active');
            });
        });
    });
</script>