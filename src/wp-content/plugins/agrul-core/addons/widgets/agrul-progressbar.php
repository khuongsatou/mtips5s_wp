<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Background;
/**
 *
 * Progressbar Widget .
 *
 */
class Elementor_Agrul_Progressbar extends Widget_Base{

	public function get_name() {
		return 'agrul_progressbar';
	}

	public function get_title() {
		return __( 'Agrul Progressbar', 'agrul-core' );
	}

	public function get_icon() {
		return 'eicon-code';
    }
    
	public function get_categories() {
		return [ 'agrul_elements' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'progressbar_section',
			[
				'label' 	=> __( 'Progressbar', 'agrul-core' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'skill_bar_text',
			[
				'label' 	=> __( 'Skill Bar Text', 'agrul-core' ),
				'type' 		=> Controls_Manager::TEXTAREA,
				'rows' 		=> 2,
			]
		);

		$repeater->add_control(
			'progress_bar_width',
			[
				'label' 		=> __( 'Skill Bar Width', 'agrul-core' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 	=> 0,
						'max' 	=> 100,
					],
				],
				'default' 	=> [
					'unit' 		=> '%',
					'size' 		=> 70,
				],
			]
		);

		$this->add_control(
			'slides',
			[
				'label' 		=> __( 'Skill Bar', 'agrul-core' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'skill_bar_text' => __( 'Repairs','agrul-core' ),
					],
					[
						'skill_bar_text' => __( 'Repairs','agrul-core' ),
					],
				],
				'title_field' => '{{{ skill_bar_text }}}',
			]
		);
		$this->end_controls_section();

		
		$this->start_controls_section(
			'progress_bar_style',
			[
				'label' 	=> __( 'Title Style', 'agrul-core' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' 		=> __( 'Title Color', 'agrul-core' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .skill-items .progress-box h5' => 'color: {{VALUE}}',
                ],
			]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'title_typography',
				'label' 	=> __( 'Title Typography', 'agrul-core' ),
                'selector' 	=> '{{WRAPPER}} .skill-items .progress-box h5',
			]
        );
       
		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		echo '<!-----------------------Start Progressbar----------------------->';
		echo '<div class="bottom-info">';
			echo '<div class="skill-items">';
			    foreach( $settings['slides'] as $single_data ){
				    echo '<div class="progress-box">';
				    	if( ! empty( $single_data['skill_bar_text'] ) ){
					        echo '<h5>'.esc_html( $single_data['skill_bar_text'] ).'</h5>';
					    }

				        echo '<div class="progress">';
				        	if( ! empty( $single_data['progress_bar_width'] ) ){
					            echo '<div class="progress-bar" role="progressbar" data-width="'.esc_attr( $single_data['progress_bar_width']['size'] ).'">';
					                 echo '<span>'.esc_html( $single_data['progress_bar_width']['size'] ).'%</span>';
					            echo '</div>';
					        }
				        echo '</div>';
				    echo '</div>';
			    }
			echo '</div>';
		echo '</div>';
		echo '<!-----------------------End Progressbar----------------------->';
	}
}