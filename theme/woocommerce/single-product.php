<?php
global $product;

if ( wc_customer_bought_product( get_current_user()->user_email, get_current_user_id(), $product->id ) && ($product->downloadable == 'yes') ) {
echo '
	<div class="woocommerce"><div class="woocommerce-info wc-nonpurchasable-message">You\'ve already purchased this product. Download links below.<ul>' ;

if ( $downloads = WC()->customer->get_downloadable_products() ) {

	do_action( 'woocommerce_before_available_downloads' );

		$downloadID = $download['product_id'];
		$id = $product->id ?>

		<?php foreach ( $downloads as $download ) :

			if ($download['product_id'] == $product->id) {

				echo '<div class="product-page-links">';

				do_action( 'woocommerce_available_download_start', $download );

				if ( is_numeric( $download['downloads_remaining'] ) )
					echo apply_filters( 'woocommerce_available_download_count', '<span class="count">' . sprintf( _n( '%s download remaining', '%s downloads remaining', $download['downloads_remaining'], 'woocommerce' ), $download['downloads_remaining'] ) . '</span> ', $download );

					echo apply_filters( 'woocommerce_available_download_link', '<a class="download-link-product-page" href="' . esc_url( $download['download_url'] ) . '">' . $download['download_name'] . '</a>', $download ) ;

				do_action( 'woocommerce_available_download_end', $download );

				echo '</div>';

			}

			endforeach;

		do_action( 'woocommerce_after_available_downloads' );

	}

	echo '</div></div>';

}
?>
