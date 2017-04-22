<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \interop\Container\ContainerInterface;
use \Slim\Views\PhpRenderer;
use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;

class OpportunityController 
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
  		$path = $this->app->router->pathFor('opporIndex');
      $ac = getac($_COOKIE['authoritySubc']);
      $sc = $_COOKIE['subcomid'];
      if(!isset($args['status'])){
        $status = 1;
      }else{
        $status = $args['status'] ?: 1;
      }
      

      if(isset($args['p']) && is_numeric($args['p']) && $args['p']>1){
        $p = $args['p'];
        $srow = ($p * 7) - 7;
      }else{
        $p = 1;
        $srow = 0;
      }
      $list = $db->select('boppo',[
          '[>]boppo_status'=>['boppo.status'=>'id'],
          '[>]member'=>['boppo.handleUid'=>'id'],
          '[>]contract_type'=>['boppo.cateId'=>'id'],
          '[>]contract_type(ct2)'=>['boppo.item'=>'id'],
          '[>]member_subcompany'=>['member.subcompany'=>'id']
          ],[
          'boppo.id(id)',
          'boppo.uname(uname)',
          'boppo.mobile(mobile)',
          'boppo.item(itemId)',
          'boppo.prov(prov)',
          'boppo.city(city)',
          'boppo.area(area)',
          'boppo.creattime(creattime)',
          'boppo.status(status)',
          'boppo.text(text)',
          'boppo.form(form)',
          'boppo.qd(qd)',
          'boppo.contractId(contractId)',
          'boppo_status.statusName(statusName)',
          'contract_type.typename(catename)',
          'ct2.typename(item)',
          'member_subcompany.subcompanyname(owenSubCompany)',
          'member.name(owenSaler)',
          ],[
            'boppo.status' => $status,
            "ORDER" => ["boppo.id"=>"DESC"],
            "LIMIT" => [$srow,7]
          ]);

      $counts =  $db->count('boppo',['boppo.status' => $status]);

  		$count=[];
      $count['all'] = $db->count('boppo');
      $count['thismonth'] =$db->count('boppo',['AND'=>[
        'creattime[>=]'=>date('y-m-1 0:0:0'),
        'creattime[<=]'=>date('y-m-31 23:59:59')]]);
      $count['today'] = $db->count('boppo',['AND'=>[
       
        'creattime[>=]'=>date('y-m-d 0:0:0'),
        'creattime[<=]'=>date('y-m-d 23:59:59')]]);
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'list' => $list,
        'count' => $count,
        'counts' => $counts,
        'p' => $p,
        'status' => $status
      ];
  		return $this->app->renderer->render($response, './opportunity.php', $as);
    }

    public function mine($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('opporIndex');
      $ac = getac($_COOKIE['authoritySubc']);
      $sc = $_COOKIE['subcomid'];

      $status = $args['status'] ?: 2;

      if(isset($args['p']) && is_numeric($args['p']) && $args['p']>1){
        $p = $args['p'];
        $srow = ($p * 7) - 7;
      }else{
        $p = 1;
        $srow = 0;
      }
      $list = $db->select('boppo',[
          '[>]boppo_status'=>['boppo.status'=>'id'],
          '[>]member'=>['boppo.handleUid'=>'id'],
          '[>]contract_type'=>['boppo.cateId'=>'id'],
          '[>]contract_type(ct2)'=>['boppo.item'=>'id'],
          '[>]member_subcompany'=>['member.subcompany'=>'id']
          ],[
          'boppo.id(id)',
          'boppo.uname(uname)',
          'boppo.mobile(mobile)',
          'boppo.item(itemId)',
          'boppo.prov(prov)',
          'boppo.city(city)',
          'boppo.area(area)',
          'boppo.creattime(creattime)',
          'boppo.status(status)',
          'boppo.text(text)',
          'boppo.form(form)',
          'boppo.qd(qd)',
          'boppo.contractId(contractId)',
          'boppo_status.statusName(statusName)',
          'contract_type.typename(catename)',
          'ct2.typename(item)',
          'member_subcompany.subcompanyname(owenSubCompany)',
          'member.name(owenSaler)',
          ],['AND'=>[
            'handleUid'=>$_COOKIE['staffID'],
            'boppo.status' => $status],
            "ORDER" => ["boppo.id"=>"DESC"],
            "LIMIT" => [$srow,7]
          ]);

      $counts =  $db->count('boppo',['AND'=>[
        'handleUid'=>$_COOKIE['staffID'],
        'boppo.status' => $status]]
        );

      $count=[];
      $count['all'] = $db->count('boppo',['handleUid'=>$_COOKIE['staffID']]);
      
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'list' => $list,
        'count' => $count,
        'counts' => $counts,
        'p' => $p,
        'status' => $status
      ];
      return $this->app->renderer->render($response, './opportunity_mine.php', $as);
    }

    public function report($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('opporIndex');
      
      if($args['year'] == ''){
        $year = date('Y');
      }else{
         $year = $args['year'];
      }

      $month = date('m');

      $ac = getac($_COOKIE['authoritySubc']);
      $sc = $_COOKIE['subcomid'];
      $count=[];
      $count['all'] = $db->count('boppo');
      $count['wait'] = $db->count('boppo',['status'=>1]);
      $count['cannext'] = $db->count('boppo',['status'=>2]);
      $count['ok'] = $db->count('boppo',['status'=>3]);
      $count['close'] = $db->count('boppo',['status'=>4]);
      $count['thismonth'] =$db->count('boppo',['AND'=>[
        'creattime[>=]'=>date('y-m-1 0:0:0'),
        'creattime[<=]'=>date('y-m-31 23:59:59')]]);
      $count['today'] = $db->count('boppo',['AND'=>[
        'creattime[>=]'=>date('y-m-d 0:0:0'),
        'creattime[<=]'=>date('y-m-d 23:59:59')]]);
      $count['todayok'] = $db->count('boppo',['AND'=>[
        'status'=>3,
        'creattime[>=]'=>date('y-m-d 0:0:0'),
        'creattime[<=]'=>date('y-m-d 23:59:59')]]);


      for($i=0;$i<12;$i++){
        $count['lineall'][$i] = $db->count('boppo',['AND'=>[
        'creattime[>=]'=>date($year.'-'.($i+1).'-1 0:0:0'),
        'creattime[<=]'=>date($year.'-'.($i+1).'-31 23:59:59')]]);
      }
      for($i=0;$i<12;$i++){
        $count['lineok'][$i] = $db->count('boppo',['AND'=>[
        'status'=>3,
        'creattime[>=]'=>date($year.'-'.($i+1).'-1 0:0:0'),
        'creattime[<=]'=>date($year.'-'.($i+1).'-31 23:59:59')]]);
      }
      
      $city = $db->select('s_city','*');
      
      $dq = [];
      $i = 0;
      foreach ($city as $c) {
        $cos = $db->count('boppo',['AND'=>[
          'city'=>$c['name'],
          'creattime[>=]'=>date($year.'-1-1 0:0:0'),
          'creattime[<=]'=>date($year.'-12-31 23:59:59')
          ]]);
        if($cos>0){
          $dq[$i]['city'] = $c['name'];
          $dq[$i]['count'] = $cos;
          $i++;
        }
      }
      $dq = my_sort($dq,'count', SORT_DESC, SORT_NUMERIC);
      $count['dq_all'] = array_slice($dq,0,10);

      $dq_ok = [];
      $j = 0;
      foreach ($city as $c) {
        $cosok = $db->count('boppo',['AND'=>[
          'city'=>$c['name'],
          'status'=>3,
          'creattime[>=]'=>date($year.'-1-1 0:0:0'),
          'creattime[<=]'=>date($year.'-12-31 23:59:59')
          ]]);
        if($cosok>0){
          $dq_ok[$j]['city'] = $c['name'];
          $dq_ok[$j]['count'] = $cosok;
          $j++;
        }
      }
      $dq_ok = my_sort($dq_ok,'count', SORT_DESC, SORT_NUMERIC);
      $count['dq_ok'] = array_slice($dq_ok,0,10);

      $as = [
        'settings'=>$this->app->get('settings'),
        'year' => $year,
        'count' => $count,
        'path' => $path
      ];
      return $this->app->renderer->render($response, './opportunity_report.php', $as);
    }

    public function detail($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('opporIndex');

      if(isset($args['id'])){
        $id = $args['id'];
        $m =  $db->get('boppo',[
          '[>]boppo_status'=>['boppo.status'=>'id'],
          '[>]member'=>['boppo.handleUid'=>'id'],
          '[>]contract_type'=>['boppo.cateId'=>'id'],
          '[>]contract_type(ct2)'=>['boppo.item'=>'id'],
          '[>]member_subcompany'=>['member.subcompany'=>'id']
          ],[
          'boppo.id(id)',
          'boppo.uname(uname)',
          'boppo.mobile(mobile)',
          'boppo.item(itemId)',
          'boppo.prov(prov)',
          'boppo.city(city)',
          'boppo.area(area)',
          'boppo.creattime(creattime)',
          'boppo.status(status)',
          'boppo.text(text)',
          'boppo.form(form)',
          'boppo.qd(qd)',
          'boppo.contractId(contractId)',
          'boppo_status.statusName(statusName)',
          'contract_type.typename(catename)',
          'ct2.typename(item)',
          'member_subcompany.subcompanyname(owenSubCompany)',
          'member.name(owenSaler)',
          ],["boppo.id"=>$id]);

        if(!$m){
          return $response->withRedirect($this->app->router->pathFor('errorNoId'));
        }

        $oplog = $db->select('boppo_go_log',[
          '[>]member'=>['boppo_go_log.uid'=>'id'],
          '[>]member_subcompany'=>['member.subcompany'=>'id']
          ],[
          'boppo_go_log.id(id)',
          'boppo_go_log.text(text)',
          'boppo_go_log.creatTime(creatTime)',
          'member.name(uname)',
          'member.mobile(umobile)',
          'member_subcompany.subcompanyname(ucompany)',
          ],[
            'boppo_go_log.sid' => $id,
            'ORDER' => ['boppo_go_log.id'=>'DESC']
          ]);
        
        

      }

      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'm' => $m,
        'oplog' => $oplog,
        'mid' => $id,
      ];
      return $this->app->renderer->render($response, './opportunity_detail.php', $as);
    }

    public function savedo($request, $response, $args){
      global $flag,$msg,$data,$db;
    
      if(isset($args['id'])){
        $id = $args['id'];
        $text = $request->getParsedBody()['text'];
        $cId = $request->getParsedBody()['contractId'];
        $status = $request->getParsedBody()['status'];
        if(!$id){
          return $response->withRedirect($this->app->router->pathFor('errorNoId'));
        }

        $b = $db->get('boppo',['id','handleUid'],[
          'id'=>$id
          ]);
        if($b['handleUid']!='' && $b['handleUid'] != $_COOKIE['staffID']){
           $json = array('flag' => 500,'msg' => '对不起，您没有权限处理本商机', 'data' =>[],'time'=>date('Y-m-d H:i:s'));
           return $response->withJson($json);
        }

        $db->update('boppo',[
              'status'=>$status,
              'handleUid'=>$_COOKIE['staffID']
            ],[
              'id'=>$id
            ]);

        $db->insert('boppo_go_log',[
              'sid'=>$id,
              'uid'=>$_COOKIE['staffID'],
              'text'=>$text,
              'creatTime'=>date('Y-m-d H:i:s')
            ]);
        

        $json = array('flag' => 200,'msg' => '保存成功', 'data' => [],'time'=>date('Y-m-d H:i:s'));
        return $response->withJson($json);

      }else{
        $json = array('flag' => 500,'msg' => '参数有误', 'data' =>[],'time'=>date('Y-m-d H:i:s'));
        return $response->withJson($json);
      }

    }
    
    public function searchform($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('opporIndex');
      $scom = $db->select('member_subcompany','*',['ORDER'=>['id'=>'ASC']]);
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'scom' => $scom
      ];
      return $this->app->renderer->render($response, './opportunity_search.php', $as);
    }

    public function searchresult($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('opporIndex');
      $key = $request->getParsedBody()['key'];
      $sc = $_COOKIE['subcomid'];
      $ac = getac($_COOKIE['authoritySubc']);

      if(isset($args['p']) && is_numeric($args['p']) && $args['p']>1){
        $p = $args['p'];
        $srow = ($p*10)-10;
      }else{
        $p = 1;
        $srow = 0;
      }

      $list = $db->select('boppo',[
          '[>]boppo_status'=>['boppo.status'=>'id'],
          '[>]member'=>['boppo.handleUid'=>'id'],
          '[>]contract_type'=>['boppo.cateId'=>'id'],
          '[>]contract_type(ct2)'=>['boppo.item'=>'id'],
          '[>]member_subcompany'=>['member.subcompany'=>'id']
          ],[
          'boppo.id(id)',
          'boppo.uname(uname)',
          'boppo.mobile(mobile)',
          'boppo.item(itemId)',
          'boppo.prov(prov)',
          'boppo.city(city)',
          'boppo.area(area)',
          'boppo.creattime(creattime)',
          'boppo.status(status)',
          'boppo.text(text)',
          'boppo.form(form)',
          'boppo.qd(qd)',
          'boppo.contractId(contractId)',
          'boppo_status.statusName(statusName)',
          'contract_type.typename(catename)',
          'ct2.typename(item)',
          'member_subcompany.subcompanyname(owenSubCompany)',
          'member.name(owenSaler)',
          ],['OR'=>[
            'boppo.uname[~]' => $key,
            'boppo.mobile[~]' => $key,
            'boppo.text[~]' => $key,
            'boppo.qd[~]' => $key,
            'boppo.form[~]' => $key
          ],
            "ORDER" => ["boppo.id"=>"DESC"]
          ]);
      
      

      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'list' => $list,
        'p' => $p,
        'key' => $key
      ];
      return $this->app->renderer->render($response, './opportunity_search_result.php', $as);
    }

    public function form($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('opporIndex');
      $sc = $_COOKIE['subcomid'];

      if(isset($args['id'])){
        $mid = $args['id'];
        $m = $db->get('customs','*',['id'=>$mid]);
      }else{
        $mid = '';
        $m = '';
      }
      $ctype = $db->select('contract_type','*',['ORDER'=>['id'=>'ASC']]);
      
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'mid' => $mid,
        'm' => $m,
        'ctype' => $ctype
      ];
      return $this->app->renderer->render($response, './opportunity_form.php', $as);
    }

    public function save($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('opporIndex');
      $u = getstaff($_COOKIE['staffID']);
      $form = $u['name'].$u['mobile'];
      if(isset($args['id'])){
        $mid = $args['id'];
        $up = $db->update("customs", [
          "uname" => $request->getParsedBody()['name'],
          "mobile" => $request->getParsedBody()['mobile'],
          "cateId" => $request->getParsedBody()['cateId'],
          "item" => $request->getParsedBody()['item'],
          "text" => $request->getParsedBody()['text'],
          "prov" => $request->getParsedBody()['prov'],
          "city" => $request->getParsedBody()['city'],
          "area" => $request->getParsedBody()['area'],
          "form" => $form,
          "qd" => $request->getParsedBody()['qd']
        ],['id'=>$mid]);
        if($up){
          $flag = 200;
          $msg = '商机编辑成功。商机ID:'.$mid;
          //wlog('12','编辑客户',$msg,$mid);
        }else{
          $mid = 0;
          $flag = 400;
          $msg = '商机编辑失败，数据有误。';
        }
        
      }else{
        $mid = $db->insert("boppo", [
          "uname" => $request->getParsedBody()['name'],
          "mobile" => $request->getParsedBody()['mobile'],
          "cateId" => $request->getParsedBody()['cateId'],
          "item" => $request->getParsedBody()['item'],
          "text" => $request->getParsedBody()['text'],
          "prov" => $request->getParsedBody()['prov'],
          "city" => $request->getParsedBody()['city'],
          "area" => $request->getParsedBody()['area'],
          "form" => $form,
          "qd" => $request->getParsedBody()['qd'],
          "status" => 1,
          "creattime" => date('Y-m-d H:i:s')
        ]);
        if($mid>0){
          $flag = 200;
          $msg = '添加商机已成功。商机ID:'.$mid;
          //wlog('9','创建客户',$msg,$mid);
        }else{
          $mid = 0;
          $flag = 400;
          $msg = '商机创建失败，数据有误。';
        }
      }
      
      $json = array('flag' => $flag,'msg' => $msg, 'data' => $data,'id' => $mid);
      return $response->withJson($json);
    }

}
