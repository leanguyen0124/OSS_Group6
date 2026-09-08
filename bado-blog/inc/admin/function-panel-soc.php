<?php
/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Social media customizer functionality
* ------------------------------------------------------------------------------ */


function badoblog_fun_customize_register_soc($wp_customize) {

	$form = get_theme_mod('badoblog_cus_soc_form', 'circle');

	// List of social networks
	$soc_net = '';
	$soc_net = apply_filters('dmcwzmulti_filter_soc_net', $soc_net, $form);
	if (empty($soc_net)) {
		$soc_net = array(
			'off' => '',
			'facebook' => 'Facebook',
			'instagram' => 'Instagram',
			'linkedin' => 'LinkedIn',
			'pinterest' => 'Pinterest',
			'skype' => 'Skype',
			'telegram' => 'Telegram',
			'tiktok' => 'TikTok',
			'twitterx' => 'Twitter X',
			'wechat' => 'WeChat',
			'whatsapp' => 'WhatsApp',
			'youtube' => 'YouTube'
		);
	}


	//? ========== ========== ========== Social link settings

	$wp_customize->add_setting(
		'badoblog_cus_soc_block',
		array(
		'sanitize_callback' => 'badoblog_fun_sanitize_elastic_soc',
		'default' => json_encode(array(
			array(
				'soc_net'		=> 'off',
				'soc_link'		=> '/',
				'soc_new_link'	=> 0,
			)
		))
	));

	$wp_customize->add_control(
		new badoblog_Elastic_Controler_soc(
			$wp_customize, 
			'badoblog_cus_soc_block',
			array(
				'priority' => 200,
				'label'               => esc_html__('Social links', 'bado-blog'),
				'description'         => esc_html__('Drag the block with the cursor to change the position of the links', 'bado-blog'),
				'section'             => 'badoblog_cus_section_soc',
				'settings'            => 'badoblog_cus_soc_block',
				'badoblog_box_label'       => esc_html__('Section with settings', 'bado-blog'),
				'badoblog_box_add_control' => esc_html__('Add section', 'bado-blog'),
			),
			array(
				'soc_net' => array(
					'type'  => 'select',
					'label' => esc_html__('Picture variant', 'bado-blog'),
					'options' => $soc_net,
					'default'	=> 'off',
					'class'     => 'class-soc-net'
				),
				'soc_link' => array(
					'type'      => 'url',
					'label'     => esc_html__('Link to social network (URL)', 'bado-blog'),
					'default'	=> '/',
					'class'     => 'class-soc-link'
				),
				'soc_new_link' => array(
					'type'      => 'checkbox',
					'label'     => esc_html__('Open link in new tab', 'bado-blog'),
					'default'	=> 0,
					'class'     => 'class-soc-new-link'
				)
			)
		)
	);

}
add_action('customize_register', 'badoblog_fun_customize_register_soc');


if (class_exists('WP_Customize_Control')) {
	class badoblog_Elastic_Controler_soc extends WP_Customize_Control {

		public $type = 'multi-elastic';

		public $badoblog_box_label = '';

		public $badoblog_box_add_control = '';

		private $cats = '';

		public $fields = array();

		public function __construct($manager, $id, $args = array(), $fields = array()) {
			$this->fields = $fields;
			$this->badoblog_box_label = $args['badoblog_box_label'] ;
			$this->badoblog_box_add_control = $args['badoblog_box_add_control'];
			$this->cats = get_categories(array( 'hide_empty' => false ));
			parent::__construct($manager, $id, $args);
		}

		public function render_content() {

			$values = json_decode($this->value());
			?>
			<span class="customize-control-title"><?php echo esc_html($this->label); ?></span>

			<?php if ($this->description) { ?>
				<span class="description customize-control-description">
					<?php echo wp_kses_post($this->description); ?>
				</span>
			<?php } ?>

			<ul class="multi-elastic-field-control-wrap">
				<?php
				$this->badoblog_fun_get_fields();
				?>
			</ul>

			<input type="hidden" <?php esc_attr($this->link()); ?> class="multi-elastic-collector" value="<?php echo esc_attr($this->value()); ?>">
			<button type="button" class="button badoblog-add-control-field"><?php echo esc_html($this->badoblog_box_add_control); ?></button>
			<?php

		}

		private function badoblog_fun_get_fields() {
			$fields = $this->fields;
			$values = json_decode($this->value());

			if (is_array($values)) {
				foreach ($values as $value) {
					$soc_title = '';
					if (
						isset($fields['soc_net']['options']) &&
						is_array($fields['soc_net']['options']) &&
						isset($value->soc_net) &&
						$value->soc_net !== 'off' &&
						isset($fields['soc_net']['options'][$value->soc_net])
					) {
						$soc_title = $fields['soc_net']['options'][$value->soc_net];
					}
					?>
					<li class="multi-elastic-field-control">
						<h3 class="multi-elastic-field-title">
							<span class="badoblog-soc-link-title"><?php echo esc_html($soc_title); ?></span>
						</h3>
						<div class="multi-elastic-fields">

							<?php
							foreach ($fields as $key => $field) {
								$class = isset($field['class']) ? $field['class'] : '';
								?>
								<div class="badoblog-fields badoblog-type-<?php echo esc_attr($field['type']).' '.$class; ?>">

									<?php
									$label = isset($field['label']) ? $field['label'] : '';
									$description = isset($field['description']) ? $field['description'] : '';
									if ($field['type'] != 'checkbox') { ?>
										<span class="customize-control-title"><?php echo esc_html($label); ?></span>
										<span class="description customize-control-description"><?php echo esc_html($description); ?></span>
									<?php
									}

									$new_value = isset($value->$key) ? $value->$key : '';
									$default = isset($field['default']) ? $field['default'] : '';

									switch ($field['type']) {

										case 'checkbox':
											echo '<label class="badoblog-def-checkbox" data-val="'.esc_attr($option).'">';
											echo '<input data-default="'.esc_attr($default).'" value="'.$new_value.'" data-name="'.esc_attr($key).'" type="checkbox" '.checked($new_value, 1, false).'>';
											echo esc_html($label);
											echo '<span class="description customize-control-description">'.esc_html($description).'</span>';
											echo '</label>';
											break;

										case 'url':
											echo '<input data-default="'.esc_attr($default).'" data-name="'.esc_attr($key).'" type="text" value="'.esc_url($new_value).'">';
											break;

										case 'selector':
											$options = $field['options'];
											echo '<div class="selector-labels-soc">';
											foreach ($options as $option => $val) {
												$class = ($new_value == $option) ? 'selector-soc-selected': '';
												echo '<label class="'.$class.'" data-val="'.esc_attr($option).'">';
												echo '<span class="badoblog-customize-soc">'.esc_html($val).'</span>';
												echo '</label>';
											}
											echo '</div>';
											echo '<input data-default="'.esc_attr($default).'" type="hidden" value="'.esc_attr($new_value).'" data-name="'.esc_attr($key).'">';
											break;

										case 'select':
											$options = $field['options'];
											echo '<select class="badoblog-custom-select dmcwzmulti-css-soc-select" data-current-value="" data-default="'.esc_attr($default).'"  data-name="'.esc_attr($key).'">';
												foreach ($options as $option => $val) {
													// Dropdown list of social networks
													printf('<option value="%s" %s>%s</option>', esc_attr($option), selected($new_value, $option, false), esc_html($val));
												}
											echo '</select>';
											break;

									} ?>
								</div>
								<?php
							} ?>

							<div class="clearfix multi-elastic-footer">
								<div class="alignright">
									<a class="button multi-elastic-field-close" href="#close"><?php esc_html_e('Roll up block', 'bado-blog') ?></a>
									<a class="button multi-elastic-field-remove" href="#remove"><?php esc_html_e('Delete block', 'bado-blog') ?></a>
								</div>
							</div>
						</div>
					</li>
					<?php	
				}
			}
		}

	}
}

function badoblog_fun_sanitize_elastic_soc($input) {
	$input_decoded = json_decode($input, true);
	if (!empty($input_decoded)) {
		foreach ($input_decoded as $boxes => $box) {
			foreach ($box as $key => $value) {
				if ($key == 'soc_net') {
					$input_decoded[$boxes][$key] = sanitize_text_field($value);
				} else if ($key == 'soc_link') {
					$input_decoded[$boxes][$key] = esc_url_raw($value);
				} else if ($key == 'soc_new_link') {
					$input_decoded[$boxes][$key] = ($value == 1) ? 1 : 0;
				}
			}
		}
		return json_encode($input_decoded);
	}
	return $input;
}