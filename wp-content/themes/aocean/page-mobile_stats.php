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
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Статистика</title>
    <style>
        .table {
            width: auto;
            margin-bottom: 50px;
        }

        table {
            margin: 0 auto;
            margin-top: 20px;
            font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
            border-collapse: collapse;
            color: #686461;
        }

        caption {
            padding: 10px;
            color: white;
            background: #32364a;
            font-size: 18px;
            text-align: center;
            font-weight: bold;
        }

        th {
            border-bottom: 3px solid #B9B29F;
            padding: 10px;
            text-align: center;
            vertical-align: top;
            width: 100px;
        }

        td {
            text-align: center;
            padding: 10px;
            border: 1px solid black;
        }

        .left {
            text-align: left;
        }

        tr:nth-child(odd) {
            background: white;
        }

        tr:nth-child(even) {
            background: #E8E6D1;
        }

    </style>
</head>
<body>
    <div class="container">
        <!--        Таблица статистики-->
        <div class="row">
            <p>Для возврата нажмите
                <a href="/statistics"  class="btn"> назад </a>
            </p>
            <form action='#' class="form1" method='POST'>
                <p> Введите период </p>
                <select size=1 name='year_input'>
                    <option value='<?= $year; ?>' hidden><?= $year; ?></option>
                    <?php foreach ($years as $y) {
                        echo "<option value='".$y."'> $y </option>";} ?>
                </select>
                <input type='submit' name='submit_period' value='Выбрать'>
            </form>
            <table class='table_stats'>
                <caption>
                    Начисления за <?php echo $year . ' год';
                    echo '  (' . ($stats['ФИО']) . ')'; ?>
                </caption>
                <tr>
                    <th>Месяц</th>
                    <th>Начисления ФОП</th>
                    <th>Профсоюзный взнос (50%)</th>
                    <th>Доначисления / Списания</th>
                    <th>Сумма</th>
                </tr>
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
        </div>
    </div>
</body>
</html>

