// jQuery(document).ready(function ($) {
//     /*Size is  set in pixels... supports being written as: '250px' */
//     var magnifierSize = 200;

//     /*How many times magnification of image on page.*/
//     var magnification = 3;

//     function magnifier() {
//         this.magnifyImg = function (ptr, magnification, magnifierSize) {
//             var $pointer;
//             if (typeof ptr == "string") {
//                 $pointer = $(ptr);
//             } else if (typeof ptr == "object") {
//                 $pointer = ptr;
//             }

//             if (!$pointer.is("img")) {
//                 // alert("Object must be image.");
//                 return false;
//             }

//             magnification = +magnification;

//             $pointer.hover(
//                 function () {
//                     $(this).css("cursor", "none");
//                     $(".magnify").show();
//                     //Setting some variables for later use
//                     var width = $(this).width();
//                     var height = $(this).height();
//                     var src = $(this).attr("src");
//                     var imagePos = $(this).offset();
//                     var image = $(this);

//                     if (magnifierSize == undefined) {
//                         magnifierSize = "150px";
//                     }

//                     $(".magnify").css({
//                         "background-size": width * magnification + "px " + height * magnification + "px",
//                         "background-image": 'url("' + src + '")',
//                         width: magnifierSize,
//                         height: magnifierSize,
//                     });

//                     //Setting a few more...
//                     var magnifyOffset = +($(".magnify").width() / 2);
//                     var rightSide = +(imagePos.left + $(this).width());
//                     var bottomSide = +(imagePos.top + $(this).height());

//                     $(document).mousemove(function (e) {
//                         if (
//                             e.pageX < +(imagePos.left - magnifyOffset / 6) ||
//                             e.pageX > +(rightSide + magnifyOffset / 6) ||
//                             e.pageY < +(imagePos.top - magnifyOffset / 6) ||
//                             e.pageY > +(bottomSide + magnifyOffset / 6)
//                         ) {
//                             $(".magnify").hide();
//                             $(".magnify").unbind("mousemove");
//                         }
//                         var backgroundPos = "" - ((e.pageX - imagePos.left) * magnification - magnifyOffset) + "px " + -((e.pageY - imagePos.top) * magnification - magnifyOffset) + "px";
//                         $(".magnify").css({
//                             left: e.pageX - magnifyOffset,
//                             top: e.pageY - magnifyOffset,
//                             "background-position": backgroundPos,
//                         });
//                     });
//                 }
//                 // function () {}
//             );
//         };

//         this.init = function () {
//             $("body").prepend('<div class="magnify"></div>');
//         };

//         return this.init();
//     }

//     var magnify = new magnifier();
//     magnify.magnifyImg(".magnify-image", magnification, magnifierSize);
// });

// jQuery(document).ready(function ($) {
//     var $loupe = $(".loupe"),
//         loupeWidth = $loupe.width(),
//         loupeHeight = $loupe.height();

//     $(document).on("mouseenter", ".image", function (e) {
//         var $currImage = $(this),
//             $img = $("<img/>")
//                 .attr("src", $("img", this).attr("src"))
//                 .css({ width: $currImage.width() * 2, height: $currImage.height() * 2, scale: 4 });

//         $loupe.html($img).fadeIn(100);

//         $(document).on("mousemove", moveHandler);

//         function moveHandler(e) {
//             var imageOffset = $currImage.offset(),
//                 fx = imageOffset.left - loupeWidth / 2,
//                 fy = imageOffset.top - loupeHeight / 2,
//                 fh = imageOffset.top + $currImage.height() + loupeHeight / 2,
//                 fw = imageOffset.left + $currImage.width() + loupeWidth / 2;

//             $loupe.css({
//                 left: e.pageX - 75,
//                 top: e.pageY - 75,
//             });

//             var loupeOffset = $loupe.offset(),
//                 lx = loupeOffset.left,
//                 ly = loupeOffset.top,
//                 lw = lx + loupeWidth,
//                 lh = ly + loupeHeight,
//                 bigy = (ly - loupeHeight / 4 - fy) * 2,
//                 bigx = (lx - loupeWidth / 4 - fx) * 2;

//             $img.css({ left: -bigx, top: -bigy });

//             if (lx < fx || lh > fh || ly < fy || lw > fw) {
//                 $img.remove();
//                 $(document).off("mousemove", moveHandler);
//                 $loupe.fadeOut(100);
//             }
//         }
//     });
// });

// jQuery(document).ready(function ($) {
//     $(document).ready(function () {
//         // Initiate magnification powers
//         $(".zoom").magnify({
//             afterLoad: function () {
//                 console.log("Magnification powers activated!");
//             },
//         });
//     });
// });

const circleButton = () => {
    const parentContainer = document.querySelector(".home_projects");
    const button = document.querySelector(".circle_div");
    let tween = null;

    parentContainer.addEventListener("mousemove", (event) => {
        const bounds = parentContainer.getBoundingClientRect();

        const relX = event.clientX - bounds.left - bounds.width / 2;
        const relY = event.clientY - bounds.top - bounds.height / 2;

        const magneticForce = 0.1;
        const maxOffset = 50;

        const offsetX = Math.max(Math.min(relX * magneticForce, maxOffset), -maxOffset);
        const offsetY = Math.max(Math.min(relY * magneticForce, maxOffset), -maxOffset);

        // Kill previous tween if still active
        if (tween) tween.kill();

        // Start a new one with short duration
        tween = gsap.to(button, {
            x: offsetX,
            y: offsetY,
            duration: 1,
            ease: "power3.out",
        });
    });

    parentContainer.addEventListener("mouseleave", () => {
        gsap.to(button, {
            x: 0,
            y: 0,
            duration: 0.4,
            ease: "power3.out",
        });
    });
};

const navTab = () => {
    const tabs = document.querySelectorAll(".tab");
    const products = document.querySelectorAll(".sherapro-product");

    tabs.forEach((tab) => {
        tab.addEventListener("click", () => {
            if (tab.classList.contains("active")) return;

            // Remove active tab and product
            tabs.forEach((t) => t.classList.remove("active"));
            products.forEach((p) => p.classList.remove("active"));

            const targetId = tab.dataset.target;
            const targetProduct = document.getElementById(targetId);

            // Animate out all products
            gsap.to(products, {
                duration: 0.3,
                opacity: 0,
                y: -20,
                onComplete: () => {
                    // Set active tab and product
                    tab.classList.add("active");
                    targetProduct.classList.add("active");

                    // Animate in new product
                    gsap.fromTo(targetProduct, { opacity: 0, y: 20 }, { duration: 0.4, opacity: 1, y: 0, ease: "power2.out" });
                },
            });
        });
    });
};

const setWrapperMinHeight = () => {
    const wrapper = document.querySelector(".navtab-wrapper");
    const tabs = wrapper.querySelector(".tabs");
    const products = document.querySelectorAll(".sherapro-product");

    let maxProductHeight = 0;

    products.forEach((product) => {
        const wasHidden = !product.classList.contains("active");
        if (wasHidden) {
            product.style.display = "block";
            product.style.visibility = "hidden";
            product.style.position = "absolute";
        }

        const height = product.offsetHeight;
        if (height > maxProductHeight) maxProductHeight = height;

        if (wasHidden) {
            product.style.display = "";
            product.style.visibility = "";
            product.style.position = "";
        }
    });

    const tabsHeight = tabs.offsetHeight;
    const totalMinHeight = tabsHeight + maxProductHeight + 50;

    wrapper.style.minHeight = `${totalMinHeight}px`;
};

const setActiveHover = () => {
    const productWrappers = document.querySelectorAll(".product-wrapper");

    productWrappers.forEach((element) => {
        element.addEventListener("mouseenter", () => {
            // productWrappers.forEach((el) => el.classList.remove("active"));

            document.querySelector(".product-wrapper.active").classList.remove("active");

            // Add 'active' to current hovered
            element.classList.add("active");
        });
    });
};

const neuSectionAnimation = () => {
    const section = document.querySelector(".Fibre_cementBoard");
    const leafElement = section.querySelector(".leaf");
    const logoElement = section.querySelector(".thumb .logo");
    const textElement = section.querySelector(".thumb .g-title");
    const sheetElement = section.querySelector(".sheet");
    const fiberBoardElement = section.querySelector(".fibreboard");
    const techImage = section.querySelector(".tech");
    const exploreButton = section.querySelector(".explore-shera-neu");
    const animationTimeline = gsap.timeline({
        ScrollTrigger: {
            trigger: section,
            scroller: "body",
            start: "top 45%",
            end: "top 45%",
            toggleActions: "play none none none",
            // markers: true,
        },
    });

    animationTimeline
        .from(
            logoElement,
            {
                y: 200,
                scale: 1,
                opacity: 1,
                duration: 1.2,
                ease: "power4.out",
            },
            "text-logo"
        )
        .from(
            textElement,
            {
                y: 200,
                scale: 2,
                opacity: 0,
                duration: 1,
                ease: "power4.out",
            },
            "text-logo"
        )
        .from(
            techImage,
            {
                y: 200,
                opacity: 0,
                duration: 1,
                ease: "power4.out",
            },
            "text-card"
        )
        .from(
            sheetElement,
            {
                rotateY: 110,
                scale: 1,
                duration: 1,
                opacity: 0,
                ease: "power4.out",
            },
            "text-card"
        )
        .from(
            leafElement,
            {
                opacity: 0,
                scale: 0.2,
                duration: 1,
                ease: "power4.out",
            },
            "text-card"
        )
        .from(
            fiberBoardElement,
            {
                opacity: 0,
                y: 0,
                duration: 3,
                delay: 0.2,
                ease: "power4.out",
            },
            "swiper-button"
        )
        .from(
            exploreButton,
            {
                opacity: 0,
                y: 30,
                duration: 1.5,
                delay: 0.2,
                ease: "power4.out",
            },
            "swiper-button"
        );
};

const marketingCampaign = () => {
    const section = document.querySelector(".marketing_cmpg");
    const taglineImg = section.querySelector(".tagline-image img");
    const taglineText = section.querySelector(".tagline-image .text-box");
    const iconImage = section.querySelector(".icon-image img");
    const floatingImage = section.querySelector(".floating-image");

    const animationTimeline = gsap.timeline({
        ScrollTrigger: {
            trigger: section,
            scroller: "body",
            start: "top 45%",
            end: "top 45%",
            toggleActions: "play none none none",
        },
    });

    animationTimeline
        .from(taglineImg, {
            opacity: 0,
            scale: 1.3,
            duration: 2,
            y: 30,
            ease: "power4.out",
        })
        .from(
            iconImage,
            {
                opacity: 0,
                duration: 2,
                y: 0,
                ease: "power4.out",
            },
            "=-1"
        )
        .from(
            taglineText,
            {
                opacity: 0,
                duration: 2,
                y: 30,
                scale: 1.2,
                ease: "power4.out",

                // onComplete: () => {
                //     const image1 = document.querySelector(".front");
                //     const image2 = document.querySelector(".back");

                //     image1.style.animation = "flip 3s infinite linear alternate";
                //     image2.style.animation = "flipp 3s infinite linear alternate";

                //     setTimeout(() => {
                //         image1.style.transform = "rotateX(100deg)";
                //         image2.style.transform = "rotateX(0deg)";
                //         image1.style.animation = "";
                //         image2.style.animation = "";
                //     }, 3000);
                // },
            },
            "=-3"
        );
};

const loaderAnimation = () => {
    // Animation timeline
    const tl = gsap.timeline({ defaults: { ease: "power2.out", repeat: -1, repeatDelay: 1, yoyo: true } });

    // Animate the logo parts sequentially
    tl.set(".preloader-container svg", {
        opacity: 1,
    })
        .from("#left-shapes, #right-shapes, #center-shapes, #bottom-shapes", {
            // Animate the logo parts sequentially
            duration: 0.6,
            opacity: 0,
            y: 20,

            stagger: 0.1,
        })
        .from(
            "#top-part, #middle-part",
            {
                duration: 0.5,
                opacity: 0,
                scale: 0.8,

                transformOrigin: "center center",
            },
            "-=0.3"
        );
    // .from(
    //     "#details path",
    //     {
    //         duration: 0.4,
    //         opacity: 0,
    //         scale: 0.9,

    //         stagger: 0.05,
    //     },
    //     "-=0.2"
    // )
    // .from(
    //     "#text path",
    //     {
    //         duration: 0.3,
    //         opacity: 0,
    //         y: 10,

    //         stagger: 0.02,
    //     },
    //     "-=0.2"
    // );

    // Add a subtle pulse effect to the green parts
    // tl.to(
    //     ".wcf-preloader .cls-1, .wcf-preloader .cls-2, .wcf-preloader .cls-3, .wcf-preloader .cls-5, .wcf-preloader .cls-6, .wcf-preloader .cls-7, .wcf-preloader .cls-8",
    //     {
    //         duration: 1.5,
    //         scale: 1.02,

    //         repeat: -1,
    //         ease: "sine.inOut",
    //         stagger: 0.1,
    //     },
    //     "+=0.5"
    // );

    // Add a subtle glow effect on hover
    // document.querySelector("svg").addEventListener("mouseenter", () => {
    //     gsap.to("svg", {
    //         duration: 0.3,
    //         filter: "drop-shadow(0 0 15px rgba(0, 171, 78, 0.5))",
    //         scale: 1.02,
    //     });
    // });

    // document.querySelector("svg").addEventListener("mouseleave", () => {
    //     gsap.to("svg", {
    //         duration: 0.3,
    //         filter: "drop-shadow(0 0 10px rgba(0, 171, 78, 0.3))",
    //         scale: 1,
    //     });
    // });
};

const loaderDisapper = () => {
    const loaderBox = document.querySelector(".loader-container");
    document.addEventListener("DOMContentLoaded", () => {
        console.log("everything loaded");
        setTimeout(() => {
            document.querySelector("body").classList.remove("wcf-preloader-active");
            const tl = gsap.timeline();
            tl.to(loaderBox, {
                opacity: 0,
                duration: 1,
                ease: "power3.out",
                onComplete: () => {
                    loaderBox.style.display = "none";
                },
            });
        }, 1500);
    });
};

const pinElement = () => {
    // Select the HTML elements needed for the animation
    const scrollSection = document.querySelectorAll(".scroll-section");

    scrollSection.forEach((section) => {
        const wrapper = section.querySelector(".wrapper");
        const items = Array.from(wrapper.querySelectorAll(".item"));

        // Initialize
        let direction = null;

        if (section.classList.contains("vertical-section")) {
            direction = "vertical";
        } else if (section.classList.contains("horizontal-section")) {
            direction = "horizontal";
        }

        initScroll(section, items, direction);
    });

    function initScroll(section, items, direction) {
        // Initial states
        items.forEach((item, index) => {
            if (index !== 0) {
                direction == "horizontal" ? gsap.set(item, { xPercent: 100 }) : gsap.set(item, { yPercent: 100 });
            }
        });

        const timeline = gsap.timeline({
            ScrollTrigger: {
                trigger: section,
                pin: true,
                start: "top top",
                end: () => `+=${(items.length - 1) * 100}%`,
                scrub: 1,
                invalidateOnRefresh: true,
                // markers: true,
            },
            defaults: { ease: "none" },
        });
        items.forEach((item, index) => {
            const tempItem = index + 1;
            timeline.to(item, {
                scale: 1,
                borderRadius: "10px",
            });

            direction == "horizontal"
                ? timeline.to(
                      items[index + 1],
                      {
                          xPercent: tempItem * 2,
                      },
                      "<"
                  )
                : timeline.to(
                      items[index + 1],
                      {
                          yPercent: tempItem * 2,
                      },
                      "<"
                  );
        });
    }
};

const sheraFilter = () => {
    const tabs = document.querySelectorAll(".nav-tab-wrapper .nav-tabs .tab");
    const products = document.querySelectorAll(".nav-tab-wrapper .tab-body-wrapper .tab-body");

    tabs.forEach((tab) => {
        tab.addEventListener("click", () => {
            if (tab.classList.contains("active")) return;

            // Remove active tab and product
            tabs.forEach((t) => t.classList.remove("active"));
            products.forEach((p) => p.classList.remove("active"));

            const targetId = tab.dataset.target;
            const targetProduct = document.getElementById(targetId);

            // Animate out all products
            gsap.to(products, {
                duration: 0.3,
                opacity: 0,
                y: -20,
                onComplete: () => {
                    // Set active tab and product
                    tab.classList.add("active");
                    targetProduct.classList.add("active");

                    // Animate in new product
                    gsap.fromTo(
                        targetProduct,
                        { opacity: 0, y: 20 },
                        {
                            duration: 0.4,
                            opacity: 1,
                            y: 0,
                            ease: "power2.out",
                            onComplete: () => {
                                ScrollSmoother.get().paused(true);
                                // Refresh ScrollTrigger after the animation is done
                                // Delay refresh to next frame so layout is stable
                                requestAnimationFrame(() => {
                                    ScrollSmoother.get().refresh(); // optional
                                    ScrollTrigger.refresh();

                                    setTimeout(() => {
                                        ScrollSmoother.get().paused(false);
                                    }, 500);
                                });
                            },
                        }
                    );
                },
            });
        });
    });
};

const scrollCards = () => {
    const cards = Array.from(document.querySelectorAll("[data-scroll-card]"));

    cards.forEach((card, index) => {
        // Animate the current card out
        gsap.from(card, {
            y: -100,
            opacity: 0,
            scale: 0.1,
            ease: "power2.out",
            ScrollTrigger: {
                trigger: card,
                start: "top 60%",
                end: "bottom 50%",
                scrub: 5,
                toggleActions: "play none none none",
                // markers: true,
            },
        });
    });
};

const gsapAos = () => {
    const animatingElements = Array.from(document.querySelectorAll("[data-aos]"));

    animatingElements.forEach((element, index) => {
        console.log(element);
        gsap.from(element, {
            opacity: 0,
            y: 50,
            duration: element.dataset.duration || 1,
            delay: element.dataset.delay || 0,
            ScrollTrigger: {
                trigger: element,
                scroller: "body",
                start: "top 85%",
                end: "top 85%",
                // markers: true,
            },
        });
    });
};

const test = () => {
    const arr = [69, 99, 11, 55, 30, 35, 77, 50, 46];
    const sortedArray = [];

    for (let i = 0; i < arr.length; i++) {
        setTimeout(() => {
            console.log(arr[i]);
            sortedArray.push(arr[i]);
            console.log(sortedArray);
        }, arr[i]);
    }
};
test();

const lerpButton = () => {
    const allButtons = Array.from(document.querySelectorAll(".lerp-button"));

    allButtons.forEach((button, index) => {
        const hoverSpan = button.querySelector("span");
        let rect = button.getBoundingClientRect();
        button.addEventListener("mouseenter", (e) => {
            console.log("wewe");
            gsap.to(hoverSpan, {
                top: `${(e.clientY - rect.top) * 0.1}px`,
                left: `${(e.clientX - rect.left) * 0.1}px`,
                // top: `${e.clientY}px`,
                // left: `${e.clientX}px`,
                width: "400px",
                height: "400px",
                duration: 1,
            });
        });
        button.addEventListener("mouseleave", (e) => {
            console.log("wewe");
            gsap.to(hoverSpan, {
                top: `${(e.clientY - rect.top) * 0.1}px`,
                left: `${(e.clientX - rect.left) * 0.1}px`,
                // top: `${e.clientY}px`,
                // left: `${e.clientX}px`,
                width: "0",
                height: "0",
                duration: 1,
            });
        });
    });
};
