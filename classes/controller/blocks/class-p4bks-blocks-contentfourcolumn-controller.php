<?php

namespace P4BKS\Controllers\Blocks;

if ( ! class_exists( 'P4BKS_Blocks_ContentFourColumn_Controller' ) ) {

	/**
	 * Class P4BKS_Blocks_ContentFourColumn_Controller
	 *
	 * @package P4BKS\Controllers\Blocks
	 */
	class P4BKS_Blocks_ContentFourColumn_Controller extends P4BKS_Blocks_Controller {

		/**
		 * Override this method in order to give your block its own name.
		 */
		public function load() {
			$this->block_name = 'content_four_column';
			parent::load();
		}

		/**
		 * Shortcode UI setup for content four column shortcode.
		 *
		 * It is called when the Shortcake action hook `register_shortcode_ui` is called.
		 *
		 * This example shortcode has many editable attributes, and more complex UI.
		 *
		 * @since 1.0.0
		 */
		public function prepare_fields() {

			$fields = [
				[
					'label' => __( 'Global Title', 'planet4-blocks' ),
					'attr'  => 'global_title',
					'type'  => 'text',
					'meta'  => [
						'placeholder' => __( 'Enter global title', 'planet4-blocks' ),
						'data-plugin' => 'planet4-blocks',
					],
				],
				[
					'label' => __( 'Text for action button', 'planet4-blocks' ),
					'attr'  => 'action_button_text',
					'type'  => 'url',
					'meta'  => [
						'placeholder' => __( 'Enter link text for action button', 'planet4-blocks' ),
						'data-plugin' => 'planet4-blocks',
					],
				],
				[
					'label' => __( 'Url for action button', 'planet4-blocks' ),
					'attr'  => 'action_button_url',
					'type'  => 'url',
					'meta'  => [
						'placeholder' => __( 'Enter link url for action button', 'planet4-blocks' ),
						'data-plugin' => 'planet4-blocks',
					],
				],
			];

			// This block will have additional 4 different columns with same fields.
			for ( $i = 1; $i < 5; $i++ ) {

				$fields[] =
					[
						// translators: placeholder needs to represent the ordinal of the column, eg. 1st, 2nd etc.
						'label'       => sprintf( __( 'Column %s: Select Image', 'planet4-blocks' ), $i ),
						'attr'        => 'attachment_' . $i,
						'type'        => 'attachment',
						'libraryType' => [ 'image' ],
						'addButton'   => __( 'Select Image', 'shortcode-ui' ),
						'frameTitle'  => __( 'Select Image', 'shortcode-ui' ),
					];

				$fields[] =
					[
						// translators: placeholder needs to represent the ordinal of the column, eg. 1st, 2nd etc.
						'label' => sprintf( __( 'Column %s: Title', 'planet4-blocks' ), $i ),
						'attr'  => 'title_' . $i,
						'type'  => 'text',
						'meta'  => [
							// translators: placeholder needs to represent the ordinal of the column, eg. 1st, 2nd etc.
							'placeholder' => sprintf( __( 'Column %s: Enter title', 'planet4-blocks' ), $i ),
							'data-plugin' => 'planet4-blocks',
						],
					];

				$fields[] =
					[
						// translators: placeholder needs to represent the ordinal of the column, eg. 1st, 2nd etc.
						'label' => sprintf( __( 'Column %s: Description', 'planet4-blocks' ), $i ),
						'attr'  => 'description_' . $i,
						'type'  => 'textarea',
						'meta'  => [
							// translators: placeholder needs to represent the ordinal of the column, eg. 1st, 2nd etc.
							'placeholder' => sprintf( __( 'Column %s: Enter description', 'planet4-blocks' ), $i ),
							'data-plugin' => 'planet4-blocks',
						],
					];

				$fields[] =
					[
						// translators: placeholder needs to represent the ordinal of the column, eg. 1st, 2nd etc.
						'label' => sprintf( __( 'Column %s: Text for Link', 'planet4-blocks' ), $i ),
						'attr'  => 'link_text_' . $i,
						'type'  => 'url',
						'meta'  => [
							// translators: placeholder needs to represent the ordinal of the column, eg. 1st, 2nd etc.
							'placeholder' => sprintf( __( 'Column %s: Enter link text', 'planet4-blocks' ), $i ),
							'data-plugin' => 'planet4-blocks',
						],
					];

				$fields[] =
					[
						// translators: placeholder needs to represent the ordinal of the column, eg. 1st, 2nd etc.
						'label' => sprintf( __( 'Column %s: Url for Link', 'planet4-blocks' ), $i ),
						'attr'  => 'link_url_' . $i,
						'type'  => 'url',
						'meta'  => [
							// translators: placeholder needs to represent the ordinal of the column, eg. 1st, 2nd etc.
							'placeholder' => sprintf( __( 'Column %s: Enter link url', 'planet4-blocks' ), $i ),
							'data-plugin' => 'planet4-blocks',
						],
					];
			}

			// Define the Shortcode UI arguments.
			$shortcode_ui_args = [
				// translators: A block that contains 4 different columns each one with title and description.
				'label'         => __( 'Content Four Column', 'planet4-blocks' ),
				'listItemImage' => '<img src="' . esc_url( plugins_url() . '/planet4-plugin-blocks/admin/images/content_four_column.png' ) . '" />',
				'attrs'         => $fields,
			];

			shortcode_ui_register_for_shortcode( 'shortcake_' . $this->block_name, $shortcode_ui_args );
		}

		/**
		 * Callback for content four column shortcode.
		 * It renders the shortcode based on supplied attributes.
		 *
		 * @param array  $attributes    Defined attributes array for this shortcode.
		 * @param string $content       Content.
		 * @param string $shortcode_tag Shortcode tag name.
		 *
		 * @return string Returns the compiled template.
		 */
		public function prepare_template( $attributes, $content, $shortcode_tag ) : string {

			$attributes_temp = [
				'global_title'       => $attributes['global_title'],
				'action_button_text' => $attributes['action_button_text'],
				'action_button_url'  => $attributes['action_button_url'],
			];

			for ( $i = 1; $i < 5; $i++ ) {
				$temp_array = [
					"title_$i"       => $attributes[ "title_$i" ],
					"description_$i" => $attributes[ "description_$i" ],
					"attachment_$i"  => $attributes[ "attachment_$i" ],
					"link_text_$i"   => $attributes[ "link_text_$i" ],
					"link_url_$i"    => $attributes[ "link_url_$i" ],
				];
				$attributes_temp = array_merge( $attributes_temp, $temp_array );
			}
			$attributes = shortcode_atts( $attributes_temp, $attributes, $shortcode_tag );

			for ( $i = 1; $i < 5; $i++ ) {
				$temp_array = wp_get_attachment_image_src( $attributes[ "attachment_$i" ] );
				if ( false !== $temp_array && ! empty( $temp_array ) ) {
					$attributes[ "attachment_$i" ] = $temp_array[0];
				}
			}

			$block_data = [
				'fields'              => $attributes,
			];

			// Shortcode callbacks must return content, hence, output buffering here.
			ob_start();
			$this->view->block( $this->block_name, $block_data );

			return ob_get_clean();
		}
	}
}