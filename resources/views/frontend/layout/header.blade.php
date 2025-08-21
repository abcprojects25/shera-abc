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
        <meta charset="UTF-8" />
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1" /> -->
        <title>{{ $seo->title ?? 'Default Title' }}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="csrf-token" content="{{ csrf_token() }}">

        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="pragma" content="no-cache" />
        <meta name="theme-color" content="#800000" />

        <link rel="icon" type="image/png" href="{{asset('favicon.ico') }}" />
        <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}" />

        <meta name="description" content="{{ $seo->meta_description ?? '' }}"/>
        <meta name="keywords" content="{{ $seo->meta_keywords ?? '' }}" />
        {!! $seo->meta_tag_script ?? '' !!}
        <meta name="robots" content="index, follow" />
        <meta name="revisit-after" content="1 month" />

        <style>
            img:is([sizes="auto" i], [sizes^="auto," i]) {
                contain-intrinsic-size: 3000px 1500px;
            }
        </style>
        <style id="classic-theme-styles-inline-css" type="text/css">
            /*! This file is auto-generated */
            .wp-block-button__link {
                color: #fff;
                background-color: #32373c;
                border-radius: 9999px;
                box-shadow: none;
                text-decoration: none;
                padding: calc(0.667em + 2px) calc(1.333em + 2px);
                font-size: 1.125em;
            }
            .wp-block-file__button {
                background: #32373c;
                color: #fff;
                text-decoration: none;
            }
        </style>

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Teko:wght@300..700&display=swap" rel="stylesheet" />
        <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
    />
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

        <link rel="stylesheet" id="wpo_min-header-0-css" href="{{ asset('css/wpo-minify-header-49bab0b4.min.css?ver=02') }}" type="text/css" media="all" />
        <link rel="stylesheet" id="wpo_min-header-0-css" href="{{ asset('css/wpo-minify-header-8839aa18.min.css?ver=02') }}" type="text/css" media="all" />
        <link rel="stylesheet" href="{{ asset('css/theme.css?ver=02') }}" type="text/css" media="all" />
 <link rel="stylesheet" href="{{ asset('css/magnify.css') }}" />
        <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}" id="jquery-core-js"></script>
        <script type="text/javascript" src="{{ asset('js/jquery-migrate.min.js') }}" id="jquery-migrate-js"></script>
        <script
      type="text/javascript"
      defer
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
      id="jquery-ui-core-js"
    ></script>
           
        <style id="arolax-theme-global-css">
            @media (max-width: 767.98px) {
                .element {  
                    color: #ffbc00;
                }
                body,
                html {
                    overflow-x: hidden;
                }
            }
        </style>
        <style>
            .e-con.e-parent:nth-of-type(n + 4):not(.e-lazyloaded):not(.e-no-lazyload),
            .e-con.e-parent:nth-of-type(n + 4):not(.e-lazyloaded):not(.e-no-lazyload) * {
                background-image: none !important;
            }
            @media screen and (max-height: 1024px) {
                .e-con.e-parent:nth-of-type(n + 3):not(.e-lazyloaded):not(.e-no-lazyload),
                .e-con.e-parent:nth-of-type(n + 3):not(.e-lazyloaded):not(.e-no-lazyload) * {
                    background-image: none !important;
                }
            }
            @media screen and (max-height: 640px) {
                .e-con.e-parent:nth-of-type(n + 2):not(.e-lazyloaded):not(.e-no-lazyload),
                .e-con.e-parent:nth-of-type(n + 2):not(.e-lazyloaded):not(.e-no-lazyload) * {
                    background-image: none !important;
                }
            }
        </style>
        <style type="text/css" id="wp-custom-css">
            .swiper-container {
                overflow: hidden;
            }

            /** Mega Menu CSS Start **/
            @media (min-width: 1200px) {
                .elementor-element-b7b6d24,
                .elementor-element-32eb3e9,
                #menu-item-8361 {
                    position: static !important;
                }
                #menu-item-8361 > .sub-menu {
                    width: 96%;
                    display: grid;
                    grid-template-columns: 1fr 1fr 1fr 1fr;
                    left: 2%;
                    top: 80px;
                    border-radius: 5px;
                    padding: 0;
                }
                #menu-item-8361 .sub-menu .sub-menu {
                    position: static;
                    opacity: 0;
                    visibility: hidden;
                    transform: unset;
                    border-radius: 0;
                    border: 0;
                }
                #menu-item-8361:hover .sub-menu .sub-menu {
                    opacity: 1;
                    visibility: visible;
                }
                #menu-item-8361 > .sub-menu > li {
                    border-right: 1px solid #ddd;
                }
                #menu-item-8361 > .sub-menu > li:last-child {
                    border-right: none;
                }
                #menu-item-8361 > .sub-menu > li > a {
                    border-bottom: 1px solid #ddd;
                    text-transform: uppercase;
                    padding: 18px 30px;
                    pointer-events: none;
                    width: 100%;
                }
                #menu-item-8361 .wcf-submenu-indicator {
                    display: none;
                }
            }
        </style>

         <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.0/dist/fancybox/fancybox.css"
    />   
    </head>

	 <body
        class="home wp-singular page-template page-template-elementor_header_footer page page-id-34 wp-theme-arolax wcf-preloader-active joya-gl-blog arolax-base elementor-default elementor-template-full-width elementor-kit-3 elementor-page elementor-page-34">
       

        <div class="loader-container preloader-container">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="Layer_2" data-name="Layer 2" viewBox="0 0 77.88 28.57">
                <defs>
                    <style>
                        .cls-1 {
                            fill: #00ab4e;
                        }

                        .cls-2 {
                            fill: url(#linear-gradient-2);
                        }

                        .cls-3 {
                            fill: #27b461;
                        }

                        .cls-4 {
                            fill: #231f20;
                        }

                        .cls-5 {
                            fill: #008a3f;
                        }

                        .cls-6 {
                            fill: #00682c;
                        }

                        .cls-7 {
                            fill: #005a24;
                        }

                        .cls-8 {
                            fill: url(#linear-gradient);
                        }
                    </style>
                    <linearGradient id="linear-gradient" x1="40.66" y1=".36" x2="40.66" y2="3.82" gradientUnits="userSpaceOnUse">
                        <stop offset="0" stop-color="#00ab4e" />
                        <stop offset="1" stop-color="#006f30" />
                    </linearGradient>
                    <linearGradient id="linear-gradient-2" x1="37.64" y1="6.12" x2="37.64" y2="16.41" gradientUnits="userSpaceOnUse">
                        <stop offset="0" stop-color="#008a3f" />
                        <stop offset="1" stop-color="#00682c" />
                    </linearGradient>
                </defs>
                <g id="Layer_1-2" data-name="Layer 1">
                    <g id="main-logo">
                        <g>
                            <g>
                                <g>
                                    <g>
                                        <path id="top-part" class="cls-8" d="M38.76.36c-2.44,0-2.93,1.29-3,1.69l-.59,3.33c.15-.5.77-1.55,2.97-1.55h4.68c2.43,0,2.92-1.29,2.99-1.69l.31-1.78h-7.37Z" />
                                        <path
                                            id="middle-part"
                                            class="cls-2"
                                            d="M30.8,11.99c.09-.51.45-.95.91-1.19.45-.23,1.06-.39,1.91-.39h8.04c2.44,0,2.93-1.29,3-1.69l.59-3.33c-.15.5-.76,1.55-2.97,1.55h-8.04c-2.44,0-2.92,1.3-3,1.69l-1.18,6.71c-.07.4-.04,1.69,2.4,1.69h10.74l.62-3.47h-10.75c-.85,0-1.41-.16-1.77-.38-.38-.23-.58-.68-.49-1.19Z"
                                        />
                                    </g>
                                    <path
                                        id="left-shapes"
                                        class="cls-1"
                                        d="M5.54,17.42c-2.22,0-4.51-.27-5.54-.54l.48-2.74c1.42.11,2.94.27,5.12.27,1.89,0,2.77-.56,2.99-1.82.17-.94-.17-1.32-1.62-2l-2.24-1.03c-2.2-1.01-3.47-2.2-2.99-4.96C2.32,1.3,4.84,0,9.06,0c2.22,0,4.05.34,5,.56l-.48,2.69c-1.53-.13-2.96-.27-4.82-.27-1.71,0-2.66.34-2.87,1.48-.15.85.15,1.19,1.57,1.82l2.19.97c2.58,1.14,3.65,2.47,3.19,5.1-.61,3.46-3.25,5.07-7.29,5.07Z"
                                    />
                                    <path
                                        id="right-shapes"
                                        class="cls-1"
                                        d="M54.89,17.04l-2.36-5.95h-2.51l-1.05,5.95h-4.04L47.86.36c1.68-.09,3.36-.2,5.42-.2,4.2,0,7.6.81,6.8,5.39l-.03.16c-.44,2.47-1.66,3.79-3.46,4.6l2.54,6.73h-4.24ZM56.01,5.61c.33-1.89-.67-2.31-3.14-2.31-.54,0-.94,0-1.48.02l-.86,4.85h1.53c2.49,0,3.61-.58,3.93-2.4l.03-.16Z"
                                    />
                                    <g id="center-shapes">
                                        <polygon class="cls-1" points="19.31 7.1 20.5 .36 16.28 .36 13.34 17.04 17.56 17.04 18.75 10.29 24.13 10.29 24.7 7.1 19.31 7.1" />
                                        <polygon class="cls-1" points="28.02 17.04 23.82 17.04 26.76 .36 30.96 .36 28.02 17.04" />
                                    </g>
                                    <path id="bottom-shapes" class="cls-1" d="M71.95.36h-6.99l-7.59,16.68h4.31l1.91-4.2h5.58l.44,4.2h4.09l-1.75-16.68ZM64.96,9.83l2.92-6.42h.3l.67,6.42h-3.89Z" />
                                </g>
                                <g id="details">
                                    <path
                                        class="cls-7"
                                        d="M45.92,1.57s0,0,0,.01c-.15.5-.77,1.52-2.9,1.53-.02,0-4.73,0-4.73,0-2.14,0-2.8.99-2.97,1.51l-.13.76c.15-.5.77-1.55,2.97-1.55h4.68c2.43,0,2.92-1.29,2.99-1.69l.1-.57h0Z"
                                    />
                                    <path class="cls-3" d="M38.67.96h7.36l.11-.6h-7.37c-2.44,0-2.93,1.29-3,1.69l-.1.57c.09-.43.62-1.66,3.01-1.66Z" />
                                    <path class="cls-7" d="M32.56,16.41c-1.96,0-2.4-.83-2.46-1.37l-.05.31c-.07.4-.04,1.69,2.4,1.69h10.74l.11-.63h-10.74Z" />
                                    <path
                                        class="cls-1"
                                        d="M31.23,8.64l-.05.3c.25-.53.97-1.38,2.94-1.38,0,0,8.08,0,8.09,0,2.09-.02,2.73-.99,2.9-1.5,0-.02.01-.04.02-.06l.11-.61c-.15.5-.76,1.55-2.97,1.55h-8.04c-2.44,0-2.92,1.3-3,1.69Z"
                                    />
                                    <path
                                        class="cls-6"
                                        d="M44.77,8.11s0,.01,0,.02c-.09.44-.63,1.63-2.93,1.65-.02,0-8.1,0-8.1,0-.86,0-1.47.16-1.91.39-.45.23-.81.68-.91,1.19l-.11.64h0c.09-.51.45-.95.91-1.19.45-.23,1.06-.39,1.91-.39h8.04c2.44,0,2.93-1.29,3-1.69l.11-.62s0,0,0,0Z"
                                    />
                                    <path
                                        class="cls-5"
                                        d="M30.7,12.53c-.09.51.11.96.49,1.19.36.23.92.38,1.77.38h10.75l.1-.54h-10.75c-.85,0-1.41-.16-1.77-.38-.38-.23-.58-.68-.49-1.19h0s-.09.54-.09.54Z"
                                    />
                                </g>
                            </g>
                        </g>
                    </g>
                </g>
            </svg>
        </div>

        <div id="wcf--top--scroll" hidden></div>

        <div id="smooth-wrapper">
            <div id="smooth-content">
                <div id="page" class="hfeed site">
                    
                    @include('frontend.layout.nav')