<?php
include_once 'conf.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title></title>
</head>
<body>
<?php
$r='';

$auth = new auth(); //~ Создаем новый объект класса

//~ Авторизация
if (isset($_POST['send'])) {
	if (!$auth->authorization()) {
		$error = $_SESSION['error'];
		unset ($_SESSION['error']);
	}
}

//~ выход
if (isset($_GET['exit'])) $auth->exit_user();

//~ Проверка авторизации
if ($auth->check()) $r.='Добро пожаловать '.$_SESSION['login_user'].'<br/><a href="?exit">Выйти</a>';
else {
	//~ если есть ошибки выводим и предлагаем восстановить пароль
	if (isset($error)) $r.=$error.'<a href="recovery.php">Восстановить пароль</a><br/>';

	$r.='
	<a href="join.php">Зарегистрироваться</a>
	<form action="" method="post">
		login <input type="text" name="login" value="'.@$_POST['login'].'" /><br />
		passwd <input type="password" name="passwd" id="" /><br />
		<input type="submit" value="send" name="send" />
	</form>
	';
}
	print $r;
?>
</body>
</html>
