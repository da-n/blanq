<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package blanq
 * @since blanq 1.0
 */
?>


<footer id="colophon" class="container site-footer" role="contentinfo">
  <div class="row">
    <div class="span12">
      <div class="box site-info">
        <?php do_action( 'blanq_credits' ); ?>
        <a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'blanq' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'blanq' ), 'WordPress' ); ?></a>
        <span class="sep"> | </span>
        <?php printf( __( 'Theme: %1$s', 'blanq' ), '<a href="https://github.com/danieldavidson/blanq">blanq</a>', '<a href="http://automattic.com/" rel="designer">Automattic</a>' ); ?>
      </div><!-- .site-info -->
    </div><!-- /row -->
  </div><!-- /container -->
</footer><!-- #colophon .site-footer -->

<?php wp_footer(); ?>

</body>
</html>