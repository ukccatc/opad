<?php
include(dirname(__FILE__).'/include/controller.php');
include(dirname(__FILE__).'/include/functions.php');

// Проверка зашел ли пользователь на страницу.
if(isset($_SESSION['userid'])) {
    header('Location:/new-stats');
}

if (isset($_POST['submit'])) {

    $userEmail = $_POST['login'];
    $userPassword = $_POST['password'];
    if (userExists_getId($userEmail, $userPassword)) {
        $userId = userExists_getId($userEmail, $userPassword);
        $_SESSION['userid'] = $userId;
        header('Location:/new-stats');
    }
}
?>
<?php get_header(); ?>
    <div class="container">
        <div class="row">
            <div class="div_attention">
                <p class="p_attention">
                    <b>Внимание!</b> Если вы первый раз на сайте и являетесь работником Одесского РСП, Вам необходимо
                    пройти регистрацию. Если вы уже зарегистрированы, введите свои данные в форме
                    ниже.
                </p>
            </div>
        </div>
    </div>
    <div class='login-billing'>
        <div class='login-billing_title'>
            <?php if (isset($userEmail) && isset($userPassword)) : ?>
                <?php if (!userExists_getId($userEmail, $userPassword)) {
                    echo '<span style="color:#a94442;">Вы ввели неверные данные, попробуйте еще раз</span></br>';
                } ?>
            <? endif; ?>
            <span>Введите Ваши логин и пароль</span>
        </div>
        <div class='login-billing_fields'>
            <form action='#' method='post' autocomplete="off">
                <div class='login-billing_fields__user'>
                    <div class='icon'>
                        <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/217233/user_icon_copy.png'>
                    </div>
                    <input placeholder='Email' type='text' name='login' autocomplete="off">
                    <div class='validation'>
                        <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/217233/tick.png'>
                    </div>
                </div>
                <div class='login-billing_fields__password'>
                    <div class='icon'>
                        <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/217233/lock_icon_copy.png'>
                    </div>
                    <input placeholder='Пароль' type='password' name='password' autocomplete="off">
                    <div class='validation'>
                        <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/217233/tick.png'>
                    </div>
                </div>
                <div class='login-billing_fields__submit'>
                    <input type='submit' value='Войти' name='submit'>
                    <input type='button' onclick="window.location.href='/registration'" value='Регистрация'>

                    <div class='forgot'></br>
                        <a href='/lost_password' onmouseover="this.style.color='#C1C1C1';"
                           onmouseout="this.style.color='#828282';"><strong  class="text-center">Восстановление пароля</strong></a>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php get_footer(); ?>