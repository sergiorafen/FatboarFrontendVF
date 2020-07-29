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

//suppression des détails des lots
$sql="TRUNCATE lotdetail";
$query = $db->prepare($sql);
$query->execute();

//Suppression de la référence des lots
$sql="TRUNCATE lot";
$query = $db->prepare($sql);
$query->execute();


$sql="TRUNCATE user";
$query = $db->prepare($sql);
$query->execute();

$sql="TRUNCATE ticket";
$query = $db->prepare($sql);
$query->execute();

$sql="TRUNCATE gain";
$query = $db->prepare($sql);
$query->execute();

//User fictif
// $sql = "INSERT INTO `user`( `Name`, `email`, `password`,`date`)
// VALUES
// ('johntest','john@gmail.com','test','2020-05-03'),
// ('johntest_2','alex@gmail.com','test_iso','2020-03-04')";
// $query = $db->prepare($sql);
// $query->execute();


//Insertion des données dans LotDetail

$sql = "INSERT INTO `lotdetail`(`LibelleLot`, `qte_lot_detail`, `date`)
VALUES ('Burger frites','1','22-10-2020'),
('Burger','1','22-10-2020'),
('Burger','1','22-10-2020'),
('Burger','1','22-10-2020'),
('Entree dessert','1','22-10-2020'),
('Entree dessert','1','22-10-2020'),
('Entree dessert','1','13-03-2020'),
('menu du jour','1','13-03-2020'),
('menu du jour','1','13-03-2020'),
('menu du jour','1','13-03-2020'),
('menu du jour','1','13-03-2020'),
('reduction','1','05-07-2020'),
('Voiture','1','05-07-2020')";
$query = $db->prepare($sql);
$query->execute();

//Insertion des données dans LotRef

$sql = "INSERT INTO `lot`( `Name`, `quantite`, `date`, `numLot`,`restaurant`)
SELECT `LibelleLot`,sum(qte_lot_detail) as Quantite,`date`,id,'Gerbor Daumartin' FROM lotdetail GROUP BY `LibelleLot`";
$query = $db->prepare($sql);
$query->execute();

// génération de la référence aleatoire
$sql="SELECT id FROM lotdetail ORDER BY RAND() LIMIT 1";
$query = $db->prepare($sql);
$query->execute();
$randomVal=$query->fetch(\PDO::FETCH_ASSOC);
$idlotRandom=$randomVal['id'];

//Insertion des données dans Ticket
$sql = "INSERT INTO `ticket`(`username`, `price`, `id_lot_detail`,`libelleLot`,`gain`)
SELECT B.username as username,'17',C.id,C.LibelleLot,'ticket gagnants' FROM users B inner join LotDetail C
WHERE C.id=$idlotRandom";
var_dump($sql);

$query = $db->prepare($sql);
$query->execute();

//Insertion dans Gain
$sql = "INSERT INTO `gain`(`libellegain`, `numlot`, `username`)
SELECT  `libelleLot`,`id_lot_detail`,`username` FROM ticket ";
$query = $db->prepare($sql);
$query->execute();

//suppression dans lot du lot remporté par une personne


//Création de l'excel en pj pour les huissiers
function getField($db,$table){
	$sql="
	SELECT column_name FROM information_schema.columns WHERE table_name = '$table' AND table_schema = 'ostc_uo'";
	$query = $db->prepare( $sql );
	$query->execute();
	$tableTmp = $query->fetchAll(PDO::FETCH_ASSOC);
	return array_column($tableTmp, 'column_name');
}

$objExcel= new PHPExcel();
$sheet = $objExcel->getActiveSheet()->setTitle('gain');
$dbFields=getField($db,'gain');
$sql="SELECT * FROM gain";
$query = $db->prepare( $sql );
$query->execute();
$datas = $query->fetchAll(PDO::FETCH_ASSOC);
array_unshift($datas, $dbFields);
$sheet->fromArray($datas);

//Création du fichier excel
$writer = new PHPExcel_Writer_Excel2007($objExcel);
$writer->save('Fatboar_david.xlsx');
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
