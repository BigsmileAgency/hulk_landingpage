
    <footer class="footer">
        <div class="inner">
            <?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>
        </div>
    </footer>


    <script>
        const baseUrl = '<?= WP_HOME ?>';
    </script>
    
        <?php wp_footer(); ?>
    </body>
</html>