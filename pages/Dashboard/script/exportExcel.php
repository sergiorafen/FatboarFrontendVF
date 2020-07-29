<?php

ini_set('default_socket_timeout', 600);
ini_set('memory_limit', '-1');
set_time_limit(0);
include_once ('composant/PHPExcel/Classes/PHPExcel.php');
include_once ('composant/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php');
include_once ('composant/PHPExcel/Classes/PHPExcel/IOFactory.php');
// include_once ('composant/PHPMailer/PHPMailerAutoload.php');
// include_once ('composant/PHPMailer/PHPMailer.php');

//config de la bdd
$db = new PDO('mysql:host=localhost;dbname=fatboar','root','');
//Initialisation des datas
//Suppression des données

//Création de l'excel en pj pour les huissiers
function getField($db,$table){
	$sql="
	SELECT column_name FROM information_schema.columns WHERE table_name = '$table' AND table_schema = 'fatboar'";
	$query = $db->prepare( $sql );
	$query->execute();
	$tableTmp = $query->fetchAll(PDO::FETCH_ASSOC);
	return array_column($tableTmp, 'column_name');
}

$objExcel= new PHPExcel();
$sheet = $objExcel->getActiveSheet()->setTitle('Ticketsgain');
$dbFields=getField($db,'ticket');
$sql="SELECT * FROM Ticket";
$query = $db->prepare( $sql );
$query->execute();
$datas = $query->fetchAll(PDO::FETCH_ASSOC);
array_unshift($datas, $dbFields);
$sheet->fromArray($datas);

// $sheet = $objExcel->setActiveSheet()->setTitle('Email');
// $dbFields=getField($db,'ticket');
// $sql="SELECT Distinct username FROM Ticket ";
// $query = $db->prepare( $sql );
// $query->execute();
// $datas = $query->fetchAll(PDO::FETCH_ASSOC);
// array_unshift($datas, $dbFields);
// $sheet->fromArray($datas);

//Création du fichier excel
$writer = new PHPExcel_Writer_Excel2007($objExcel);
$writer->save('Fatboar_Admin.xlsx');
// $mail = new PHPMailer;
// $mail->setFrom('rafensergio@gmail.com','Sergio RAFENOMANANA');
//   $mail->addAddress('rafensergio@gmail.com', 'Sergio RAFENOMANANA'); // Add a recipient
//   $mail->addAttachment('C:/wamp64/www/FatBoar/script/Fatboar.xlsx');// Add attachments
//   $mail->isHTML(true);// Set email format to HTML
//   $mail->CharSet = 'UTF-8';
//   $mail->Subject = 'Tirage du mois '.date('Y-m');
//   $mail->Body    = '<p>Bonjour,</p>
//       <p>Vous trouverez ci-joint la liste des gagnants de FatBoar</p>
//       <p>Cordialement</p>';
//   $mail->send();
