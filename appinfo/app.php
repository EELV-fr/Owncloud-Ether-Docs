<?php
OCP\Util::addscript( 'files_etherpad', 'core-min');
OCP\Util::addscript( 'files_etherpad', 'md5-min');
OCP\Util::addscript( 'files_etherpad', 'files_etherpad');
OCP\App::registerAdmin('files_etherpad','settings');
