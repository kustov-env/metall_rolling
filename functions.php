<?php
//For Contact form 7
define( 'WPCF7_AUTOP', false );
//SUPPORT
add_theme_support( 'title-tag' );
add_theme_support('post-thumbnails');
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
add_theme_support( 'menus' );
//LOAD SCRIPTS
add_action( 'wp_enqueue_scripts', 'load_scripts');
function load_scripts()
{
	//Удаляем встроенную версию jQuery
    wp_deregister_script('jquery');
	//Добавляем свою
    wp_enqueue_script('jquery', get_template_directory_uri() .'/js/jquery.min.js','','',true);
	//Bootstrap.js толькоо необходимое (collapse,modal и сопутствующее)
	wp_enqueue_script('bootstrap_js', get_template_directory_uri() .'/js/bootstrap.min.js',array('jquery'),'',true);
	//Слайдер на главной
	wp_enqueue_script('swipe', get_template_directory_uri() .'/js/swiper.min.js','','',true);
	//Самоинициализируюший слайдер для модальных окон
	wp_enqueue_script('fotorama', get_template_directory_uri() .'/js/fotorama.js',array('jquery'),'',true);
	//Анимации
	wp_enqueue_script('wow', get_template_directory_uri() .'/js/wow.min.js','','',true);
	//Прочее
	wp_enqueue_script('custom', get_template_directory_uri() .'/js/function.js',array('jquery','bootstrap_js','swipe','wow'),'',true);
	//Bottstrap.css
	wp_enqueue_style('bootstrap_css', get_template_directory_uri() .'/css/bootstrap.min.css');
	//Для слайдера
	wp_enqueue_style('swipe_css', get_template_directory_uri() .'/css/swiper.min.css');
	//Для слайдеров в модальных окнах
	wp_enqueue_style('fotorama_css', get_template_directory_uri() .'/css/fotorama.css');
	//Анимации
	wp_enqueue_style('animate_css', get_template_directory_uri() .'/css/animate.min.css');
	//Стили темы
    wp_enqueue_style('style', get_template_directory_uri() .'/css/style.min.css');
}
//MENU
register_nav_menus(array('top'=>'Основное меню','footer'=>'Меню внизу страницы'));
//SIDEBARS
add_action( 'widgets_init', 'register_my_widgets' );
function register_my_widgets(){
	//Для формы заявки
    register_sidebar(
        array(
            'name'=> "Форма заказа",
            'id'=>"order",
            'before_widget' => '',
            'after_widget'  => '',
            'before_title'=> '',
            'after_title'   => ''
            )
    );
	//Для Акций
    register_sidebar(
        array(
            'name'=> "Акции",
            'id'=> "action",
            'before_widget' => '',
            'after_widget'  => '',
            'before_title'  => '',
            'after_title'   => ''
            )
    );
	//Для АОбратной связи
    register_sidebar(
        array(
            'name'=> "Форма обратной связи",
            'id'=>"feedback",
            'before_widget' =>'',
            'after_widget'=>'',
            'before_title'=>'',
            'after_title'=>''
            )
    );
}
//Для слайдера на главной(Пожелание чтобы не shortcode)
function type_posts(){
	$labels = array(
		'name' => 'slider',
		'singular_name' => 'Баннер',
		'add_new' => 'Добавить новый',
		'add_new_item' => 'Добавить новый баннер',
		'edit_item' => 'Редактировать баннер',
		'new_item' => 'Новый баннер',
		'view_item' => 'Посмотреть баннер',
		'search_items' => 'Найти баннер',
		'not_found' =>  'Баннер не найден',
		'not_found_in_trash' => 'В корзине баннера не найдено',
		'parent_item_colon' => '',
		'menu_name' => 'Баннеры'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'menu_position'=>10,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_icon'=>'dashicons-images-alt2',
		'supports' => array('title', 'thumbnail','editor')
	);
	register_post_type('slider', $args);
}
add_action('init', 'type_posts');
//Опции
require get_template_directory() . '/modules/options.php';
//Модули
require get_template_directory() . '/modules/modules.php';