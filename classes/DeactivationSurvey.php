<?php

class DeactivationSurvey {

  public function init() {

    add_action('admin_print_scripts', array($this, 'js'), 20);
    add_action('admin_print_scripts', array($this, 'css'));
    add_action('admin_footer', array($this, 'modal'));
  }

  private function shouldShow() {
    if(!function_exists('get_current_screen')) {
      return false;
    }
    $screen = get_current_screen();
    if(!is_object($screen)) {
      return false;
    }
    return (in_array(get_current_screen()->id, array('plugins', 'plugins-network'), true));
  }

   public function js() {
    if(!$this->shouldShow()) {
       return;
     }
    wp_register_script( 'survey_js', ES_URL . 'deactivationSurvey/js.js' );
    wp_enqueue_script( 'survey_js' );
   }

   public function css() {
     if(!$this->shouldShow()) {
       return;
     }
     wp_register_style( 'survey_css', ES_URL . 'deactivationSurvey/css.css' );
     wp_enqueue_style( 'survey_css' );
   }

   public function modal() {
     if(!$this->shouldShow()) {
       return;
     }
     include_once(ES_DIR.'deactivationSurvey'.DIRECTORY_SEPARATOR.'index.html');
   }
}
