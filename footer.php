<?php get_template_part('content_footer');?>
<?php 	$modal=new WP_Query(array('post_type'=>'post'));
$counter=1;
if($modal->have_posts()):?>
    <?php while($modal->have_posts()):?>
        <?php $modal->the_post();?>
        <div class="modal fade" id="product-<?=$counter?>" tabindex="-1" role="dialog" aria-labelledby="product-<?=$counter?>">
            <div class="modal-dialog" role="document">
                <div class="modal-content container-fluid">
                    <div class="modal-header row">
						<?php get_template_part('content_header');?>
                    </div>
                    <div class="button-wrap">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="icon-metall icon-cancel"></i></button>
                    </div>
                    <div class="modal-body container">
                        <div class="row">
                            <div class="col-md-4 col-sm-5 hidden-xs">
                                <?=apply_filters('the_content',get_post_meta(get_the_ID(),'slider',true));?>
                            </div>
                            <div class="col-md-8 col-sm-7 col-xs-12">
                                <h2><?php the_title()?></h2>
                                <?php the_content()?>
                                <a href="#feedback" class="link link__orange" data-toggle="modal" data-target="#feedback">заказать</a>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer row">
						<?php get_template_part('content_footer');?>
                    </div>
                </div>
            </div>
        </div>
        <?php $counter++?>
        <?php endwhile;?>
<?php endif;?>
<div class="modal fade" id="order" tabindex="-1" role="dialog" aria-labelledby="order">
	<div class="modal-dialog" role="document">
		<div class="modal-content container-fluid">
			<div class="modal-header row">
				<?php get_template_part('content_header');?>
			</div>
			<div class="button-wrap">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="icon-metall icon-cancel"></i></button>
			</div>
			<div class="modal-body container">
				<?php if(dynamic_sidebar('feedback')):?><?php endif;?>
			</div>
			<div class="modal-footer row">
				<?php get_template_part('content_footer');?>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="feedback" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content container-fluid">
			<div class="modal-header row">
				<?php get_template_part('content_header');?>
			</div>
			<div class="button-wrap">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="icon-metall icon-cancel"></i></button>
			</div>
			<div class="modal-body container">
				<?php if(dynamic_sidebar('order')):?><?php endif;?>
			</div>
			<div class="modal-footer row">
				<?php get_template_part('content_footer');?>
			</div>
		</div>
	</div>
</div>
<?php wp_footer();?>
</body>
</html>