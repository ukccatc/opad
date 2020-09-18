<?php

include(dirname(__FILE__).'/include/controller.php');

include(dirname(__FILE__).'/include/functions.php'); ?>



<?php

    $email = $_POST['email'];

    if (isset($email)) {

        //Если такая почта существует

        if (CheckEmailExist($email)) {

            //Отсылаем на почту УРЛ с информацией

            SendHref($email);

            $error = "<div class='alert alert-success'>Ваш пароль отправлен на $email</div>";
            $error = $error . "<div class='alert alert-danger'>Письмо может попасть в папку Спам, проверьте!</div>";

        }

        else {

            $error = "<div class='alert alert-danger'>Такой почты не существует. <a href='/registration'>Пройдите регистрацию</a></div>";

        }

    }

?>





<?php get_header(); ?>



<div id="primary" class="content-area">

    <div id="content" class="site-content form-register" role="main">



    <?= $error; ?>



        <form action="#" method="post">
            <?php if (!isset($_POST['email'])) : ?>
            <h1>Форма <?php if (isset($_SESSION['userid'])) echo 'изменения'; else { echo 'восстановления';}?> пароля</h1>

            <section class="container one">

                <label for="email">Введите адрес електронной почты</label>

                <input name="email" type="email" />

            </section>

            <section class="container two"><button type="submit" name="submit">Отправить запрос</button></section>
            <?php endif; ?>


        </form>



        <!-- #content --></div>

    <!-- #primary --></div>



<?php get_sidebar(); ?>

<?php get_footer(); ?>



