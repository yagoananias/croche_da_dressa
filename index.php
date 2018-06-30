<?php 
//Composer
require_once("vendor/autoload.php");
//Namespaces
use \Slim\Slim;
use \yagoananias\Page;
//Nova Aplicação(Rotas)
$app = new Slim();

$app->config('debug', true);
//Rotas (ao chamar pasta raiz do site executa essa função que carrega a página***
$app->get('/', function() {
    
	$page = new Page();

	$page->setTpl("index");

});

$app->run();

 ?>