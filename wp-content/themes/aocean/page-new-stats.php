<?php
include(__DIR__ . '/include/controller.php');
include(__DIR__ . '/include/functions.php');

// Проверка зашел ли пользователь на страницу.
if (!isset($_SESSION['userid'])) {
    header('Location:billing');
}

//Имя пользователя
$stats = getUserStatistics($_SESSION['userid']);
$_SESSION['userinfo'] = $stats;
if ($stats == NULL) {
    include('404.php');
}
sessionAddPeriod();
$month_one = listOfMonth();
$years = getYears();
$year = date('Y');
if (isset($_POST['year_input'])) {
    $year = $_POST['year_input'];
}

?>


<?php get_header(); ?>
<div class="container">
    <div class="container_all">
        <div class="new_stats_header">
            <span>Добро пожаловать в Ваш личный кабинет</span>
        </div>
        <div class="container_user_data">
            <p>Пользователь:
                <span><?php echo $stats['ФИО']?></span>
            </p>
            <p>Текущий счет:
                <span><?php echo $stats['Общая сумма'] ?> грн (по состоянию на 01.09.2020) </span>
            </p>
            <p>Статус:
                <span>
                    <?php if ($stats['Член-профсоюза']) {
                        echo 'Вы являетесь членом профсоюза';
                    } else {
                        echo
                        'Вы не являетесь членом профсоюза';
                    } ?>
                </span>
            </p>
        </div>
        <div class="container_buttons">
            <button type="button" class="btn btn-info" onclick="window.location.href='/lost_password'">Изменение пароля</button>
            <button type="button" class="btn btn-info" onclick="window.location.href='/contacts'">Вопросы по сайту</button>
            <button type="button" class="btn btn-info" onclick="window.location.href='/session_destroy'">Выход из кабинета</button>
        </div>
    </div>
</div>

<?php get_footer(); ?>
