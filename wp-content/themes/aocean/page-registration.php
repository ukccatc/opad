<?php

include(dirname(__FILE__).'/include/controller.php');

include(dirname(__FILE__).'/include/functions.php'); ?>



<?php

// Получаем данные из регистрационной формы

$registered = false;

if (isset($_POST['submit'])) {

    $new_surname = $_POST['user_surname'];

    $new_name = $_POST['user_name'];

    $new_sname = $_POST['user_sname'];

    $new_email = $_POST['email'];

    $new_email_check = $_POST['email_check'];

    $new_password = $_POST['password'];

    $new_password_check = $_POST['password_check'];

    $errors = Array();

    $errors = CheckExistNewUser($new_surname, $new_name, $new_sname, $new_email,$new_email_check, $new_password, $new_password_check, $registered);



} ?>



<?php get_header(); ?>



<div id="primary" class="content-area">

    <div id="content" class="site-content form-register" role="main">



        <form action="#" method="post">

            <h1>Форма регистрации нового пользователя</h1>



            <?php if ($registered) echo "<div class='alert alert-success'>$errors[0]</div>" ?>

            <?php //Если пользователь зарегистрирован, форму не выводить ?>

            <?php if (!$registered) : ?>

                <?php //Вывод ошибок или успеха ?>

                <?php if (!$registered) ErrorReporting($errors); ?>

                <div class="pannel panel-success">
                    <div class="panel-heading">
                        <h4 class='panel-title'>
                            <a href="#collapse-2" data-parent='#accordion' data-toggle='collapse'>Инструкция по регистрации</a>
                        </h4>
                    </div>
                    <div id='collapse-2' class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                <li> Для корректной регистрации необходимо ввести Фамилию, Имя, Отчество на русском языке.</li>
                                <li> В случае если вы не можете загеристрироваться, пишите на <b><i>обратную связь</i></b> с указанием ваших ФИО.</li>
                        </div>
                    </div>
                </div>

                <section class="container one">

                    <label for="user_surname">Фамилия</label>

                    <input name="user_surname" pattern="^[А-Яа-яЁё\s]+$" type="text" value="<?php if (isset ($new_surname)) echo $new_surname; ?> "/>



                    <label for="user_name">Имя</label>

                    <input name="user_name" pattern="^[А-Яа-яЁё\s]+$" type="text" value="<?php if (isset ($new_name)) echo $new_name; ?> " />



                    <label for="user_name">Отчество</label>

                    <input name="user_sname" pattern="^[А-Яа-яЁё\s]+$" type="text" value="<?php if (isset ($new_sname)) echo $new_sname; ?> "/>



                    <label for="email">Эл. почта</label>

                    <input name="email" type="email" value="<?php if (isset ($new_email)) echo $new_email; ?> "/>


                    <label for="email_check">Подтвердите эл.почту</label>

                    <input name="email_check" type="email"/>


                    <label for="password">Пароль</label>

                    <input name="password" type="password" />


                    <label for="password">Подтвердите пароль</label>

                    <input name="password_check" type="password" />

                </section>

                <section class="container two"><button type="submit" name="submit">Зарегистрироваться</button></section>

            <?php endif; ?>

        </form>



        <!-- #content --></div>

    <!-- #primary --></div>



<?php get_sidebar(); ?>

<?php get_footer(); ?>

