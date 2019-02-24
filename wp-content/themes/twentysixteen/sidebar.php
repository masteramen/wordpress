<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<?php if ( is_active_sidebar( 'sidebar-1' )  ) : ?>
	<aside id="secondary" class="sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
		<div class="sfix"><!-- 240x600 -->
			<div class="fixedme">
				<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-9477174171188196" data-ad-slot="9597600460"
					data-ad-format="auto"></ins>
				<script>
					(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
			</div>
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		</div>

	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>