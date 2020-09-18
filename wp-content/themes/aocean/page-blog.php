<?php
/*
    Template Name: Blog
*/
?>
<?php get_header(); ?>

    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">

            <?php
            if ( have_posts() ) : // если имеются записи в блоге.
                query_posts('cat=31');   // указываем ID рубрик, которые необходимо вывести.
                while (have_posts()) : the_post();  // запускаем цикл обхода материалов блога
                    ?>
                    <?php get_template_part( 'content', get_post_format() );
                endwhile;  // завершаем цикл.
            /* Сбрасываем настройки цикла. Если ниже по коду будет идти еще один цикл, чтобы не было сбоя. */
            wp_reset_query();
            ?>

            <?php endif; ?>


            <!-- #content --></div>
        <!-- #primary --></div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>