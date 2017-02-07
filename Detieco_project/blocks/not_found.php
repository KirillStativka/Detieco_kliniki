<?php
$_content = '<p>Такой страницы нет, возможно Вы неправильно набрали адрес страницы или перешли по неверной ссылке на наш сайт, или такой страницы никогда не было.</p>
 <p>Если у Вас есть вопросы пишите: info@detieco.ru</p>
 <p>В любом случае не расстраивайтесь, у нас много полезной и актуальной информации.</p>'
?>
<div class="error-block text">
	<h4><?php _e( 'Ошибка 404', 'base' ); ?></h4>
	<p><?php echo $_content; ?></p>
</div>
<hr>
<?php get_template_part('blocks/categories'); ?>
<hr>
<?php get_template_part('blocks/recomend'); ?>