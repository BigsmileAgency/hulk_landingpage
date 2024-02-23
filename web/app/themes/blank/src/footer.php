<footer class="footer">
    <div class="inner">
      
    </div>
    <section class="bg_footer">
        <div class="container container_footer">
            <div class="menus">

                <div class="menu1">
                    <div class="head_li bold">Ressources</div>
                    <ul>
                        <li>Status page</li>
                        <li>Social and mockups</li>
                        <li>API</li>
                        <li>Blog</li>
                    </ul>
                </div>
                <div class="menu2">
                    <div class="head_li bold">Support</div>
                    <ul>
                        <li>Knowledgebase</li>
                        <li>Security</li>
                        <li>Contact</li>
                    </ul>
                </div>
                
            </div>
            <div class="logo_hulk"><img class="logo_hulk" src="<?php echo get_template_directory_uri() ?>/images/logo_footer.svg"></div>
        </div>
    </section>

    <section>
    <div class="legal_footer">

    © 2023 Big Smile Agency - Terms and conditions | Privacy policy | Cookie policy
    </div>
</section>


</footer>


<script>
    const baseUrl = '<?= WP_HOME ?>';
</script>

<?php wp_footer(); ?>
</body>

</html>