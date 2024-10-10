<script type="text/javascript" src="/assets/frontend/js/jquery.js"></script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/CSSRulePlugin.min.js"
    integrity="sha512-IxxYrSNXnt/RJlxNX40+7BQL88FLqvdpVpuV9AuvpNH/NFP0L8xA8WLxWTXx6PYExB5R/ktQisp6tIrnLn8xvw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

<script type="text/javascript" defer src="/assets/frontend/js/owl-carousel.js"></script>
<script type="text/javascript" src="/assets/frontend/js/bootstrap5.min.js"></script>
<script type="text/javascript" defer src="/assets/frontend/js/libs.min.js"></script>

<script type="text/javascript" defer src="/assets/frontend/js/fancybox.min.js"></script>

<script type="text/javascript" defer src="/assets/frontend/js/script.js"></script>

<!--Toast Js-->
<script defer defer src="/assets/frontend/js/toastr.min.js"></script>

<!--jQuery Validate-->
<script defer src="/assets/frontend/js/jquery.validate.min.js"></script>

<script type="text/javascript" defer src="/assets/frontend/js/Init.js"></script>


<script>
    document.querySelector('.menu-trigger').addEventListener('change', function() {
        if (this.checked) {
            // Disable scrolling
            document.body.style.overflow = 'hidden';
        } else {
            // Enable scrolling
            document.body.style.overflow = 'auto';
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('[data-fancybox="gallery"]').fancybox();
    });
</script>
<script>
    $(document).ready(function() {
        $(".gallery_yt_video").click(function() {
            var url = $(this).attr("data-youtube-url");
            var title = $(this).attr("data-title");
            $("#videoIframe").attr("src", url);
            $("#videoModalLabel").html(title ? title : ''); // Set the title if available, otherwise clear
            $("#videoModal").modal("show");
        });


        $(".close").click(function() {
            $("#videoModal").modal("hide");
        });

        $("#videoModal").on("hide.bs.modal", function() {
            $("#videoIframe").attr("src", "");
        });
    });
</script>



<!--moment js-->
<!-- <script defer defer src="/assets/frontend/js/moment.min.js"></script> -->
