
//smooth scroll
var containerEl = document.querySelector(".scroll-container");
var Header = document.querySelector(".header");
var Whatsapp = document.querySelector(".whatsappdesktop");
var Main = document.querySelector("main");
var multiplier = 1.5;
var lerp = 0.05; // для FF
var mediaQuery = window.matchMedia("(max-width: 992px)");

if (mediaQuery.matches) {
  multiplier = 2;
  lerp = 0.07;
}

// Initialize Locomotive Scroll
var locoScroll = new LocomotiveScroll({
  el: document.querySelector(".scroll-container"),
  smooth: true,
  lerp: 0.1, // Adjust lerp to make scrolling smooth
  smartphone: {
    smooth: true
  },
  tablet: {
    smooth: true
  }
});
gsap.registerPlugin(ScrollTrigger);
gsap.registerPlugin(SplitText);


// Tell ScrollTrigger to use Locomotive Scroll as a proxy for native scrolling
ScrollTrigger.scrollerProxy(".scroll-container", {
  scrollTop(value) {
    return arguments.length ? locoScroll.scrollTo(value, 0, 0) : locoScroll.scroll.instance.scroll.y;
  },
  getBoundingClientRect() {
    return {
      top: 0,
      left: 0,
      width: window.innerWidth,
      height: window.innerHeight
    };
  },
  pinType: document.querySelector(".scroll-container").style.transform ? "transform" : "fixed"
});

locoScroll.on("scroll", ScrollTrigger.update);

// Apply the header background change after scrolling a bit
// Initialize ScrollTrigger to update on scroll changes
ScrollTrigger.create({
  trigger: ".scroll-container", 
  start: "top top",
  end: "max",
  onUpdate: (self) => {
    // Use ScrollTrigger's scroll position instead of accessing Locomotive Scroll directly
    const scrollY = self.scroll(); 
    
    console.log('Scroll Position:', scrollY); // Debugging line to verify scroll position

    if (scrollY > 0.4) {
      $('.header').addClass('bgcolor_add'); // Add background color when scrolling past 10px
      console.log("Adding bgcolor_add class"); // Debugging
      //alert(1);
    } else {
      $('.header').removeClass('bgcolor_add'); // Remove background color when scrolling back up
      console.log("Removing bgcolor_add class"); // Debugging
      //alert(2);
    }
  },
  scroller: ".scroll-container",
  scrub: true
});

// Make sure ScrollTrigger and Locomotive Scroll are synced
locoScroll.on("scroll", ScrollTrigger.update);
ScrollTrigger.addEventListener("refresh", () => locoScroll.update());
ScrollTrigger.refresh();

//pinning or stick header and whatsapp icon 

// Calculate the total height of the body or the main content
var bodyHeight = document.body.scrollHeight;
var viewportHeight = window.innerHeight;

// Function to refresh the scroll and triggers after load
function refreshScroll() {
  locoScroll.update(); // Update Locomotive Scroll
  ScrollTrigger.refresh(); // Refresh ScrollTrigger
}

// Sticky header using GSAP
gsap.to(".header", {
  scrollTrigger: {
    trigger: Header, // Use the header element as the trigger
    start: "top top", // Pin when the header reaches the top of the viewport
    end: () => document.body.scrollHeight - window.innerHeight + "px", // Sticky until the page reaches the end
    pin: true, // Pin the header to make it sticky
    pinSpacing: false, // Prevent extra spacing below the header when it's pinned
    markers: false, // Enable markers for debugging (remove in production)
  },
});

// WhatsApp icon position using GSAP
gsap.to(".whatsappdesktop", {
  scrollTrigger: {
    trigger: "body", // Use the main scroll container for smooth scrolling
    start: "top 30%", // Start pinning at the top of the page
    end: "100% bottom", // Keep it pinned until the bottom of the page
    onUpdate: (self) => {
      // Dynamically update the WhatsApp icon position using GSAP
      gsap.set(".whatsappdesktop", {
        x: window.innerWidth - 80, // Calculate the position from the right edge
        y: window.innerHeight - 100 // Calculate the position from the bottom edge
      });
    },
    pin: false, // Don't use pinning, just position it with GSAP
    scrub: true, // Make the changes follow the scroll
    markers: false, // Enable markers for debugging (remove in production)
  }
});

// Add a load event listener to ensure everything is initialized correctly
window.addEventListener('load', () => {
  // Refresh ScrollTrigger and Locomotive Scroll after full load
  refreshScroll();
});

// Optional: also listen for window resize, as mobile can behave differently on resize
window.addEventListener('resize', () => {
  refreshScroll();
});







// Function to override body's transform property when Fancybox is open
function checkFancyboxPresence() {
  var fancyboxExists = document.querySelector('.fancybox-container') !== null;
  
  if (fancyboxExists) {
      // Disable GSAP transform when Fancybox is open
      document.body.style.transform = 'matrix3d(0, 0, 0) !important';
  } else {
      // Re-enable GSAP transform when Fancybox is closed
      locoScroll.update(); // Reapply LocomotiveScroll transform settings
  }
}

// For continuous checking in case Fancybox adds/removes its container asynchronously
setInterval(checkFancyboxPresence, 500); // Polling every 500ms to ensure accurate state


// preloader

document.addEventListener("DOMContentLoaded", () => {
  const loader = document.querySelector(".preloader");
  const header = document.getElementById("header");
  const content = document.getElementById("home_page");
  const mainLogo = document.querySelector(".main_logo");

  // Only apply the scroll restrictions on the home page (when preloader exists)
  if (loader && content) {
    // Disable scrolling and remove any transform on body while preloader is active
    document.body.classList.add('no-scroll', 'no-transform');

    // Initialize GSAP Timeline
    const tl = gsap.timeline({
      onComplete: () => {
        // Hide the loader and show the content after animation
        if (content) {
          content.style.display = "block";
        }
        loader.style.display = "none";

        // Re-enable scrolling and reset body transformations after preloader
        document.body.classList.remove('no-scroll', 'no-transform');
      },
    });

    // Add animations to the timeline
    tl.set(".preloader svg path", {
      strokeDasharray: 4500,
      strokeDashoffset: 4500,
      fillOpacity: 0,
      stroke: "#ffffff",
    })
      .to(".preloader svg", {
        opacity: 1,
        duration: 0.5, // Fade-in duration for SVG
      })
      .to(".preloader svg path", {
        strokeDashoffset: 0,
        fillOpacity: 1,
        duration: 3,
        ease: "cubic.inOut",
      })
      .to(loader, {
        opacity: 0,
        duration: 0.5, // Fade-out duration for preloader
        delay: 0.5, // Delay to ensure the path animation is complete
      });

    // Check and animate mainLogo if it exists
    if (mainLogo) {
      tl.fromTo(
        mainLogo,
        {
          opacity: 0,
          y: 50, // Start position (below the initial position)
        },
        {
          opacity: 1,
          y: 0, // End position (normal position)
          duration: 1, // Duration of the fade and move-up animation
          ease: "power3.out",
        },
        "-=0.5" // Overlap with preloader fade-out
      );
    }

    // Check and animate header if it exists
    if (header) {
      tl.fromTo(
        header,
        {
          opacity: 0,
          y: -50, // Start position (above the initial position)
        },
        {
          display: "block",
          opacity: 1,
          y: 0, // End position (normal position)
          duration: 1, // Duration of the fade and move-up animation
          ease: "back.out",
        },
        "-=0.5" // Overlap with preloader fade-out
      );
    }
  }


  // for music lines
  // Function to create bars for music lines
  function createMusicBars() {
    // Function to create bars for a given container
    function createBars(containerId, count, spacing) {
      const container = document.querySelector(containerId);
      if (container) {
        // Check if the container exists
        container.innerHTML = ''; // Clear any existing bars
        for (let i = 0; i < count; i++) {
          const left = i * spacing + 1;
          const anim = Math.floor(Math.random() * 75 + 500);
          const height = Math.floor(Math.random() * 25 + 30);
  
          container.innerHTML += `<div class="bar" style="left:${left}vw; animation-duration:${anim}ms; height:${height}vw"></div>`;
        }
      }
    }
  
    // Check screen width to adjust bar count for #bars8 and #bars9 in mobile view
    const isMobile = window.innerWidth < 768;
  
    // Create bars for each container
    createBars("#bars1", 120, 0.3);
    createBars("#bars2", 120, 0.3);
    createBars("#bars3", 200, 0.8);
    createBars("#bars4", 120, 0.3);
    createBars("#bars5", 80, 0.3);
    createBars("#bars6", 57, 0.3);
    createBars("#bars7", 57, 0.3);
  
    // Show only 20 bars for #bars8 and #bars9 in mobile view, otherwise full count
    createBars("#bars8", isMobile ? 20 : 45, 0.3);
    createBars("#bars9", isMobile ? 20 : 45, 0.3);
  
    createBars("#bars10", 200, 0.8); 
    createBars("#bars11", isMobile ? 60 : 80, 0.3);
    createBars("#bars12", isMobile ? 60 : 80, 0.3);
  }
  

  createMusicBars();

  // link with image hover effect
  const filmLinks = document.querySelectorAll(".film_link");
  const filmImages = document.querySelectorAll(".film_img");

  function moveImg(e) {
    const mouseX = e.clientX;
    const mouseY = e.clientY;

    gsap.to(filmImages, {
      duration: 1,
      x: mouseX - window.innerWidth / 1.7,
      y: mouseY - window.innerHeight / 2,
      ease: "expo.ease",
    });
  }

  // Function to create the animation for all elements with the class 'main_name'
  function setupMainNameAnimation() {
    const mainNameElements = document.querySelectorAll(".main_name"); // Select all elements with the class

    // Check if there are any elements
    if (mainNameElements.length) {
      mainNameElements.forEach((mainNameElement) => {
        const tl = gsap.timeline({
          scrollTrigger: {
            trigger: mainNameElement, // Use the element itself as the trigger
            start: "top bottom", // Start when the top of the element is at the bottom of the viewport
            end: "bottom top", // End when the bottom of the element reaches the top of the viewport
            markers: false, // Set markers to debug start and end points
            //scrub: 1, // Uncomment to scrub the animation with scroll
          },
        });

        tl.fromTo(
          mainNameElement,
          { x: "100%", opacity: 0 }, // Starting state (offscreen to the right and transparent)
          { x: "0%", opacity: 1, duration: 1, ease: "back2.out" } // Ending state (onscreen and fully visible)
        );
      });
    }
  }

  // Call the function
  setupMainNameAnimation();

  function linkHover(e) {
    const imgId = this.parentElement.getAttribute("data-img");
    if (e.type === "mouseenter") {
      filmImages.forEach((img) => {
        gsap.to(img, {
          autoAlpha: 0,
          scale: 0.3,
          rotation: 0, // Reset rotation to 0 for all images
        });
        img.classList.remove("active"); // Remove 'active' class from all images
      });

      const activeImg = document.getElementById(imgId);
      gsap.to(activeImg, {
        autoAlpha: 1,
        scale: 1,
        rotation: 10, // Rotate the active image by 10 degrees
      });
      activeImg.classList.add("active"); // Add 'active' class to the shown image
    } else if (e.type === "mouseleave") {
      gsap.to(filmImages, {
        autoAlpha: 0,
        scale: 0.3,
        rotation: 0, // Reset rotation on mouse leave
      });
    }
  }

  filmLinks.forEach((link) => {
    link.addEventListener("mouseenter", linkHover);
    link.addEventListener("mouseleave", linkHover);
    link.addEventListener("mousemove", moveImg);
  });

  // Check if SplitText is available
  if (typeof SplitText !== "undefined") {
    // Example usage of SplitText
    document.querySelectorAll(".animated-heading").forEach((element) => {
      // Trim leading and trailing whitespaces
      element.innerHTML = element.innerHTML.trim();

      const split = new SplitText(element, {
        linesClass: "split-line",
        type: "lines, words, chars",
      });

      // Remove any empty lines before the animation starts
      element.querySelectorAll(".split-line").forEach((line) => {
        if (!line.textContent.trim()) {
          line.remove(); // Remove empty split lines
        }
      });

      // GSAP animation with ScrollTrigger
      gsap.from(split.chars, {
        y: 100,
        stagger: 0.1,
        delay: 0.2,
        ease: "back.out",
        duration: 1,
        scrollTrigger: {
          trigger: element,
          once: true,
          start: "top bottom", // When the top of the trigger element reaches the bottom of the viewport
          end: "bottom center", // When the bottom of the trigger element reaches the top of the viewport
          scrub: 1, // Smoothly scrubs the animation
          markers: false, // Enable markers for debugging (optional)
          onComplete: () => {
            // Clean up to prevent spacing issues after animation (if needed)
            split.revert();
          },
        },
      });
    });

    // Example usage of SplitText
    document.querySelectorAll(".animated-para p").forEach((element) => {
      // Trim leading and trailing whitespaces
      element.innerHTML = element.innerHTML.trim();

      const split = new SplitText(element, {
        linesClass: "split-line",
        type: "lines, words",
      });
      // Remove any empty lines before the animation starts
      element.querySelectorAll(".split-line").forEach((line) => {
        if (!line.textContent.trim()) {
          line.remove(); // Remove empty split lines
        }
      });
      // GSAP animation with ScrollTrigger
      gsap.from(split.words, {
        duration: 0.8,
        opacity: 0,
        y: 80,
        ease: "in",
        stagger: 0.01,
        scrollTrigger: {
          trigger: element,
          once: true,
          start: "top bottom", // When the top of the trigger element reaches the bottom of the viewport
          end: "bottom center", // When the bottom of the trigger element reaches the top of the viewport
          scrub: 1, // Smoothly scrubs the animation
          markers: false, // Enable markers for debugging (optional)
        },
        onComplete: () => {
          // Clean up to prevent spacing issues after animation (if needed)
          split.revert();
        },
      });
    });
  } else {
    console.error("SplitText plugin is not available.");
  }

  // Function to animate clip-path for multiple images
  function setupClipPathAnimation() {
    gsap.utils.toArray(".reveal-img-top").forEach((img) => {
      gsap.fromTo(
        img,
        {
          clipPath: "polygon(0 0, 100% 0, 100% 0, 0 0)", // Initial state (invisible, clipped to top)
        },
        {
          clipPath: "polygon(0 0, 100% 0, 100% 100%, 0 100%)", // Final state (revealed from top to bottom)
          duration: 1,
          ease: "ease.inOut",
          scrollTrigger: {
            trigger: img.parentElement, // Trigger based on the parent container of the image
            start: "top bottom", // Starts when the container reaches the center of the viewport
            once: true, // Animation runs only once
            markers: false, // Set markers to debug start and end points
          },
        }
      );
    });
  }

  // Call the function
  setupClipPathAnimation();

  function splitTexthalf(selector) {
    var elements = document.querySelectorAll(selector);

    elements.forEach(function (element) {
      var text = element.textContent;
      var splittedText = text.split("");
      var halfValue = Math.ceil(splittedText.length / 2);

      var clutter = "";

      splittedText.forEach(function (char, index) {
        // Replace spaces with non-breaking spaces to ensure they are visible
        if (char === " ") {
          char = "&nbsp;";
        }
        if (index < halfValue) {
          clutter += `<span class="char1">${char}</span>`;
        } else {
          clutter += `<span class="char2">${char}</span>`;
        }
      });

      element.innerHTML = clutter;
    });
  }
  splitTexthalf(".heading-anim");

  function animateText(selector) {
    // General ScrollTrigger options
    const scrollTriggerOptions = {
      start: "top 90%", // Adjust based on when you want the animation to start
      end: "center 80%",
      scrub: false,
      once: true,
      markers: false, // Remove or set to false in production
    };

    // Select all elements matching the selector
    document.querySelectorAll(selector).forEach((element) => {
      // Animate chars within each element
      gsap.from(element.querySelectorAll("span.char1"), {
        y: 100,
        opacity: 0,
        stagger: -0.1,
        ease: "back.out",
        duration: 0.2,
        scrollTrigger: {
          ...scrollTriggerOptions,
          trigger: element, // Set specific trigger for each element
        },
      });

      gsap.from(element.querySelectorAll("span.char2"), {
        y: 100,
        opacity: 0,
        stagger: 0.1,
        ease: "back.out",
        duration: 0.2,
        scrollTrigger: {
          ...scrollTriggerOptions,
          trigger: element, // Set specific trigger for each element
        },
      });
    });
  }
  animateText(".heading-anim");

  // Function to create the scale-up animation
  function setupScaleUpAnimation() {
    gsap.utils.toArray(".scaleup-element").forEach((element) => {
      gsap.fromTo(
        element,
        { scale: 0 }, // Starting state
        {
          scale: 1, // Ending state
          scrollTrigger: {
            trigger: element,
            start: "top bottom", // Adjust start and end points as needed
            end: "bottom 40%",
            scrub: true, // Scrubs animation with scroll
            markers: false,
          },
        }
      );
    });
  }

  setupScaleUpAnimation();

  // Function to create the scale-up animation
  function setupLeftscaleUpAnimation() {
    gsap.utils.toArray(".left-scaleup-element").forEach((element) => {
      const tl2 = gsap.timeline({
        scrollTrigger: {
          trigger: element,
          start: "top 80%", // Adjust start and end points as needed
          end: "bottom center",
          scrub: 2, // Scrubs animation with scroll
          markers: false,
        },
      });

      tl2.fromTo(
        element,
        { x: "-50%", scale: 0 }, // Starting state
        {
          x: 0, // Ending state for x
          scale: 1, // Ending state for scale
          duration: 0.6, // Duration for both animations
          ease: "power3.out",
        }
      );
    });
  }

  setupLeftscaleUpAnimation();

  gsap.utils
    .toArray(".zip_zap_bg_img_container img.zig-zag-img")
    .forEach((img) => {
      gsap.to(img, {
        clipPath: "polygon(0 0, 100% 0, 100% 100%, 0 100%)", // Reveals the image from top to bottom
        duration: 0.1,
        ease: "power2.inOut",
        scrollTrigger: {
          trigger: img.closest(".zip_zap_bg_img_container"), // Adjusting trigger based on the container of the image
          start: "top 70%", // Starts when the image container reaches the center of the viewport
          end: "center top",
          scrub: 1,
          once: false, // Animation runs only once
          markers: false,
        },
      });
    });

  // Image reveal animation
  gsap.utils.toArray(".reveal-img").forEach((container) => {
    let image = container.querySelector("img");

    let tl = gsap.timeline({
      scrollTrigger: {
        trigger: container,
        start: "top 120%", // Start the animation when the container is 120% from the top
        toggleActions: "play none none reverse", // Define scroll trigger actions
      },
    });

    tl.set(container, { autoAlpha: 1 }); // Ensure the container is visible

    // Corrected animation logic
    tl.fromTo(
      image,
      {
        rotationX: 90, // Start with the image rotated 90 degrees along the X-axis
        z: -400, // Push the image back on the Z-axis for depth
        scale: 0.3,
      },
      {
        rotationX: 0, // Rotate to 0 degrees, bringing it upright
        z: 0, // Move the image back to its original Z position
        scale: 1,
        duration: 0.4, // Duration of the animation
        ease: "ease.in", // Easing for smooth animation
        scrollTrigger: {
          trigger: container, // Trigger the animation based on the container
          start: "top 70%", // Start when the container is 80% from the top of the viewport
          end: "center center", // End when the container is 30% from the top
          scrub: true, // Sync animation with scroll
          markers: false, // Show markers for debugging (remove in production)
        },
      }
    );
  });

  // gsap.utils.toArray(".reveal-img").forEach((container) => {
  //   let image = container.querySelector("img");
  //   let tl = gsap.timeline({
  //     scrollTrigger: {
  //       trigger: container,
  //       start: "top 120%",
  //       toggleActions: "play none none reverse",
  //     },
  //   });

  //   tl.set(container, { autoAlpha: 1 });
  //   tl.from(container, {
  //     duration: 3,
  //     yPercent: 100,
  //     skewX: 0.1,
  //     ease: "expo",
  //   });
  //   tl.from(
  //     image,
  //     {
  //       duration: 3,
  //       yPercent: -100,
  //       skewX: 0.1,
  //       ease: "expo",
  //     },
  //     0
  //   );
  // });

  // GSAP and ScrollTrigger animation for elements with the class 'fade-in-effect'
  // Function to get a random position within the container, staying away from the edges
  // function getRandomPositionWithinContainer(container, element) {
  //   const containerRect = container.getBoundingClientRect();
  //   const elementRect = element.getBoundingClientRect();

  //   // Define 100px offset from edges
  //   const margin = 100;
  //   const maxOffsetX = containerRect.width - elementRect.width - margin * 2; // Margin on both sides
  //   const maxOffsetY = containerRect.height - elementRect.height - margin * 2; // Margin on both sides

  //   // Generate random position within constraints
  //   const offsetX = Math.random() * maxOffsetX + margin;
  //   const offsetY = Math.random() * maxOffsetY + margin;

  //   return { x: offsetX, y: offsetY };
  // }

  // // Function to create the floating animation with snake pattern, scaling, and fading out
  // function createFloatingAnimation(element, container) {
  //   const containerRect = container.getBoundingClientRect();
  //   const randomDelay = Math.random() * 2; // Random delay between 0 and 2 seconds

  //   // Get initial random position within the container
  //   const { x, y } = getRandomPositionWithinContainer(container, element);

  //   // Set initial position
  //   gsap.set(element, { x, y });

  //   // Floating upwards animation with ScrollTrigger
  //   gsap.to(element, {
  //     duration: 10 + Math.random() * 10, // Duration between 10 and 20 seconds
  //     y: `-=${containerRect.height + 100}`, // Float upwards
  //     ease: "sine.inOut",
  //     repeat: -1, // Infinite loop
  //     yoyo: false, // No bouncing back
  //     delay: randomDelay, // Random delay before starting animation
  //     scrollTrigger: {
  //       trigger: container,
  //       start: "top bottom", // Starts when the container is at the bottom of the viewport
  //       end: "bottom top", // Ends when the container is at the top of the viewport
  //       scrub: true, // Syncs with scrolling
  //       onEnter: () => {
  //         // Trigger the animation when the container enters the viewport
  //         gsap.to(element, {
  //           duration: 10 + Math.random() * 10,
  //           y: `-=${containerRect.height + 100}`,
  //           ease: "sine.inOut",
  //           repeat: -1,
  //           yoyo: false
  //         });
  //       },
  //       onLeave: () => {
  //         // Fade out and remove the icon when it leaves the viewport
  //         gsap.to(element, {
  //           opacity: 0, // Fade out
  //           duration: 2, // Duration of fade out
  //           ease: "power1.in",
  //           onComplete: () => {
  //             element.remove(); // Remove element from DOM
  //           }
  //         });
  //       }
  //     }
  //   });

  //   // Scaling and snake-like movement animation
  //   gsap.fromTo(element,
  //     {
  //       scale: 0, // Start scaled down
  //       opacity: 0, // Start invisible
  //     },
  //     {
  //       scale: 1, // Scale up to full size
  //       opacity: 1, // Fade in to full opacity
  //       duration: 2, // Duration of scaling and fading
  //       ease: "power2.out",
  //       repeat: -1, // Infinite loop for the scaling and fade-out effect
  //       yoyo: true, // Bounce back and forth
  //       delay: randomDelay, // Random delay before starting animation
  //       modifiers: {
  //         x: gsap.utils.unitize(value => {
  //           // Snake-like horizontal movement
  //           const offset = Math.sin(parseFloat(value) / 50) * 20; // Horizontal movement range
  //           const newValue = parseFloat(value) + offset;

  //           // Ensure newValue stays within container boundaries
  //           const containerWidth = containerRect.width;
  //           const elementWidth = element.getBoundingClientRect().width;
  //           if (newValue < 0) return 0;
  //           if (newValue + elementWidth > containerWidth) return containerWidth - elementWidth;
  //           return newValue;
  //         }),
  //       },
  //       onComplete: () => {
  //         // Fade out and remove the element after scaling and snake animation
  //         gsap.to(element, {
  //           opacity: 0, // Fade out
  //           duration: 2, // Duration of fade out
  //           ease: "power1.in",
  //           onComplete: () => {
  //             element.remove(); // Remove element from DOM
  //           }
  //         });
  //       }
  //     }
  //   );
  // }

  // // Select the container
  // const container = document.querySelector('.floating-icons');

  // // Apply floating animation to each element without cloning
  // gsap.utils.toArray(".fade-in-effect").forEach((element) => {
  //   // Apply floating animation with snake pattern and scaling
  //   createFloatingAnimation(element, container);
  // });

  //musical notes icon animate
  // Array of image paths for musical note icons
const musicNoteIcons = [
  "/assets/frontend/images/Homepage/Music_1.png",
  "/assets/frontend/images/Homepage/Music_2.png",
  "/assets/frontend/images/Homepage/Music_3.png",
  "/assets/frontend/images/Homepage/Music_4.png",
  "/assets/frontend/images/Homepage/Music_5.png",
  "/assets/frontend/images/Homepage/Music_6.png",
  "/assets/frontend/images/Homepage/Music_7.png",
];

// Function to create a single icon element
function createIcon(container) {
  const iconIndex = Math.floor(Math.random() * musicNoteIcons.length);
  const icon = document.createElement("img");
  icon.src = musicNoteIcons[iconIndex];
  icon.alt = "musical notes"; // Set alt attribute
  icon.classList.add("music-icon"); // Add class for styling/animation
  icon.style.position = "absolute"; // Ensure icons can move freely
  icon.style.opacity = 0; // Start hidden
  icon.style.width = "20px"; // Set width

  // Start icons at a random horizontal position, at the bottom
  icon.style.left = `${Math.random() * 100}vw`; // Random horizontal starting point
  icon.style.bottom = `0px`; // Start from slightly below the container

  return icon;
}

// Function to create multiple icons and append them to the container
function createIcons(container, numberOfIcons = 20) {
  for (let i = 0; i < numberOfIcons; i++) {
    const icon = createIcon(container);
    container.appendChild(icon);
  }
}

// Function to get vertical movement height based on the data attribute
function getVerticalHeightBasedOnData(container) {
  const height = container.getAttribute("data-icon-height"); // Read height from data attribute
  return height ? `-${height}` : `-50vh`; // Default to -50vh if no data-height is provided
}

// Function to generate random horizontal movement (optional zigzag)
function getRandomHorizontalMovement() {
  return (Math.random() - 2) * 50; // Optional small zigzag motion (-25px to +25px)
}

// Function to animate a single icon
function animateIcon(icon, container) {
  const randomDuration = Math.random() * 2 + 4; // Random duration between 2s and 4s
  const randomY = getVerticalHeightBasedOnData(container); // Get vertical height based on the container's data-height attribute
  const randomX = getRandomHorizontalMovement(); // Small zigzag movement
  const randomDelay = Math.random() * 2; // Random delay between animations

  const timeline = gsap.timeline({
    scrollTrigger: {
      trigger: container,
      start: "top center",
      end: "bottom top",
      markers: false,
    },
  });

  // Animate the icon to move up randomly within the section
  timeline.to(icon, {
    y: Math.random() * -40 + "vh", // Set y movement based on data-height attribute // Set y movement within -30vh
    x: randomX, // Small zigzag movement for variation
    opacity: 1, // Fade in to full opacity
    scale: 1, // Grow to full size
    duration: randomDuration, // Randomized animation duration
    delay: randomDelay, // Delay before the animation starts
    ease: "power1.inOut", // Smooth easing effect
    repeat: -1, // Infinite loop
    repeatDelay: Math.random() * 2, // Random delay between repetitions
    stagger: {
      each: 1, // 300ms delay between each icon animation start
    },
  });

  // Fade out the icon at the end of the animation
  timeline.to(icon, {
    opacity: 0,
    duration: 0.1,
  }, `+=0`);
}

// Function to animate all icons in the container
function animateIcons(container) {
  const icons = container.querySelectorAll(".music-icon");
  icons.forEach(icon => {
    animateIcon(icon, container);
  });
}

// Main function to create and animate icons in all containers
function initializeIconAnimation() {
  // Get all containers with the class .icon-container
  const containers = document.querySelectorAll(".icon-container");

  // Create and animate icons in each container
  containers.forEach(container => {
    createIcons(container); // Create icons for the container
    animateIcons(container); // Animate icons in the container
  });
}

// Call the main function to start the process
initializeIconAnimation();


  // Array of image paths for musical note icons
  // const musicNoteIcons = [
  //   "/assets/frontend/images/Homepage/Music_1.png",
  //   "/assets/frontend/images/Homepage/Music_2.png",
  //   "/assets/frontend/images/Homepage/Music_3.png",
  //   "/assets/frontend/images/Homepage/Music_4.png",
  //   "/assets/frontend/images/Homepage/Music_5.png",
  //   "/assets/frontend/images/Homepage/Music_6.png",
  //   "/assets/frontend/images/Homepage/Music_7.png",
  // ];

  // // Function to dynamically create icons in each container
  // function createIcons(container) {
  //   for (let i = 0; i < 20; i++) {
  //     const iconIndex = Math.floor(Math.random() * musicNoteIcons.length);
  //     const icon = document.createElement("img");
  //     icon.src = musicNoteIcons[iconIndex];
  //     icon.classList.add("music-icon"); // Add class for styling/animation
  //     icon.style.position = "absolute"; // Ensure icons can move freely
  //     icon.style.opacity = 0; // Start hidden
  //     icon.style.width = "1.6vw"; // Set width

  //     // Start icons at a random horizontal position, at the bottom
  //     icon.style.left = `${Math.random() * 100}vw`; // Random horizontal starting point
  //     icon.style.bottom = `50px`; // Start from slightly below the container

  //     container.appendChild(icon);
  //   }
  // }

  // // Function to generate random vertical movement within the container
  // function getRandomVerticalPosition(containerHeight) {
  //   return Math.random() * containerHeight; // Generate a random Y position within the container
  // }

  // // Function to generate random horizontal movement (optional zigzag)
  // function getRandomHorizontalMovement() {
  //   return (Math.random() - 2) * 50; // Optional small zigzag motion (-25px to +25px)
  // }

  // // Function to animate icons in a container
  // function animateIcons(container) {
  //   const icons = container.querySelectorAll(".music-icon");

  //   icons.forEach((icon) => {
  //     const randomDuration = Math.random() * 2 + 4; // Random duration between 2s and 4s
  //     const randomY = getRandomVerticalPosition(container.offsetHeight); // Get random vertical position
  //     const randomX = getRandomHorizontalMovement(); // Small zigzag movement
  //     const randomDelay = Math.random() * 2; // Random delay between animations

  //     const timeline = gsap.timeline({
  //       scrollTrigger: {
  //         trigger: container,
  //         start: "top center",
  //         end: "bottom top",
  //         markers: false,
  //       },
  //     });

  //     // Animate the icon to move up randomly within the section
  //     timeline.to(icon, {
  //       y: `-50vh`, //y: `-${randomY}px`, // Move upward to a random point inside the container
  //       x: randomX, // Small zigzag movement for variation
  //       opacity: 1, // Fade in to full opacity
  //       scale: 1, // Grow to full size
  //       duration: randomDuration, // Randomized animation duration
  //       delay: randomDelay, // Delay before the animation starts
  //       ease: "power1.inOut", // Smooth easing effect
  //       repeat: -1, // Infinite loop
  //       repeatDelay: Math.random() * 2, // Random delay between repetitions
  //       stagger: {
  //         each: 1, // 300ms delay between each icon animation start
  //       },
  //     });
  //     timeline.to(icon, {
  //       opacity: 0,
  //       duration: 0.1,
  //     }, `+=0`);
  //   });
  // }

  // // Get all containers with the class .icon-container
  // const containers = document.querySelectorAll(".icon-container");

  // // Create and animate icons in each container
  // containers.forEach((container) => {
  //   createIcons(container);
  //   animateIcons(container);
  // });

  // Array of image paths for musical note icons
  // const musicNoteIcons = [
  //   "/assets/frontend/images/Homepage/Music_1.png",
  //   "/assets/frontend/images/Homepage/Music_2.png",
  //   "/assets/frontend/images/Homepage/Music_3.png",
  //   "/assets/frontend/images/Homepage/Music_4.png",
  //   "/assets/frontend/images/Homepage/Music_5.png",
  //   "/assets/frontend/images/Homepage/Music_6.png",
  //   "/assets/frontend/images/Homepage/Music_7.png",
  // ];

  // const container = document.getElementsByClassName('icon-container');

  // // Function to dynamically create 50 music note icons
  // function createIcons() {
  //   for (let i = 0; i < 100; i++) {
  //     const iconIndex = Math.floor(Math.random() * musicNoteIcons.length);
  //     const icon = document.createElement('img');
  //     icon.src = musicNoteIcons[iconIndex];
  //     icon.classList.add('music-icon'); // Add class for styling/animation
  //     icon.style.position = 'absolute'; // Ensure icons can move freely
  //     icon.style.opacity = 0; // Start hidden
  //     icon.style.width = "1.6vw"; // Set width

  //     // Set random horizontal position
  //     icon.style.left = `${Math.random() * 100}vw`; // Random horizontal starting point
  //     // Start icons off-screen at the bottom
  //     icon.style.bottom = `-50px`; // Start from slightly below the bottom of the container

  //     container.appendChild(icon);
  //   }
  // }

  // // Function to animate a small batch of icons at intervals
  // // Function to animate a small batch of icons at intervals
  // function animateIcons() {
  //   const icons = document.querySelectorAll('.music-icon');
  //   const batchSize = Math.floor(Math.random() * 6) + 8; // Randomly choose 8-6 icons
  //   const batchIcons = Array.from(icons).slice(0, batchSize);

  //   batchIcons.forEach((icon, index) => {
  //     const randomDuration = Math.random() * 1 + 3; // Random duration between 3s and 4s
  //     const randomX = Math.random() * 800 - 400; // Random zigzag movement
  //     const fadeOutStart = Math.random() * 100 + 300; // Ensure fade out starts higher up

  //     const timeline = gsap.timeline({
  //       scrollTrigger: {
  //         trigger: container,
  //         start: "top center",
  //         end: "bottom top",
  //         markers: false, // Display ScrollTrigger markers
  //         // scrub: true, // Animation follows scroll
  //         // toggleActions: "play reverse play reverse"
  //       }
  //     });

  //     // Animate the icon from below to its final position
  //     timeline.to(icon, {
  //       y: `-${window.innerHeight + fadeOutStart}px`, // Move upward to the top, beyond the view
  //       x: randomX, // Zigzag movement
  //       opacity: 1, // Fade in to full opacity
  //       duration: randomDuration, // Animation duration
  //       ease: "power1.inOut", // Smooth easing effect
  //       onComplete: () => {
  //         gsap.to(icon, {
  //           opacity: 0, // Fade out
  //           duration: 0.1, // Fade out duration
  //           ease: "back.out", // Smooth fade-out effect
  //         });
  //       },
  //       repeat: -1, // Infinite loop
  //       repeatDelay: Math.random() * 2, // Random delay between repetitions
  //       stagger: {
  //         each: 0.3, // 300ms delay between each icon animation start
  //       }
  //     });
  //   });
  // }

  // // Create the icons and animate them
  // createIcons();
  // animateIcons();

  // GSAP and ScrollTrigger animation for elements with the class 'fade-in-effect'
  // gsap.utils.toArray(".fade-in-effect").forEach((element) => {
  //   gsap.from(element, {
  //     opacity: 0,
  //     y: 0,
  //     scaleX: -1, // Start from 50px below its original position
  //     duration: 0.6, // Animation duration
  //     ease: "power3.out",
  //     scrollTrigger: {
  //       trigger: element, // Each element triggers its own animation
  //       start: "top 70%", // Animation starts when the top of the element hits 80% of the viewport height
  //       end: "bottom 50%", // Ends when the bottom reaches 50% of the viewport
  //       scrub: 1, // Disable scrub for smooth animation
  //       once: true,
  //       markers: false,
  //     },
  //   });
  // });

  // Select all .film_list elements
  const filmLists = document.querySelectorAll(".film_list");
  filmLists.forEach((list) => {
    gsap.from(list.querySelectorAll("li a"), {
      y: "100px",
      stagger: 0.3,
      ease: "back.out",
      duration: 1,
      scrollTrigger: {
        trigger: list, // Trigger each list individually
        once: true,
        start: "top bottom", // When the top of the trigger element reaches the bottom of the viewport
        end: "bottom center", // When the bottom of the trigger element reaches the center of the viewport
        scrub: 1, // Smoothly scrubs the animation
        markers: false, // Set to true if you want to debug with markers
      },
    });
  });

  // Access the ::before pseudo-element of #home_page .non_film_section using CSSRulePlugin
  // const beforeRule = CSSRulePlugin.getRule(
  //   "#home_page .non_film_section::before"
  // );

  // // Animate the pseudo-element using GSAP and ScrollTrigger
  // gsap.fromTo(
  //   beforeRule,
  //   {
  //     cssRule: { opacity: 0, scale: 0 }, // Initial state
  //   },
  //   {
  //     cssRule: { opacity: 1, scale: 1 }, // Final state
  //     duration: 0.6,
  //     ease: "power3.out",
  //     scrollTrigger: {
  //       trigger: "#home_page .non_film_section", // The element to trigger the animation
  //       start: "-80% bottom", // Start the animation when the top of the element reaches 80% of the viewport
  //       end: "center 15%",
  //       scrub: true, // Disable scrub for smooth animation
  //       once: false, // Run animation only once
  //       markers: false,
  //     },
  //   }
  // gsap.fromTo(beforeRule,
  //   {
  //     cssRule: { opacity: 0, x: "-20%" }, // Initial state
  //   },
  //   {
  //     cssRule: { opacity: 1, x: "0%" }, // Final state
  //     duration: 0.6,
  //     ease: "power3.out",
  //     scrollTrigger: {
  //       trigger: "#home_page .non_film_section", // The element to trigger the animation
  //       start: "top bottom", // Start the animation when the top of the element reaches 80% of the viewport
  //       end: "bottom 50%",
  //       scrub: false, // Disable scrub for smooth animation
  //       once: true, // Run animation only once
  //       markers:false
  //     },
  //   }
  // );
});

// background color transition new
// document.addEventListener("DOMContentLoaded", function () {
//   const sections = document.querySelectorAll(".section");

//   // Ensure GSAP is initialized
//   gsap.registerPlugin(ScrollTrigger);

//   sections.forEach((section, index) => {
//     const nextSection = sections[index + 1];
//     if (nextSection) {
//       // Use ScrollTrigger to track scroll position between sections
//       ScrollTrigger.create({
//         trigger: section,
//         start: "center center", // Start the effect when the section comes into view
//         endTrigger: nextSection,
//         end: "80% bottom", // End when the next section is fully in view
//         scrub: true,
//         markers: false,
//         onUpdate: (self) => {
//           // Interpolate colors between the current and next section
//           const progress = self.progress; // 0 to 1 between sections
//           const currentColor = section.getAttribute("data-bg");
//           const nextColor = nextSection.getAttribute("data-bg");

//           // Use gsap to interpolate the background color smoothly
//           const interpolatedColor = gsap.utils.interpolate(
//             currentColor,
//             nextColor,
//             progress
//           );

//           // Apply the interpolated color to the body background
//           document.body.style.backgroundColor = interpolatedColor;
//         },
//       });
//     }
//   });
// });

//gallery page masonry gallery
// Initialize Masonry
$(document).ready(function () {
  // Check if the .masonry_gallery element exists
  if ($(".masonry_gallery").length) {
    var $gallery = $(".masonry_gallery").masonry({
      itemSelector: ".masonry_gallery_div",
      columnWidth: ".masonry_gallery_div",
      percentPosition: true,
    });

    // Layout Masonry after each image loads
    $gallery.imagesLoaded().progress(function () {
      $gallery.masonry("layout");
    });

    // Initialize Fancybox
    // $('[data-fancybox="masonry_gallery"]').fancybox({
    //   loop: true,
    //   buttons: ["zoom", "slideShow", "thumbs", "close"],
    // });
  }
});

// background color transition new
/*document.addEventListener("DOMContentLoaded", function () {
  const sections = document.querySelectorAll(".section");

  // Loop through each section to create individual scrollTriggers
  sections.forEach((section, index) => {
    const nextSection = sections[index + 1];
    
    if (nextSection) {
      // Set up individual background color transitions between adjacent sections
      gsap.to(section, {
        scrollTrigger: {
          trigger: section,
          start: "top center",
          end: "bottom center",
          scrub: 1,
          markers: false,
          onEnter: () => {
            // Change the background to the current section color on enter
            gsap.to("body", {
              backgroundColor: section.getAttribute("data-bg"),
              ease: "ease.in",
              duration: 0.5
            });
          },
          onLeave: () => {
            // Change the background to the next section color on leave
            gsap.to("body", {
              backgroundColor: nextSection.getAttribute("data-bg"),
              ease: "ease.in",
              duration: 0.5
            });
          },
          onEnterBack: () => {
            // Reverse the background color change when scrolling back
            gsap.to("body", {
              backgroundColor: section.getAttribute("data-bg"),
              ease: "ease.in",
              duration: 0.5
            });
          }
        }
      });
    }
  });
});
*/

// // // heading Animation
// gsap.registerPlugin(ScrollTrigger);
// // Splits text into words and characters
// const text = new SplitType(".heading-anim", { types: "chars" });
// gsap.set(".heading-anim", { autoAlpha: 1 }); // prevents flash of unstyled content
// gsap.set(text.chars, { yPercent: 100 }); // set initial state
// // Page Load Animation
// const initialAnimation = gsap.to(text.chars, {
//   yPercent: 0,
//   ease: "sine.out",
//   stagger: { from: "center", amount: 0.5, ease: "power1.out" },
//   onComplete: activateScrollTrigger, // Activate ScrollTrigger after initial animation
// });

// // User Scroll Animation
// function activateScrollTrigger() {
//   gsap.to(text.chars, {
//     yPercent: -100,
//     stagger: { from: "center", amount: 1 },
//     scrollTrigger: {
//       trigger: ".heading-anim",
//       start: "top top",
//       end: () => `+=${document.querySelector(".heading-anim").offsetHeight * 0.25}`,
//       scrub: 1,
//       markers: true,
//     },
//   });
// }

// const para = document.querySelector("para-anim");
// const text = "animation";
// const arr = text.split("");
// generateText(arr);
// function generateText(text) {
//   text.forEach((data) => {
//     const span = document.createElement("span");
//     span.classList.add("char");
//     span.innerHTML = data;
//     para.appendChild(span);
//   });
// }
// // gsap
// gsap.from(".char", {
//   y: 100,
//   stagger: 0.07,
//   delay: 0.2,
//   ease: "back.out",
//   duration: 1,
// });

// var animatedTextNodes = document.querySelectorAll(".animated-para");

// if (animatedTextNodes.length && !mediaQuery.matches) {
//   animatedTextNodes.forEach(function (node) {
//     node.split = new SplitText(node, {
//       type: "lines,words",
//       linesClass: "split-line",
//     });
//   });
// }

// GSAP animation
// gsap.fromTo(
//   ".preloader-main svg",
//   { strokeDasharray: 4500, strokeDashoffset: 4500, fillOpacity: 0 },
//   {
//     strokeDashoffset: 0,
//     fillOpacity: 1,
//     duration: 3,
//     ease: "power1.inOut",
//     onComplete: function () {
//       // Move the SVG back to its original place after animation
//       gsap.to(".preloader-main", {
//         opacity: 0,
//         duration: 1,
//         onComplete: function () {
//           document.querySelector(".preloader-main").style.display = "none";
//         },
//       });
//     },
//   }
// );
/*
document.addEventListener("DOMContentLoaded", function () {
  const sections = document.querySelectorAll(".section");

  // Create a GSAP timeline for background color transitions
  const colorTimeline = gsap.timeline({
    scrollTrigger: {
      trigger: ".section",
      start: "top top",
      end: "bottom bottom",
      scrub: 1,
      markers: true,
      onUpdate: (self) => {
        // Iterate over each section and update its background color
        sections.forEach((section, index) => {
          const nextSection = sections[index + 1] || sections[0];
          const sectionColor = section.getAttribute("data-bg");
          const nextSectionColor = nextSection.getAttribute("data-bg");

          const progress = self.progress;
          const blend = progress * (sections.length - 1) - index;

          // Interpolate between current and next section colors
          const interpolatedColor = gsap.utils.interpolate(
            sectionColor,
            nextSectionColor,
            blend
          );

          section.style.backgroundColor = interpolatedColor;
        });
      },
    },
  });

  // Optional: Add some delays or effects for better visual experience
  sections.forEach((section) => {
    colorTimeline.to(section, {
      duration: 1,
      autoAlpha: 1,
      ease: "power1.out",
    });
  });
});
*/

//about section
// Function to animate all sections in sequence
function setupAboutSectionAnimation() {
  const tl = gsap.timeline({
    scrollTrigger: {
      trigger: ".animate-about-first-section", // Use this class as the trigger
      start: "top center", // Start animation when this section reaches the center of the viewport
      once: true, // Animation runs only once
      markers: false, // Set to true for debugging
    },
  });

  // Step 1: Animate the image with clip-path
  tl.fromTo(
    ".reveal-img-toptobottom",
    {
      clipPath: "polygon(0 0, 100% 0, 100% 0, 0 0)", // Initial state (invisible, clipped to top)
    },
    {
      clipPath: "polygon(0 0, 100% 0, 100% 100%, 0 100%)", // Final state (revealed from top to bottom)
      duration: 2,
      ease: "power2.inOut",
    }
  );

  function initMobileAnimation() {
    const isMobile = window.innerWidth <= 768; // Define mobile view (width <= 768px)
  
    if (isMobile) {
      const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            // Trigger GSAP animation when the element is in the viewport
            gsap.fromTo(
              ".reveal-img-toptobottom_mobile",
              {
                clipPath: "polygon(0 0, 100% 0, 100% 0, 0 0)", // Initial state (invisible, clipped to top)
              },
              {
                clipPath: "polygon(0 0, 100% 0, 100% 100%, 0 100%)", // Final state (revealed from top to bottom)
                duration: 2,
                ease: "power2.inOut",
              }
            );
            observer.unobserve(entry.target); // Stop observing once the animation is triggered
          }
        });
      });
  
      // Target the image element for intersection observer
      const target = document.querySelector(".reveal-img-toptobottom_mobile");
      if (target) {
        observer.observe(target); // Start observing the target
      }
    }
  }
  
  // Run the function on page load
  window.addEventListener("load", initMobileAnimation);
  

  // Step 2: Animate .about_main_name (from right to left)
  tl.fromTo(
    ".about_main_name",
    { x: "100%", opacity: 0 }, // Starting state (offscreen to the right and transparent)
    { x: "0%", opacity: 1, duration: 0.6, ease: "back.out(2)" } // Ending state (onscreen and fully visible)
  );

  // Step 3: Animate .animated-heading-about with SplitText effect
  document.querySelectorAll(".animated-heading-about").forEach((element) => {
    // Trim leading and trailing whitespaces
    element.innerHTML = element.innerHTML.trim();

    // Create the SplitText instance
    const split = new SplitText(element, {
      linesClass: "split-line",
      type: "lines, words, chars", // Split by lines, words, and characters
    });

    // Remove any empty lines before the animation starts
    element.querySelectorAll(".split-line").forEach((line) => {
      if (!line.textContent.trim()) {
        line.remove();
      }
    });

    // Animation using GSAP
    tl.from(split.chars, {
      y: 100,
      stagger: 0.05,
      opacity: 0,
      ease: "power3.out",
      duration: 0.4,
      // Optional: Reverting to original structure after animation
      onComplete: () => {
        // If reverting is needed, do it after animation
        split.revert();
      },
    });
  });

  // Step 4: Animate .animated-para-about with SplitText effect
  document.querySelectorAll(".animated-para-about p").forEach((element) => {
    // Trim leading and trailing whitespaces
    element.innerHTML = element.innerHTML.trim();

    // Create the SplitText instance
    const split = new SplitText(element, {
      linesClass: "split-line",
      type: "lines, words",
    });

    // Remove any empty lines before the animation starts
    element.querySelectorAll(".split-line").forEach((line) => {
      if (!line.textContent.trim()) {
        line.remove();
      }
    });

    // Animation using GSAP
    tl.from(split.words, {
      y: 80,
      opacity: 0,
      stagger: 0.03,
      ease: "power2.out",
      duration: 0.6,
      // Optional: You can still revert if necessary later
      onComplete: () => {
        // Cleanup if reverting is needed
        split.revert();
      },
    });
  });
}

// Call the function to initialize the animation
setupAboutSectionAnimation();

//image reveal 2
// Function to animate clip-path for multiple images
function setupClipPathAnimation() {
  gsap.utils.toArray(".reveal-img-diagonal").forEach((img) => {
    gsap.fromTo(
      img,
      {
        clipPath: "polygon(72% 0%, 100% 0%, 100% 100%, 100% 0%)", // Initial state (invisible, clipped to top)
      },
      {
        clipPath: "polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)", // Final state (revealed from top to bottom)
        duration: 1,
        ease: "ease.inOut",
        scrollTrigger: {
          trigger: img.parentElement, // Trigger based on the parent container of the image
          start: "top center", // Starts when the container reaches the center of the viewport
          once: true, // Animation runs only once
          markers: false, // Set markers to debug start and end points
        },
      }
    );
  });
}

// Call the function
setupClipPathAnimation();

//fade-in animation
function setupGallerySectionAnimation() {
  const tl = gsap.timeline({
    scrollTrigger: {
      trigger: ".animate-gallery-first-section", // Use this class as the trigger
      start: "top center", // Start animation when this section reaches the center of the viewport
      once: true, // Animation runs only once
      markers: false, // Set to true for debugging
    },
  });

  // Step 1: Animate the image with clip-path
  tl.fromTo(
    ".img-scale",
    {
      scale: 0, // Initial state (invisible, clipped to top)
    },
    {
      scale: 1, // Final state (revealed from top to bottom)
      duration: 1,
      ease: "power2.inOut",
    }
  );
}

// Call the function to initialize the animation
setupGallerySectionAnimation();

//achievemnets first section
// Function to animate all sections in sequence
function setupAchievementsSectionAnimation() {
  const tl = gsap.timeline({
    scrollTrigger: {
      trigger: ".animate-achievements-first-section", // Use this class as the trigger
      start: "top center", // Start animation when this section reaches the center of the viewport
      once: true, // Animation runs only once
      markers: false, // Set to true for debugging
    },
  });

  // Step 1: Animate the image with clip-path

  tl.fromTo(
    ".achievements_main_name",
    { x: "100%", opacity: 0 }, // Starting state (offscreen to the right and transparent)
    { x: "0%", opacity: 1, duration: 1, ease: "back.out(1.7)" } // Ending state (onscreen and fully visible)
  );

  // Step 3: Animate .animated-heading-about with SplitText effect
  // document.querySelectorAll(".animated-heading-about").forEach((element) => {
  //   const split = new SplitText(element, {
  //     linesClass: "split-line",
  //     type: "lines, words, chars",
  //   });
  //   tl.from(split.chars, {
  //     y: 100,
  //     stagger: 0.05,
  //     opacity: 0,
  //     ease: "power3.out",
  //     duration: 1,
  //   });
  // });

  // Step 4: Animate .animated-para-about with SplitText effect
  document
    .querySelectorAll(".animated-para-achievements p")
    .forEach((element) => {
      const split = new SplitText(element, {
        linesClass: "split-line",
        type: "lines, words",
      });
      tl.from(split.words, {
        y: 80,
        opacity: 0,
        stagger: 0.03,
        ease: "power2.out",
        duration: 0.8,
      });
    });
}
// Call the function to initialize the animation
setupAchievementsSectionAnimation();

//achievements float-up
const tl5 = gsap.timeline({
  scrollTrigger: {
    trigger: ".float-up", // Element that triggers the animation
    start: "top 140%", // Start when the top of the row hits the bottom of the viewport
    end: "bottom 80%", // End when the center of the row hits the center of the viewport
    scrub: 0.6, // Smooth scrubbing, takes 1 second to catch up to the scroll position
    once: true,
    markers: false, // Enable markers for debugging (remove in production)
  },
});
gsap.utils.toArray(".award_main_div").forEach((div, index) => {
  const isMobile = window.innerWidth <= 768; // Define mobile view (width <= 768px)

  tl5.fromTo(
    div,
    { opacity: 0, y: "40%" }, // Start state
    { 
      opacity: 1, 
      y: 0, 
      duration: isMobile ? 0.2 : 1, // Use 0.3s duration for mobile, 1s for desktop
      stagger: 0.3 
    },
    "<+=0.1" // Staggering effect
  );
});

//works page
//fade-in animation
function setupWorkSectionAnimation() {
  const tl = gsap.timeline({
    scrollTrigger: {
      trigger: ".animate-work-first-section", // Use this class as the trigger
      start: "top center", // Start animation when this section reaches the center of the viewport
      once: true, // Animation runs only once
      markers: false, // Set to true for debugging
    },
  });
  // Step 1: Animate .about_main_name (from right to left)
  tl.fromTo(
    ".work_main_name",
    { x: "100%", opacity: 0 }, // Starting state (offscreen to the right and transparent)
    { x: "0%", opacity: 1, duration: 1, ease: "back.out(1.7)" } // Ending state (onscreen and fully visible)
  );
  // Step 2: Animate the image with clip-path
  tl.fromTo(
    ".img-scale-work",
    {
      scale: 0, // Initial state (invisible, clipped to top)
    },
    {
      scale: 1, // Final state (revealed from top to bottom)
      duration: 1.5,
      ease: "power2.inOut",
    }
  );

  // Step 3: Animate .animated-para-about with SplitText effect
  document.querySelectorAll(".animated-para-work p").forEach((element) => {
    const split = new SplitText(element, {
      linesClass: "split-line",
      type: "lines, words",
    });
    tl.from(split.words, {
      y: 80,
      opacity: 0,
      stagger: 0.03,
      ease: "power2.out",
      duration: 0.8,
        // Optional: You can still revert if necessary later
        onComplete: () => {
        // Cleanup if reverting is needed
        split.revert();
        },
    });
  });
}

// Call the function to initialize the animation
setupWorkSectionAnimation();

//work cards

// Select all card elements
const cards = gsap.utils.toArray(".card");

cards.forEach((card) => {
  const image = card.querySelector("img");
  const title = card.querySelector(".card-title");

  // Create a timeline for each card
  const tl = gsap.timeline({
    scrollTrigger: {
      trigger: card,
      start: "top bottom", // Animation starts when card enters bottom of the viewport
      end: "top 20%", // Ends when card reaches the center of the viewport
      scrub: 2, // Smooth scrolling animation
      once: true,
      markers: false, // Enable markers for debugging (remove in production)
    },
  });

  // Scale image from 0 to 1
  tl.fromTo(image, { scale: 0 }, { scale: 1, duration: 0.6 });

  // Translate card title from 30vh to 0vh
  tl.fromTo(
    title,
    { y: "30vh", opacity: 0 },
    { y: "0vh", opacity: 1, duration: 1, ease: "power2.out" },
    "-=0.2" // Overlap the animations
  );
});

//Contact us page first section
// Function to animate all sections in sequence
function setupContactSectionAnimation() {
  const tl = gsap.timeline({
    scrollTrigger: {
      trigger: ".animate-contact-first-section", // Use this class as the trigger
      start: "top center", // Start animation when this section reaches the center of the viewport
      once: true, // Animation runs only once
      markers: false, // Set to true for debugging
    },
  });
  // Step 1: Animate .about_main_name (from right to left)
  tl.fromTo(
    ".contact_main_name",
    { x: "100%", opacity: 0 }, // Starting state (offscreen to the right and transparent)
    { x: "0%", opacity: 1, duration: 1, ease: "back.out(1.7)" } // Ending state (onscreen and fully visible)
  );
  // Step 2: Animate .animated-heading-about with SplitText effect
  tl.fromTo(
    ".scale-img-contact",
    {
      scale: 0, // Initial state (invisible, clipped to top)
    },
    {
      scale: 1, // Final state (revealed from top to bottom)
      duration: 1.5,
      ease: "power2.inOut",
    }
  );
  // Step 3: Animate the image with clip-path
  tl.fromTo(
    ".reveal-img-toptobottom-contact",
    {
      clipPath: "polygon(0 0, 100% 0, 100% 0, 0 0)", // Initial state (invisible, clipped to top)
    },
    {
      clipPath: "polygon(0 0, 100% 0, 100% 100%, 0 100%)", // Final state (revealed from top to bottom)
      duration: 2,
      ease: "power2.inOut",
    }
  );

  // Step 4: Animate .about_main_name (from right to left)
  tl.fromTo(
    ".contact_form_animate",
    { x: "100%", opacity: 0 }, // Starting state (offscreen to the right and transparent)
    { x: "0%", opacity: 1, duration: 1, ease: "back.out(1.7)" } // Ending state (onscreen and fully visible)
  );
}

// Call the function to initialize the animation
setupContactSectionAnimation();

// gallery page .reveal-img-top-contact
let tl6 = gsap.timeline({
  scrollTrigger: {
    trigger: ".gallery_videos", // The element to trigger the animation
    start: "top 80%", // Start animation when the element is 80% from the top of the viewport
    end: "bottom center", // End the animation when the element is 20% from the bottom of the viewport
    scrub: false, // Smooth scrubbing, a smoother animation tied to scroll speed
    markers: false, // Set to true if you want to see start/end markers for testing
  },
});

// Animation for .gallery-video-item elements, staggered
tl6.fromTo(
  ".gallery-video-item",
  { x: "100%", opacity: 0 }, // Initial state: off-screen to the right and hidden
  { x: "0%", opacity: 1, duration: 1, ease: "power2.out", stagger: -0.3 } // End state: in place and fully visible
);

ScrollTrigger.addEventListener("refresh", function () {
  return locoScroll.update();
}); // после того, как все настроено, вызываем refresh() ScrollTrigger и он обновит и LocomotiveScroll,
// потому что могли быть добавлены отступы и т. д.

ScrollTrigger.refresh();


document.querySelector('.menu-trigger').addEventListener('change', function() {
  if (this.checked) {
    locoScroll.stop();
  } else {
    locoScroll.start();
  }
});


let splitTextChars = [...document.querySelectorAll('.split-text-chars')];

splitTextChars.forEach(element => {
  new SplitText(element, { 
    type: "words, chars",
    wordsClass: "word",
    charsClass: "char-perspective" 
  });

  let mySplitText = new SplitText(element, {
    type: "words, chars",
    charsClass: "char"
  });

  // Desktop and general behavior
  gsap.fromTo(mySplitText.chars,
    {
      autoAlpha: 0, // Starting state (invisible)
      opacity: 0,
      rotateY: "90",
      transform: 'translateZ(-0.8em)',
      scale: 1.2,
      x: "100%"
    },
    {
      autoAlpha: 1, // Ending state (fully visible)
      opacity: 1,
      rotateY: "0",
      transform: 'translateZ(0)',
      scale: 1,
      x: "0%",
      duration: 3,
      ease: Expo.easeOut,
      stagger: {
        amount: 1.5,
        from: "0"
      },
      scrollTrigger: {
        trigger: element,
        start: "top 90%", // Animation starts when the top of the section hits 90% of the viewport
        once: true, // Ensures animation happens only once
        markers: false
      }
    }
  );

  // Mobile-specific behavior using matchMedia
  ScrollTrigger.matchMedia({
    "(max-width: 768px)": function() {
      gsap.fromTo(mySplitText.chars,
        {
          autoAlpha: 0, // Ensure it starts invisible
          opacity: 0,
          rotateY: "90",
          transform: 'translateZ(-0.8em)',
          scale: 1.2,
          x: "100%"
        },
        {
          autoAlpha: 1, // End state should be visible
          opacity: 1,
          rotateY: "0",
          transform: 'translateZ(0)',
          scale: 1,
          x: "0%",
          duration: 3,
          delay: 5,
          ease: Expo.easeOut,
          stagger: {
            amount: 1.5,
            from: "0"
          },
          scrollTrigger: {
            trigger: element,
            start: "top 100%", // Start when fully in view
            once: true, // Ensure it only happens once
            markers: false
          }
        }
      );
    }
  });
});
