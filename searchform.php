<?php
/**
 * The template for displaying search forms in blanq
 *
 * @package blanq
 * @since blanq 1.0
 */
?>
  <form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search" class="form-search">    
    
    <div class="controls">
    
      <input type="text" class="search-query span4 field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'blanq' ); ?>" />
      <button type="submit" class="btn" name="submit" id="searchsubmit"><?php esc_attr_e( 'Search', 'blanq' ); ?></button>
    
    </div>
  </form>
