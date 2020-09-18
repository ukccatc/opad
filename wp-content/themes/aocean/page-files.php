<?php
/*
    Template Name: Files
*/
?>
<?php get_header(); ?>

    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">
            <?php
                if ( have_posts() ) : the_post(); // если имеются записи в блоге.
                    query_posts('cat=30');   // указываем ID рубрик, которые необходимо вывести.
                    while (have_posts()) : the_post();  // запускаем цикл обхода материалов блога
                        
                        //Получение набора меток для каждого поста
                        $metki = wp_get_post_terms($post->ID);
                        if ($metki[0]->slug == 'private' && isset($_SESSION['userid'])) {
                            get_template_part('content', get_post_format());
                        }
                        if ($metki[0]->slug == 'free') {
                            get_template_part('content', get_post_format());
                        }
                        if ($metki[0]->slug == Null) {
                            get_template_part('content', get_post_format());
                        }
                        ?>
                    <?php endwhile; // завершаем цикл.
                    /* Сбрасываем настройки цикла. Если ниже по коду будет идти еще один цикл, чтобы не было сбоя. */
                    wp_reset_query();
                    ?>

            <?php endif; ?>





            <!-- #content --></div>
        <!-- #primary --></div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>