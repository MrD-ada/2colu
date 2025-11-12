<footer id="colophon" class="site-footer">
        <div class="container">
            <?php if (is_active_sidebar('footer-widget')) : ?>
                <div class="footer-widgets">
                    <?php dynamic_sidebar('footer-widget'); ?>
                </div>
            <?php endif; ?>
            
            <div class="site-info">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>