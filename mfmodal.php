<?php

/**
 * Plugin Name:       MF Modal Button
 * Plugin URI:        https://www.mario-flores.com/
 * Description:       Add a button to open a modal window
 * Version:           1.2.2
 * Requires at least: 5.2
 * Requires PHP:      5.6
 * Author:            Mario Flores
 * Author URI:        https://mario-flores.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       mf_model
 * Domain Path:       /mfmodal
 */

define('MFMODAL_VERSION', '1.2.2');

add_action('wp_enqueue_scripts', 'mf_modal_enqueue');

function mf_modal_enqueue()
{
    wp_enqueue_style(
        'bootstrap',
        plugins_url('/css/bootstrap.min.css', __FILE__)
    );
    wp_enqueue_style(
        'mfmodal',
        plugins_url('/css/mfmodal.css', __FILE__),
        array('bootstrap'),
        MFMODAL_VERSION
    );
    wp_enqueue_script(
        'mfmodal',
        plugins_url('/js/mfmodal.js', __FILE__),
        array(),
        MFMODAL_VERSION,
        true
    );
}

add_shortcode('mf_modal', 'mfmodal');
function mfmodal($attr = array(), $content = null)
{
    $param = shortcode_atts(
        array(
            'label' => 'Open',
            'button_class' => 'mf-modal-trigger',
            'modal_width' => 'modal-lg',
            'close_class' => 'btn-close',
            'title' => ''
        ),
        $attr
    );
    $modalid = uniqid();
    $titleid = 'mfmodal-title-' . $modalid;
    ob_start();
    include(plugin_dir_path(__FILE__) . 'views/modal.php');
    return ob_get_clean();
}

add_shortcode('mf_modal_iframe', 'mfmodaliframe');
function mfmodaliframe($attr = array())
{
    $param = shortcode_atts(
        array(
            'url' => '',
            'modal_width' => 'modal-lg',
            'button_class' => 'mf-modal-trigger',
            'close_class' => 'btn-close',
            'title' => '',
            'label' => 'Open',
            'modalid' => uniqid()
        ),
        $attr
    );
    $titleid = 'mfmodal-title-' . $param['modalid'];
    ob_start();
    include(plugin_dir_path(__FILE__) . 'views/modaliframe.php');
    return ob_get_clean();
}
