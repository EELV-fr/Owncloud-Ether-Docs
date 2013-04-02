<?php
OCP\User::checkLoggedIn();
echo(OC_Appconfig::getValue('files_etherpad', 'files_etherpad_host',''));
?>