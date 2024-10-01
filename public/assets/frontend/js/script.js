function toggleSearchBar() {
	document.querySelector(".search-bar").classList.toggle("d-none")
}

function toggleSearchBar2() {
	document.querySelector(".search-bar-for-tab").classList.toggle("d-none")
}

// Clear search field after the page loads
window.addEventListener("DOMContentLoaded", function() {
    let searchInput = document.getElementById("searchInput");
    if (searchInput) {
        // Clear the input field on all devices, including mobile
        searchInput.value = "";

        // Reset the form to ensure any cached values are removed
        document.getElementById("searchForm").reset();
    }
});

// for sub menu closing and opening
// JavaScript/jQuery for mobile and tablet view 
$(document).ready(function() {
    if ($(window).width() <= 991) {
        $('.nav-item.dropdown .fa-angle-down').on('click', function(e) {
            e.preventDefault();
            var parentDropdown = $(this).closest('.nav-item.dropdown');
            var submenu = parentDropdown.find('.submenu');

            // Toggle the submenu
            if (parentDropdown.hasClass('open')) {
                // Close the submenu using CSS transitions
                submenu.css({
                    'height': submenu.get(0).scrollHeight + 'px', // Get current height
                });

                setTimeout(function () {
                    submenu.css({
                        'height': '0', // Collapse the height
                        'opacity': '0',
                        'visibility': 'hidden',
                    });
                }, 10);

                parentDropdown.removeClass('open');
                $(this).removeClass('rotate');
            } else {
                // Open the submenu
                submenu.css({
                    'height': '0',
                    'opacity': '1',
                    'visibility': 'visible',
                });

                setTimeout(function () {
                    submenu.css({
                        'height': submenu.get(0).scrollHeight + 'px', // Transition to full height
                    });
                }, 10);

                setTimeout(function() {
                    submenu.css('height', 'auto'); // Allow it to expand naturally
                }, 300); // After transition duration (ensure it matches your CSS)

                parentDropdown.addClass('open');
                $(this).addClass('rotate');
            }
        });

        // Close dropdown when clicking anywhere else
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.nav-item.dropdown').length) {
                $('.nav-item.dropdown').removeClass('open');
                $('.submenu').css({
                    'height': '0',
                    'opacity': '0',
                    'visibility': 'hidden',
                });
                $('.fa-angle-down').addClass('rotateoff');
            }
        });
    }
});


$(document).ready(function() {
	var e, o, t, a, s = !1;
	$("#zoomable-image").on("click", function(e) {
		$(this).toggleClass("zoomed"), $("body").toggleClass("zoomed-image"), s = !1
	}), $("#zoomable-image").on("mousedown", function(n) {
		$(this).hasClass("zoomed") && (s = !0, e = n.pageX - this.offsetLeft, o = n.pageY - this.offsetTop, t = $(this).parent().scrollLeft(), a = $(this).parent().scrollTop(), $(this).addClass("dragging"))
	}), $("#zoomable-image").on("mousemove", function(n) {
		if (s) {
			n.preventDefault();
			var i = n.pageX - this.offsetLeft,
				r = n.pageY - this.offsetTop,
				l = (i - e) * 1,
				m = (r - o) * 1;
			$(this).parent().scrollLeft(t - l), $(this).parent().scrollTop(a - m)
		}
	}), $(document).on("mouseup mouseleave", function() {
		s = !1, $("#zoomable-image").removeClass("dragging")
	})
}), 

$(document).ready(function() {
	$("#home_page_banner_slider").owlCarousel({
		onInitialized: function(e) {
			$(".owl-stage").css("transform-style", "preserve-3d")
		},
		loop: !0,
		margin: 0,
		autoplay: !0,
		nav: !0,
		dots: !1,
		animateOut: "fadeOut",
		animateIn: "fadeIn",
		mouseDrag: !1,
		touchDrag: !1,
		responsive: {
			0: {
				items: 1
			},
			600: {
				items: 1
			},
			1e3: {
				items: 1
			}
		}
	})
}), 

$(document).ready(function() {
	$("#what_we_do_slider").owlCarousel({
		onInitialized: function(e) {
			$(".owl-stage").css("transform-style", "preserve-3d")
		},
		loop: !0,
		margin: 30,
		autoplay: !0,
		autoplaySpeed: 3e3,
		nav: !0,
		dots: !1,
		responsive: {
			0: {
				items: 1.2,
				margin: 20
			},
			600: {
				items: 2
			},
			1e3: {
				items: 3
			}
		}
	})
}), 

$(document).ready(function() {
	$("#future_activity_slider").owlCarousel({
		onInitialized: function(e) {
			$(".owl-stage").css("transform-style", "preserve-3d")
		},
		loop: !0,
		margin: 30,
		autoplay: !1,
		autoplaySpeed: 3e3,
		nav: !0,
		dots: !1,
		responsive: {
			0: {
				items: 1
			},
			600: {
				items: 2
			},
			1e3: {
				items: 3
			}
		}
	})
}), 

document.addEventListener("DOMContentLoaded",function(){
    var e=document.getElementById("mainHeader");
    ("/"===window.location.pathname||"/index.html"===window.location.pathname)&&e.classList.add("transparent")
});

document.addEventListener("DOMContentLoaded", function() {
	const lazyImages = document.querySelectorAll('img.lazy');

	// Intersection Observer setup
	const imageObserver = new IntersectionObserver((entries, observer) => {
		entries.forEach(entry => {
			if (entry.isIntersecting) {
				const img = entry.target;
				img.src = img.dataset.src; // Set src to the value of data-src
				img.classList.remove('lazy'); // Optionally remove the lazy class
				observer.unobserve(img); // Stop observing this image
			}
		});
	});

	// Start observing each lazy image
	lazyImages.forEach(image => {
		imageObserver.observe(image);
	});
});

