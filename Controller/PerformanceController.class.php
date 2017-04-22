<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \interop\Container\ContainerInterface;
use \Slim\Views\PhpRenderer;
use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;

class PerformanceController 
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
  		$path = $this->app->router->pathFor('performanceIndex');
    		$as = [
  			'settings'=>$this->app->get('settings'),
  			'path' => $path
  		];
  		return $this->app->renderer->render($response, './performance.php', $as);
    }

    public function ranking($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('performanceIndex');
      $sc = $_COOKIE['subcomid'];
      if(isset($args['month'])){
        $month = $args['month'];
      }else{
        $month = date('Ym');
      }
      
      $in = $db->select('member_integral',[
        '[>]member'=>['member_integral.staffid' => 'id']
        ],[
        'member_integral.staffid(staffid)',
        'member.name(name)',
        'member_integral.integral(integral)'
        ],[
        'AND' => [
          'member.subcompany' => $sc,
          'member.status' => 1,
          'member_integral.month' => $month
        ],
        'ORDER' => ['member_integral.integral'=>'DESC'],
        'LIMIT' =>[0,10]
        ]);

      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'thismonth' => $month,
        'in' => $in
      ];
      return $this->app->renderer->render($response, './ranking.php', $as);
    }

      

}
