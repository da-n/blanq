<?php
/**
 * The template for displaying search forms in blanq
 *
 * @package blanq
 * @since blanq 1.0
 */
?>
  <form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search" class="form-search">    
    <input type="text" class="input-medium search-query field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" />
    <button type="submit" class="btn" name="submit" id="searchsubmit"><?php esc_attr_e( 'Search', 'blanq' ); ?></button>
  </form>
