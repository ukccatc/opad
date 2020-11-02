<div class="row">
    <form action='#' class="form1" method='POST'>
        <p> Введите период </p>
        <select size=1 name='year_input'>
            <option value='<?= $year; ?>' hidden><?= $year; ?></option>
            <option value='2015'> 2015</option>
            <option value='2016'> 2016</option>
        </select>
        <input type='submit' name='submit_period' value='Выбрать'>
    </form>
    <p style="min-width:250px;margin:0 auto; padding:10px; color:ghostwhite; text-align: center;" class="mobile_link_p">
        Для просмотра своего счета пройдите <br><a href="/mobile_stats" class="mobile_link"> по ссылке</a>
    </p>
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
                <td><?php if (gettype($stats["$formated_i-$year-Предпр"]) == 'NULL' || $stats["$formated_i-$year-Предпр"] == 0)  { echo '-';}  else { echo $stats["$formated_i-$year-Предпр"];}?></td>
                <td><?php if (gettype($stats["$formated_i-$year-ПВ(50%)"]) == 'NULL' || $stats["$formated_i-$year-ПВ(50%)"] == 0) { echo '-';}  else { echo $stats["$formated_i-$year-ПВ(50%)"];}?></td>
                <td><?php if (gettype($stats["$formated_i-$year-Начисления"]) == 'NULL' || $stats["$formated_i-$year-Начисления"] == 0) { echo '-';}  else { echo $stats["$formated_i-$year-Начисления"].'/'. $stats["$formated_i-$year-Списания"];}?></td>
                <td><?php if (gettype($stats["$formated_i-$year-сумма"]) == 'NULL' || $stats["$formated_i-$year-сумма"] == 0) { echo '-';}  else { echo $stats["$formated_i-$year-сумма"];}?></td>
            </tr>
        <?php endfor; ?>
        <tr>
            <td style="visibility:hidden"></td>
            <td style="visibility:hidden"></td>
            <td rowspan='3' style="text-align: center; padding: 35px;">Всего на Вашем счету</td>
            <td style="text-align: left;">Предприятие</td>
            <td style="text-align: left;"><?php echo $stats['Предприятие']; ?></td>

        </tr>
        <tr style="color:black; background: #E8E6D1">
            <td style="visibility:hidden"></td>
            <td style="visibility:hidden"></td>
            <td style="text-align: left;">Личные</td>
            <td style="text-align: left;"><?php echo $stats['Личные']; ?></td>
        </tr>
        <tr style="color:black">
            <td style="visibility:hidden"></td>
            <td style="visibility:hidden"></td>
            <td style="text-align: left;"> Сумма</td>
            <td style="text-align: left;"><?php echo $_SESSION['userinfo']['Общая сумма']; ?> грн</td>
        </tr>
    </table>
</div>