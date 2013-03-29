<?php  
$filename=$_REQUEST['dir'].'/'.stripslashes($_REQUEST['file']);
$uid=OC_User::getUser();
if(OC_Filesystem::is_file($filename)){
	$content=OC_Filesystem::file_get_contents($filename);
	if(strpos($content,'URL=')>-1){
		$content=preg_split('/[\n]/',$content);
		foreach($content as $line){
			if(substr($line,0,4)=='URL='){
				echo substr($line,4);
				exit();
			}
		}
	}
}
else{
	if(!class_exists('OC')) {
		try {
			// OC < 4
			include_once('../../../lib/base.php');
		} catch(Exception $e) {
			// OC >= 4
			require_once('lib/base.php');
		}
	}
	$host = OC_Appconfig::getValue('files_etherpad', 'files_etherpad_host','');	
	if($host!='' && OC_Files::newFile($_REQUEST['dir'], stripslashes($_REQUEST['file']), 'file')) {
		$link=$host.'/p/'.str_replace('.url','',stripslashes($_REQUEST['file']));
		$content='[InternetShortcut]\nURL='.$link."\n";
		if(OC_Filesystem::file_put_contents($filename, $content)){
			echo $link;
			exit();
		}
	}
}
echo '0';