<?php

if (!function_exists('rishi__cb_customizer_validate_color')) {
	function rishi__cb_customizer_validate_color( $color )
	{
		/**
		 * Allow hex colors
		 */
		if (sanitize_hex_color($color)) {
			return $color;
		}

		/**
		 * Allow rgb* colors
		 */
		if (strpos($color, 'rgb') !== false) {
			return $color;
		}

		/**
		 * Allow var(--global) values
		 */
		if (strlen($color) > 2 && substr($color, 0, 5) === "var(--") {
			return $color;
		}

		if ($color === 'CT_CSS_SKIP_RULE') {
			return $color;
		}

		return null;
	}
}

if (!function_exists('rishi__cb_customizer_validate_single_slider')) {
	function rishi__cb_customizer_validate_single_slider( $option, $value )
	{
		if (!intval($value) && intval($value) !== 0) {
			return null;
		}

		return true;
	}
}

if (!function_exists('rishi__cb_customizer_validate_for')) {
	function rishi__cb_customizer_validate_for( $option, $input )
	{
		if (
			$option['type'] === 'rara-switch'
			||
			$option['type'] === 'rt-panel'
		) {
			if (in_array($input, ['yes', 'no'], true)) {
				return $input;
			}

			return $option['value'];
		}

		if ($option['type'] === 'text' || $option['type'] === 'textarea') {
			return wp_kses_post($input);
		}

		if ($option['type'] === 'rt-color-picker') {
			if (!is_array($input)) {
				return $option['value'];
			}

			foreach ($input as $single_color) {
				if (!isset($single_color['color'])) {
					return $option['value'];
				}

				if (rishi__cb_customizer_validate_color($single_color['color'])) {
					return $option['value'];
				}
			}
		}

		if (
			$option['type'] === 'rt-select'
			||
			$option['type'] === 'rt-image-picker'
			||
			$option['type'] === 'rt-radio'
		) {
			if (!in_array(
				$input,
				array_reduce(
				 rishi__cb_customizer_ordered_keys($option['choices']),
					function ($current, $item) {
						return array_merge($current, [$item['key']]);
					},
					[]
				),
				true
			)) {
				return $option['value'];
			}
		}

		if (
			$option['type'] === 'rt-checkboxes'
			||
			$option['type'] === 'rt-visibility'
		) {
			foreach ($input as $key => $value) {
				if (
					!is_bool($value)
					||
					!in_array(
						$key,
						array_reduce(
						 rishi__cb_customizer_ordered_keys($option['choices']),
							function ($current, $item) {
								return array_merge($current, [$item['key']]);
							},
							[]
						),
						true
					)
				) {
					return $option['value'];
				}
			}
		}

		if ($option['type'] === 'rt-number') {
			if (!is_numeric($input)) {
				return $option['value'];
			}

			return max(
				intval($option['min']),
				min(intval($option['max']), intval($current))
			);
		}

		if ($option['type'] === 'rt-slider') {
			if ($option['responsive']) {
				foreach (array_values(
					 rishi__cb_customizer_expand_responsive_value($input)
					) as $single_value) {
					if (rishi__cb_customizer_validate_single_slider($single_value)) {
						return $option['value'];
					}
				}
			}

			if (
				is_array($input)
				||
				rishi__cb_customizer_validate_single_slider($input)
			) {
				return $option['value'];
			}
		}

		if ($option['type'] === 'rt-image-uploader') {
			if (
				!is_array($input)
				||
				!isset($input['attachment_id'])
				||
				!wp_attachment_is_image($input['attachment_id'])
			) {
				return $option['value'];
			}
		}

		return $input;
	}
}

if (!function_exists('rishi__cb_customizer_include_sanitizer')) {
	function rishi__cb_customizer_include_sanitizer( $option )
	{
		if (isset($option['sanitize_callback'])) {
			return $option;
		}

		$option['sanitize_callback'] = function ($input, $setting) use ($option) {
			return rishi__cb_customizer_validate_for($option, $input);
		};

		return $option;
	}
}
