<?php
/**
* ownCloud - Files Etherpad
*
* @author Bastien Ho (EELV - Urbancube)
 * @contributor Ernesto Ruge
* @copyleft 2012 bastienho@urbancube.fr
* @projeturl http://ecolosites.eelv.fr/files_etherpad
*
* Free Software under creative commons licence
* http://creativecommons.org/licenses/by-nc/3.0/
* Attribution-NonCommercial 3.0 Unported (CC BY-NC 3.0)
* 
* You are free:
* to Share — to copy, distribute and transmit the work
* to Remix — to adapt the work
*
* Under the following conditions:
* Attribution — You must attribute the work in the manner specified by the author or licensor (but not in any way that
* suggests  that they endorse you or your use of the work).
* Noncommercial — You may not use this work for commercial purposes.
*
*/
$params = array(
    'files_etherpad_host',
    'files_etherpad_calc_host',
);

if ($_POST) {
  foreach($params as $param){
    if(isset($_POST[$param])){
      OC_Appconfig::setValue('files_etherpad', $param, $_POST[$param]);
    }
  }
}

// fill template
$tmpl = new OC_Template('files_etherpad', 'settings');
foreach($params as $param){
  $value = OC_Appconfig::getValue('files_etherpad', $param,'');
  $tmpl->assign($param, $value);
}

return $tmpl->fetchPage();
