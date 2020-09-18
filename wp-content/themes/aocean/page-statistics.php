<?php
include(dirname(__FILE__) . '/include/controller.php');
include(dirname(__FILE__) . '/include/functions.php');

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
        <div class="stats_div" style="margin:0 auto; width:auto; margin-top:40px;">
            <a href="#" class="stats_button one link_stats" onclick="window.location.href='/mobile_stats'">Текущий счет (моб)</a>
            <a href="/lost_password" class="stats_button two">Изменение пароля</a>
            <a href="/session_destroy" class="stats_button three">Выход из кабинета</a>
        </div>
        <!--        Таблица статистики-->
        <div class="row">
            <form action='#' class="form1" method='POST'>
                <p> Введите период </p>
                <select size=1 name='year_input'>
                    <option value='<?= $year; ?>' hidden><?= $year; ?></option>
                    <?php foreach ($years as $y) {
                        echo "<option value='".$y."'> $y </option>";} ?>
                </select>
                <input type='submit' name='submit_period' value='Выбрать'>
            </form>
            <?php if (isset($_POST['year_input'])) :?>
            <table class='table_stats'>
                <caption>
                    Начисления за <?php echo ($_POST['year_input'] ? $_POST['year_input'] : $year) . ' год';
                    echo '  (' . ($stats['ФИО']) . ')'; ?>
                </caption>
                <thead>
                <tr>
                    <th>Месяц</th>
                    <th>Начисления ФОП</th>
                    <th>Профсоюзный взнос (50%)</th>
                    <th>Доначисления / Списания</th>
                    <th>Сумма</th>
                </tr>
                </thead>
                <?php for ($i = 1; $i < 13; $i++) : ?>
                    <tr>
                        <?php strlen($i) == 1 ? $formated_i = '0'.$i : $formated_i = $i; ?>
                        <td class='left'> <?php echo $month_one[$i]; ?> </td>
                        <td><?php if (gettype($stats["$formated_i-$year-Предпр"]) == 'NULL' || $stats["$formated_i-$year-Предпр"] == 0)  { echo '-';}  else { echo $stats["$formated_i-$year-Предпр"];} ?></td>
                        <td><?php if (gettype($stats["$formated_i-$year-ПВ(50%)"]) == 'NULL' || $stats["$formated_i-$year-ПВ(50%)"] == 0) { echo '-';}  else { echo $stats["$formated_i-$year-ПВ(50%)"];} ?></td>
                        <td><?php if (gettype($stats["$formated_i-$year-Начисления"]) == 'NULL' || $stats["$formated_i-$year-Начисления"] == 0) { echo '-/';}  else { echo $stats["$formated_i-$year-Начисления"].'/';}
                            if (gettype($stats["$formated_i-$year-Списания"]) == 'NULL' || $stats["$formated_i-$year-Списания"] == 0) { echo '-';} else { echo $stats["$formated_i-$year-Списания"];} ?></td>
                        <td><?php if (gettype($stats["$formated_i-$year-сумма"]) == 'NULL' || $stats["$formated_i-$year-сумма"] == 0) { echo '-';}  else { echo $stats["$formated_i-$year-сумма"];} ?></td>
                    </tr>
                <?php endfor; ?>

                <tr style="color:black">
                    <td style="visibility:hidden"></td>
                    <td style="visibility:hidden"></td>
                    <td style="visibility:hidden"></td>
                    <td  style="text-align: center;height:50px;vertical-align: middle;"> Всего на вашем счету </td>
                    <td  style="text-align: center;height:50px;vertical-align: middle;"><?php echo $_SESSION['userinfo']['Общая сумма']; ?> грн</td>
                </tr>
            </table>
            <?php endif; ?>
        </div>
    </div>
    </div>

<?php get_footer(); ?>