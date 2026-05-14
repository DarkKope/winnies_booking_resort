</div> <!-- End main-content -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
    
    // Set active nav link
    $(document).ready(function() {
        var currentUrl = window.location.pathname;
        $('.nav-link').each(function() {
            if (currentUrl.includes($(this).attr('href'))) {
                $(this).addClass('active');
            }
        });
    });
</script>
</body>
</html>