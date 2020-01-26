<?php get_header()?>
<?php $option=get_option('ferrum-options');?>
<main>
	<header class="first_view">
		<section class="menu">
			<nav class="navbar" role="navigation">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse" id="menu">
					<?php wp_nav_menu( array('theme_location'=>'top','container'=> 'ul','menu_class'=>'','items_wrap'=>'<ul class="nav navbar-nav">%3$s</ul>','after'=>'<span></span>'));?>
				</div>
			</nav>
		</section>
        <?php do_action('slider');?>
	</header>
	<?php do_action('plus');?>
	<?php do_action('products');?>
	<section class="advantages"  id="service">
		<div class="container">
			<h2>Мы для вас</h2>
			<div class="row">
				<div class="col-sm-3 col-xs-6 col-smx">
					<article class="advantages__article">
						<i class="icon-metall icon-scissors wow fadeInDownBig"></i>
						<h3 class="wow fadeInLeftBig">Порежем в размер</h3>
						<p class="wow fadeInRightBig">Укажите ваши требования по размеру. Наши специалисты подготовят материал нужного размера.</p>
						<a href="#feedback" data-toggle="modal" data-target="#order" class="link wow fadeInDownBig">ЗАКАЗАТЬ</a>
					</article>
				</div>
				<div class="col-sm-3 col-xs-6 col-smx">
					<article class="advantages__article">
						<i class="icon-metall icon-hook wow fadeInDownBig" data-wow-delay=".5s"></i>
						<h3 class="wow fadeInLeftBig" data-wow-delay=".5s">Погрузим</h3>
						<p class="wow fadeInRightBig" data-wow-delay=".5s">Погрузка осуществляется как в закрытый так и в открытый автотранспорт</p>
					</article>
				</div>
				<div class="col-sm-3 col-xs-6 col-smx">
					<article class="advantages__article">
						<i class="icon-metall icon-package wow fadeInDownBig" data-wow-delay="1s"></i>
						<h3 class="wow fadeInLeftBig" data-wow-delay="1s">Соберём груз</h3>
						<p class="wow fadeInRightBig" data-wow-delay="1s">Погрузка позиций большой сборности и разного сортамента с учетом правильного расположения металлопрокта</p>
					</article>
				</div>
				<div class="col-sm-3 col-xs-6 col-smx">
					<article class="advantages__article">
						<i class="icon-metall icon-delivery wow fadeInDownBig" data-wow-delay="1.5s"></i>
						<h3 class="wow fadeInLeftBig" data-wow-delay="1.5s">Доставим</h3>
						<p class="wow fadeInRightBig" data-wow-delay="1.5s">Доставка по Барнаулу осуществляется в день заказа. Стоимость доставки уточните у специалиста.</p>
						<a href="#feedback" class="link wow fadeInDownBig" data-toggle="modal" data-target="#feedback" data-wow-delay="1.5s">Узнать стоимость</a>
					</article>
				</div>
			</div>
		</div>
	</section>
	<div id="special">
		<?php if(dynamic_sidebar('action')):?><?php endif;?>
	</div>
	<section class="map" id="contacts">
		<article class="wow fadeInLeft" data-wow-duration="1s">
			<div class="map__content">
				<?php if(!empty($option['logo'])):?>
                    <img src="<?=$option['logo']?>" alt="Компания Феррум Барнаул">
				<?php endif;?>
                <?php if(!empty($option['address_1'])):?>
				    <span class="address"><?=$option['address_1']?></span>
                <?php endif;?>
				<?php if(!empty($option['address_2'])):?>
                    <span class="address"><?=$option['address_2']?></span>
				<?php endif;?>
                <?php if(!empty($option['phone_1'])):?>
				<table class="contact_information">
                        <tr class="phone">
                            <td colspan="2"><a href="tel:<?=str_replace(array(' ','-','(',')','+','  '),'',trim($option['phone_1']))?>"><i class="icon-metall icon-phone"></i><?=$option['phone_1']?></a></td>
                        </tr>
                    <?php if(!empty($option['sclad_1']) && !empty($option['office_1'])):?>
					<tr>
						<td rowspan="2" class="icon"><i class="icon-metall icon-clock"></i></td>
						<td>Склад: <?=trim($option['sclad_1'])?></td>
					</tr>
					<tr>
						<td>Офис:  <?=trim($option['office_1'])?></td>
					</tr>
                        <?php endif;?>
				</table>
                <?php endif;?>
				<?php if(!empty($option['phone_2'])):?>
                    <table class="contact_information">
                        <tr class="phone">
                            <td colspan="2"><a href="tel:<?=str_replace(array(' ','-','(',')','+','  '),'',trim($option['phone_2']))?>"><i class="icon-metall icon-phone"></i><?=$option['phone_1']?></a></td>
                        </tr>
					<?php if(!empty($option['sclad_2']) && !empty($option['office_2'])):?>
                        <tr>
                            <td rowspan="2" class="icon"><i class="icon-metall icon-clock"></i></td>
                            <td>Склад: <?=trim($option['sclad_2'])?></td>
                        </tr>
                        <tr>
                            <td>Офис:  <?=trim($option['office_2'])?></td>
                        </tr>
					<?php endif;?>
                    </table>
				<?php endif;?>
				<a class="link" href="#feedback" data-toggle="modal" data-target="#feedback">ЗАКАЗАТЬ ЗВОНОК <i class="icon-metall icon-phone"></i></a>
				<?php if(!empty($option['price_list'])):?>
                    <a href="<?=$option['price_list']?>" download="<?=$option['price_list']?>" class="link">ПРАЙС-ЛИСТ<i class="icon-metall icon-tag"></i></a>
				<?php endif;?>
			</div>
		</article>
		<?php if(!empty($option['map'])):?>
            <?=$option['map'];?>
		<?php endif;?>
	</section>
</main>
<?php get_footer()?>