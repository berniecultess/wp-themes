/* ======================
    Backgrounds
   ====================== */
#header {
    <?php be_themes_set_backgrounds('header'); ?>
}
#footer {
    <?php be_themes_set_backgrounds('header'); ?>
}

#main {
    <?php be_themes_set_backgrounds('body'); ?>
}
<?php 
	if(!isset($be_themes_data['disable_smooth_scroll']) || empty($be_themes_data['disable_smooth_scroll']) || !$be_themes_data['disable_smooth_scroll']) { ?>
		html {
			overflow-y: hidden !important; 
		} <?php
	}
?>

<?php 

if(!isset($be_themes_data['content']['none'])) {  ?>
     ul.tabs li.ui-tabs-active, .separator.style-2:after {
         <?php be_themes_set_backgrounds('content'); ?>
    }
<?php } 

else{ ?>
     ul.tabs li.ui-tabs-active, .separator.style-2:after {
         <?php be_themes_set_backgrounds('body'); ?>
    }
<?php } ?>

/* ======================
    Typography
   ====================== */

body{
    <?php be_themes_print_typography('body_text'); ?>
}

h1{
     <?php be_themes_print_typography('h1'); ?>
}

h2{
    <?php be_themes_print_typography('h2'); ?>
}
h3{
    <?php be_themes_print_typography('h3'); ?>
}
h4{
    <?php be_themes_print_typography('h4'); ?>
}

h5{
    <?php be_themes_print_typography('h5'); ?>
}
h6{
    <?php be_themes_print_typography('h6'); ?>

}


#reply-title {
  font-size: <?php echo $be_themes_data['h4']['size']; ?>;
}

#navigation, .language-switcher-custom-wrap {
    <?php be_themes_print_typography('navigation_text'); ?>
  
    text-rendering:optimizeLegibility;
    -moz-osx-font-smoothing: grayscale;
  /*  -webkit-font-smoothing:antialiased; */
}

.top-header #navigation {
  <?php
    $logo_id = get_attachment_id_from_src($be_themes_data['logo']);
    $logo = wp_get_attachment_image_src($logo_id,'full');
    $logo_height = 38;
    if( isset( $logo[2] ) || !empty( $logo[2] ) ) {
      $logo_height = $logo[2];
    }
  ?>
   line-height: <?php echo $logo_height; ?>px;
}

.mobile-menu-controller i.font-icon {
  color: <?php echo $be_themes_data['navigation_text']['color']; ?>;
}

#navigation ul ul {
  font-size: 11px;
  line-height: 22px;
  color: #a3a3a3;
  font-family: "Noto Sans", Arial, sans-serif;
}

#navigation ul ul {
  background-color: <?php echo $be_themes_data['sub_menu_bg']; ?>;
  <?php be_themes_print_typography('sub_menu_text'); ?>
}
.top-header #navigation ul ul:after {
  border-bottom-color: <?php echo $be_themes_data['sub_menu_bg']; ?>;
}
.left-header #navigation ul ul:after {
  border-right-color: <?php echo $be_themes_data['sub_menu_bg']; ?>;
}
#header-bottom ,
#footer {
    <?php be_themes_print_typography('footer_text'); ?>
}

.recent_post_content a {
  color: <?php echo $be_themes_data['h1']['color']; ?> !important;
}

.ui-accordion .font-icon, ul.tabs li h6 { font-size: <?php echo $be_themes_data['body_text']['size']; ?> !important; }

.breadcrumbs a, .breadcrumbs a:visited { color: <?php echo $be_themes_data['body_text']['color']; ?> !important; } 

/* ======================
    Layout 
   ====================== */


.single-normal .be-section.single-portfolio-title {
  padding: 35px 0px 0px !important;
  /* box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.3); */
}
.be-section.single-portfolio-title .column-block {
  margin-bottom:0 !important;
}

/* ======================
    Colors 
   ====================== */

.sec-bg,
article.comment,
.woocommerce #reviews #comments ol.commentlist li .comment-text, .woocommerce-page #reviews #comments ol.commentlist li .comment-text,
.woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce #content nav.woocommerce-pagination ul li a:focus, .woocommerce-page nav.woocommerce-pagination ul li span.current, .woocommerce-page nav.woocommerce-pagination ul li a:hover, .woocommerce-page nav.woocommerce-pagination ul li a:focus, .woocommerce-page #content nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li a:focus,
.woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active,
ul.products li.product .product-inner-wrap,
.ui-tabs .ui-tabs-nav li a,
.ui-accordion .ui-accordion-header,
.pagination a, .pagination span, .pages_list a {
  background: <?php echo $be_themes_data['sec_bg']; ?>;
}
.sec-color,
article.comment,
.ui-tabs .ui-tabs-nav li a,
.ui-accordion .ui-accordion-header,
.pagination a, .pagination span, .pages_list a,
.blog-traditional-wrap #s,
.blog-traditional-wrap .search-icon {
  color: <?php echo $be_themes_data['sec_color']; ?>;
}

.sec-title-color,
.recentcomments a  {
  color:<?php echo $be_themes_data['sec_title_color']; ?>;
}

.post-nav,
.centered.portfolio-item .portfolio-item-terms,
.recent-post-date {
  color: <?php echo $be_themes_data['meta_colors']; ?>;
}



.alt-color,
li.ui-tabs-active h6 a,
#navigation a:hover,
#navigation .current-menu-item > a,
#navigation .current-menu-ancestor > a,
a,
a:visited,
.social_media_icons a:hover,
.post-title a:hover,
.fn a:hover,
.pricing-table .price,
a.team_icons:hover,
.portfolio-title a:hover,
.search-icon,
#s,
.portfolio-item.centered .portfolio-item-title a:hover, 
.separator.style-2:after,
.woocommerce ul.products li.product .price ins, .woocommerce-page ul.products li.product .price ins ,
.woocommerce.single-product .entry-summary .amount  {
    color: <?php echo $be_themes_data['color_scheme']; ?>;
}

.woocommerce.single-product .entry-summary del .amount {
  color:inherit;
}

.woocommerce #commentform input[type="submit"],
.shop_table.cart input[type="submit"],
.woocommerce .cart-collaterals .shipping_calculator .button, .woocommerce-page .cart-collaterals .shipping_calculator .button {
  background: <?php echo $be_themes_data['woo_sec_button_colors']; ?>;
  padding: 0 20px;
  color:#fff;
}

#s::-webkit-input-placeholder {
  color: <?php echo $be_themes_data['color_scheme']; ?>;
}
#s:-moz-placeholder {
  color: <?php echo $be_themes_data['color_scheme']; ?>;
}
#s::-moz-placeholder {
  color: <?php echo $be_themes_data['color_scheme']; ?>;
}
#s:-ms-input-placeholder {
  color: <?php echo $be_themes_data['color_scheme']; ?>;
}


.blog-traditional-wrap #s::-webkit-input-placeholder {
  color: <?php echo $be_themes_data['sec_color']; ?>;
}
.blog-traditional-wrap #s:-moz-placeholder {
  color: <?php echo $be_themes_data['sec_color']; ?>;
}
.blog-traditional-wrap #s::-moz-placeholder {
  color: <?php echo $be_themes_data['sec_color']; ?>;
}
.blog-traditional-wrap #s:-ms-input-placeholder {
  color: <?php echo $be_themes_data['sec_color']; ?>;
}


.recent_post_content a:hover,
.project_navigation a:hover h6  {
    color: <?php echo $be_themes_data['color_scheme']; ?> !important;
}

.ui-accordion-header-active a {
	color: <?php echo $be_themes_data['color_scheme']; ?> !important;
}

.alt-bg,
input[type="submit"],
.tagcloud a:hover,
.pagination a:hover,
.post-tags a:hover,
.widget_tag_cloud a:hover,
.flex-direction-nav a:hover,
.pagination .current,
.filters_list_container ,
.sidebar-widgets-wrap,
.portfolio_pagination.vertical,
.portfolio_pagination.horizontal,
.arrow_next .font-icon:hover , .arrow_prev .font-icon:hover,
.ui-tabs .ui-tabs-nav li.ui-tabs-active a ,
.ui-accordion .ui-accordion-header.ui-accordion-header-active.ui-state-active,
.woocommerce ul.products li.product .onsale, .woocommerce-page ul.products li.product .onsale ,
.woocommerce span.onsale, .woocommerce-page span.onsale,
.be-loader li:nth-child(1),
.be-loader li:nth-child(3),
.single_add_to_cart_button.button.alt,
.shop_table.cart input[type="submit"].checkout-button,
.elastislide-horizontal nav span:hover {
    background-color: <?php echo $be_themes_data['color_scheme']; ?>;
    transition: 0.4s ease-out all;
}

.photostream_overlay, .portfolio-overlay {
	background-color: <?php echo $be_themes_data['color_scheme']; ?>;
	opacity: 0.9;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=90)";
	filter: alpha(opacity=90);
	-moz-opacity: 0.9;
	-khtml-opacity: 0.9;
	opacity: 0.9;
}
.alt-bg-text-color,
input[type="submit"],
.tagcloud a:hover,
.pagination a:hover,
.post-tags a:hover,
.widget_tag_cloud a:hover,
.thumb-icons .font-icon,
.pagination .current,
.ui-tabs .ui-tabs-nav li.ui-tabs-active a,
.ui-accordion .ui-accordion-header.ui-accordion-header-active.ui-state-active,
.woocommerce ul.products li.product .onsale, .woocommerce-page ul.products li.product .onsale ,
.woocommerce span.onsale, .woocommerce-page span.onsale,
.single_add_to_cart_button.button.alt {
    color: <?php echo $be_themes_data['alt_bg_text_color'];  ?> !important;
    transition: 0.4s ease-out all;
}

.be-skill {
    transition: 1s ease-out width;
}




.widget_tag_cloud a, .widget_tag_cloud a:hover, #s,
.ui-tabs .ui-tabs-nav li.ui-tabs-active a  {
  border: 1px solid <?php echo $be_themes_data['color_scheme']; ?>;
}
.blog-traditional-wrap #s {
  border: 1px solid <?php echo $be_themes_data['sec_border']; ?>;
}
.widget , .widget:last-child{
  border-color: <?php echo $be_themes_data['alt_bg_border']; ?>;
}


.thumb-overlay {
  background-color: <?php echo $be_themes_data['color_scheme']; ?>;
  opacity:0.9;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=90)";
  filter: alpha(opacity=90);

}



.thumb-icons a {
	background-color: <?php echo $be_themes_data['color_scheme']; ?>;
	transition: 0.2s linear all;
}
.thumb-icons a {
	color: <?php echo $be_themes_data['alt_bg_text_color'];  ?>;
	transition: 0.2s linear all;
}
.thumb-icons a:hover{
	color: <?php echo $be_themes_data['color_scheme']; ?>;
}
.thumb-icons a:hover {
	background-color: <?php echo $be_themes_data['alt_bg_text_color'];  ?>;
}
.overlay-thumb-icons a,.overlay-thumb-title a,.overlay-thumb-title span {
	color: <?php echo $be_themes_data['alt_bg_text_color'];  ?>;
}

.filters_lists .current_choice{
   border-bottom-width:1px;
   border-bottom-style: solid;
   border-bottom-color: inherit;
}


.portfolio-title a{
    color: inherit;
}




.sidebar-navigation .current_page_item {
    border-right: 3px solid <?php echo $be_themes_data['color_scheme']; ?>;
    background: <?php echo $be_themes_data['alt_bg_text_color'];  ?> ;
}

.post-meta, .post-meta a{
    color: #999999;
}


pre {
    background-image: -webkit-repeating-linear-gradient(top, <?php echo $be_themes_data['content']['color']; ?> 0px, <?php echo $be_themes_data['content']['color']; ?> 30px, <?php echo $be_themes_data['sec_bg']; ?> 24px, <?php echo $be_themes_data['sec_bg']; ?> 56px);
    background-image: -moz-repeating-linear-gradient(top, <?php echo $be_themes_data['content']['color']; ?> 0px, <?php echo $be_themes_data['content']['color']; ?> 30px, <?php echo $be_themes_data['sec_bg']; ?> 24px, <?php echo $be_themes_data['sec_bg']; ?> 56px);
    background-image: -ms-repeating-linear-gradient(top, <?php echo $be_themes_data['content']['color']; ?> 0px, <?php echo $be_themes_data['content']['color']; ?> 30px, <?php echo $be_themes_data['sec_bg']; ?> 24px, <?php echo $be_themes_data['sec_bg']; ?> 56px);
    background-image: -o-repeating-linear-gradient(top, <?php echo $be_themes_data['content']['color']; ?> 0px, <?php echo $be_themes_data['content']['color']; ?> 30px, <?php echo $be_themes_data['sec_bg']; ?> 24px, <?php echo $be_themes_data['sec_bg']; ?> 56px);
    background-image: repeating-linear-gradient(top, <?php echo $be_themes_data['content']['color']; ?> 0px, <?php echo $be_themes_data['content']['color']; ?> 30px, <?php echo $be_themes_data['sec_bg']; ?> 24px, <?php echo $be_themes_data['sec_bg']; ?> 56px);
    display: block;
    line-height: 28px;
    margin-bottom: 50px;
    overflow: auto;
    padding: 0px 10px;
    border:1px solid <?php echo $be_themes_data['sec_border_color']; ?>;
}

.separator {
  border-color: <?php echo $be_themes_data['separator_color'];  ?> ;
  color: <?php echo $be_themes_data['separator_color'];  ?> ;
}

.tagcloud a {
  background: rgba(255,255,255,0.04);
}
.portfolio-categories h6, .filters h6, .post-nav h6, .post-author h6 {
  font-size:12px;
  font-weight:600;
  display: inline-block;
}
.post-nav h6 {
  color: #7a8593;
}
.post-category a, .post-title a ,
.post-header .project_client,
.woocommerce .cart-collaterals .cart_totals tr th,
.woocommerce .cart_totals strong ,
.woocommerce table.shop_table th, .woocommerce-page table.shop_table th,
.woocommerce table.shop_table th, .woocommerce-page table.shop_table th ,
.woocommerce table.shop_table tfoot td, .woocommerce table.shop_table tfoot th, .woocommerce-page table.shop_table tfoot td, .woocommerce-page table.shop_table tfoot th {
  color: <?php echo $be_themes_data['h1']['color'];  ?>;
}
.woocommerce .cart-collaterals .cart_totals tr th,
.woocommerce .cart_totals strong  {
  font-weight:normal !important;
}
.post-category a:hover, .post-title a:hover {
  color: <?php echo $be_themes_data['color_scheme']; ?>;
}
.portfolio-title h5, .recent-post-header h5{
    font-size: 16px;
}
.mejs-controls .mejs-time-rail .mejs-time-current ,
.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,
.language-switcher-custom-wrap,
.laguage-selector-icon {
    background: <?php echo $be_themes_data['color_scheme']; ?> !important;
} 
.call-to-action {
  background-color: #f8f8f8;
}

#navigation a:hover,
#navigation .current-menu-item > a, #navigation .current-menu-ancestor > a {
  color: #fff;
}

#navigation a:hover {
  color: <?php echo $be_themes_data['menu_hover_color'];  ?>;
}

#navigation .current-menu-item > a, #navigation .current-menu-ancestor > a {
  color: <?php echo $be_themes_data['menu_selected_color'];  ?>;
}

.current_choice {
  color: inherit;
}
 
.blog-posts .blog-title a:hover,
.woocommerce a.add_to_cart_button.button.product_type_simple.added, .woocommerce a.add_to_cart_button.button.product_type_simple.added:hover {
  color: <?php echo $be_themes_data['color_scheme'];  ?> !important;
}

.woocommerce a.add_to_cart_button.button.product_type_simple.added, .woocommerce a.add_to_cart_button.button.product_type_simple.added:hover {
  border: 1px solid <?php echo $be_themes_data['color_scheme'];  ?>;
}

.portfolio_pagination .load-more-btn {
  color: <?php echo $be_themes_data['alt_bg_text_color'];  ?>;
}

input[type="text"], 
input[type="email"], 
input[type="password"], 
textarea {
  background: <?php echo $be_themes_data['sec_bg'];  ?>;
  border: 1px solid <?php echo $be_themes_data['sec_border'];  ?>;
}

.blog-posts .blog-post.sticky .post-item-wrap {
  border-top: 5px solid <?php echo $be_themes_data['color_scheme'];  ?>;
}

.vertical .portfolio-item-heading {
  background-color: <?php echo $be_themes_data['vertical_portfolio_title_bg']; ?>;
}
.vertical .portfolio-item-cats,
.gallery-item-caption {
	background-color: <?php echo $be_themes_data['vertical_portfolio_cats_bg']; ?>;
}

.vertical .portfolio-item-heading {
  <?php be_themes_print_typography('vertical_portfolio_title'); ?>
}
.vertical .portfolio-item-cats {
  <?php be_themes_print_typography('vertical_portfolio_cats'); ?>
}

.centered .portfolio-item-title, .related-items .portfolio-item-title {
  <?php be_themes_print_typography('centered_portfolio_title'); ?>
}
.centered.portfolio-item .portfolio-item-terms, .related-items .portfolio-item-terms {
  <?php be_themes_print_typography('centered_portfolio_cats'); ?>
}

.arrow_next .font-icon, .arrow_prev .font-icon, .single_portfolio_info .font-icon, .single_portfolio_info_close .font-icon,
.flex-direction-nav a {
  background-color: <?php echo $be_themes_data['slider_arrow_bg']; ?>;
  color: <?php echo $be_themes_data['slider_arrow_color']; ?>;
}

.social_media_icons .font-icon:hover {
    background: <?php echo $be_themes_data['social_icon_colors']; ?>;
}
.social_media_icons.invert .icon-facebook,
.social_media_icons.invert .icon-twitter,
.social_media_icons.invert .icon-gplus,
.social_media_icons.invert .icon-instagramm,
.social_media_icons.invert .icon-dribbble,
.social_media_icons.invert .icon-skype,
.social_media_icons.invert .icon-youtube,
.social_media_icons.invert .icon-pinterest-circled,
.social_media_icons.invert .icon-flickr,
.social_media_icons.invert .icon-linkedin {
   background: <?php echo $be_themes_data['social_icon_colors']; ?>;
}

.gallery-item-caption {
  background-color: <?php echo $be_themes_data['gallery_caption_bg']; ?>;
  color: <?php echo $be_themes_data['gallery_caption_text_color']; ?>;
}

@media only screen and (max-width: 1279px) {
  #navigation{
    <?php
      $logo_id = get_attachment_id_from_src($be_themes_data['logo']);
      $logo = wp_get_attachment_image_src($logo_id,'full');
      $logo_height = 38;
      if( isset( $logo[2] ) || !empty( $logo[2] ) ) {
        $logo_height = $logo[2];
      }
    ?>
    line-height: <?php echo $logo_height; ?>px;
  }
}


/*  Optiopn Panel Css */
<?php echo stripslashes_deep(htmlspecialchars_decode($be_themes_data['custom_css'],ENT_QUOTES));  ?>

<?php
	if(empty($be_themes_data['disable_loader']) || !($be_themes_data['disable_loader'])) {
		if(!empty($be_themes_data['custom_loader'])) {
			$loader_id = get_attachment_id_from_src($be_themes_data['custom_loader']);
			$loader = wp_get_attachment_image_src($loader_id, 'full'); ?>
			.page-loader {
				margin-top: -<?php echo ($loader[2]/2).'px !important;'; ?>
				margin-right: -<?php echo ($loader[1]/2).'px !important;'; ?>
			} <?php
		}
	}
?>