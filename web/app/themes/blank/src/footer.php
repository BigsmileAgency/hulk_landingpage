<footer class="footer">
    <div class="inner">
      
    </div>
    <section class="bg_footer">
        <nav aria-label="Footer navigation" class="container container_footer">
            <div class="menus">
                <div class="menu1">
                    <div class="head_li bold">Ressources</div>
                    <ul>
                        <li><a href="<?php echo get_home_url() . '/faq'; ?>">FAQ</a></li>
                        <li>Status page</li>        
                    </ul>
                </div>
                <div class="menu2">
                    <div class="head_li bold">Support</div>
                    <ul>
                        <!-- <li>Knowledgebase</li> -->
                        <li>Security</li>
                        <li>Contact</li>
                    </ul>
                </div>
            </div>
            <div class="logo_hulk"><a href="<?php echo get_home_url(); ?>"><img alt="FoxBanner logo" class="logo_hulk" src="<?php echo get_template_directory_uri() ?>/images/logo_footer.svg"></a></div>
        </nav>
    </section>

    <section>
    <div class="legal_footer">

    © <?= date('Y') ?> Big Smile Agency -&nbsp;<a href="<?php echo get_home_url() . '/terms'; ?>">Terms and conditions</a>&nbsp;| Privacy policy | Cookie policy
    </div>
</section>


</footer>


<script>
    const baseUrl = '<?= WP_HOME ?>';
</script>

<?php wp_footer(); ?>
</body>

</html>