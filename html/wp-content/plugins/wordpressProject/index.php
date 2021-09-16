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

if (!defined('ABSPATH')) exit;

function Activate(){
}

function Deactivate(){
	flush_rewrite_rules();
}

echo "Hola soy plugin";

register_activation_hook(__FILE__, 'Activate');
register_deactivation_hook(__FILE__, 'Deactivate');

add_action('admin_menu', 'CreateMenu');

function CreateMenu() {
	add_menu_page(
		'Instrucciones de uso del plugin Menú', //pageTitle
		'DonationPlugin',//menuTitle
		'manage_options',//capability
		plugin_dir_path(__FILE__) . 'admin/mainpage.php',//menuSlug
		null, //functionName
		'1' //position
	);
	add_submenu_page(
		plugin_dir_path(__FILE__) . 'admin/mainpage.php',//menuSlug
		'Submenu 1',
		'Historial de Donaciones',
		'manage_options',
		plugin_dir_path(__FILE__) . 'admin/history.php',
		null,
		'2'
	);
	add_submenu_page(
		plugin_dir_path(__FILE__) . 'admin/mainpage.php',//menuSlug
		'Submenu 2',
		'Settings Culqi',
		'manage_options',
		plugin_dir_path(__FILE__) . 'admin/settings.php',
		null,
		'3'
	);
}

add_shortcode('ShortcodeDonate', 'ShortcodeDonation');
function ShortcodeDonation($atts){
	//attributes
	$atts = shortcode_atts(
		array(
			'button_text3' => 'Donar',
			'text_content' => ''
		),
		$atts
	);
	return '
		<div>
			<button
				onclick="document.querySelector(\'.donation-plugin-modal\').style.display = \'block\'"
			>'
			. $atts['button_text3'] .
			'</button>
      <div class="donation-plugin-modal" style="display: none;">
        <form method="post">
					<div class="mb-2">
						<label for="exampleInputEmail1" class="form-label">Nombres</label>
						<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="name">
					</div>
					<div class="mb-2">
						<label for="exampleInputEmail1" class="form-label">Apellidos</label>
						<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="name">
					</div>
					<div class="mb-2">
						<label for="exampleInputEmail1" class="form-label">Correo</label>
						<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					</div>
					<div class="mb-3">
						<label for="exampleInputPassword1" class="form-label">Llave</label>
						<input type="password" class="form-control" id="exampleInputPassword1">
						<div id="emailHelp" class="form-text">Tu llave es confidencial.</div>
					</div>
					<button type="submit" class="btn btn-primary">Guardar</button>
        </form>
      </div>
    </div>
    ';
}
