<?php 
	/*
Plugin Name: Mail ALL Users
Description: Helps to mail to all users which have Email in Stats.sql
Author: Oleg Rostovtsev
Version: 0.1
Author URI: Rostme@mail.ru
*/
	function is_submited() {
		if (isset($_POST['submit']) && $_POST['text'] !== '') {
			$mail = get_all_mail();
			send_email($mail);
			return $_POST['submit'];
		}
	}

add_action('admin_menu', 'mail_users');

	function mail_users() {
		add_submenu_page('options-general.php','Mail to Users', 'mail to users','manage_options', 'mail_users_page', 'mail_users_callback');

	}

	function mail_users_callback() {
		echo '<div class="wrap">';
		echo '<h2>Страница отправки уведомлений пользователям</h2>';

		if (is_submited()) {
			echo "<h3>Все письма отправлены</h3>";
		}
		else {
		
			echo "<form action=# method='post'>
	    			<p><b>Введите тему письма:</b></p>
	    			<p><input type='text' name='title'></p>
	    			<p><b>Введите текст письма:</b></p>
	   				<p><textarea rows='10' cols='90' name='text'></textarea></p>
	   				<p><input type='submit' value='Отправить'' name='submit'></p>
	  			  </form>";
		echo '</div>';
		}
		
	}
		/*
		Getting list of Mails
	*/
	function get_all_mail() {
		require_once(ABSPATH . '/wp-content/themes/aocean/include/functions.php');
		$dbh = getConnectionDB();
		$sql = "SELECT Email FROM Stats";
		$result = $dbh->query($sql);
		$i = 0;
		$mail = array();
		while ($row = $result->fetch()) {
			if (strpos($row['Email'], '@')) {
				$mail[] = $row['Email'];
			}
		}
		return $mail;

	}

	function send_email($mail) {
		$text = $_POST['text'];
		$title = $_POST['title'];
		foreach ($mail as $email) {
			mail($email, $title, $text);
		}
		return $email_sended;

	}