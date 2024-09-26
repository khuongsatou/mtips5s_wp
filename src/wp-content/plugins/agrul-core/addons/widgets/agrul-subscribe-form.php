<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Background;
/**
 * 
 * Newsletter Widget .
 *
 */
class Agrul_Subscribe_Widgets extends Widget_Base {

	public function get_name() {
		return 'agrulnewsletter';
	}

	public function get_title() {
		return __( 'Agrul Newsletter', 'agrul' );
	}


	public function get_icon() {
		return 'eicon-code';
    }
    

	public function get_categories() {
		return [ 'agrul_elements' ];
	}

	
	protected function register_controls() {

		$this->start_controls_section(
			'newsletter_content',
			[
				'label' 	=> __( 'Newsletter', 'agrul' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

       
		$this->add_control(
			'newsletter_placeholder',
			[
				'label' 		=> __( 'Newsletter Placeholder Text', 'agrul' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Enter Your Email', 'agrul' ),
			]
		);
		$this->add_control(
			'newsletter_button',
			[
				'label' 		=> __( 'Newsletter Button Text', 'agrul' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> __( 'Subscribe', 'agrul' ),
				'rows' 			=> 2,
			]
		);
		
        $this->end_controls_section();

        
        $this->start_controls_section(
			'subscribe_section',
			[
				'label' 	=> __( 'Subscribe Form Style', 'agrul' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'form_bg_color',
			[
				'label' 	=> __( 'Form Background Color', 'agrul' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} input' => 'background-color: {{VALUE}}',
                ]
			]
        );
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'border2',
				'label' 	=> __( 'Border', 'agrul' ),
                'selector' 	=> '{{WRAPPER}}  input',
			]
		);
		$this->add_control(
			'btn_color',
			[
				'label' 		=> __( 'Button Color 1 ', 'agrul' ),
				'type' 			=> Controls_Manager::COLOR,
			]
        );
        $this->add_control(
			'btn_color2',
			[
				'label' 		=> __( 'Button Color 2', 'agrul' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}}  button' => 'background-image: -webkit-linear-gradient(45deg,{{btn_color.VALUE}} 0%,{{VALUE}} 50%);',
                ],
			]
        );


		$this->end_controls_section();
	}

	protected function render() {

    $agrul_newsletter = $this->get_settings_for_display();

        echo '<form class="newsletter-form">';
            echo '<input type="email" placeholder="'.esc_attr( $agrul_newsletter['newsletter_placeholder'] ).'" class="form-control" name="email">';
            echo '<button type="submit"> '.esc_html( $agrul_newsletter['newsletter_button'] ).'</button>  ';
        echo '</form>';
    }

}

						