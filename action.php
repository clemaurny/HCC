<?php
require_once('header.php');

global $db;
$db = (file_exists(PATH_BDD)?Functions::unstore():array());
switch($_['action']){

case 'ADD_ENGINE':
    $fichier = basename($_FILES['picture']['name']);
    move_uploaded_file($_FILES['picture']['tmp_name'], PICTURE_FOLDER .'/'. $fichier);
	$newEngine['picture'] = PICTURE_FOLDER .'/'.$fichier;
	$newEngine['name'] = $_['name'];
	$newEngine['code'] = $_['code'];
	$newEngine['state'] = 'off';
	$newEngine['description'] = $_['description'];
	$newEngine['place'] = $_['idPlace'];
	$newEngine['type'] = $_['selectType'];
	$newEngine['hours'] = $_['hoursMoy'];
	$db['keys']['engines']=(isset($db['keys']['engines'])?$db['keys']['engines']+1:1);
	$db['engines']['id-'.$db['keys']['engines']] =  $newEngine;
	Functions::store($db);
	header('location: settings.php');
break;

case 'LOGIN':
    $login = $db['logins']['id-1'];
var_dump(sha1($_['password']));
	if($_['email']==$login["email"] && sha1($_['password'])==$login['pass']){
		$_SESSION['myUser'] = serialize(array('login'=>$login["email"]));
	}else{
		exit('Bad code');
	}
   header('location: index.php');
break;

case 'UPDATE_SUNSET':

	$_SESSION["sunset"] = Functions::getSunset(45.4,5.21);
	var_dump($_SESSION["sunset"]);
	header('location: index.php');
break;

case 'DISCONNECT':
	$_SESSION = array();
	session_unset();
	session_destroy();
	header('location: index.php');
break;

case 'ADD_LOGIN':
		if(isset($_POST['newEmail']) && isset($_POST['newPass']) && $_POST['newPass'] != '' 
		&& $_POST['newEmail'] != '' )
		{
			$newLogin['email'] = $_['newEmail'];
			$newLogin['pass'] = sha1($_['newPass']);
			$db['keys']['logins']=1;
			$db['logins']['id-'.$db['keys']['logins']] =  $newLogin;
			Functions::store($db);
			header('location: settings.php');
		}
	
break;
case 'ADD_PLACE':
	
	$newPlace['name'] = $_['place'];
	$db['keys']['places']=(isset($db['keys']['places'])?$db['keys']['places']+1:1);
	$db['places']['id-'.$db['keys']['places']] =  $newPlace;
	Functions::store($db);
	header('location: settings.php');
break;

case 'DELETE_ENGINE':
	
	unset($db['engines'][$_['engine']]);
	Functions::store($db);
	header('location: settings.php');
break;

case 'DELETE_PLACE':
	
	unset($db['places'][$_['place']]);
	Functions::store($db);
	header('location: settings.php');
break;

case 'CHANGE_STATE':
	
        $dateN = new DateTime('Now');
        $dateN->format('d/m/Y H:i:s');
        $state = $_GET['state'];
        $state = $state == "off" ? "off" : "on"; 
	if($_GET['code']=='-1'){
		foreach($db['engines'] as $id=>$engine){
			system('sudo /radioEmission '.PIN.' '.SENDER.' '.$engine['code'].' '.$state);
		}
	}else{
		system('sudo ./radioEmission '.PIN.' '.SENDER.' '.$_GET['code'].' '.$state);
	}
	$db[$_GET['code']] = $_GET['state'];
	
	$engine = $db['engines'][$_['engine']];
	
	if($_GET['state'] == 'on') {
			if($engine['dateStart'] == '' ) {
				$engine['dateStart'] = time();
			}
			$engine['dateEnd'] = time() ;			

	}

	if($_GET['state'] == 'off') {
		if($_GET['CURRENT_STATE'] !== 'off'){
			
			$engine['dateEnd'] = time() ;
		}

	}
	
	$duration = Functions::durationEngine($engine['dateStart'], $engine['dateEnd'], $engine['power'],$engine['hours']);

    $_SESSION['duration'] = $duration[1];
	$_SESSION['conso'] = $duration[0];

	//$engine['name'] = $_['name'];
	//$engine['code'] = $_['code'];
	$engine['state'] = $_['state'];
	//$engine['description'] = $_['description'];
	//$engine['place'] = $_['place'];
	$db['engines'][$_['engine']] =  $engine;

	Functions::store($db);
	
	if(!isset($_['provider'])){
		header('location: index.php');
	}else{
		echo 'A vos ordres';
	}
break;



	case 'GET_YURI_XML':
		
		$hccPath = substr($_SERVER['HTTP_REFERER'],0,strrpos($_SERVER['HTTP_REFERER'], '/')).'/action.php';

		$template = '<grammar version="1.0" xml:lang="fr-FR" mode="voice" root="ruleEedomus" xmlns="http://www.w3.org/2001/06/grammar" tag-format="semantics/1.0">
						  <rule id="ruleEedomus" scope="public">
						    <example>Yuri allume le salon</example>
						    <tag>out.action=new Object(); </tag>
						    <item>Yuri</item>
						    <one-of>
						      <item>allume<tag>out.action.state="on"</tag></item>
						      <item>eteint<tag>out.action.state="off"</tag></item>
						    </one-of>

						    <one-of>';

						    foreach($db['engines'] as $id=>$engine){
						    $template .= '<item>'.$engine['name'].'
						        <tag>out.action.engine=\''.$id.'\'</tag>
								<tag>out.action.code=\''.$engine['code'].'\'</tag>
						      </item>';
							}
						   


						  $template .= '

						  	<item>tout
						        <tag>out.action.engine=\'id-all\'</tag>
								<tag>out.action.code=\'-1\'</tag>
						      </item>

						   </one-of>
						    <tag>out.action.action=\'CHANGE_STATE\'</tag>
							 <tag>out.action.provider=\'yuri\'</tag>
							  <tag>out.action._attributes.threashold="0.80";</tag>
						    <tag>out.action._attributes.uri="'.$hccPath.'";</tag>
						  </rule>
						</grammar>';

						header('Content-Description: File Transfer');
			    		header('Content-Type: application/octet-stream');
			    		header('Content-Disposition: attachment; filename=hcc_yuri_xml.xml');
			    		header('Content-Transfer-Encoding: binary');
			    		header('Expires: 0');
			   	 		header('Cache-Control: must-revalidate');
			    		header('Pragma: public');
			    		header('Content-Length: ' . strlen($template));
			    		ob_clean();
			    		flush();
						echo $template;
				
	break;
	default:
		echo 'Aucune action correcte n\'est sp�cifi�e';
	break;

}





?>
