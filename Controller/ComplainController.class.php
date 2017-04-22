<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \interop\Container\ContainerInterface;
use \Slim\Views\PhpRenderer;
use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;

class ComplainController 
{
	protected $app;
   	
   	public function __construct(ContainerInterface $ci) {
       $this->app = $ci;
   	}
   	public function __invoke($request, $response, $args) {
        //to access items in the container... $this->ci->get('');
   	}
   	
   	public function index($request, $response, $args){
    	global $flag,$msg,$data,$db;
    
  		$path = $this->app->router->pathFor('complainIndex');
  		$as = [
			'settings'=>$this->app->get('settings'),
			'path' => $path,
			'v'=>$v
		];
		return $this->app->renderer->render($response, './complain.php', $as);
    }

      

}