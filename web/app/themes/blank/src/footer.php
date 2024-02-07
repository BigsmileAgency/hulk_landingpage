<footer class="footer">
    <div class="inner">
        <?php wp_nav_menu(array('theme_location' => 'footer')); ?>
    </div>
    <section class="bg_footer">
        <div class="container container_footer">
            <div class="menu1">
                <span class="bold">Ressources</span>
                <ul>
                    <li>Status page</li>
                    <li>Social and mockups</li>
                    <li>API</li>
                    <li>Blog</li>
                </ul>
            </div>
            <div class="menu2">
                <span class="bold">Support</span>
                <ul>
                    <li>Knowledgebase</li>
                    <li>Security</li>
                    <li>Contact</li>
                </ul>
            </div>
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