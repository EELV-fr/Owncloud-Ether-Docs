<?php
OCP\Util::addscript( 'files_etherpad', 'core-min');
OCP\Util::addscript( 'files_etherpad', 'md5-min');
OCP\Util::addscript( 'files_etherpad', 'mutations.core');
OCP\Util::addscript( 'files_etherpad', 'mutations.html');
OCP\Util::addscript( 'files_etherpad', 'files_etherpad');
OCP\App::registerAdmin('files_etherpad','settings');
OCP\Util::addStyle('files_etherpad', 'files_etherdocs');
