<?php
OCP\User::checkLoggedIn();
$get_host='files_etherpad_host';
if($_REQUEST['type']=='calc') $get_host='files_etherpad_calc_host';
// Some other formats
echo(OC_Appconfig::getValue('files_etherpad', $get_host,''));
?>