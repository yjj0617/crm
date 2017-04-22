<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \interop\Container\ContainerInterface;
use \Slim\Views\PhpRenderer;
use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;

class CmsController 
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
  		$path = $this->app->router->pathFor('cmsIndex');
    		$as = [
  			'settings'=>$this->app->get('settings'),
  			'path' => $path
  		];
  		return $this->app->renderer->render($response, './cms.php', $as);
    }

    public function projects($request, $response, $args){
      global $flag,$msg,$data,$db;

      if(isset($args['p']) && is_numeric($args['p']) && $args['p']>1){
        $p = $args['p'];
        $srow = ($p*10)-10;
      }else{
        $p = 1;
        $srow = 0;
      }
      
      $list = $db->select('mcms_service',[
          "[>]mcms_categories" => ["mcms_service.cateId"=>"id"]
          ],[
          'mcms_service.id(id)',
          'mcms_service.title(title)',
          'mcms_service.cateId(cateId)',
          'mcms_service.marketPrice(marketPrice)',
          'mcms_service.allPrice(allPrice)',
          'mcms_service.template(template)',
          'mcms_service.status(status)',
          'mcms_categories.cateName(cateName)',
          ],[
        'mcms_service.status'=>0,
        "ORDER" => ["mcms_service.id"=>"DESC"],
        "LIMIT" => [$srow,10]
        ]);

      $count=[];
      $count['all'] = $db->count('mcms_service',['status'=>0]);
      
      $path = $this->app->router->pathFor('cmsIndex');
        $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'p' => $p,
        'count'=> $count,
        'list' => $list
      ];
      return $this->app->renderer->render($response, './cms_projects.php', $as);
    }
    
    public function projectsform($request, $response, $args){
      global $flag,$msg,$data,$db;
      
      if(isset($args['id'])){
        $id = $args['id'];
        $m = $db->get('mcms_service',[
          "[>]mcms_categories" => ["mcms_service.cateId"=>"id"],
          "[>]mcms_attachment" => ["mcms_service.thumbnail"=>"id"]
          ],[
          'mcms_service.id(id)',
          'mcms_service.title(title)',
          'mcms_service.cateId(cateId)',
          'mcms_service.marketPrice(marketPrice)',
          'mcms_service.allPrice(allPrice)',
          'mcms_service.template(template)',
          'mcms_service.desc(desc)',
          'mcms_service.thumbnail(thumbnail)',
          'mcms_service.pics(pics)',
          'mcms_service.text(text)',
          'mcms_service.status(status)',
          'mcms_attachment.thumbnail(thumbnailp)',
          'mcms_categories.cateName(cateName)',
          ],['mcms_service.id'=>$id]);
      }else{
        $id = 0;
        $m = '';
      }
      
      $path = $this->app->router->pathFor('cmsIndex');
        $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'id' => $id,
        'm'=>$m
      ];
      return $this->app->renderer->render($response, './cms_projects_form.php', $as);
    }

    public function saveprojects($request, $response, $args){

      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('cmsIndex');
      $sc = $_COOKIE['subcomid'];

      //$cus = $request->getParsedBody()['customsid'];
      $text = $_POST['editorValue'];
      if(isset($args['id'])){
        $id = $args['id'];
        $up = $db->update("mcms_service", [
          "title" => $request->getParsedBody()['title'],
          "cateId" => $request->getParsedBody()['cateId'],
          "desc" => $request->getParsedBody()['desc'],
          "thumbnail" => $request->getParsedBody()['thumbnail'],
          "text" => $text,
          "template" => $request->getParsedBody()['template'],
          "marketPrice" => $request->getParsedBody()['marketPrice'],
          "allPrice" => $request->getParsedBody()['allPrice'],
          "pics" => $request->getParsedBody()['pics']
        ],['id'=>$id]);
        if($up){
          $flag = 200;
          $msg = '服务编辑成功。服务ID:'.$id;
          //wlog('12','编辑客户',$msg,$mid);
        }else{
          //$mid = 0;
          $flag = 400;
          $msg = '没有修改任何数据。';
        }
        
      }else{
        $id = $db->insert("mcms_service", [
         "title" => $request->getParsedBody()['title'],
          "cateId" => $request->getParsedBody()['cateId'],
          "desc" => $request->getParsedBody()['desc'],
          "thumbnail" => $request->getParsedBody()['thumbnail'],
          "text" => $text,
          "template" => $request->getParsedBody()['template'],
          "marketPrice" => $request->getParsedBody()['marketPrice'],
          "allPrice" => $request->getParsedBody()['allPrice'],
          "pics" => $request->getParsedBody()['pics'],
          "status" => 0
        ]);
        if($mid > 0){
          $flag = 200;
          $msg = '添加新服务已成功。服务ID:'.$id;
          //wlog('9','创建客户',$msg,$mid);
        }else{
          $mid = 0;
          $flag = 400;
          $msg = '添加新服务失败，数据有误。';
        }
      }
      
      $json = array('flag' => $flag,'msg' => $msg, 'data' => $data,'id' => $id);
      return $response->withJson($json);
    }

}
