<?php
require '../../tools/SMSTruth.php';
require '../../tools/Util.php';
require '../../models/Recordatorio.php';

$Recordatorio = new Recordatorio();
$Util = new Util();

$Recordatorio->setEmpresaid(1);
$array_vencimientos = $Recordatorio->verxVencer();
$mensate = "Hola, le recordamos que: \n";
$contar = 0;
foreach ($array_vencimientos as $fila) {
    $contar++;
    $mensate .= "el dia " . $Util->fecha_mysql_web($fila['fec_vencimiento']) . " se vencera: " . $fila['documento'] ."\n";
}

$Sms = new SMSTruth();

$textosms =  "Great app! Thank you!";
$Sms->setNumero("+51949490436");
$Sms->setNumero("+51936507153");
$Sms->setNumero("+51922636405");
$Sms->setTexto(trim($mensate));
//$Sms->setData();
if ($contar > 0) {
    $Sms->sendSMS();
}
//curl - X POST - H "Content-Type: application/json" - H "Authorization: user:123456" - d
// '{"phone": "+212676892632", "msg": "Great app! Thank you!"}' https://smsgateway.truthful.be/sms?deviceId=4eaf8edd74b1785a