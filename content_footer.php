<footer>
	<div class="container-fluid">
		<div class="col-md-6 col-xs-12">
			<?php wp_nav_menu( array('theme_location'=>'footer','container'=> 'ul','menu_class'=>'','items_wrap'=>'<ul style="margin-top: 17px">%3$s</ul>',));?>
		</div>
		<div class="col-md-6 col-xs-12 text-right">
			<a class="agency-link" style="margin-right:40px" href="http://agencyinsight.ru" target="_blank"><img src="<?php bloginfo('template_url');?>/images/insight.png" alt=""></a>
		</div>
	</div>
</footer>