<?php
	// --- 1° 	TO DO	Add description Pluging
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

	//require
	require_once dirname(__FILE__) . '/classes/shortcode.class.php';

	if (!defined('ABSPATH')) exit;

	// --- 2° 	TO DO	Add Plugin Hook Activation
	// Function Activation Plugin 	
	function Activate(){
	// crea una tabla de bd desde wordpress - donaciones
	global $wpdb;
	//Use comands SQL
	//Create DB_TableName => 'wp_donaciones' (
	// 1° nameUniqueKey		-	data_type		-	NOT NULL OR NULL AND/OR AUTO_INCREMENT
	// 2° property_name
	// INT => 'number not decimal'	-	VARCHAR=>'string' =>VARCHAR(number=>'lenght')
	$sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}donaciones(
		`DonacionId` INT NOT NULL AUTO_INCREMENT,
		`Monto` INT NOT NULL,
		`Nombre` VARCHAR(50) NULL,
		`Email` VARCHAR(50) NULL,
		`Telefono` INT NOT NULL,
		PRIMARY KEY (`DonacionId`));";

	$wpdb->query($sql);

	// crea una tabla de bd desde wordpress - settings	
	$settingsTable = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}settings(
		`SettingsId` INT NOT NULL AUTO_INCREMENT,
		`SecretKey` VARCHAR(40) NOT NULL,
		`PublicKey` VARCHAR(40) NULL,
		`OrgName` VARCHAR(40) NULL,
		PRIMARY KEY (`SettingsId`));";

	$wpdb->query($settingsTable);
	}

	function Deactivate(){
		flush_rewrite_rules();
	}

// ------- 3° 	TO DO	Confing menu section plugin
// ---------------Config menu plugging-----------------------

	register_activation_hook(__FILE__, 'Activate');
	register_deactivation_hook(__FILE__, 'Deactivate');

	add_action('admin_menu', 'CreateMenu');

	function CreateMenu() {
		// seteando menús y submenús del plugin
		add_menu_page(
			'Instrucciones de uso del plugin Menú', //pageTitle
			'DonationPlugin',//menuTitle
			'manage_options',//capability
			plugin_dir_path(__FILE__) . 'admin/mainpage.php',//menuSlug
			null, //functionName
			plugin_dir_url(__FILE__) . 'admin/icon.png',
			'1', //position
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

	// Seteando titulo del shortcode
	// add_shortcode=> WordPress's function 'prefixing '
	// wordpress_function('title_name_to_call' , 'function_name')
	add_shortcode('ShortcodeDonate', 'ShortcodeDonation');

	function ShortcodeDonation($atts){
		$_short = new shortCode;
		shortcode_atts(array(
			'title' => '',
			'bg-color' => '',
			'button-color'=> '',
			'font-color'=> ''
		), $atts);
	
		$html = $_short->formulario($atts);
		return $html;
	}

	//enviando información del Webmaster
	if(isset($_POST['submitWebmasterInfo'])){ // isset -> evalua si una variable está definida - se ha mandado un formulario?
		$webmasterData = array("SecretKey"=>$_POST['secretKey'], "PublicKey"=>$_POST['publicKey'], "OrgName"=>$_POST['orgName']);
		$tabla = "wp_settings";//Tabla en base de datos
		$wpdb->insert($tabla,$webmasterData);
	}
?>
