<?php
        acf_add_local_field_group([
            'key' => 'ai_settings',
            'title' => 'AIorg Settings',
            'fields' => [[
                'key' => 'field_usia',
                'label' => 'USIA Variant of AI',
                'name' => 'usia_variant',
                'type' => 'radio',
                'prefix' => '',
                'instructions' =>
                    'Enable USIA features',
                'required' => 'yes',
                'conditional_logic' => 0,
                'default_value' => 'no',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'readonly' => 0,
                'disabled' => 0,
                'other_choice' => 0,
                'save_other_choice' => 0,
                'layout' => 'horizontal',
                'choices' => [
                    'yes' => 'Yes',
                    'no' => 'No',
                ],
              ],
            ],
            'location' => [
                [
                    [
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'acf-options',
                    ],
                ],
            ],
            'menu_order' => 1, 'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'active' => true,
            'hide_on_screen' => '',
            'description' => 'Set default EAT settings site-wide.',
        ]);
