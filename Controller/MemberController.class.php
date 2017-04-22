<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \interop\Container\ContainerInterface;
use \Slim\Views\PhpRenderer;
use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;

class MemberController 
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
      $path = $this->app->router->pathFor('customsIndex');
      $ac = getac($_COOKIE['authoritySubc']);
      $sc = $_COOKIE['subcomid'];
      if(isset($args['from'])){
        $from = $args['from'];
      }else{
        $from = 0;
      }

      if(isset($args['p']) && is_numeric($args['p']) && $args['p']>1){
        $p = $args['p'];
        $srow = ($p*10)-10;
      }else{
        $p = 1;
        $srow = 0;
      }
      
      
      $list = $db->select('customs',[
          "[>]member_subcompany" => ["subc"=>"id"],
          '[>]member'=>['ywuid'=>'id']
          ],[
          'customs.id(id)',
          'customs.name(name)',
          'customs.mobile(mobile)',
          'customs.mobile2(mobile2)',
          'customs.prov(prov)',
          'customs.city(city)',
          'customs.area(area)',
          'customs.creattime(creattime)',
          'customs.status(status)',
          'member_subcompany.subcompanyname(owenSubCompany)',
          'member.name(owenSaler)',
          ],[
        'AND'=>['customs.from' => $from,
        'customs.subc'=>$ac],
        "ORDER" => ["customs.status"=>"ASC","customs.id"=>"DESC"],
        "LIMIT" => [$srow,10]
        ]);


      $count=[];
      $count['all'] = $db->count('customs',['AND'=>['status'=>0,'subc'=>$ac]]);
      $count['offline'] = $db->count('customs',['AND'=>['status'=>0,'from'=>0,'subc'=>$ac]]);
      $count['wechat'] = $db->count('customs',['AND'=>['status'=>0,'from'=>1,'subc'=>$ac]]);
      $count['website'] = $db->count('customs',['AND'=>['status'=>0,'from'=>2,'subc'=>$ac]]);
      $count['thismonth'] =$db->count('customs',['AND'=>[
        'status'=>0,
        'subc'=>$ac,
        'creattime[>=]'=>date('y-m-1 0:0:0'),
        'creattime[<=]'=>date('y-m-31 23:59:59')]]);
      $count['today'] = $db->count('customs',['AND'=>[
        'status'=>0,
        'subc'=>$ac,
        'creattime[>=]'=>date('y-m-d 0:0:0'),
        'creattime[<=]'=>date('y-m-d 23:59:59')]]);
      $subcompany = $db->select('member_subcompany','*');
      $as = [
  			'settings'=>$this->app->get('settings'),
  			'path' => $path,
        'list' => $list,
        'count' => $count,
        'p' => $p,
        'from' => $from
		  ];
		  return $this->app->renderer->render($response, './customs.php', $as);
    }

    public function searchform($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('customsIndex');
      $scom = $db->select('member_subcompany','*',['ORDER'=>['id'=>'ASC']]);
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'scom' => $scom
      ];
      return $this->app->renderer->render($response, './customs_search.php', $as);
    }

    public function searchresult($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('customsIndex');
      $key = $_POST['key'];
      $sc = $_COOKIE['subcomid'];
      $ac = getac($_COOKIE['authoritySubc']);

      if(isset($args['p']) && is_numeric($args['p']) && $args['p']>1){
        $p = $args['p'];
        $srow = ($p*10)-10;
      }else{
        $p = 1;
        $srow = 0;
      }
      
      $list = $db->select('customs',[
          "[>]member_subcompany" => ["subc"=>"id"],
          '[>]member'=>['ywuid'=>'id']
          ],[
          'customs.id(id)',
          'customs.name(name)',
          'customs.mobile(mobile)',
          'customs.mobile2(mobile2)',
          'customs.prov(prov)',
          'customs.city(city)',
          'customs.area(area)',
          'customs.creattime(creattime)',
          'customs.status(status)',
          'member_subcompany.subcompanyname(owenSubCompany)',
          'member.name(owenSaler)',
          ],[
        'AND'=>[
          'OR'=>[
            'customs.mobile[~]' => $key,
            'customs.mobile2[~]' => $key,
            'customs.name[~]' => $key
          ],
        'customs.subc'=>$ac],
        "ORDER" => ["customs.status"=>"ASC","customs.id"=>"DESC"]
        ]);

      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'list' => $list,
        'p' => $p,
        'key' => $key
      ];
      return $this->app->renderer->render($response, './customs_search_result.php', $as);
    }

    public function searchresultJSON($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('customsIndex');
      $key = $_POST['key'];
      $sc = $_COOKIE['subcomid'];
      $ac = getac($_COOKIE['authoritySubc']);

      if(isset($args['p']) && is_numeric($args['p']) && $args['p']>1){
        $p = $args['p'];
        $srow = ($p*10)-10;
      }else{
        $p = 1;
        $srow = 0;
      }
      
      $list = $db->select('customs',[
          "[>]member_subcompany" => ["subc"=>"id"],
          '[>]member'=>['ywuid'=>'id']
          ],[
          'customs.id(id)',
          'customs.name(name)',
          'customs.mobile(mobile)',
          'customs.mobile2(mobile2)',
          'customs.prov(prov)',
          'customs.city(city)',
          'customs.area(area)',
          'customs.creattime(creattime)',
          'customs.status(status)',
          'member_subcompany.subcompanyname(owenSubCompany)',
          'member.name(owenSaler)',
          ],[
        'AND'=>[
          'OR'=>[
            'customs.mobile[~]' => $key,
            'customs.mobile2[~]' => $key,
            'customs.name[~]' => $key
          ],
        'customs.subc'=>$ac],
        "ORDER" => ["customs.status"=>"ASC","customs.id"=>"DESC"]
        ]);

      $json = array('flag' => 200,'msg' => '查询成功', 'data' => $list);
      return $response->withJson($json);
    }
    public function report($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('customsIndex');
      if($args['year'] == ''){
        $year = date('Y');
      }else{
         $year = $args['year'];
      }

      $month = date('m');

      $ac = getac($_COOKIE['authoritySubc']);
      $sc = $_COOKIE['subcomid'];
      $count=[];
      $count['all'] = $db->count('customs',['AND'=>['status'=>0,'subc'=>$ac]]);
      $count['offline'] = $db->count('customs',['AND'=>['status'=>0,'from'=>0,'subc'=>$ac]]);
      $count['wechat'] = $db->count('customs',['AND'=>['status'=>0,'from'=>1,'subc'=>$ac]]);
      $count['website'] = $db->count('customs',['AND'=>['status'=>0,'from'=>2,'subc'=>$ac]]);
      $count['thismonth'] =$db->count('customs',['AND'=>[
        'status'=>0,
        'subc'=>$ac,
        'creattime[>=]'=>date('y-m-1 0:0:0'),
        'creattime[<=]'=>date('y-m-31 23:59:59')]]);
      $count['today'] = $db->count('customs',['AND'=>[
        'status'=>0,
        'subc'=>$ac,
        'creattime[>=]'=>date('y-m-d 0:0:0'),
        'creattime[<=]'=>date('y-m-d 23:59:59')]]);

      for($i=0;$i<12;$i++){
        $count['lineall'][$i] = $db->count('customs',['AND'=>[
        'status'=>0,
        'subc'=>$ac,
        'creattime[>=]'=>date($year.'-'.($i+1).'-1 0:0:0'),
        'creattime[<=]'=>date($year.'-'.($i+1).'-31 23:59:59')]]);
      }
      for($i=0;$i<12;$i++){
        $count['lineaoffline'][$i] = $db->count('customs',['AND'=>[
        'status'=>0,
        'subc'=>$ac,
        'from'=>0,
        'creattime[>=]'=>date($year.'-'.($i+1).'-1 0:0:0'),
        'creattime[<=]'=>date($year.'-'.($i+1).'-31 23:59:59')]]);
      }
      for($i=0;$i<12;$i++){
        $count['linewechat'][$i] = $db->count('customs',['AND'=>[
        'status'=>0,
        'subc'=>$ac,
        'from'=>1,
        'creattime[>=]'=>date($year.'-'.($i+1).'-1 0:0:0'),
        'creattime[<=]'=>date($year.'-'.($i+1).'-31 23:59:59')]]);
      }
      for($i=0;$i<12;$i++){
        $count['linewebsite'][$i] = $db->count('customs',['AND'=>[
        'status'=>0,
        'subc'=>$ac,
        'from'=>2,
        'creattime[>=]'=>date($year.'-'.($i+1).'-1 0:0:0'),
        'creattime[<=]'=>date($year.'-'.($i+1).'-31 23:59:59')]]);
      }


      $as = [
        'settings'=>$this->app->get('settings'),
        'year' => $year,
        'count' => $count,
        'path' => $path
      ];
      return $this->app->renderer->render($response, './customs_report.php', $as);
    }

    public function detail($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('customsIndex');

      if(isset($args['id'])){
        $id = $args['id'];
        $m = $db->get('customs',[
          '[>]member(m1)'=>['ywuid'=>'id'],
          '[>]member(m2)'=>['creatUid'=>'id'],
          '[>]member_subcompany(ms1)'=>['m1.subcompany'=>'id'],
          '[>]member_subcompany(ms2)'=>['m2.subcompany'=>'id'],
          ],[
          'customs.id(id)',
          'customs.name(name)',
          'customs.mobile(mobile)',
          'customs.mobile2(mobile2)',
          'customs.prov(prov)',
          'customs.city(city)',
          'customs.area(area)',
          'customs.sexy(sexy)',
          'customs.sfz(sfz)',
          'customs.from(from)',
          'customs.img_1(img_1)',
          'customs.img_2(img_2)',
          'customs.img_3(img_3)',
          'customs.img_4(img_4)',
          'customs.more(more)',
          'customs.pics(pics)',
          'customs.address(address)',
          'customs.birthday(birthday)',
          'customs.openID(openID)',
          'customs.wxloingtime(wxloingtime)',
          'customs.creattime(creattime)',
          'customs.status(status)',
          'ms1.subcompanyname(owenSubCompany)',
          'm1.name(owenSaler)',
          'm2.name(staffName)',
          'm2.mobile(staffMobile)',
          'ms2.subcompanyname(staffCompany)'
          ],['customs.id'=>$id]);
        if(!$m){
          return $response->withRedirect($this->app->router->pathFor('errorNoId'));
        }
        

      }

      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'm' => $m,
        'mid' => $id,
      ];
      return $this->app->renderer->render($response, './customs_detail.php', $as);
    }

    public function detailCandc($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('customsIndex');

      if(isset($args['id'])){
        $id = $args['id'];
      }
      $m = $db->get('customs',[
          '[>]member(m1)'=>['ywuid'=>'id'],
          '[>]member(m2)'=>['creatUid'=>'id'],
          '[>]member_subcompany(ms1)'=>['m1.subcompany'=>'id'],
          '[>]member_subcompany(ms2)'=>['m2.subcompany'=>'id'],
          ],[
          'customs.id(id)',
          'customs.name(name)',
          'customs.from(from)',
          'customs.creattime(creattime)',
          'customs.status(status)',
          'ms1.subcompanyname(owenSubCompany)',
          'm1.name(owenSaler)',
          'm2.name(staffName)',
          'm2.mobile(staffMobile)',
          'ms2.subcompanyname(staffCompany)'
          ],['customs.id'=>$id]);
      if(!$m){
          return $response->withRedirect($this->app->router->pathFor('errorNoId'));
      }
     

      $m['hasCompany'] = $db->select('companies',[
        "[>]member_subcompany" => ["subc"=>"id"],
        "[>]member" => ["ywuid"=>"id"]
        ],[
        'companies.id(id)',
        'companies.companyname(companyname)',
        'companies.decname(decname)',
        'companies.cno(cno)',
        'companies.prov(prov)',
        'companies.city(city)',
        'companies.area(area)',
        'companies.bgprov(bgprov)',
        'companies.bgcity(bgcity)',
        'companies.bgarea(bgarea)',
        'companies.status(status)',
        'member_subcompany.subcompanyname(subcompanyname)',
        'member.name(ywname)',
        ],[
        'OR'=>[
        'companies.cus_1'=>$id,
        'companies.cus_2'=>$id,
        'companies.cus_3'=>$id,
        'companies.cus_4'=>$id,
        'companies.cus_5'=>$id]
        ]);

      $c1 = $db->select('contracts',[
            "[>]companies" => ["uid"=>"id"],
            "[>]customs" => ["uid"=>"id"],
            "[>]contract_type" => ["type"=>"id"],
            "[>]contract_status" => ["status"=>"id"],
            "[>]member" => ["ywuid"=>"id"],
            "[>]member(runname)"  => ["runmember"=>"id"],
            "[>]member_subcompany" => ["ywoid"=>"id"]
            ],[
            'contracts.id(id)',
            'contracts.cno(cno)',
            'contracts.utype(utype)',
            'contracts.uid(uid)',
            'contracts.type(type)',
            'contracts.start_day(start_day)',
            'contracts.end_day(end_day)',
            'contracts.content(content)',
            'contracts.paytype(paytype)',
            'contracts.money_total(money_total)',
            'contracts.money_ok(money_ok)',
            'contracts.order_day(order_day)',
            'contracts.zq(zq)',
            'contracts.status(status)',
            'customs.name(cname)',
            'contract_type.typename(typename)',
            'contract_status.statusname(statusname)',
            'companies.decname(decname)',
            'companies.companyname(companyname)',
            'member.name(yname)',
            'runname.name(runname)',
            'member_subcompany.subcompanyname(yscname)'
          ],['AND'=>['contracts.utype'=>2,'contracts.uid'=>$id],'ORDER'=>['contracts.status'=>'ASC']]);

      $ca = [];
      foreach ($m['hasCompany'] as $a) {
        array_push($ca,$a['id']);
      }

      $c2 = $db->select('contracts',[
              "[>]companies" => ["uid"=>"id"],
              "[>]customs" => ["uid"=>"id"],
              "[>]contract_type" => ["type"=>"id"],
              "[>]contract_status" => ["status"=>"id"],
              "[>]member" => ["ywuid"=>"id"],
              "[>]member(runname)"  => ["runmember"=>"id"],
              "[>]member_subcompany" => ["ywoid"=>"id"]
              ],[
              'contracts.id(id)',
              'contracts.cno(cno)',
              'contracts.utype(utype)',
              'contracts.uid(uid)',
              'contracts.type(type)',
              'contracts.start_day(start_day)',
              'contracts.end_day(end_day)',
              'contracts.content(content)',
              'contracts.paytype(paytype)',
              'contracts.money_total(money_total)',
              'contracts.money_ok(money_ok)',
              'contracts.order_day(order_day)',
              'contracts.zq(zq)',
              'contracts.status(status)',
              'contract_type.typename(typename)',
              'contract_status.statusname(statusname)',
              'companies.decname(decname)',
              'companies.companyname(companyname)',
              'member.name(yname)',
              'runname.name(runname)',
              'member_subcompany.subcompanyname(yscname)'
            ],['AND'=>['contracts.utype'=>1,'contracts.uid'=>$ca],'ORDER'=>['contracts.status'=>'ASC']]);
      
      $hc = [];
      foreach ($c1 as $key => $value) {
        $hc[$key] = $value;
      }
      foreach ($c2 as $key => $value) {
        $hc[$key+count($c1)] = $value;
      }
      $m['hasContracts'] = $hc;
      
      
     
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'm' => $m,
        'mid' => $id
      ];
      return $this->app->renderer->render($response, './customs_detail_candc.php', $as);
    }

    public function detailMsg($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('customsIndex');

      if(isset($args['id'])){
        $id = $args['id'];
      }

      $m = $db->get('customs',[
          '[>]member(m1)'=>['ywuid'=>'id'],
          '[>]member(m2)'=>['creatUid'=>'id'],
          '[>]member_subcompany(ms1)'=>['m1.subcompany'=>'id'],
          '[>]member_subcompany(ms2)'=>['m2.subcompany'=>'id'],
          ],[
          'customs.id(id)',
          'customs.name(name)',
          'customs.from(from)',
          'customs.creattime(creattime)',
          'customs.status(status)',
          'ms1.subcompanyname(owenSubCompany)',
          'm1.name(owenSaler)',
          'm2.name(staffName)',
          'm2.mobile(staffMobile)',
          'ms2.subcompanyname(staffCompany)'
          ],['customs.id'=>$id]);
      if(!$m){
          return $response->withRedirect($this->app->router->pathFor('errorNoId'));
        }
      

      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'm' => $m,
        'mid' => $id
      ];
      return $this->app->renderer->render($response, './customs_detail_msg.php', $as);

    }

    public function form($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('customsIndex');
      $sc = $_COOKIE['subcomid'];

      if(isset($args['id'])){
        $mid = $args['id'];
        $m = $db->get('customs','*',['id'=>$mid]);
      }else{
        $mid = '';
        $m = '';
      }
      $scom = $db->select('member_subcompany','*',['ORDER'=>['id'=>'ASC']]);
      $satff = $db->select('member','*',[
        'AND'=>[
        'subcompany'=>$sc,
        'isout'=>0,
        'status'=>1
        ],
        'ORDER'=>['id'=>'ASC']
        ]);
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'mid' => $mid,
        'm' => $m,
        'scom' => $scom,
        'satff'=>$satff
      ];
      return $this->app->renderer->render($response, './customs_form.php', $as);
    }

    public function save($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('customsIndex');
      if(isset($args['id'])){
        $mid = $args['id'];
        $up = $db->update("customs", [
          "name" => $_POST['name'],
          "mobile" => $_POST['mobile'],
          "sexy" => $_POST['sexy'],
          "birthday" => $_POST['birthday'],
          "prov" => $_POST['prov'],
          "city" => $_POST['city'],
          "area" => $_POST['area'],
          "sfz" => $_POST['sfz'],
          "ywuid" => $_POST['ywuid'],
          "address" => $_POST['address'],
          "mobile2" => $_POST['mobile2'],
          "pics" => $_POST['pics'],
          "more" => $_POST['more']
        ],['id'=>$mid]);
        if($up){
          $flag = 200;
          $msg = '客户资料编辑成功。客户ID:'.$mid;
          wlog('12','编辑客户',$msg,$mid);
        }else{
          $mid = 0;
          $flag = 400;
          $msg = '客户资料编辑失败，数据有误。';
        }
        
      }else{
        $mid = $db->insert("customs", [
          "name" => $_POST['name'],
          "mobile" => $_POST['mobile'],
          "sexy" => $_POST['sexy'],
          "birthday" => $_POST['birthday'],
          "prov" => $_POST['prov'],
          "city" => $_POST['city'],
          "area" => $_POST['area'],
          "sfz" => $_POST['sfz'],
          "ywuid" => $_POST['ywuid'],
          "address" => $_POST['address'],
          "mobile2" => $_POST['mobile2'],
          "pics" => $_POST['pics'],
          "more" => $_POST['more'],
          "subc" => $_COOKIE['subcomid'],
          "status" => 0,
          "creattime" => date('Y-m-d H:i:s'),
          'from'=>0
        ]);
        if($mid>0){
          $flag = 200;
          $msg = '添加新客户已成功。客户ID:'.$mid;
          wlog('9','创建客户',$msg,$mid);
        }else{
          $mid = 0;
          $flag = 400;
          $msg = '客户资料创建失败，数据有误。';
        }
      }
      
      $json = array('flag' => $flag,'msg' => $msg, 'data' => $data,'id' => $mid);
      return $response->withJson($json);
    }

    public function close($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('customsIndex');
      //$foo = $request->getAttribute('foo');中间件传过来的参数
      if(isset($args['id'])){
        $mid = $args['id'];
        $up = $db->update("customs", [
          'status'=>1
        ],['id'=>$mid]);
        if($up){
          $flag = 200;
          $msg = '客户资料关闭成功，客户ID:'.$mid.'。关闭原因：'.$_POST['msg'];
          wlog('10','关闭客户',$msg,$mid);
        }else{
          $mid = 0;
          $flag = 400;
          $msg = '客户资料关闭失败，数据有误。';
        }
        
      }
      
      $json = array('flag' => $flag,'msg' => $msg, 'data' => $data,'id' => $mid);
      return $response->withJson($json);
    }

    public function vmobile($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('customsIndex');
      if(isset($_POST['param'])){
        $mobile = $_POST['param'];
      }
      
      $v = $db->select('customs',['mobile','mobile2'],['OR'=>['mobile'=>$mobile,'mobile2'=>$mobile]]);
      if(count($v)>0){
        $data = array('status' => 'n', 'info' => '手机号已存在');
        return $response->withJson($data);
      }else{
        $data = array('status' => 'y');
        return $response->withJson($data);
      }
    }
      

}
