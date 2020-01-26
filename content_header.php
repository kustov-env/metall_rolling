<?php $option=get_option('ferrum-options');?>
<header class="header">
	<div class="container-fluid main-fluid">
		<div class="col-sm-4 col-xs-6 col-smx">
			<div class="links">
				<?php if(!empty($option['price_list'])):?>
                    <a href="<?=$option['price_list']?>" download="<?=$option['price_list']?>" class="link">ПРАЙС-ЛИСТ<i class="icon-metall icon-tag"></i></a>
				<?php endif;?>
				<a href="#order" class="link"  data-toggle="modal" data-target="#order">Рассчитать стоимость<i class="icon-metall icon-division"></i></a>
				<a href="#feedback" class="link" data-toggle="modal" data-target="#feedback">Заказать звонок<i class="icon-metall icon-phone"></i></a>
			</div>
		</div>
		<div class="col-sm-3 col-md-4 logo col-xs-6 col-smx">
			<div>
				<a href="<?=home_url()?>" class="link__logo">
					<?php if(!empty($option['logo'])):?>
                        <img src="<?=$option['logo']?>" alt="Компания Феррум Барнаул">
					<?php endif;?>
                </a>
			</div>
		</div>
		<div class="col-sm-5 col-md-4 col-xs-12 col-smx">
			<div class="row">
				<div class="col-sm-4 hidden-xs hidden-sm">
					<div>
						<img src="<?php bloginfo('template_url')?>/images/Герб_Барнаула.png" alt="Город Барнаул">
						<span class="city">Барнаул</span>
					</div>
				</div>
				<div class="col-md-8 col-xs-12 contacts">
					<article class="contacts__content">
						<?php if(!empty($option['address_1'])):?>
                            <span class="address"><?=$option['address_1']?></span>
						<?php endif;?>
						<?php if(!empty($option['email_1'])):?>
                            <span class="address"><a href="mailto:<?=$option['email_1']?>"><?=$option['email_1']?></a></span>
						<?php endif;?>
						<?php if(!empty($option['email_2'])):?>
                            <span class="address"><a href="mailto:<?=$option['email_2']?>"><?=$option['email_2']?></a></span>
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
					</article>
				</div>
			</div>
		</div>
	</div>
</header>