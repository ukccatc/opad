<?php
include(dirname(__FILE__).'/include/controller.php');
include(dirname(__FILE__).'/include/functions.php'); ?>

<?php
$user_id = $_GET['ud'];
if ($user_id == Null) { die ('Что то пошно не так');}
if (isset($_POST['submit'])) {
    if (CheckPassword($_POST['password'], $_POST['password-2']) == false) {
        UpdatePassword($user_id, $_POST['password']);
        $error = '<div class=\'alert alert-success\'>Пароль успешно изменен!</div>';
    }
    else { $error = 'Пароли не совпадают';}
    
}
?>


<?php get_header(); ?>

<div id="primary" class="content-area">
    <div id="content" class="site-content form-register" role="main">

        <?= $error; ?>

        <form action="#" method="post">
            <h1>Форма изменения пароля</h1>
            <section class="container one">
                <label for="password">Введите новый пароль</label>
                <input name="password" type="password" />
                <label for="password">Введите пароль еще раз</label>
                <input name="password-2" type="password" />
            </section>
            <section class="container two"><button type="submit" name="submit">Отправить запрос</button></section>
        </form>

        <!-- #content --></div>
    <!-- #primary --></div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

