jQuery(document).ready(function() {
	var $product_container = jQuery('.products-wrap ul.products');
	$product_container.imagesLoaded( function() {
		$product_container.isotope({
			itemSelector : '.hentry'
		});
	});
	jQuery(window).smartresize(function() {
		$product_container.isotope( 'reLayout' );
	});
	jQuery(document).on( 'adding_to_cart', 'body', function(event, $this, $data) {
		$this.closest('.product-inner-wrap').find('.product-image-overlay').fadeIn(200);
		jQuery('.woocommerce.widget_shopping_cart.widget').find('.widget-content').slideDown().delay(3000).slideUp();
	});
	jQuery(document).on( 'added_to_cart', 'body', function() {
		jQuery('.product-image-overlay').fadeOut(200);
		$product_container.isotope( 'reLayout' );
	});
	jQuery("select.orderby,select#calc_shipping_country,select#calc_shipping_state").chosen({inherit_select_classes: true});
	jQuery("select.orderby,select#calc_shipping_country,select#calc_shipping_state").trigger("chosen:updated");
});