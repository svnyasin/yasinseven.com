<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if($_POST['email']<>'' && $_POST['name']<>'' && $_POST['subject']<>'' && $_POST['message']<>''){

	$isim=$_POST['name'];
	$eposta=$_POST['email'];
	$konu=$_POST['subject'];
	$mesaj=$_POST['message'];

	$mail = new PHPMailer(true);				// Passing `true` enables exceptions
	try {
		//Server settings
		$mail->SMTPDebug = 0;				// SMTP hata ayıklama // 0 = mesaj göstermez // 1 = sadece mesaj gösterir // 2 = hata ve mesaj gösterir
		$mail->isSMTP();										
		$mail->SMTPAuth = true;				// SMTP doğrulamayı etkinleştirir
		$mail->Username = 'iletisim@yasinseven.com';	// SMTP kullanıcı adı (gönderici adresi)
		$mail->Password = '1866dbe802d682e197eb0a(encryptedRC4)';			// SMTP şifre
		$mail->Host = 'srvc199.turhost.com';		// Mail sunucusunun adresi
		$mail->Port = 465;				// Normal bağlantı için 587, güvenli bağlantı için 465 yazın
		$mail->SMTPSecure = 'ssl';			// Enable TLS encryption, '' , 'ssl' , 'tls'
		$mail->SMTPOptions = array(
			'ssl' => [
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true,
			],
		);
		$mail->SetLanguage('tr', 'PHPMailer/language/');
	
		//Recipients
		$mail->setFrom('iletisim@yasinseven.com', 'Yasin Seven');	// Mail atıldığında gorulecek isim ve email
		$mail->addAddress('yasinsvn@gmail.com');				// Mailin gönderileceği alıcı adresi

		//Content
		$mail->isHTML(true);                                  
		$mail->Subject = 'İletişim formundan mesajınız var!';				// Email konusu
		$mail->Body    = "$isim<br />$eposta<br />$konu <br />$mesaj";		// Mailin içeriği
		$mail->CharSet = 'utf-8';
		$mail->send();
		echo 'Mesaj gönderildi';
	} catch (Exception $e) {
		echo 'Mesaj gönderilmedi. Hata: ', $mail->ErrorInfo;
	}
}
