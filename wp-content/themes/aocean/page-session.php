<?php
/*
    Template Name: Session-distroy
*/
?>
<?php
// Удаляет сессию и перенаправляет на станицу с которой перешли на эту страницу
session_start();
session_destroy();
$prev_ref = $_SERVER['HTTP_REFERER'];
$site_url = get_site_url();
// Перенаправление пользователя на текую страницу, при нажатии кнопк ВЫХОД (удаление сесси)
if ($prev_ref == get_site_url().'/statistics/') {
    header("Location: $site_url");
}
else {
    header("Location:$prev_ref");
}
?>
