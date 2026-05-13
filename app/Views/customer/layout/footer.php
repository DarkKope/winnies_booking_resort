</div> <!-- End container -->

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h5><i class="fas fa-umbrella-beach me-2"></i> Winnie's Resort</h5>
                <p>Experience the perfect blend of luxury, comfort, and natural beauty at Winnie's Resort.</p>
                <div class="social-icons mt-3">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
        <hr class="mt-4" style="border-color: rgba(255,255,255,0.1);">
        <div class="row">
            <div class="col-md-12 text-center">
                <p><i class="fas fa-map-marker-alt me-2"></i> Boracay Island, Philippines</p>
                <p><i class="fas fa-phone-alt me-2"></i> +63 912 345 6789 &nbsp;|&nbsp; <i class="fas fa-envelope me-2"></i> info@winniesresort.com</p>
                <p class="mb-0 mt-3">&copy; <?= date('Y') ?> Winnie's Resort. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
    
    $(document).ready(function() {
        var currentUrl = window.location.pathname;
        $('.nav-link').each(function() {
            if ($(this).attr('href') === currentUrl) {
                $(this).addClass('active');
            }
        });
    });
</script>
</body>
</html>