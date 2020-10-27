<?php 

require_once('phpmailer/PHPMailerAutoload.php');
$mail = new PHPMailer;
$mail->CharSet = 'utf-8';

$name = $_POST['user_name'];
$phone = $_POST['user_phone']; 

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.mail.ru';  																							// Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'example@mail.ru'; // Ваш логин от почты с которой будут отправляться письма
$mail->Password = 'password'; // Ваш пароль от почты с которой будут отправляться письма
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465; // TCP port to connect to / этот порт может отличаться у других провайдеров

$mail->setFrom('example@mail.ru'); // от кого будет уходить письмо?
$mail->addAddress('example0@gmail.com');     // Кому будет уходить письмо 
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Заявка с MoreThanMarketing';
$mail->Body    = '' .$name . ' оставил заявку, его телефон ' .$phone;
$mail->AltBody = '';

if(!$mail->send()) {
    $message = 'Ошибка
Данные не отправленны!';
} else {
	$message = 'Спасибо за заявку!
Данные отправленны!';
}

$response = ['message' => $message];

header('Content-type: application/json');
echo json_encode($response);
?>