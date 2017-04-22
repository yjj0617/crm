<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\UriInterface as Uri;
use \interop\Container\ContainerInterface;
use \Slim\Views\PhpRenderer;
use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;
use MyApp\Chat;

class DesktopController 
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
  		$path = $this->app->router->pathFor('Index');
      $sc = $_COOKIE['subcomid'];
      $u = $db->get('member',[
        "[>]member_department" => ["member.department" => "id"]
        ],[
          'member.department(department)',
          'member_department.departmentname(departmentname)',
          'member_department.template(template)'
        ],['member.id'=>$_COOKIE['staffID']]);

      if($u['template']!=''){
        $desktop = $u['template'];
      }else{
        $desktop = 'index.php';
      }

      $notice = $db->select('notice','*',['ORDER'=>['id'=>'DESC'],'LIMIT'=>[0,2]]);
      
      $oto = $db->select('member_oto',[
        "[>]member" => ["member_oto.uid" => "id"]
        ],[
          'member_oto.id(id)',
          'member_oto.start(start)',
          'member_oto.end(end)',
          'member_oto.affair(affair)',
          'member.name(staffName)',
        ],[
          'member.subcompany' => $sc,
        'ORDER'=>['id'=>'DESC'],
        'LIMIT'=>[0,2]
        ]);

      $ts = $db->select('complains',[
        "[>]member" => ["complains.memberid" => "id"],
        "[>]customs" => ["complains.cid" => "id"]
        ],[
        'complains.id(id)',
        'complains.text(text)',
        'complains.creattime(creattime)',
        'customs.name(cName)',
        'customs.mobile(cMobile)',
        'member.name(sName)',
        ],[
        'AND'=>[
          'complains.status'=>0,
          'complains.memberid'=>[$_COOKIE['staffID'],0],
        ],
        'ORDER'=>['id'=>'DESC']]);
      
      $xb = $db->select('redpaper',[
          "[>]member" => ["redpaper.uid" => "id"],
          "[>]member_subcompany" => ["member.subcompany" => "id"],
          "[>]member_department" => ["member.department" => "id"],
          "[>]contract_type" => ["redpaper.type" => "id"],
        ],[
          'redpaper.id(id)',
          'redpaper.uid(uid)',
          'redpaper.money(money)',
          'redpaper.day(day)',
          'redpaper.type(type)',
          'member.name(name)',
          'member_subcompany.subcompanyname(subcompanyname)',
          'member_department.departmentname(departmentname)',
          'contract_type.typename(typename)',
        ],[
        'ORDER' => ['redpaper.id'=>'DESC'],
        'LIMIT' => [0,5]
        ]);

     

      //通讯录
      $ubook = $db->select('member',[
          "[>]member_position" => ["member.position" => "id"],
          "[>]member_department" => ["member.department" => "id"]
        ],[
          'member.name(name)',
          'member.mobile(mobile)',
          'member_department.departmentname(department)',
          'member_position.positionname(position)'
        ],[
         'AND'=>[
          "isout" =>0,
          "status" =>1,
          "subcompany" => $sc
         ],
         'ORDER'=>['member.department'=>'ASC',"member.position" => "ASC"]
      ]);

      //我的打卡信息
      $dk = $db->select('member_worktime','*',[
          'AND'=>[
            'staffid' => $_COOKIE['staffID'],
            'workday' => date('Y-m-d')
          ]
        ]);

      $daily = $db->select('member_daily',[
          '[>]member'=>['member_daily.uid'=>'id'],
          '[>]member_subcompany'=>['member.subcompany'=>'id'],
        ],[
        'member_daily.id(id)',
        'member_daily.day(day)',
        'member_daily.daily(daily)',
        'member_daily.creattime(creatTime)',
        'member_daily.uid(uid)',
        'member.name(staffName)',
        'member_subcompany.subcompanyname(staffCompany)'
        ],[
          'AND'=>[
            'member_daily.uid' => $_COOKIE['staffID'],
            'member_daily.day' => date('Y-m-d')
          ]
        ]);

  		$as = [
  			'settings'=>$this->app->get('settings'),
  			'path' => $path,
        'notice' => $notice,
        'oto' => $oto,
        'ts' => $ts,
        'xb' => $xb,
        'ubook' => $ubook,
        'dk' => $dk,
        'daily' => $daily
  		];
  		return $this->app->renderer->render($response, './'.$desktop, $as);
    }

    public function loginpage($request, $response, $args){
    	global $flag,$msg,$data,$db;
    	$vs = $this->app->get('settings');
  		$as = [
			'settings'=>$this->app->get('settings')
		];
		return $this->app->renderer->render($response, './login.php', $as);
    }

    public function login($request, $response, $args){
    	global $flag,$msg,$data,$db;
      $mobile = $_POST['mobile'];
		  $password =  md5($_POST['password']);	
      //生成客户端SSID
      $uniqid = uniqid();	
		  if($mobile != '' || $password != ''){
			    $has = $db->get("member",'*',[
	            "mobile" => $mobile
	        ]);
	        if($has){
				    $login = $db->get("member",'*',["AND"=>[
		            "mobile" => $mobile,
		            "password" => $password,
		            "status" => 1
		        ]]);

		        if($login && $login!=0){
		        	setcookie("mobile", $mobile, time()+43200,'/');
		        	setcookie("staffID", $login['id'], time()+43200,'/');
		        	setcookie("subcomid", $login['subcompany'], time()+43200,'/');
		        	setcookie("authoritySubc", $login['authoritySubc'], time()+43200,'/');
              setcookie("uniqid", $uniqid, time()+43200,'/');
              $db->update('member',['uniqid'=>$uniqid],['id'=>$login['id']]);
		        	$flag = 200;
		        	$msg = '登录成功，登录手机号：'.$mobile;
		        }else{
		        	$flag = 400;
		        	$msg = '登录失败，手机号或密码不正确,或您已被限制登录。您的手机号：'.$mobile;
		        }
  		    }else{
  		    	$flag = 400;
  		        $msg = '手机号未录入，请先联系人事部。您的手机号：'.$mobile;
  		    }
	    }else{
	    	$flag = 400;
	        $msg = '登录失败，手机号或密码不能为空。';
	    }
   		
   		$json = array('flag' => $flag,'msg' => $msg, 'data' => $data);
      	return $response->withJson($json);
    }

    public function logout($request, $response, $args){
    	global $flag,$msg,$data,$db;
    	setcookie("mobile", '', time()-43200,'/');
    	setcookie("staffID", '', time()-43200,'/');
    	return $response->withRedirect($this->app->router->pathFor('Loginpage'));	
    }

    public function getprov($request, $response, $args){
    	global $flag,$msg,$data,$db;
    	$data = $db->select('s_province','*');
      $response = $response->withAddedHeader('Access-Control-Allow-Origin', '*');
    	return $response->withJson($data);
    }

    public function getcity($request, $response, $args){
    	global $flag,$msg,$data,$db;
    	$code = $args['pcode'];
    	$data = $db->select('s_city','*',['provincecode'=>$code]);
      $response = $response->withAddedHeader('Access-Control-Allow-Origin', '*');
    	return $response->withJson($data);
    }

    public function getarea($request, $response, $args){
    	global $flag,$msg,$data,$db;
    	$code = $args['pcode'];
    	$data = $db->select('s_area','*',['citycode'=>$code]);
      $response = $response->withAddedHeader('Access-Control-Allow-Origin', '*');
    	return $response->withJson($data);
    }

    public function noauthority($request, $response, $args){
    	$code = '<div style="text-align:center;padding-top:23%;">对不起，您没有相应的权限。请联系人事部进行授权。<a href="javascript:history.go(-1);">返回</a></div>';
    	return $response->write($code);
    }

    public function noId($request, $response, $args){
    	$code = '<div style="text-align:center;padding-top:23%;">对不起，没有找到相关资源。<a href="javascript:history.go(-1);">返回</a></div>';
    	return $response->write($code);
    }


    public function getChatLog($request, $response, $args){
    	global $flag,$msg,$data,$db;
    	
    	$list = $db->select('chat_messages',
        ["[>]member" => ["chat_messages.formUid" => "id"],
        "[>]member(m2)" => ["chat_messages.targetUid" => "id"]],
        [
          'chat_messages.formName(formName)',
          'm2.name(targetName)',
          'chat_messages.formUid(formUid)',
          'chat_messages.msgText(msgText)',
          'chat_messages.Title(Title)',
          'chat_messages.targetUid(targetUid)',
          'chat_messages.sendTime(sendTime)'
        ],[
        	
        	'ORDER'=>['chat_messages.sendTime'=>'DESC'],
        	'LIMIT'=>[0,200]
        ]);

      $json = array('flag' => 200,'msg' => '聊天记录', 'data' => $list,'time'=>date('Y-m-d H:i:s'));
      return $response->withJson($json);
    }
    

}
