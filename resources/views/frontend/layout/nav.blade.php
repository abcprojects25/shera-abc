<li>
    <ul class="navbar-nav navbar-nav-scroll">
        <li class="nav-item"><a href="/why-aapl">Why AAPL</a></li>

        <li class="nav-item dropdown dropdown-short mob-dropdown">
            <a href="/products/solutions" class="dropdown-toggle" data-bs-toggle="dropdown"
                aria-expanded="false">SOLUTIONS</a>
            <!-- <div class="dropdown-menu">
    @foreach($nestedCategories as $item)
        @php
            $parent = $item['category'];
            $children = $item['subcategories'];
        @endphp

        @if($children->isEmpty())
            <a href="#" class="dropdown-item">
                {{ $parent->name }}
            </a>
        @else
            <div class="dropdown-submenu">
                <a href="#" class="dropdown-item dropdown-toggle">
                    {{ $parent->name }}
                </a>
                <div class="dropdown-menu">
                    @foreach($children as $child)
                        <a href="{{ url('category/' . $child->seourl) }}" class="dropdown-item">
                            {{ $child->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach
</div> -->
            <div class="dropdown-menu">

                <div class="dropdown-submenu">
                    <a href="#" class="dropdown-item dropdown-toggle">
                        Packaging Solutions
                    </a>
                    <div class="dropdown-menu">
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

                <div class="dropdown-submenu">
                    <a href="#" class="dropdown-item dropdown-toggle">
                        Raw Material Solutions
                    </a>
                    <div class="dropdown-menu">
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
        <!-- <li class="nav-item"><a href="/trade-shows">Trade Shows</a></li> -->
        <li class="nav-item"><a href="/contact">Contact us</a></li>
    </ul>
</li>

<li class="nav-item blue_btn">
    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
        GET A QUOTE <img src="/img/icon/arrow.png" class="img-fluid" />
    </a>
</li>
<style>
    /* Position relative to parent dropdown item */

    .dropdown-submenu {
        position: relative;
    }

    /* Submenu hidden by default */
    .dropdown-submenu>.dropdown-menu {
        display: none;
        position: absolute;
        top: 0;
        left: 100%;
        /* Show to the right */
        margin-top: -1px;
    }


    /* Show submenu on hover (desktop) */
    @media (min-width: 992px) {
        .dropdown-submenu:hover>.dropdown-menu {
            display: block;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // On mobile, toggle submenu on click
        const toggles = document.querySelectorAll('.dropdown-submenu > a.dropdown-toggle');

        toggles.forEach(toggle => {
            toggle.addEventListener('click', function (e) {
                if (window.innerWidth < 992) {
                    e.preventDefault();
                    const submenu = this.nextElementSibling;
                    if (submenu.style.display === 'block') {
                        submenu.style.display = 'none';
                    } else {
                        submenu.style.display = 'block';
                    }
                }
            });
        });
    });

</script>