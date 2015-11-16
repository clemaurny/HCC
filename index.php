<?php
/*
 @nom: index
 @auteur: Idleman (idleman@idleman.fr)
 @description:  Page d'accueil et de lecture des flux
*/
session_start();
require_once('header.php');

$db = (file_exists(PATH_BDD)?Functions::unstore():array());
asort($db['engines']);
$tpl->assign('engines',$db['engines']);
$duration = Functions::durationEngine($engine['dateStart'], $engine['dateEnd'], $engine['power'],$engine['hours']);
$places = (isset($db['places'])?$db['places']:array());
asort($places);
$ip = Functions::getIp();
$tpl->assign('ip',$ip);
$tpl->assign('places',$places);
$tpl->assign('duration',$_SESSION['duration']);
$tpl->assign('consommation',$_SESSION['conso']);
$view = 'index';
require_once('footer.php'); 
?>
