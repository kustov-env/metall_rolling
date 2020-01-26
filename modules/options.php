<?php
//Удаление версии Wordpress
remove_action('wp_head', 'wp_generator');
//Не выводить ошибки регистрации
add_filter('login_errors',create_function('$a', "return null;"));
//Проверка на SSL-атаки
global $user_ID;if($user_ID) {if(!current_user_can('level_10')) {if (strlen($_SERVER['REQUEST_URI']) > 255 || strpos($_SERVER['REQUEST_URI'], "eval(") || strpos($_SERVER['REQUEST_URI'], "CONCAT") || strpos($_SERVER['REQUEST_URI'], "UNION+SELECT") || strpos($_SERVER['REQUEST_URI'], "base64")) {@header("HTTP/1.1 414 Request-URI Too Long");@header("Status: 414 Request-URI Too Long");@header("Connection: Close");@exit;}}}
//Убираем версии скриптов
add_filter( 'script_loader_src', '_remove_script_version' );
add_filter( 'login_headerurl', create_function('', 'return get_home_url();') );
add_filter( 'style_loader_src', '_remove_script_version' );function _remove_script_version( $src ){$parts = explode( '?', $src );return $parts[0];}
//Убираем ненужные типы записей(Комментарии и ссылки)
add_action('admin_menu', 'remove_menus');function remove_menus(){global $menu;$restricted = array(__('Links'),__('Comments'),);end ($menu);while (prev($menu)){$value = explode(' ', $menu[key($menu)][0]);if( in_array( ($value[0] != NULL ? $value[0] : "") , $restricted ) ){unset($menu[key($menu)]);}}}
//Лотготип для админки
add_action('add_admin_bar_menus', 'reset_admin_wplogo');
function reset_admin_wplogo( ){remove_action( 'admin_bar_menu', 'wp_admin_bar_wp_menu', 10 );add_action( 'admin_bar_menu', 'my_admin_bar_wp_menu', 10 );}
function my_admin_bar_wp_menu( $wp_admin_bar ) {$wp_admin_bar->add_menu( array('id'    => 'wp-logo', 'title' => '<img style="height:25px;" src="'. get_bloginfo('template_url') .'/images/pre_slide.png" alt="Компания Феррум" >', 'href'  => home_url('/')));}
add_action('admin_head', 'custom_colors');function custom_colors() {echo '<style type="text/css">*{transition: all .75s!important;}.wp-core-ui .button-primary.button-hero,.wp-core-ui .button-primary{border: none;text-shadow: none;box-shadow: none!important;}.wp-core-ui .button-primary:hover,.wp-core-ui .button-primary:focus{background:#2d2d2e; }.wp-core-ui .button-primary,#adminmenu a:hover, #adminmenu li.menu-top:hover, #adminmenu li.opensub>a.menu-top, #adminmenu li>a.menu-top:focus,#adminmenu li.current a.menu-top, #adminmenu li.wp-has-current-submenu .wp-submenu .wp-submenu-head, #adminmenu li.wp-has-current-submenu a.wp-has-current-submenu, .folded #adminmenu li.current.menu-top{background: #a84c06!important;}#wpadminbar,#adminmenu, #adminmenuback, #adminmenuwrap{background: #ed6600!important;}#adminmenu .wp-has-current-submenu.opensub .wp-submenu li.current a:focus, #adminmenu .wp-has-current-submenu.opensub .wp-submenu li.current a:hover, #adminmenu .wp-submenu li.current a:focus, #adminmenu .wp-submenu li.current a:hover, #adminmenu a.wp-has-current-submenu:focus+.wp-submenu li.current a:focus, #adminmenu a.wp-has-current-submenu:focus+.wp-submenu li.current a:hover,#wpadminbar .menupop .menupop>.ab-item:hover:before, #wpadminbar .quicklinks .ab-sub-wrapper .menupop.hover>a .blavatar, #wpadminbar .quicklinks li a:focus .blavatar, #wpadminbar .quicklinks li a:hover .blavatar, #wpadminbar.mobile .quicklinks .ab-icon:before, #wpadminbar.mobile .quicklinks .ab-item:before,#collapse-button:focus, #collapse-button:hover,#adminmenu .wp-has-current-submenu .wp-submenu a:focus, #adminmenu .wp-has-current-submenu .wp-submenu a:hover, #adminmenu .wp-has-current-submenu.opensub .wp-submenu a:focus, #adminmenu .wp-has-current-submenu.opensub .wp-submenu a:hover, #adminmenu .wp-submenu a:focus, #adminmenu .wp-submenu a:hover, #adminmenu a.wp-has-current-submenu:focus+.wp-submenu a:focus, #adminmenu a.wp-has-current-submenu:focus+.wp-submenu a:hover, .folded #adminmenu .wp-has-current-submenu .wp-submenu a:focus, .folded #adminmenu .wp-has-current-submenu .wp-submenu a:hover{color:#fff;text-decoration: underline !important;} #wp-admin-bar-wp-logo a:hover,#wp-admin-bar-wp-logo:focus{background: transparent!important;</style>';}
/*Опции*/
add_action( 'admin_menu', 'get_option_ferrum' );
add_action('admin_init','get_all_option_ferrum');
//В вкладке настройки
function get_option_ferrum(){
	add_submenu_page( 'options-general.php', 'Настройки сайта', 'Настройки темы', 'manage_options', 'ferrum-options','get_ferrum_options' );
}
function get_ferrum_options(){
	?>
	<div class="wrap">
		<h2>Настройки</h2>
		<form action="options.php" method="post" enctype="multipart/form-data">
			<?php settings_fields( 'ferrum' ); ?>
			<?php do_settings_sections( 'ferrum-options' ); ?>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}
function get_all_option_ferrum(){
	register_setting('ferrum','ferrum-options','ferrum_validate');
    //Общие(Контакты,адреса,телефоны и прочее)
	add_settings_section( 'ferrum-option', 'Общие', '', 'ferrum-options' );
	//Для секции Плюсы
	add_settings_section( 'ferrum-content', 'Контент секции .plus', '', 'ferrum-options' );
    //Фавикон
	add_settings_field( 'favicon', 'Фавикон', 'get_favicon', 'ferrum-options', 'ferrum-option' , array('label_for' => 'favicon') );
	//Логотип
	add_settings_field( 'logo', 'Логотип', 'get_logo', 'ferrum-options', 'ferrum-option' , array('label_for' => 'logo') );
	//Прайс-лист
	add_settings_field( 'price_list', 'Прайс-лист', 'get_price_list', 'ferrum-options', 'ferrum-option' , array('label_for' => 'price_list') );
	//Телеоны
	add_settings_field( 'phone_1', 'Телефон №1', 'get_phone_1', 'ferrum-options', 'ferrum-option' , array('label_for' => 'phone_1') );
	add_settings_field( 'phone_2', 'Телефон №2', 'get_phone_2', 'ferrum-options', 'ferrum-option' , array('label_for' => 'phone_2') );
	//Склады
	add_settings_field( 'sclad_1', 'Склад №1', 'get_sclad_1', 'ferrum-options', 'ferrum-option' , array('label_for' => 'sclad_1') );
	add_settings_field( 'sclad_2', 'Склад №2', 'get_sclad_2', 'ferrum-options', 'ferrum-option' , array('label_for' => 'sclad_2') );
	//Офисы
	add_settings_field( 'office_1', 'Офис №1', 'get_office_1', 'ferrum-options', 'ferrum-option' , array('label_for' => 'office_1') );
	add_settings_field( 'office_2', 'Офис №2', 'get_office_2', 'ferrum-options', 'ferrum-option' , array('label_for' => 'office_2') );
	//Адреса
	add_settings_field( 'address_1', 'Адрес №1', 'get_address_1', 'ferrum-options', 'ferrum-option' , array('label_for' => 'address_1') );
	add_settings_field( 'address_2', 'Адрес №2', 'get_address_2', 'ferrum-options', 'ferrum-option' , array('label_for' => 'address_2') );
	//Почта
	add_settings_field( 'email_1', 'E-mail №1', 'get_email_1', 'ferrum-options', 'ferrum-option' , array('label_for' => 'email_1') );
	add_settings_field( 'email_2', 'E-mail №2', 'get_email_2', 'ferrum-options', 'ferrum-option' , array('label_for' => 'email_2') );
	//Iframe
	add_settings_field( 'map', 'Карта', 'get_map', 'ferrum-options', 'ferrum-option' , array('label_for' => 'map') );
	//Заголовок слайдера на главной
	add_settings_field( 'title', 'Заголовок слайдов', 'get_title_for_slider', 'ferrum-options', 'ferrum-option' , array('label_for' => 'title') );
    //Секция плюсов
	add_settings_field( 'plus_1', 'Контент №1', 'get_plus_1', 'ferrum-options', 'ferrum-content' , array('label_for' => 'plus_1') );
	add_settings_field( 'plus_2', 'Контент №2', 'get_plus_2', 'ferrum-options', 'ferrum-content' , array('label_for' => 'plus_2') );
	add_settings_field( 'plus_3', 'Контент №3', 'get_plus_3', 'ferrum-options', 'ferrum-content' , array('label_for' => 'plus_3') );
	add_settings_field( 'plus_4', 'Контент №4', 'get_plus_4', 'ferrum-options', 'ferrum-content' , array('label_for' => 'plus_4') );

}
function get_favicon(){
	$options = get_option('ferrum-options');
	?>
	<input type="file" name="favicon" id="favicon">
	<input type="hidden" name="favicon"  value="<?php echo $options['favicon']?>">
	<p>Size 32x32</p>
	<?php
	if( !empty($options['favicon']) ){
		echo "<p><img src='{$options['favicon']}'  width='40'></p>";
	}
}
function get_logo(){
	$options = get_option('ferrum-options');
	?>
	<input type="file" name="logo" id="logo">
	<input type="hidden" name="logo"  value="<?php echo $options['logo']?>">
	<?php
	if( !empty($options['logo']) ){
		echo "<p><img src='{$options['logo']}'  width='80'></p>";
	}
}
function get_price_list(){
	$options = get_option('ferrum-options');?>
	<input type="text" name="ferrum-options[price_list]"  value="<?php echo esc_attr($options['price_list'])?esc_attr($options['price_list']):''; ?>" class="regular-text" style="width: 100%;border: 1px dotted green;color: #000">
	<?php
}
function get_phone_1(){
	$options = get_option('ferrum-options');?>
	<input type="text" name="ferrum-options[phone_1]"  value="<?php echo esc_attr($options['phone_1'])?esc_attr($options['phone_1']):''; ?>" class="regular-text">
	<?php
}
function get_phone_2(){
	$options = get_option('ferrum-options');?>
	<input type="text" name="ferrum-options[phone_2]"  value="<?php echo esc_attr($options['phone_2'])?esc_attr($options['phone_2']):''; ?>" class="regular-text">
	<?php
}
function get_sclad_1(){
	$options = get_option('ferrum-options');?>
	<input type="text" name="ferrum-options[sclad_1]"  value="<?php echo esc_attr($options['sclad_1'])?esc_attr($options['sclad_1']):''; ?>" class="regular-text">
	<?php
}
function get_sclad_2(){
	$options = get_option('ferrum-options');?>
	<input type="text" name="ferrum-options[sclad_2]"  value="<?php echo esc_attr($options['sclad_2'])?esc_attr($options['sclad_2']):''; ?>" class="regular-text">
	<?php
}
function get_office_1(){
	$options = get_option('ferrum-options');?>
	<input type="text" name="ferrum-options[office_1]"  value="<?php echo esc_attr($options['office_1'])?esc_attr($options['office_1']):''; ?>" class="regular-text">
	<?php
}
function get_office_2(){
	$options = get_option('ferrum-options');?>
	<input type="text" name="ferrum-options[office_2]"  value="<?php echo esc_attr($options['office_2'])?esc_attr($options['office_2']):''; ?>" class="regular-text">
	<?php
}
function get_address_1(){
	$options = get_option('ferrum-options');?>
	<input type="text" name="ferrum-options[address_1]"  value="<?php echo esc_attr($options['address_1'])?esc_attr($options['address_1']):''; ?>" class="regular-text">
	<?php
}
function get_address_2(){
	$options = get_option('ferrum-options');?>
	<input type="text" name="ferrum-options[address_2]"  value="<?php echo esc_attr($options['address_2'])?esc_attr($options['address_2']):''; ?>" class="regular-text">
	<?php
}
function get_email_1(){
	$options = get_option('ferrum-options');?>
	<input type="text" name="ferrum-options[email_1]"  value="<?php echo esc_attr($options['email_1'])?esc_attr($options['email_1']):''; ?>" class="regular-text">
	<?php
}
function get_email_2(){
	$options = get_option('ferrum-options');?>
	<input type="text" name="ferrum-options[email_2]"  value="<?php echo esc_attr($options['email_2'])?esc_attr($options['email_2']):''; ?>" class="regular-text">
	<?php
}
function get_title_for_slider(){
	$options = get_option('ferrum-options'); ?>
	<textarea name="ferrum-options[title]" cols="30" rows="5" class="large-text code"><?php echo esc_attr($options['title'])?esc_attr($options['title']):' '; ?></textarea>
	<?php
}
function get_map(){
	$options = get_option('ferrum-options'); ?>
    <textarea name="ferrum-options[map]" cols="30" rows="5" class="large-text code"><?php echo esc_attr($options['map'])?esc_attr($options['map']):' '; ?></textarea>
	<?php
}
function get_plus_1(){
	$options = get_option('ferrum-options'); ?>
	<textarea name="ferrum-options[plus_1]" cols="30" rows="5" class="large-text code"><?php echo esc_attr($options['plus_1'])?esc_attr($options['plus_1']):' '; ?></textarea>
	<?php
}
function get_plus_2(){
	$options = get_option('ferrum-options'); ?>
	<textarea name="ferrum-options[plus_2]" cols="30" rows="5" class="large-text code"><?php echo esc_attr($options['plus_2'])?esc_attr($options['plus_2']):' '; ?></textarea>
	<?php
}
function get_plus_3(){
	$options = get_option('ferrum-options'); ?>
	<textarea name="ferrum-options[plus_3]" cols="30" rows="5" class="large-text code"><?php echo esc_attr($options['plus_3'])?esc_attr($options['plus_3']):' '; ?></textarea>
	<?php
}
function get_plus_4(){
	$options = get_option('ferrum-options'); ?>
	<textarea name="ferrum-options[plus_4]" cols="30" rows="5" class="large-text code"><?php echo esc_attr($options['plus_4'])?esc_attr($options['plus_4']):' '; ?></textarea>
	<?php
}
//Валидация для файлов
function ferrum_validate($options){
	$overrides = array('test_form' => false);
	foreach ($_FILES as $key=>$value){
		if( !empty($_FILES[$key]['tmp_name']) ){
			$file = wp_handle_upload( $_FILES[$key], $overrides );
			$options[$key] = $file['url'];
		}elseif(!empty($_POST[$key])){
			$options[$key] = $_POST[$key];
		}
	}
	return $options;
}