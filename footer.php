<?php
/**
 * Footer Template
 *
 * @package WordPress
 * @since V0.1
 *
 */
?>

<!--Start of footer-->
<section id="footer">
    <div class="container">
        <div class="row text-center">
                <?php
                if (is_active_sidebar('footer-sidebar-left')) {
                    dynamic_sidebar('footer-sidebar-left');
                }
                if (is_active_sidebar('footer-sidebar-right')) {
                    dynamic_sidebar('footer-sidebar-right');
                }
                ?>
        </div>
        <!--End of row-->
    </div>
    <!--End of container-->
</section>
<!--End of footer-->

<!--Scroll to top-->
<a href="#" id="back-to-top" title="Back to top">&uarr;</a>
<!--End of Scroll to top-->
<?php
wp_footer();
?>
</body>
</html>