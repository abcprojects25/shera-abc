<div class="elementor-element top-bar">
                        <div class="container">
                            <div class="top-menu">
                                <ul class="top-menu-list">
                                    <li class="list">
                                        <a href="{{ url('be-our-dealer')}}" class="link">Be Our Dealer</a>
                                    </li>
                                    <li class="list">
                                        <a href="{{ url('be-our-retailer')}}" class="link">Be Our Retailer</a>
                                    </li>
                                    
                                </ul>
                                <ul class="top-menu-list">
                                    <li class="list">
                                       <a href="{{ url('/about-us') }}" class="link">About Us</a>
                                    </li>
                                    <li class="list">
                                        <a href="" class="link">Knowledge Center</a>
                                    </li>
                                    <li class="list">
                                        <a href="" class="link">Resources</a>
                                    </li>
                                    <li class="list">
                                        <a href="{{ url('careers')}}" class="link">Careers</a>
                                    </li>
                                    <li class="list">
                                        <a href="" class="link">Support</a>
                                    </li>
                                    <li class="list">
                                        <a href="{{ url('/contact-us') }}" class="link">Contact Us</a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="elementor elementor-7370 nav_top">
                        <div class="container-fluid">
                            <div class="elementor-element elementor-element-9329b62 e-flex e-con-boxed e-con e-parent container">
                                <div class="e-con-inner nav-con-inner">
                                    <div
                                        class="elementor-element elementor-element-01cb2f5 e-con-full e-flex e-con e-child"
                                        data-id="01cb2f5"
                                        data-element_type="container"
                                        data-settings='{"wcf_enable_cursor_hover_effect_text":"View","wcf-animation":"none"}'
                                    >
                                        <div
                                            class="elementor-element elementor-element-c512135 elementor-widget elementor-widget-wcf--site-logo"
                                            data-id="c512135"
                                            data-element_type="widget"
                                            data-settings='{"wcf-animation":"none"}'
                                            data-widget_type="wcf--site-logo.default"
                                        >
                                            <div class="elementor-widget-container">
                                                <div class="elementor-image">
                                                    <a href="{{ url('/') }}" aria-label="Site Logo">
                                                        <img width="125" height="34" src="{{ asset('img/logo.png') }}" class="attachment-full size-full wp-image-6069" alt="" />
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="elementor-element elementor-element-b7b6d24 e-con-full e-flex e-con e-child"
                                        data-id="b7b6d24"
                                        data-element_type="container"
                                        data-settings='{"wcf_enable_cursor_hover_effect_text":"View","wcf-animation":"none"}'
                                    >
                                        <div
                                            class="elementor-element elementor-element-32eb3e9 elementor-widget elementor-widget-wcf--nav-menu"
                                            data-id="32eb3e9"
                                            data-element_type="widget"
                                            data-settings='{"mobile_menu_breakpoint":"tablet","onpsc_duration":1,"ease_type":"power2.out","wcf-animation":"none"}'
                                            data-widget_type="wcf--nav-menu.default"
                                        >
                                            <div class="elementor-widget-container">
                                                <div class="wcf__nav-menu mobile-menu-active mobile-menu-right hover-pointer-">
                                                    <button class="wcf-menu-hamburger" type="button" aria-label="hamburger-icon">
                                                        <svg aria-hidden="true" class="e-font-icon-svg e-fas-bars" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"
                                                            ></path>
                                                        </svg>
                                                    </button>
                                                    <div class="wcf-nav-menu-container">
                                                        <ul id="menu-mega-menu" class="wcf-nav-menu-nav menu-layout-horizontal">
                                                            <!-- <li class="menu-item"><a href="#" class="wcf-nav-item">Home </a></li> -->
                                                            <li class="menu-item"><a href="#" class="wcf-nav-item">Home Owner</a></li>
                                                            <li class="menu-item"><a href="#" class="wcf-nav-item">Professionals</a></li>
                                                            <li
                                                                id="menu-item-9435"
                                                                class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor menu-item-has-children menu-item-9435"
                                                            >
                                                                <a href="{{ url('/products') }}" class="wcf-nav-item"
                                                                    >Products<span class="wcf-submenu-indicator"
                                                                        ><svg aria-hidden="true" class="e-font-icon-svg e-fas-angle-down" viewBox="0 0 320 512" xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"
                                                                            ></path></svg></span
                                                                ></a>
                                                                <ul class="sub-menu">
                                                                    @foreach($mainCategories as $mainCategory)
                                                                    <li
                                                                        id="menu-item-9436"
                                                                        class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children menu-item-9436"
                                                                    >
                                                                        <a href="{{ url('/products') }}">
                                                                            {{ $mainCategory->name }}
                                                                            <span class="submenu-indicator">
                                                                                <svg
                                                                                    aria-hidden="true"
                                                                                    class="e-font-icon-svg e-fas-angle-down"
                                                                                    viewBox="0 0 320 512"
                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                >
                                                                                    <path
                                                                                        d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"
                                                                                    ></path>
                                                                                </svg> </span
                                                                        ></a>
                                                                        @if(!empty($subCategoriesByMain[$mainCategory->id]) && $subCategoriesByMain[$mainCategory->id]->count())
                                                                        <ul class="sub-menu">
                                                                            @foreach($subCategoriesByMain[$mainCategory->id] as $subCategory)
                                                                            <li id="menu-item-9437" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9437">
                                                                                <a href="{{ route('category.products', $subCategory->seourl) }}">{{ $subCategory->name }}</a>
                                                                            </li>
                                                                            @endforeach                                                                            
                                                                        </ul>
                                                                        @endif
                                                                    </li>
                                                                    @endforeach
                                                                    
                                                                </ul>
                                                            </li>
                                                            <li id="menu-item-9542" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-9542">
                                                                <a href="{{ url('applications')}}" class="wcf-nav-item"
                                                                    >Applications
                                                                   
                                                                </a>
                                                               
                                                            </li>
                                                            <li id="menu-item-9542" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-9542">
                                                                <a href="{{ url('/project/hospital') }}" class="wcf-nav-item"
                                                                    >Projects<span class="wcf-submenu-indicator"
                                                                        ><svg aria-hidden="true" class="e-font-icon-svg e-fas-angle-down" viewBox="0 0 320 512" xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"
                                                                            ></path></svg></span
                                                                ></a>
                                                                <ul class="sub-menu">
                                                                    @foreach($categories as $category)
                                                                    <li id="menu-item-9543" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9543">
                                                                        <a href="{{ route('frontend.project.category', $category->seourl) }}">{{ $category->name }}</a>
                                                                    </li>
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                            
                                                           
                                                            
                                                        </ul>
                                                        <button class="wcf-menu-close" type="button">
                                                            <svg aria-hidden="true" class="e-font-icon-svg e-fas-times" viewBox="0 0 352 512" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"
                                                                ></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div class="wcf-menu-overlay"></div>
                                                </div>
                                                <script type="text/javascript">
                                                    (function () {
                                                        const windowWidth = window.innerWidth;
                                                        const menu = document.querySelector('[data-id="32eb3e9"] .wcf__nav-menu');

                                                        //desktop menu active
                                                        if (windowWidth > 1024) {
                                                            menu.classList.remove("mobile-menu-active");
                                                            menu.classList.add("desktop-menu-active");
                                                        }
                                                    })();
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>