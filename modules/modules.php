<?php
//Шорткод для вывода акций
add_shortcode('action','get_action');
function get_action($attr){
	$title=trim($attr['title']);
	$product=trim($attr['product']);
	$product_value=trim($attr['product_value']);
	$product_price=trim($attr['price']);
	$price_value=trim($attr['price_value']);
	$image_src=trim($attr['image']);
	$image='<img src="'.$image_src.'" alt="'.$title.'" class="wow fadeInRight" data-wow-duration="1s">';

	if(!empty($product_value)){
		$product_string='<p class="offer__product">'.$product.' <span class="offer__value">'.$product_value.'</span></p>';
	}
	else{
		$product_string='<p class="offer__product">'.$product.'</p>';
	}
	if(!empty($price_value)){
		$price_string=' <p class="offer__price"><span>'.$product_price.'</span> '.$price_value.'</p>';
	}
	else{
		$price_string=' <p class="offer__price"><span>'.$product_price.'</span></p>';
	}
	$html='<section class="offer"><div class="container"><div class="offer__image"><img src="'.get_bloginfo("template_url").'/images/special.png" alt="Специальное предложение от компании Феррум: '.$product.' всего за '.$product_price.' '.$price_value.'" class="wow fadeInLeft" data-wow-duration="1s"></div><div class="row"><div class="col-sm-9 col-sm-offset-3 col-xs-12"><div class="row"><div class="col-sm-6 col-xs-12"><article class="offer__content"><h2 class="offer__title">'.$title.'</h2>'.$product_string. $price_string.'</article></div><div class="col-sm-6">'.$image.'</div></div><a href="#feedback" data-toggle="modal" data-target="#feedback" class="link">узнать подробнее</a></div></div></div></section>';
	return $html;
}
//Функция для вывода слайдера
add_action('slider','get_slider_banners');
function get_slider_banners(){
	$html='';
	$slider=new WP_Query(array('post_type'=>'slider'));
	if($slider->have_posts()){
		$option=get_option('ferrum-options');
		$html.='<section class="slider"><div class="list hidden-sm"><ul><li><img src="'.get_bloginfo("template_url").'/images/best_1.png" alt="Труба,сетка,list,уголок,швеллер" class="wow fadeInLeft" data-wow-duration=".5s" data-wow-delay="0"></li><li><img src="'.get_bloginfo("template_url").'/images/best_2.png" alt="Лучший металлопрокат " class="wow fadeInLeft" data-wow-duration=".5s" data-wow-delay=".5s"></li><li><img src="'.get_bloginfo("template_url").'/images/best_3.png" alt="Лучшие в металлопрокате 2017 года" class="wow fadeInLeft" data-wow-duration=".5s" data-wow-delay="1s"></li></ul></div><div class="swiper-container"><div class="swiper-wrapper">';
		while($slider->have_posts()){
			$slider->the_post();
			$html.='<div class="swiper-slide" style="background-image: url('.get_the_post_thumbnail_url(get_the_ID(),'full').')"><div class="slider__caption"><div class="container"><div class="slider__title">'.trim($option['title']).'<img src="'.get_bloginfo("template_url").'/images/man.png" alt="Труба,сетка,list,уголок,швеллер" class="fix_mage_position hidden-esmx wow-slide fadeInDownBig" data-wow-duration="1s"></div><div class="wow-slide fadeInDown" style="display: inline-block">'.get_the_content().'</div></div></div></div>';
		}
		$html.='</div><div class="swipe-scrollbar"></div><div class="swiper-pagination"></div></div></section>';
	}
	echo $html;
}
//Функция для вывода плюсов из админки
add_action('plus','get_plus');
function get_plus(){
	$option=get_option('ferrum-options');
	$html='<section class="plus"><div class="container"><div class="row"><div class="col-md-3 col-xs-6 col-smx"><article class="plus__content wow fadeInUp" data-wow-duration=".75s" data-wow-delay="0">'.$option['plus_1'].'</article></div><div class="col-md-3 col-xs-6 col-smx"><article class="plus__content wow fadeInUp" data-wow-duration=".75s" data-wow-delay=".5s">'.$option['plus_2'].'</article></div><div class="col-md-3 col-xs-6 col-smx"><article class="plus__content wow fadeInUp" data-wow-duration=".75s" data-wow-delay="1s">'.$option['plus_3'].'</article></div><div class="col-md-3 col-xs-6 col-smx"><article class="plus__content wow fadeInUp" data-wow-duration=".75s" data-wow-delay="1.5s">'.$option['plus_4'].'</article></div></div></div></section >';
	echo $html;
}
//Получение продукции
add_action('products','get_products');
function get_products(){
	$html='';
	$product=new WP_Query(array('post_type'=>'post'));
	if($product->have_posts()){
		$html.='<section class="product clearfix" id="production"><h2>Продукция</h2><ul>';
		$counter=1;
		while ($product->have_posts()){
			$product->the_post();
			$html.='<li><a href="#product-'.$counter.'" data-toggle="modal" data-target="#product-'.$counter.'"><img src="'.get_the_post_thumbnail_url(get_the_ID(),'full').'" alt="'.get_the_title().'"><h3 class="product__caption">'.get_the_title().'</h3></a></li>';
			//По макету(7)
			if($counter==6){
				$html.='<li class="null"><a><img src="'.get_bloginfo('template_url').'/images/null/null_1.png" alt="Компания Феррум Барнаул"></a></li>';
			}
			//По макету(9)
			if($counter==7){
				$html.='<li class="null"><a><img src="'.get_bloginfo('template_url').'/images/null/null_2.png" alt="Компания Феррум Барнаул"></a></li>';
			}
			$counter++;
		}
		$html.='</ul></section>';
	}
	echo $html;
}
//Удаляем привычный шорткод галереи
remove_shortcode('gallery');
//Добавляем свой
add_shortcode('gallery','get_gallery_image_product_on_modal_windows');
function get_gallery_image_product_on_modal_windows($attr){
	$html='<div class="product__slider"><div class="fotorama" data-fit="cover"  data-loop="true" data-nav="false"  data-min-height="650">';
	$ids=explode(',',$attr['ids']);
	foreach ($ids as $image){
		$image_url=wp_get_attachment_image_url($image,'full');
		$alt=get_post_meta($image,'_wp_attachment_image_alt',true);
		$html.='<img src="'.$image_url.'" alt="'.$alt.'">';
	}
	$html.='</div></div>';
	return $html;
}
//шорткод для вывода товаров
add_shortcode('product','get_product_info');
function get_product_info($attr,$content){
	$html='';
	$description=trim($attr['description']);
	$full_content=apply_filters('the_content',trim($content));
	$html.='<p>'.$description.'</p>'.$full_content;
	return $html;

}
//Шорткоде для вывода сортамента
add_shortcode('sortament','get_sortament');
function get_sortament($attr,$content){
	$add=trim($attr['plus']);
	$html='<h3>Сортамент:</h3><div class="list clearfix">'.$content.'</div><span>'.$add.'</span>';
	return $html;
}
//SUPPORT WORK SHORTCODES ON TEXT/HTML WIDJETS
add_filter('widget_text','do_shortcode');