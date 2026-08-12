<?php
/**
 * Title: FAIR Certification Badge
 * Slug: spotlight-theme-2026/fair-badge
 * Categories: footer
 * Description: Press Council / FAIR certification image, used in the footer template part.
 * Inserter: no
 *
 * @package spotlight-theme-2026
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- wp:image {"width":"90px","height":"65px","sizeSlug":"full","linkDestination":"none","align":"right","className":"site-footer__certification is-resized"} -->
<figure class="wp-block-image alignright size-full is-resized site-footer__certification"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/logos/fair-logo.png' ) ); ?>" alt="<?php echo esc_attr__( 'Press Council FAIR certification', 'spotlight-theme-2026' ); ?>" style="width:90px;height:65px"/></figure>
<!-- /wp:image -->
