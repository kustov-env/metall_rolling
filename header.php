<?php $option=get_option('ferrum-options');?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php if(!empty($option['favicon'])):?>
    <link rel="icon" type="image/x-icon" href="<?=$option['favicon']?>"/>
    <link rel="shortcut icon" href="<?=$option['favicon']?>" type="image/x-icon" />
    <?php endif;?>
	<?php wp_head();?>
</head>
<body>
<?php get_template_part('content_header');?>