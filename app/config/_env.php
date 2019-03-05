<?php 
use Dotenv\Dotenv;

$dotEnv = new Dotenv(APP_ROOT);
$dotEnv->load();

// define("URL_ROOL",APP_ROOT."/public/assets/");

require_once __DIR__."/_stripe.php";

?>