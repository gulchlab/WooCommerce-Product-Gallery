<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;
$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$placeholder       = has_post_thumbnail() ? 'with-images' : 'without-images';
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . $placeholder,
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
) );

// gallery attachment first image
$attachment_ids = $product->get_gallery_image_ids();
$attachment_first_image			= wp_get_attachment_image_src( $attachment_ids[0], 'full' );
$attachment_first_image_thumb	= wp_get_attachment_image_src( $attachment_ids[0], 'shop_thumbnail' );
$image_first_title       		= get_post_field( 'post_excerpt', $attachment_ids[0] );
if ($attachment_ids) {
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<figure class="woocommerce-product-gallery__wrapper">
		<?php
		// attribute gallery thumb
		$attributes_fthumb = array(
			'title'                   => $image_first_title,
			'data-src'                => $attachment_first_image[0],
			'data-large_image'        => $attachment_first_image[0],
			'data-large_image_width'  => $attachment_first_image[1],
			'data-large_image_height' => $attachment_first_image[2],
		);

			$html  = '<div data-thumb="' . esc_url( $attachment_first_image_thumb[0] ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $attachment_first_image[0] ) . '">';
			$html .= wp_get_attachment_image( $attachment_ids[0], 'shop_single', false, $attributes_fthumb );
	 		$html .= '</a></div>';

		do_action( 'woocommerce_product_thumbnails' );
		?>
	</figure>
</div>
<?php } ?>
