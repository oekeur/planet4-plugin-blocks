<?php

namespace P4BKS\Controllers\Blocks;

use P4BKS\Views\P4BKS_View;

if ( ! class_exists( 'P4BKS_Blocks_Controller' ) ) {

	/**
	 * Class P4BKS_Blocks_Controller
	 *
	 * @package P4BKS\Controllers\Blocks
	 */
	abstract class P4BKS_Blocks_Controller {

		/** @const string BLOCK_NAME
		 * The block's name.
		 */
		const BLOCK_NAME = 'default';

		/** @var string $block_name
		 * This property is replaced with the use of a const and Late Static Binding http://php.net/manual/en/language.oop5.late-static-bindings.php.
		 * Should be removed completely in following changes.
		 *
		 * @deprecated This property is no longer needed. This also results in children controllers not needing to override the load() method.
		 */
		protected $block_name = 'default';

		/** @var P4BKS_View $view */
		protected $view;

		/**
		 * Creates the plugin's controller object.
		 * Avoid putting hooks inside the constructor, to make testing easier.
		 *
		 * @param P4BKS_View $view The view object.
		 *
		 * @since 0.1.0
		 */
		public function __construct( P4BKS_View $view ) {
			$this->view = $view;
		}

		/**
		 * Hooks all the needed functions to load the block.
		 *
		 * @since 0.1.0
		 */
		public function load() {
			// Check to see if Shortcake is running, with an admin notice if not.
			add_action( 'init', array( $this, 'shortcode_ui_detection' ) );
			// Register the shortcodes.
			add_action( 'init', array( $this, 'shortcode_ui_register_shortcodes' ) );
			// Add Two Column element in UI.
			add_action( 'register_shortcode_ui', array( $this, 'prepare_fields' ) );

			// Register an admin render callback for previewing in the wysiwyg.
			add_action( 'wp_ajax_p4bks_preview_render_' . static::BLOCK_NAME, array( $this, 'prepare_admin_preview' ) );
		}

		/**
		 * If Shortcake isn't active, then add an administration notice.
		 *
		 * This check is optional. The addition of the shortcode UI is via an action hook that is only called in Shortcake.
		 * So if Shortcake isn't active, you won't be presented with errors.
		 *
		 * Here, we choose to tell users that Shortcake isn't active, but equally you could let it be silent.
		 *
		 * Why not just self-deactivate this plugin? Because then the shortcodes would not be registered either.
		 *
		 * @since 0.1.0
		 */
		public function shortcode_ui_detection() {
			if ( ! function_exists( 'shortcode_ui_register_for_shortcode' ) ) {
				add_action( 'admin_notices', array( $this, 'shortcode_ui_notices' ) );
			}
		}

		/**
		 * Display an administration notice if the user can activate plugins.
		 *
		 * If the user can't activate plugins, then it's poor UX to show a notice they can't do anything to fix.
		 *
		 * @since 0.1.0
		 */
		public function shortcode_ui_notices() {
			if ( current_user_can( 'activate_plugins' ) ) {
				?>
				<div class="error message">
					<p><?php esc_html_e( 'Shortcode UI plugin must be active for Planet4 - Blocks plugin to work.', 'planet4-blocks' ); ?></p>
				</div>
				<?php
			}
		}

		/**
		 * Register shortcodes
		 *
		 * This registration is done independently of any UI that might be associated with them, so it always happens, even if
		 * Shortcake is not active.
		 *
		 * @since 0.1.0
		 */
		public function shortcode_ui_register_shortcodes() {

			/**
			 * If we're in a request to admin render shortcodes, use a preview iframe for render so we
			 * can load in all the site styles.
			 *
			 * No clean filters/actions to check here so manually checking for ajax, action and user privs
			 */
			if (
				wp_doing_ajax()
				&& is_user_logged_in()
				&& wp_get_current_user()->has_cap( 'edit_posts' )
				&& isset( $_REQUEST['action'] )
				&& $_REQUEST['action'] === 'bulk_do_shortcode'
			) {
				// Render a preview iframe using a wrapper method.
				add_shortcode( 'shortcake_' . static::BLOCK_NAME, array( $this, 'prepare_template_preview_iframe' ) );
			} else {
				// Render using the default method.
				add_shortcode( 'shortcake_' . static::BLOCK_NAME, array( $this, 'prepare_template' ) );
			}
		}

		/**
		 * Shortcode UI setup for the twocolumn shortcode.
		 *
		 * It is called when the Shortcake action hook `register_shortcode_ui` is called.
		 *
		 * This example shortcode has many editable attributes, and more complex UI.
		 *
		 * @since 0.1.0
		 */
		abstract public function prepare_fields();

		/**
		 * Output markup of an iframe to render shortcode when previewing in admin edit screen.
		 *
		 * We need to load through iframe to enqueue frontend styles without breaking admin ui
		 *
		 * @param array  $fields         Associative array of shortcode paramaters.
		 * @param string $content        The content of the shortcode block for content wrapper shortcodes only.
		 * @param string $shortcode_tag  The name of the shortcode.
		 * @return string                The html markup for the shortcode preview iframe.
		 */
		public function prepare_template_preview_iframe( $fields, $content, $shortcode_tag ) {

			$request = add_query_arg(
				array_merge( $fields,
					[
						'_tag'     => $shortcode_tag,
						'_content' => $content,
						'_post_id' => get_the_ID(),
						'_nonce'   => wp_create_nonce( 'p4bks_preview_render_' . static::BLOCK_NAME ),
						'action'   => 'p4bks_preview_render_' . static::BLOCK_NAME,
					]
				),
				admin_url( 'admin-ajax.php' )
			);

			ob_start();
			?>
			<iframe width="100%" src="<?php echo esc_url( $request ); ?>" onload="this.style.height = this.contentWindow.document.body.scrollHeight + 'px';"></iframe>
			<?php
			return ob_get_clean();
		}

		/**
		 * Render preview markup for the shortcode when loading through an iframe.
		 *
		 * Takes a custom admin ajax request to render a shortcode and outputs shortcode
		 * via $this->prepare_template along with wrapper html and enqueued frontend styles and scripts.
		 */
		public function prepare_admin_preview() {

			// Shortcode UI not callable.
			if ( ! is_callable( 'Shortcode_UI', 'get_shortcode' ) ) {
				exit;
			}

			// Don't do anything if an invalid nonce.
			if ( ! wp_verify_nonce( $_GET['_nonce'], 'p4bks_preview_render_' . static::BLOCK_NAME ) ) {
				exit;
			}

			$tag                 = isset( $_GET['_tag'] ) ? sanitize_text_field( $_GET['_tag'] ) : '';
			$content             = isset( $_GET['_content'] ) ? wp_kses_post( $_GET['_content'] ) : '';
			$post_id             = isset( $_GET['_post_id'] ) && is_numeric( $_GET['_post_id'] ) ? absint( $_GET['_post_id'] ) : false;
			$shortcode_object    = \Shortcode_UI::get_instance()->get_shortcode( $tag );
			$shortcode_attrs     = is_array( $shortcode_object ) && is_array( $shortcode_object['attrs'] ) ? $shortcode_object['attrs'] : [];
			$shortcode_attr_keys = wp_list_pluck( $shortcode_attrs, 'attr' );
			$fields              = [];

			// Filter out any $_GET params not used by the shortcode.
			foreach ( $shortcode_attr_keys as $attr_key ) {
				if ( isset( $_GET[ $attr_key ] ) ) {
					$fields[ $attr_key ] = $_GET[ $attr_key ];
				}
			}

			$current_post = get_post( $post_id );

			// Setup postdata incase it's needed during shortcode render.
			if ( $current_post ) {
				// @codingStandardsIgnoreStart
				global $post;
				$post = $current_post;
				setup_postdata( $post );
				// @codingStandardsIgnoreEnd
			}

			?>
			<html>
				<head>
					<?php do_action( 'wp_head' ); ?>
				</head>
				<body style="background-color: transparent;">
					<?php echo $this->prepare_template( $fields, $content, $tag ); ?>
				</body>
				<footer>
					<?php do_action( 'wp_footer' ); ?>
				</footer>
			</html>
			<?php

			// Ajax callbacks need to call exit.
			exit;
		}

		/**
		 * Callback for the shortcode.
		 * It renders the shortcode based on supplied attributes.
		 *
		 * @param array  $fields         Associative array of shortcode paramaters.
		 * @param string $content        The content of the shortcode block for content wrapper shortcodes only.
		 * @param string $shortcode_tag  The name of the shortcode.
		 *
		 * @since 0.1.0
		 *
		 * @return string                The html markup for the shortcode preview iframe
		 */
		abstract public function prepare_template( $fields, $content, $shortcode_tag ) : string;

		/**
		 * Define the image sizes that should be used by each block for it's images
		 *
		 * @return array
		 */
		private function define_image_sizes_per_block() {

			$c     = get_called_class();
			$sizes = [];
			switch ( $c::BLOCK_NAME ) {
				case 'carousel_split':
					$sizes = [
						'p4-carousel-split-image-s',
						'p4-carousel-split-image-m',
						'p4-carousel-split-image-l',
						'p4-carousel-split-image-xl',
					];
					break;
				case 'happy_point':
					$sizes = [
						'p4-happy-point-image-s',
						'p4-happy-point-image-m',
						'p4-happy-point-image-l',
						'p4-happy-point-image-xl',
					];
					break;
				default:
					break;
			}

			return $sizes;
		}

		/**
		 * Get an image html tag based on the class (block) that is calling the method
		 *
		 * @param int/string $image_id WordPress image id.
		 *
		 * @return string
		 */
		protected function get_image_tag( $image_id ) {
			if ( function_exists( '\Planet4\Images\Sizes\construct_image_tag' ) ) {
				$sizes = $this->define_image_sizes_per_block();
				$img   = \Planet4\Images\Sizes\construct_image_tag( $image_id, $sizes );
			} else {
				$img = wp_get_attachment_image( $image_id );
			}

			return $img;
		}

		/**
		 * Get an image tag based on the class (block) that is calling the method
		 *
		 * @param int/string $image_id    WordPress image id.
		 * @param string     $css_classes Css classes.
		 * @param string     $background_properties Extra css background properties.
		 *
		 * @return string
		 */
		protected function get_css_image_rules( $image_id, $css_classes, $background_properties = '' ) {
			$img = '';
			if ( function_exists( '\Planet4\Images\Sizes\construct_css_background_image' ) ) {
				$sizes = $this->define_image_sizes_per_block();
				$img   = \Planet4\Images\Sizes\construct_css_background_image( $image_id, $sizes, $css_classes, $background_properties );
			} else {
				$source = wp_get_attachment_image_src( $image_id, 'full' );
				if ( ! empty( $source ) ) {
					$img = " $css_classes {
							   background: url('$source[0]') $background_properties ;
							} ";
				}
			}
			return $img;
		}

	}
}
