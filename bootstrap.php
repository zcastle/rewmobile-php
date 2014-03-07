<?php
require_once 'lib/php-activerecord/ActiveRecord.php';
require_once 'lib/config.class.php';

$config = new config();
$server = $config->getServer();
$username = $config->getUserName();
$password = $config->getPassword();
$database_name = $config->getDataBaseName();

/*$connections = array(
	'development' => 'mysql://username:password@localhost/development',
	'production' => 'mysql://username:password@localhost/production',
	'test' => 'mysql://username:password@localhost/test'
);
ActiveRecord\Config::initialize(function($cfg) use ($connections) {});
*/

//ActiveRecord\Config::initialize(function($cfg){
//	$cfg->set_model_directory('models');
//	$cfg->set_connections(array('development' => 'mysql://root:123456@localhost/dbrewsoft?charset=utf8'));
	//$cfg->set_default_connection('development');
//});

$cfg = ActiveRecord\Config::instance();
$cfg->set_model_directory('models');
$cfg->set_connections(array('development' => "mysql://".$username.":".$password."@".$server."/".$database_name."?charset=utf8"));

?>