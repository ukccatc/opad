<?php
include_once('database.php');

	// Получение статистики для одного пользователя, определенного по ID
	function getUserStatistics($id) {
		$dbh = getConnectionDB();
		$id = intval($id);

		$result = $dbh->query("SELECT * FROM Stats where id =$id");
		 
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$row = $result ->fetch();
		return $row;

	}


	//Получение ID пользователя при ВХОДЕ в личный кабинет
	function userExists_getId($email, $password) {
		$dbh = getConnectionDB();
		$password_hash = passwordHash($password);
		$sql = "SELECT * FROM Stats WHERE Email=:email AND Password=:password";
		$result = $dbh->prepare($sql);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->bindParam(':password', $password_hash, PDO::PARAM_STR);
		$result->execute();

		$user = $result->fetch();
		if($user) {
			return $user['id'];
		}
		return false;
	}

//	function showColumns() {
//		$dbh = getConnectionDB();
//		$result = $dbh->query("SHOW FIELDS FROM Stats");
//		$result->setFetchMode(PDO::FETCH_ASSOC);
//		$result = $result ->fetch();
//		return $result;
//	}

	function sessionAddPeriod() {
		if (isset($_POST['submit_period']) || isset($_POST['submit_other'])) {
			if (isset($_POST['period'])) {
				$period = $_POST['period'];
			}
			else {
				$period = $_SESSION['period'];
			}
			$_SESSION['period'] = $period;
		}
		else {
			unset($_SESSION['period']);
		}
		return $_SESSION['period'];
	}
	// Массив месяцев
	function listOfMonth() {
		return array("1"=>"Январь","2"=>"Февраль","3"=>"Март","4"=>"Апрель","5"=>"Май", "6"=>"Июнь", "7"=>"Июль","8"=>"Август","9"=>"Сентябрь","10"=>"Октябрь","11"=>"Ноябрь","12"=>"Декабрь");
	}
	//Проверяем совпадение с ФИО
	function CheckExistNewUser($new_surname, $new_name, $new_sname, $new_email,$new_email_check, $new_password, $new_password_check, $registered) {
		$dbh = getConnectionDB();
		//Полное ФИО
		$full_name = $new_surname.$new_name.$new_sname;
		//Убираем все возможные пробелы из ФИО, делаем всем lowercase
		$full_name = str_replace(' ','',$full_name);
		$full_name = mb_strtolower($full_name);
		//Массив всех ФИО
		$found_FIO_id = CheckFullName($dbh, $full_name);
		//Получение совпадения(если такой юзер существует)
		//Выводит ФИО
		if ($found_FIO_id) {
			$sign_error = Array();
			//Проверка существования такого юзера в БД users
			if (CheckUserData($found_FIO_id, $dbh)) {
				$sign_error[] = CheckUserData($found_FIO_id, $dbh);
			}
			//Проверка Email на совпадение
			if (CheckPassword($new_email, $new_email_check)) {
				$sign_error[] = 'Email не совпадают';
			}
			//Проверка пароля
			if (CheckPassword($new_password, $new_password_check)) {
				$sign_error[] = 'Пароли не совпадают';
			}
			//Проверка почты на существование в базе данных
			if (CheckEmailDouble($new_email, $dbh)) {
				$sign_error[] = 'Пользователь с такие Email уже существует';
			}

			//Добавление данных в таблицу юзеров (если нет ошибок)
			if (empty($sign_error)) {
				AddNewUser($found_FIO_id, $dbh, $new_email, $new_password);
				UpdateUser($found_FIO_id, $dbh, $new_email, $new_password);
				$sign_error[] = 'Вы успешно зарегистрированы';
				global $registered;
				$registered = true;
				return $sign_error;
			}
			else {
				return $sign_error;
			}
		}
		else {
			$sign_error[] = 'Вы ввели неверные данные (Фамилия, Имя, Отчество)';
			return $sign_error;
		}
	}
	// Создаем массив всех ФИО
	function CheckFullName($dbh, $full_name) {

		$result = $dbh->query("SELECT * FROM Stats");
		$i = 0;
		while ($row = $result->fetch()) {
			$name[$i] = $row['ФИО'];
			$name[$i] = str_replace(' ','',$name[$i]);
			$name[$i] = mb_strtolower($name[$i]);
			if ($name[$i] == $full_name) {
				$id_number = $row['id'];
			}
			$i++;
		}
		return $id_number;
	}
	//Проверка мыла на повторение
	function CheckEmailDouble($email, $dbh) {
		$result = $dbh->prepare("SELECT Email FROM Stats WHERE Email=:email");
		$result->bindValue('email', $email, PDO::PARAM_STR);
		$result->execute();
		$row = $result->fetch();
		if ($row) {
			return true;
		}
	}

	//Добавление нового юзера в users
	function AddNewUser($user_id, $dbh, $new_email, $new_password)
	{
		$passwrod_hash = passwordHash($new_password);
		$result = $dbh->prepare("INSERT INTO Users (Email, Password, user_id) VALUES (:Email, :Password, :user_id)");
		$result->bindValue(':Email', $new_email);
		$result->bindValue(':Password', $passwrod_hash);
		$result->bindValue(':user_id', $user_id);
		return $result->execute();
	}
	//Добавляет пароль и мыло в Stats
	function UpdateUser($user_id, $dbh, $new_email, $new_password) {
		$passwrod_hash = passwordHash($new_password);
		$result = $dbh->prepare("UPDATE Stats SET Email = :Email, Password = :Password WHERE id = :user_id");
		$result->bindValue(':Email', $new_email, PDO::PARAM_STR);
		$result->bindValue(':Password', $passwrod_hash, PDO::PARAM_STR);
		$result->bindValue(':user_id', $user_id, PDO::PARAM_INT);
		return $result->execute();
	}
	//Проверяет существует ли пользователь в БД users
	function CheckUserData($user_id, $dbh) {
		$result = $dbh->prepare("SELECT id FROM Users WHERE user_id = :user_id");
		$result->bindValue(':user_id', $user_id, PDO::PARAM_INT);
		$result->execute();
		$exist = $result->fetchColumn();
		//Если найдено совпадение
		if ($exist) {
			return 'Такой пользователь уже существует';
		}
	}
	//Проверка 2 полей пароля на соответствие
	function CheckPassword($new_password, $new_password_check) {
		if ($new_password === $new_password_check) return false;
		else return true;
	}

	// Вывод сообщений перед формой регистрации
	//Для массивов
/**
 * @param array $errors  Вывод сообщений перед формой регистрации(Для массивов)
 */
	function ErrorReporting($errors){
		if (is_array($errors)) {
			if (!empty($errors))
				foreach ($errors as $error) {
					echo "<div class='alert alert-danger'>$error</div>";
				}
		}
		//Для переменной
		else {
			if (!empty($errors)) {
				echo "<div class='alert alert-danger'>$errors</div>";
			}
		}
	}


	//Проверка существования такого email
	function CheckEmailExist($email)
	{
		$dbh = getConnectionDB();
		$result = $dbh->prepare("SELECT Email FROM Stats WHERE Email = :email");
		$result->bindValue(':email', $email, PDO::PARAM_STR);
		$result->execute();
		$exist = $result->fetch();
		if ($exist) {
			return true;
		}
	}

	//добавление нового пароля в БД
	function UpdatePassword($user_id, $new_password)
	{
		$dbh = getConnectionDB();
		$new_password_hash = passwordHash($new_password);
		$result = $dbh->prepare("UPDATE Stats SET Password=:Password WHERE id=:id");
		$result->bindValue(':Password', $new_password_hash);
		$result->bindValue(':id', $user_id);
		$result->execute();

		$result = $dbh->prepare("UPDATE Users SET Password=:Password WHERE user_id=:id");
		$result->bindValue(':Password', $new_password_hash);
		$result->bindValue(':id', $user_id);
		$result->execute();
		return true;
	}
	//отправка на почту подтверждения изменения пароля
	function SendHref($email) {
		$user_id = getUserByEmail($email);
		$site = $_SERVER['HTTP_HOST'];
		$message = 'Ссылка для изменения пароля - ';
		$href = "{$message} http://{$site}/change_password?ud={$user_id['id']}&smdad21&sdaadd";
        $headers = 'From: ukccatc@gmail.com' . "\r\n" .
            'Reply-To: ukccatc@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
		mail($email, 'Password Change', $href, $headers);
	}

	//Получение ID пользователя по Email (user_id['id'])
	function getUserByEmail($email) {
		$dbh = getConnectionDB();

		$result = $dbh->prepare("SELECT id FROM Stats where Email =:email");
		$result->bindValue('email', $email, PDO::PARAM_STR);
		$result->execute();

		$row = $result->fetch();
		return $row;
	}

	//Создание хеша для паролей
	function passwordHash($password) {
		$secret = 'fsdfsd6287gf';
		$hash = md5($secret.$password);
		return $hash;
	}

	function passwordUnHash() {

	}

	//Первоначальное хеширование паролей, при первом внесении произвольных данных в таблицу
	// function HashAllPass() {
		// 	$dbh = getConnectionDB();
		// 	$result = $dbh->prepare("SELECT Password, id FROM Stats");
		// 	$result->execute();
		// 	$i = 1;
		// 	$arr_stats = Array();
		// 	while ($row = $result->fetch()) {

		// 		$arr_stats[$i]['Password'] = $row['Password'];
		// 		$arr_stats[$i]['id'] = $row['id'];
		// 		$i++;
		// 	}

		// 	$result = $dbh->prepare("SELECT Password, id FROM Users");
		// 	$result->execute();
		// 	$i = 1;
		// 	$arr_users = Array();
		// 	while ($row = $result->fetch()) {

		// 		$arr_users[$i]['Password'] = $row['Password'];
		// 		$arr_users[$i]['id'] = $row['id'];
		// 		$i++;
		// 	}


		// 	foreach ($arr_stats as $arr1) {
		// 		$dbh = getConnectionDB();
		// 		$new_password_hash = passwordHash($arr1['Password']);
		// 		$result = $dbh->prepare("UPDATE Stats SET Password=:Password WHERE id=:id");
		// 		$result->bindValue(':Password', $new_password_hash);
		// 		$result->bindValue(':id', $arr1['id']);
		// 		$result->execute();
		// 	}

		// 	foreach ($arr_users as $arr2) {
		// 		$dbh = getConnectionDB();
		// 		$new_password_hash = passwordHash($arr2['Password']);
		// 		$result = $dbh->prepare("UPDATE Users SET Password=:Password WHERE id=:id");
		// 		$result->bindValue(':Password', $new_password_hash);
		// 		$result->bindValue(':id', $arr2['id']);
		// 		$result->execute();
		// 	}

	// }

	function getYears() {
		$years = array('2015', '2016');
		$current_year = date('Y');
		if (!in_array($current_year, $years)) {
			$years[] = $current_year;
		}
		return $years;
	}

	





