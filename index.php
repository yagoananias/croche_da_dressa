<?php
session_start(); 
//Composer
require_once("vendor/autoload.php");
//Namespaces
use \Slim\Slim;
use \yagoananias\Page;
use \yagoananias\PageAdmin;
use \yagoananias\Model\User;
//Nova Aplicação(Rotas)
$app = new Slim();

$app->config('debug', true);
//Rotas (ao chamar pasta raiz do site executa essa função que carrega a página***
$app->get('/', function() {
    
	$page = new Page();

	$page->setTpl("index");

});

$app->get('/admin/', function() {

	User::verifyLogin();
    
	$page = new PageAdmin();

	$page->setTpl("index");

});

$app->get('/admin/login', function() {
    //Desabilita o header e o footer padrão
	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false

	]);

	$page->setTpl("login");

});
$app->post('/admin/login', function() {

	User::login($_POST["login"], $_POST["password"]);

	header("Location: /admin");
	exit;

});

$app->get('/admin/logout', function() {

	User::logout();

	header("Location: /admin/login");
	exit;
});
$app->run();

 ?>