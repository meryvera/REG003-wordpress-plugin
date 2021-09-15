<?php
/*
Plugin Name: plugin donation
Plugin URI: https://example.com/plugin-name
Description: Este un plugin para donación de dinero a organizaciones sin fines de lucro y puede ser integrado con la pasarela de pago Culqi.
Version: 0.0.1
Requires at Least: 5.6.1
Requires PHP: 7.4.14
Author: Astrid & Mery
Licence: MIT
*/

if(!defined('ABSPATH')) exit;

function Activate(){

}
function Deactivate(){
    flush_rewrite_rules();
}

echo"Hola soy plugin";

register_activation_hook(__FILE__, 'Activate');
register_deactivation_hook(__FILE__, 'Deactivate');

add_action('admin_menu', 'CreateMenu');

function CreateMenu() {
    add_menu_page(
        'Instrucciones de uso del plugin Menú',
        'DonationPlugin',
        'manage_options',
        plugin_dir_path(__FILE__). 'admin/table.php',
        null,
        '1'
    );
}

// function ShowContent() {
//     echo "<h1>Instrucciones para usar el plugin de donación</h1>";
// }
// 'sp_menu',
// 'ShowContent',

// Shortcode

function example_plugin()
{
	/* create a variable to hold the html information */
	$content = ''; /* creates a string variable */

	/* open the form tag */
	$content .= '<form method="post" action="'.plugin_dir_path(__FILE__).'admin/processed.php">'; /* adds to the string variable */

	$content .= '<input type="number" name="Importe" placeholder="Monto a aportar" /><br /><br />';
	$content .= '<input type="text" name="your_name" placeholder="Nombre completo" /><br /><br />';
	$content .= '<input type="email" name="your_email" placeholder="Email" /><br /><br />';
    $content .= '<input type="number" name="phone" placeholder="Número de teléfono" /><br /><br />';
    $content .= '<input type="number" name="card" placeholder="Número de tarjeta" /><br /><br />';
    $content .= '<input type="date" name="expiration" placeholder="Fecha de exp." /><br /><br />';
    $content .= '<input type="number" name="cvv" placeholder="CVV" /><br /><br />';

	$content .= '<input type="submit" name="form_exaple_contact_submit" value="DONAR" /><br /><br />';

	/* close the form tag */
	$content .= '</form>';

	return $content;
}
add_shortcode('pluginForm' , 'example_plugin');

function Shortcode() {
    return "<button>Dona acá</button>";
} add_shortcode('plugin_shortcode', 'Shortcode');

function Shortcode2($atts) {
    //attributes
    $atts = shortcode_atts(
        array( 'button_text2' => 'Donar'), $atts
    );
    return 'Hola, este es el: '.$atts['button_text2'];
} add_shortcode('plugin_shortcode2', 'Shortcode2');


add_shortcode('plugin_shortcode3', 'Shortcode3');
function Shortcode3($atts) {
    //attributes
    $atts = shortcode_atts(
        array( 'button_text3' => 'Donar'
        ), $atts
    );
    //return '<button onclick="console.log(\'hola\')" data-toggle="modal" data-target="#ourModal">'. $atts['button_text3'] . '</button>';
    return '<button onclick="window.location=\'form.php\'" data-toggle="modal" data-target="#ourModal">'. $atts['button_text3'] . '</button>';
} 