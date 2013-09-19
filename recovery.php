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
$reg = new auth();  //~ Создаем новый объект класса
$r='';
$form='
	<form action="" method="post">
		логин <input type="text" name="login" id="" value="'.@$_POST['login'].'" /><br />
		Почта <input type="text" name="mail" value="" /><br />
		<input type="submit" value="send" name="send" />
	</form>
';

if (isset($_POST['send'])) {
	//~ запрос на восстановление пароля
	$reply = $reg->recovery_pass($_POST['login'], $_POST['mail']);
	if ($reply=='good') {
		//~ положительный ответ
		$r.='Новый пароль был выслан вам на почту';
	} else {
		//~ ошибка во время восстановления
		$r.=$reply.$form;
	}
} else $r.=$form;
print $r;

?>
</body>
</html>
