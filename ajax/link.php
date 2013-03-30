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
echo '0';