
<!DOCTYPE html>

<html class="no-js" lang="en">
    <!--<![endif]-->


  @include('frontend.layout.header')


                    <div data-elementor-type="wp-page" data-elementor-id="34" class="elementor elementor-34">
                        <div class="inner-page product-page deco-product-page">
                            <section class="banner">
                                <div class="image-box">
                                    <img src="{{ asset('img/products-page/banner/banner.jpg') }}" alt="" />
                                </div>
                                <div class="heading-box">
                                    <div
                                        class="elementor-element elementor-element-946b02c e-con-full e-flex e-con e-child"
                                        data-id="946b02c"
                                        data-element_type="container"
                                        data-settings='{"wcf_enable_cursor_hover_effect_text":"View","wcf-animation":"none"}'
                                    >
                                        <div
                                            class="elementor-element elementor-element-7d0fae9 wcf-t-animation-text_move elementor-widget elementor-widget-wcf--title"
                                            data-id="7d0fae9"
                                            data-element_type="widget"
                                            data-settings='{"text_transform_origin":"top center -50","wcf_text_animation":"text_move","text_delay":2,"text_duration":1,"text_stagger":0.02,"text_on_scroll":"yes","text_rotation_di":"x","text_rotation":"-80","wcf-animation":"none"}'
                                            data-widget_type="wcf--title.default"
                                        >
                                            <div class="elementor-widget-container">
                                                <!-- <h2 class="sub-heading alt mb-3">Product</h2> -->
                                                <h2 class="sub-heading alt"><span class="mini-heading">Product</span><span class="heading">{{ $subCategory->name }}</span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="section deco-board-products">
                                <div data-elementor-type="wp-page" data-elementor-id="6543" class="elementor elementor-6543 home_about">
                                    <div
                                        class="elementor-element elementor-element-be7fb25 e-flex e-con-boxed e-con e-parent"
                                        data-id="be7fb25"
                                        data-element_type="container"
                                        data-settings='{"wcf_enable_cursor_hover_effect_text":"View","wcf-animation":"none"}'
                                    >
                                        <div class="e-con-inner">
                                            <div
                                                class="elementor-element elementor-element-6c93c04 e-con-full e-flex e-con e-child"
                                                data-id="6c93c04"
                                                data-element_type="container"
                                                data-settings='{"wcf_pin_area_start_custom":"top top+=100","wcf_pin_area_end_custom":"bottom bottom-=150","wcf_enable_cursor_hover_effect_text":"View","wcf_enable_pin_area":"yes","wcf_pin_area_start":"custom","wcf_pin_area_end":"custom","wcf-animation":"none","wcf_pin_status":"true","wcf_pin_spacing":"false","wcf_pin_type":"transform","wcf_pin_scrub":"false","wcf_pin_markers":"false","wcf_pin_breakpoint":"mobile"}'
                                                style="min-width: 350px"
                                            >
                                                <div
                                                    class="elementor-element elementor-element-c9e9057 wcf-t-animation-none elementor-widget elementor-widget-wcf--title"
                                                    data-id="c9e9057"
                                                    data-element_type="widget"
                                                    data-settings='{"wcf-animation":"fade","fade-from":"left","data-duration":0.75,"fade-offset":40,"wcf_text_animation":"none","delay":0.15,"on-scroll":1,"ease":"power2.out"}'
                                                    data-widget_type="wcf--title.default"
                                                >
                                                    <div class="elementor-widget-container">
                                                        @if($mainCategory)
                                                        <h4 class="wcf--title mini-title">{{ $mainCategory->name }} Product</h4>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div
                                                    class="elementor-element elementor-element-93f9009 elementor-widget-mobile_extra__width-initial wcf-t-animation-word elementor-widget elementor-widget-wcf--title"
                                                    data-id="93f9009"
                                                    data-element_type="widget"
                                                    data-settings='{"wcf_text_animation":"word","text_translate_x":-60,"text_delay":0.15,"text_duration":1,"text_stagger":0.02,"text_on_scroll":"yes","text_translate_y":0,"wcf-animation":"none"}'
                                                    data-widget_type="wcf--title.default"
                                                >
                                                    <div class="elementor-widget-container">
                                                        <h2 class="wcf--title sub-heading alt">{{ $subCategory->name }}</h2>
                                                    </div>
                                                </div>
                                                <div
                                                    class="elementor-element elementor-element-55aed85 elementor-widget elementor-widget-wcf--image"
                                                    data-id="55aed85"
                                                    data-element_type="widget"
                                                    data-settings='{"wcf-animation":"fade","on-scroll":"1","fade-from":"left","data-duration":0.75,"fade-offset":40,"wcf-image-animation":"none","delay":0.15,"ease":"power2.out"}'
                                                    data-widget_type="wcf--image.default"
                                                >
                                                    <div class="elementor-widget-container p-0">
                                                        <p class="wcf--para">
                                                            {{ $subCategory->description }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="elementor-element elementor-element-55aed85 elementor-widget elementor-widget-wcf--image"
                                                    data-id="55aed85"
                                                    data-element_type="widget"
                                                    data-settings='{"wcf-animation":"fade","on-scroll":"1","fade-from":"left","data-duration":0.75,"fade-offset":40,"wcf-image-animation":"none","delay":0.15,"ease":"power2.out"}'
                                                    data-widget_type="wcf--image.default"
                                                >
                                                    <div class="elementor-widget-container p-0">
                                                        <ul class="usp-icon-list">
                                                            <li class="list">
                                                                <div class="icon">
                                                                    <img src="{{ asset('img/products-page/shera-pro/icons/excellent.png') }}" alt="" />
                                                                </div>
                                                                <div class="text">
                                                                    <p>
                                                                        Excellent <br />
                                                                        Aesthetic
                                                                    </p>
                                                                </div>
                                                            </li>
                                                            <li class="list">
                                                                <div class="icon">
                                                                    <img src="{{ asset('img/products-page/shera-pro/icons/crystal.png') }}" alt="" />
                                                                </div>
                                                                <div class="text">
                                                                    <p>
                                                                        Crystal Engineering <br />
                                                                        Technology
                                                                    </p>
                                                                </div>
                                                            </li>
                                                            <li class="list">
                                                                <div class="icon">
                                                                    <img src="{{ asset('img/products-page/shera-pro/icons/protection.png') }}" alt="" />
                                                                </div>
                                                                <div class="text">
                                                                    <p>
                                                                        Protection From <br />
                                                                        All Elements
                                                                    </p>
                                                                </div>
                                                            </li>
                                                            <li class="list">
                                                                <div class="icon">
                                                                    <img src="{{ asset('img/products-page/shera-pro/icons/strong.png') }}" alt="" />
                                                                </div>
                                                                <div class="text">
                                                                    <p>
                                                                        Strong And <br />
                                                                        Durable
                                                                    </p>
                                                                </div>
                                                            </li>
                                                            <li class="list">
                                                                <div class="icon">
                                                                    <img src="{{ asset('img/products-page/shera-pro/icons/versatile.png') }}" alt="" />
                                                                </div>
                                                                <div class="text">
                                                                    <p>
                                                                        Versatile <br />
                                                                        Solution
                                                                    </p>
                                                                </div>
                                                            </li>
                                                 
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="products-container" style="flex: 1;">
                                                <div class="product-wrapper">
                                                    <div class="row">
                                                        @foreach($subCategory->products as $product)
                                                        <div class="col col-12 col-lg-4">
                                                            <a href="{{ route('product.show', $product->product_url) }}" class="product-card">
                                                                <div class="image-box mb-4">
                                                                    <!-- this is thumbnail image  -->
                                                                     <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                                                    <div class="hovered-box">
                                                                        <!-- <h4 class="title">Wall Partitions, False Ceiling, Wall Cladding, Landscaping, External Cladding</h4> -->
                                                                        <ul class="information-list">
                                                                            <li class="list mb-1">Profile : {{ $product->profile }}</li>
                                                                            <li class="list mb-1">Colour : {{ $product->colour }}</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="text-box">
                                                                    <h3 class="title inner-title mb-1">{{ $product->title }}</h3>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        @endforeach
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Home_About -->
                                        </div>
                                        <!-- E-con-inner -->
                                    </div>
                                </div>
                            </section>
                            <section class="section applications-section background-section">
                                <div class="container">
                                    <div class="applications-wrapper">
                                        <div class="heading-box mb-5">
                                            <div
                                                class="elementor-element elementor-element-946b02c e-con-full e-flex e-con e-child"
                                                data-id="946b02c"
                                                data-element_type="container"
                                                data-settings='{"wcf_enable_cursor_hover_effect_text":"View","wcf-animation":"none"}'
                                            >
                                                <div
                                                    class="elementor-element elementor-element-7d0fae9 wcf-t-animation-text_move elementor-widget elementor-widget-wcf--title"
                                                    data-id="7d0fae9"
                                                    data-element_type="widget"
                                                    data-settings='{"text_transform_origin":"top center -50","wcf_text_animation":"text_move","text_delay":0.5,"text_duration":1,"text_stagger":0.02,"text_on_scroll":"yes","text_rotation_di":"x","text_rotation":"-80","wcf-animation":"none"}'
                                                    data-widget_type="wcf--title.default"
                                                >
                                                    <div class="elementor-widget-container">
                                                        <h2 class="sub-heading alt mb-3"><span class="shera-green">Shera</span> <span class="shera-brown">{{ $subCategory->name }}</span></h2>
                                                        <h2 class="heading alt">Applications</h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-container">
                                            <div class="swiper application-swipper">
                                                <!-- Additional required wrapper -->
                                                <div class="swiper-wrapper">
                                                    <!-- Slides -->
                                                     @foreach($subCategory->applications as $app)
                                                    <div class="swiper-slide">
                                                        <a href="" class="application-card">
                                                            <div class="image-box">
                                                                <img src="{{ asset($app->image) }}" alt="{{ $app->alt_text }}" />
                                                            </div>
                                                            <div class="text-box">
                                                                <h4 class="title">  {{ $app->name }}</h4>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    @endforeach
                                                    
                                                </div>
                                                <!-- If we need pagination -->
                                            </div>
                                            <div class="swipper-button-wrapper">
                                                <div class="swipper-button swiper-button-prev"></div>
                                                <div class="swipper-button swiper-button-next"></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>

                    @include('frontend.layout.footer')
                    
                </div>
                <!-- #page -->
            </div>
        </div>
          @include('frontend.layout.enquiryModal')
        <div class="whatsapp-box">
            <a href="https://wa.me/1234567890?text=Test" class="whatsapp-icon" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                    <path
                        d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"
                    />
                </svg>
            </a>
        </div>
        <div class="lets-talk-box">
            <a href="" class="lets-talk" data-bs-toggle="modal" data-bs-target="#viewDownloadModal">
                <span class="wc-btn-play"> <i aria-hidden="true" class="arolax-theme arolax-wcf-icon icon-wcf-arrow-up-right2"></i> </span>
                <span class="text"> Lets Talk </span>
                <span class="wc-btn-play"> <i aria-hidden="true" class="arolax-theme arolax-wcf-icon icon-wcf-arrow-up-right2"></i> </span>
                <!-- <i aria-hidden="true" class="arolax-theme arolax-wcf-icon icon-wcf-arrow-right1"></i>  -->
            </a>
        </div>
        <div class="wcf-scroll-to-top scroll-to-"><i aria-hidden="true" class="arolax-theme arolax-wcf-icon icon-wcf-arrow-up-4"></i></div>
        <div class="wcf-cursor"></div>
        <div class="wcf-cursor-follower"></div>

        <script>
            const lazyloadRunObserver = () => {
                const lazyloadBackgrounds = document.querySelectorAll(`.e-con.e-parent:not(.e-lazyloaded)`);
                const lazyloadBackgroundObserver = new IntersectionObserver(
                    (entries) => {
                        entries.forEach((entry) => {
                            if (entry.isIntersecting) {
                                let lazyloadBackground = entry.target;
                                if (lazyloadBackground) {
                                    lazyloadBackground.classList.add("e-lazyloaded");
                                }
                                lazyloadBackgroundObserver.unobserve(entry.target);
                            }
                        });
                    },
                    { rootMargin: "200px 0px 200px 0px" }
                );
                lazyloadBackgrounds.forEach((lazyloadBackground) => {
                    lazyloadBackgroundObserver.observe(lazyloadBackground);
                });
            };
            const events = ["DOMContentLoaded", "elementor/lazyload/observe"];
            events.forEach((event) => {
                document.addEventListener(event, lazyloadRunObserver);
            });
        </script>
        <style id="wcf-preloader-inline-css" type="text/css">
            .wcf-preloader {
                background-color: #121212;
            }
            .wcf-preloader {
                background-color: #121212;
            }
        </style>
        <style id="wcf-scroll-to-top-inline-css" type="text/css">
            .wcf-scroll-to-top {
                bottom: 5px;
                right: 15px;
                width: 35px;
                height: 35px;
                z-index: 9999;
                background-color: #00ab4d;
                border-radius: 5px;
                font-size: 16px;
                color: #fff;
                fill: #fff;
                mix-blend-mode: normal;
            }
            .wcf-scroll-to-top.scroll-to-circle {
                width: 35px;
                height: 35px;
            }
        </style>
        <style id="wcf-cursor-inline-css" type="text/css">
            .wcf-cursor {
                width: px;
                height: px;
                border-color: #ffffff;
                mix-blend-mode: difference;
            }
            .wcf-cursor-follower {
                width: px;
                height: px;
                background-color: #ffffff;
                mix-blend-mode: difference;
            }
        </style>
        <link rel="stylesheet" id="wpo_min-footer-0-css" href="{{ asset('css/wpo-minify-footer-24b84006.min.css') }}" type="text/css" media="all" />

        <script type="text/javascript" src="{{ asset('js/gsap.min.js') }}" id="gsap-js"></script>
        <script type="text/javascript" src="{{ asset('js/ScrollTrigger.min.js') }}" id="ScrollTrigger-js"></script>

        <script type="text/javascript" id="arolax-essential--global-core-js-extra">
            /* <![CDATA[ */
            var AROLAX_ADDONS_JS = { ajaxUrl: "", _wpnonce: "d2b278181b" };
            /* ]]> */
        </script>
        <script type="text/javascript" src="{{ asset('js/wcf--global-core.min.js') }}" id="arolax-essential--global-core-js"></script>
        <script type="text/javascript" id="wcf--addons-js-extra">
            /* <![CDATA[ */
            var WCF_ADDONS_JS = {
                ajaxUrl: "",
                _wpnonce: "35217e1834",
                post_id: "34",
                i18n: { okay: "Okay", cancel: "Cancel", submit: "Submit", success: "Success", warning: "Warning" },
                smoothScroller: null,
                mode: "",
            };
            /* ]]> */
        </script>
        <script type="text/javascript" src="{{ asset('js/wcf-addons.min.js') }}" id="wcf--addons-js"></script>
        <script type="text/javascript" id="arolax-script-js-extra">
            /* <![CDATA[ */
            var arolax_obj = { ajax_url: "", cart_update_qty_change: "" };
            /* ]]> */
        </script>
        <script type="text/javascript" src="{{ asset('js/script.min.js') }}" id="arolax-script-js"></script>
        <script type="text/javascript" src="{{ asset('js/swiper.min.js') }}" id="swiper-js"></script>
        <script type="text/javascript" src="{{ asset('js/slider.min.js') }}" id="wcf--slider-js"></script>
        <script type="text/javascript" src="{{ asset('js/jquery-numerator.min.js') }}" id="jquery-numerator-js"></script>
        <script type="text/javascript" src="{{ asset('js/counter.min.js') }}" id="wcf--counter-js"></script>
        <script type="text/javascript" id="mediaelement-core-js-before">
            /* <![CDATA[ */
            var mejsL10n = {
                language: "en",
                strings: {
                    "mejs.download-file": "Download File",
                    "mejs.install-flash":
                        "You are using a browser that does not have Flash player enabled or installed. Please turn on your Flash player plugin or download the latest version from https:\/\/get.adobe.com\/flashplayer\/",
                    "mejs.fullscreen": "Fullscreen",
                    "mejs.play": "Play",
                    "mejs.pause": "Pause",
                    "mejs.time-slider": "Time Slider",
                    "mejs.time-help-text": "Use Left\/Right Arrow keys to advance one second, Up\/Down arrows to advance ten seconds.",
                    "mejs.live-broadcast": "Live Broadcast",
                    "mejs.volume-help-text": "Use Up\/Down Arrow keys to increase or decrease volume.",
                    "mejs.unmute": "Unmute",
                    "mejs.mute": "Mute",
                    "mejs.volume-slider": "Volume Slider",
                    "mejs.video-player": "Video Player",
                    "mejs.audio-player": "Audio Player",
                    "mejs.captions-subtitles": "Captions\/Subtitles",
                    "mejs.captions-chapters": "Chapters",
                    "mejs.none": "None",
                    "mejs.afrikaans": "Afrikaans",
                    "mejs.albanian": "Albanian",
                    "mejs.arabic": "Arabic",
                    "mejs.belarusian": "Belarusian",
                    "mejs.bulgarian": "Bulgarian",
                    "mejs.catalan": "Catalan",
                    "mejs.chinese": "Chinese",
                    "mejs.chinese-simplified": "Chinese (Simplified)",
                    "mejs.chinese-traditional": "Chinese (Traditional)",
                    "mejs.croatian": "Croatian",
                    "mejs.czech": "Czech",
                    "mejs.danish": "Danish",
                    "mejs.dutch": "Dutch",
                    "mejs.english": "English",
                    "mejs.estonian": "Estonian",
                    "mejs.filipino": "Filipino",
                    "mejs.finnish": "Finnish",
                    "mejs.french": "French",
                    "mejs.galician": "Galician",
                    "mejs.german": "German",
                    "mejs.greek": "Greek",
                    "mejs.haitian-creole": "Haitian Creole",
                    "mejs.hebrew": "Hebrew",
                    "mejs.hindi": "Hindi",
                    "mejs.hungarian": "Hungarian",
                    "mejs.icelandic": "Icelandic",
                    "mejs.indonesian": "Indonesian",
                    "mejs.irish": "Irish",
                    "mejs.italian": "Italian",
                    "mejs.japanese": "Japanese",
                    "mejs.korean": "Korean",
                    "mejs.latvian": "Latvian",
                    "mejs.lithuanian": "Lithuanian",
                    "mejs.macedonian": "Macedonian",
                    "mejs.malay": "Malay",
                    "mejs.maltese": "Maltese",
                    "mejs.norwegian": "Norwegian",
                    "mejs.persian": "Persian",
                    "mejs.polish": "Polish",
                    "mejs.portuguese": "Portuguese",
                    "mejs.romanian": "Romanian",
                    "mejs.russian": "Russian",
                    "mejs.serbian": "Serbian",
                    "mejs.slovak": "Slovak",
                    "mejs.slovenian": "Slovenian",
                    "mejs.spanish": "Spanish",
                    "mejs.swahili": "Swahili",
                    "mejs.swedish": "Swedish",
                    "mejs.tagalog": "Tagalog",
                    "mejs.thai": "Thai",
                    "mejs.turkish": "Turkish",
                    "mejs.ukrainian": "Ukrainian",
                    "mejs.vietnamese": "Vietnamese",
                    "mejs.welsh": "Welsh",
                    "mejs.yiddish": "Yiddish",
                },
            };
            /* ]]> */
        </script>
        <script type="text/javascript" src="{{ asset('js/mediaelement-and-player.min.js') }}" id="mediaelement-core-js"></script>
        <script type="text/javascript" src="{{ asset('js/mediaelement-migrate.min.js') }}" id="mediaelement-migrate-js"></script>
        <script type="text/javascript" id="mediaelement-js-extra">
            /* <![CDATA[ */
            var _wpmejsSettings = { pluginPath: "", classPrefix: "mejs-", stretching: "responsive", audioShortcodeLibrary: "mediaelement", videoShortcodeLibrary: "mediaelement" };
            /* ]]> */
        </script>
        <script type="text/javascript" src="{{ asset('js/wp-mediaelement.min.js') }}" id="wp-mediaelement-js"></script>

        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script> -->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script> -->
        <script type="text/javascript" src="{{ asset('js/ScrollSmoother.min.js') }}" id="ScrollSmoother-js"></script>
        <script type="text/javascript" src="{{ asset('js/SplitText.min.js') }}" id="SplitText-js"></script>
        <script type="text/javascript" src="{{ asset('js/ScrollToPlugin.min.js') }}" id="ScrollToPlugin-js"></script>
        <script type="text/javascript" src="{{ asset('js/Flip.min.js') }}" id="flip-js"></script>
        <script type="text/javascript" src="{{ asset('js/post.js') }}" id="wcf--posts-js"></script>
        <script type="text/javascript" src="{{ asset('js/wcf-addons-pro.js') }}" id="wcf--addons-pro-js"></script>
        <script type="text/javascript" src="{{ asset('js/wcf-addons-ex.js') }}" id="wcf--addons-ex-js"></script>
        <script type="text/javascript" defer src="{{ asset('js/offcanvas-menu.js') }}" id="wcf-offcanvas-menu-js"></script>
        <script type="text/javascript" src="{{ asset('js/video-testimonial.js') }}" id="arolax-video-testimonial-js"></script>
        <script type="text/javascript" defer src="{{ asset('js/mailchimp.js') }}" id="wcf--mailchimp-js"></script>
        <script type="text/javascript" src="{{ asset('js/webpack.runtime.min.js') }}" id="elementor-webpack-runtime-js"></script>
        <script type="text/javascript" src="{{ asset('js/frontend-modules.min.js') }}" id="elementor-frontend-modules-js"></script>
        <script type="text/javascript" src="{{ asset('js/core.min.js') }}" id="jquery-ui-core-js"></script>
        <script type="text/javascript" src="{{ asset('js/app.js') }}" id="jquery-ui-core-js"></script>

        <script>
            loaderAnimation();
            loaderDisapper();
            jQuery(document).ready(function ($) {
                new Swiper(".application-swipper", {
                    loop: false,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    speed: 2000,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    slidesPerView: 4,
                    spaceBetween: 10,
                    paginationClickable: true,
                    spaceBetween: 20,
                    breakpoints: {
                        1920: { slidesPerView: 4 },
                        1200: { slidesPerView: 4 },
                        1028: { slidesPerView: 2 },
                        480: { slidesPerView: 1 },
                    },
                });
                circleButton();
                setActiveHover();
                neuSectionAnimation();
                marketingCampaign();
                pinElement();
                // setWrapperMinHeight();
                // navTab();
            });
        </script>

        <script>
            jQuery(document).ready(function ($) {
                // Swiper: Slider
                new Swiper(".fibreboard", {
                    loop: true,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    speed: 2000,
                    nextButton: ".swiper-button-next",
                    prevButton: ".swiper-button-prev",
                    slidesPerView: 3,
                    spaceBetween: 10,
                    paginationClickable: true,
                    spaceBetween: 20,
                    breakpoints: {
                        1920: { slidesPerView: 3 },
                        1200: { slidesPerView: 3 },
                        1028: { slidesPerView: 2 },
                        480: { slidesPerView: 1 },
                    },
                });

                new Swiper(".icon_swipper", {
                    loop: false,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    speed: 2000,
                    nextButton: ".swiper-button-next",
                    prevButton: ".swiper-button-prev",
                    slidesPerView: 4,
                    spaceBetween: 10,
                    paginationClickable: true,
                    spaceBetween: 20,
                    breakpoints: {
                        1920: { slidesPerView: 4 },
                        1200: { slidesPerView: 4 },
                        1028: { slidesPerView: 4 },
                        480: { slidesPerView: 4 },
                    },
                });

                new Swiper(".logos_swipper", {
                    loop: true,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    speed: 2000,
                    nextButton: ".swiper-button-next",
                    prevButton: ".swiper-button-prev",
                    slidesPerView: 1,
                    spaceBetween: 10,
                    paginationClickable: true,
                    spaceBetween: 20,
                    breakpoints: {
                        1920: { slidesPerView: 1 },
                        1200: { slidesPerView: 1 },
                        1028: { slidesPerView: 1 },
                        480: { slidesPerView: 2 },
                    },
                });
            });
        </script>

        <script type="text/javascript" id="elementor-frontend-js-before">
            /* <![CDATA[ */
            var elementorFrontendConfig = {
                environmentMode: { edit: false, wpPreview: false, isScriptDebug: false },
                i18n: {
                    shareOnFacebook: "Share on Facebook",
                    shareOnTwitter: "Share on Twitter",
                    pinIt: "Pin it",
                    download: "Download",
                    downloadImage: "Download image",
                    fullscreen: "Fullscreen",
                    zoom: "Zoom",
                    share: "Share",
                    playVideo: "Play Video",
                    previous: "Previous",
                    next: "Next",
                    close: "Close",
                    a11yCarouselPrevSlideMessage: "Previous slide",
                    a11yCarouselNextSlideMessage: "Next slide",
                    a11yCarouselFirstSlideMessage: "This is the first slide",
                    a11yCarouselLastSlideMessage: "This is the last slide",
                    a11yCarouselPaginationBulletMessage: "Go to slide",
                },
                is_rtl: false,
                breakpoints: { xs: 0, sm: 480, md: 768, lg: 1025, xl: 1440, xxl: 1600 },
                responsive: {
                    breakpoints: {
                        mobile: { label: "Mobile Portrait", value: 767, default_value: 767, direction: "max", is_enabled: true },
                        mobile_extra: { label: "Mobile Landscape", value: 880, default_value: 880, direction: "max", is_enabled: true },
                        tablet: { label: "Tablet Portrait", value: 1024, default_value: 1024, direction: "max", is_enabled: true },
                        tablet_extra: { label: "Tablet Landscape", value: 1200, default_value: 1200, direction: "max", is_enabled: true },
                        laptop: { label: "Laptop", value: 1366, default_value: 1366, direction: "max", is_enabled: true },
                        widescreen: { label: "Widescreen", value: 2400, default_value: 2400, direction: "min", is_enabled: true },
                    },
                    hasCustomBreakpoints: true,
                },
                version: "3.28.3",
                is_static: false,
                experimentalFeatures: {
                    e_font_icon_svg: true,
                    additional_custom_breakpoints: true,
                    container: true,
                    e_local_google_fonts: true,
                    "nested-elements": true,
                    editor_v2: true,
                    e_element_cache: true,
                    home_screen: true,
                },
                urls: { assets: "", ajaxurl: "", uploadUrl: "" },
                nonces: { floatingButtonsClickTracking: "2ccff04513" },
                swiperClass: "swiper",
                settings: { page: [], editorPreferences: [] },
                kit: {
                    active_breakpoints: ["viewport_mobile", "viewport_mobile_extra", "viewport_tablet", "viewport_tablet_extra", "viewport_laptop", "viewport_widescreen"],
                    wcf_enable_preloader: "yes",
                    body_background_background: "classic",
                    global_image_lightbox: "yes",
                    lightbox_enable_counter: "yes",
                    lightbox_enable_fullscreen: "yes",
                    lightbox_enable_zoom: "yes",
                    lightbox_enable_share: "yes",
                    lightbox_title_src: "title",
                    lightbox_description_src: "description",
                    wcf_enable_cursor: "yes",
                    wcf_cursor_breakpoint: "mobile",
                },
                post: { id: 34, title: "", excerpt: "", featuredImage: false },
            };
            /* ]]> */
        </script>
        <script type="text/javascript" src="{{ asset('js/frontend.min.js') }}" id="elementor-frontend-js"></script>

        <!-- Fancybox -->
        <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.min.css') }}" type="text/css" />
        <script src="{{ asset('js/jquery.fancybox.min.js') }}"></script>

        <script>
            // Fancybox Config
            $('[data-fancybox="gallery"]').fancybox({
                buttons: ["slideShow", "thumbs", "zoom", "fullScreen", "close"],
                loop: false,
                protect: true,
            });
        </script>
    </body>
</html>
