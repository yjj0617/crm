<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \interop\Container\ContainerInterface;
use \Slim\Views\PhpRenderer;
use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;

class ContractController 
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
    	$path = $this->app->router->pathFor('contractsIndex');
      $ac = getac($_COOKIE['authoritySubc']);
      $sc = $_COOKIE['subcomid'];
      
      if(isset($args['s']) && $args['s']!=0){
        $s = $args['s'];
      }else{
        $s = [1,2,3,4,5,6,7];
      }//合同状态

      

      if(isset($args['p']) && is_numeric($args['p']) && $args['p']>1){
        $p = $args['p'];
        $srow = ($p*10)-10;
      }else{
        $p = 1;
        $srow = 0;
      }
      

      $list = $db->select('contracts',[
          "[>]companies" => ["uid"=>"id"],
          "[>]customs" => ["uid"=>"id"],
          "[>]contract_type" => ["type"=>"id"],
          "[>]member_subcompany" => ["subc"=>"id"],
          "[>]member" => ["ywuid"=>"id"],
          "[>]member(rm)" => ["runmember"=>"id"],
          "[>]contract_status" => ["status"=>"id"]
          ],[
          'contracts.id(id)',
          'contracts.cno(cno)',
          'contracts.utype(utype)',
          'contracts.uid(uid)',
          'contracts.money_total(money_total)',
          'contracts.money_ok(money_ok)',
          'contracts.order_day(order_day)',
          'contracts.runmember(runmember)',
          'contracts.ywuid(ywuid)',
          'contracts.ywoid(ywoid)',
          'contracts.start_day(start_day)',
          'contracts.end_day(end_day)',
          'contracts.status(status)',
          'contract_status.statusname(statusname)',
          'companies.companyname(coname)',
          'customs.name(cuname)',
          'contract_type.typename(typename)',
          'member_subcompany.subcompanyname(owenSubCompany)',
          'member.name(owenSaler)',
          'rm.name(owenRuner)'
          ],[
        'AND'=>[
        'contracts.subc'=>$ac,
        'contracts.status'=>$s],
        "ORDER" => ["contracts.id"=>"DESC"],
        "LIMIT" => [$srow,10]
        ]);
      
      $count = [];
      $count['all'] = $db->count('contracts',['contracts.subc'=>$ac]);
      $count['list'] = $db->count('contracts',['AND'=>['contracts.subc'=>$ac,'contracts.status'=>$s]]);
      $count['today'] = $db->count('contracts',['AND'=>[
        'creattime[>=]'=>date('Y-m-d 00:00:00'),
        'creattime[<=]'=>date('Y-m-d 23:59:59'),
        'contracts.subc'=>$ac,
        'contracts.status'=>$s
        ]]);
      

      $cslist = $db->select('contract_status','*');

      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'list' => $list,
        'count' => $count,
        'p' => $p,
        's' => $s,
        'cslist' => $cslist,
        'cmodel' => 0
      ];
  		return $this->app->renderer->render($response, './contracts.php', $as);
    }

    public function day60end($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('contractsIndex');
      $ac = getac($_COOKIE['authoritySubc']);
      $sc = $_COOKIE['subcomid'];
      
      if(isset($args['s']) && $args['s']!=0){
        $s = $args['s'];
      }else{
        $s = [1,2,3,4,5,6,7];
      }//合同状态

      

      if(isset($args['p']) && is_numeric($args['p']) && $args['p']>1){
        $p = $args['p'];
        $srow = ($p*10)-10;
      }else{
        $p = 1;
        $srow = 0;
      }
      
      $dayjia60 = date('Y-m-d', strtotime(' +60 day'));

      $list = $db->select('contracts',[
          "[>]companies" => ["uid"=>"id"],
          "[>]customs" => ["uid"=>"id"],
          "[>]contract_type" => ["type"=>"id"],
          "[>]member_subcompany" => ["subc"=>"id"],
          "[>]member" => ["ywuid"=>"id"],
          "[>]member(rm)" => ["runmember"=>"id"],
          "[>]contract_status" => ["status"=>"id"]
          ],[
          'contracts.id(id)',
          'contracts.cno(cno)',
          'contracts.utype(utype)',
          'contracts.uid(uid)',
          'contracts.money_total(money_total)',
          'contracts.money_ok(money_ok)',
          'contracts.order_day(order_day)',
          'contracts.runmember(runmember)',
          'contracts.ywuid(ywuid)',
          'contracts.ywoid(ywoid)',
          'contracts.start_day(start_day)',
          'contracts.end_day(end_day)',
          'contracts.status(status)',
          'contract_status.statusname(statusname)',
          'companies.companyname(coname)',
          'customs.name(cuname)',
          'contract_type.typename(typename)',
          'member_subcompany.subcompanyname(owenSubCompany)',
          'member.name(owenSaler)',
          'rm.name(owenRuner)'
          ],[
        'AND'=>[
          'contracts.subc'=>$ac,
          'contracts.status[!]' => [6,7],
          'contracts.type'=>1,
          'contracts.end_day[<=]'=>$dayjia60,
          'contracts.end_day[!]'=>['0000-00-00',NULL],
        ],
        "ORDER" => ["contracts.id"=>"DESC"],
        "LIMIT" => [$srow,10]
        ]);
      
      $count = [];
      $count['all'] = $db->count('contracts',['contracts.subc'=>$ac]);
      $count['list'] = $db->count('contracts',['AND'=>[
        'contracts.subc'=>$ac,
        'contracts.status[!]' => [6,7],
        'contracts.type'=>1,
        'contracts.end_day[<=]'=>$dayjia60,
        'contracts.end_day[!]'=>['0000-00-00',NULL],
        ]]);
      $count['today'] = $db->count('contracts',['AND'=>[
        'creattime[>=]'=>date('Y-m-d 00:00:00'),
        'creattime[<=]'=>date('Y-m-d 23:59:59'),
        'contracts.subc'=>$ac,
        'contracts.status'=>$s
        ]]);
      

      $cslist = $db->select('contract_status','*');

      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'list' => $list,
        'count' => $count,
        'p' => $p,
        's' => $s,
        'cslist' => $cslist,
        'cmodel' => 1
      ];
      return $this->app->renderer->render($response, './contracts.php', $as);
    }

    public function notpayall($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('contractsIndex');
      $ac = getac($_COOKIE['authoritySubc']);
      $sc = $_COOKIE['subcomid'];
      
      if(isset($args['s']) && $args['s']!=0){
        $s = $args['s'];
      }else{
        $s = [1,2,3,4,5,6,7];
      }//合同状态

      if(isset($args['p']) && is_numeric($args['p']) && $args['p']>1){
        $p = $args['p'];
        $srow = ($p*10)-10;
      }else{
        $p = 1;
        $srow = 0;
      }

      $list = $db->query('SELECT 
      o.id AS id,
      o.cno AS cno,
      o.utype AS utype,
      o.uid AS uid,
      o.type AS type,
      o.start_day AS start_day,
      o.end_day AS end_day,
      o.content AS content,
      o.money_total AS money_total,
      o.money_ok AS money_ok,
      o.order_day AS order_day,
      o.zq AS zq,
      o.paytype AS paytype,
      o.status AS status,
      zscrm_contract_type.typename AS typename,
      zscrm_contract_status.statusname AS statusname,
      zscrm_companies.decname AS decname,
      zscrm_companies.companyname AS coname,
      zscrm_customs.name AS cuname,
      zscrm_member.name AS owenSaler,
      b.name AS owenRuner,
      zscrm_member_subcompany.subcompanyname AS owenSubCompany FROM zscrm_contracts AS o
      LEFT JOIN zscrm_companies ON o.uid = zscrm_companies.id  
      LEFT JOIN zscrm_customs ON o.uid = zscrm_customs.id
      LEFT JOIN zscrm_contract_type ON o.type = zscrm_contract_type.id
      LEFT JOIN zscrm_contract_status ON o.status = zscrm_contract_status.id
      LEFT JOIN zscrm_member ON o.ywuid = zscrm_member.id
      LEFT JOIN zscrm_member_subcompany ON o.ywoid = zscrm_member_subcompany.id
      LEFT JOIN zscrm_member as b ON o.runmember = b.id
      WHERE o.money_ok < o.money_total AND o.status != 6 ORDER BY o.id DESC ,o.end_day
      LIMIT '.$srow.',10')->fetchAll();
      
      
      $count = [];
      $count['all'] = $db->count('contracts',['contracts.subc'=>$ac]);
      $count['list'] = count($db->query('SELECT `id` FROM `ZSCRM_contracts` WHERE `money_ok` < `money_total` AND `ZSCRM_contracts`.`status` != 6')->fetchAll());
      $count['today'] = $db->count('contracts',['AND'=>[
        'creattime[>=]'=>date('Y-m-d 00:00:00'),
        'creattime[<=]'=>date('Y-m-d 23:59:59'),
        'contracts.subc'=>$ac,
        'contracts.status'=>$s
        ]]);
      

      $cslist = $db->select('contract_status','*');

      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'list' => $list,
        'count' => $count,
        'p' => $p,
        's' => $s,
        'cslist' => $cslist,
        'cmodel' => 2
      ];
      return $this->app->renderer->render($response, './contracts.php', $as);
    }

    public function notpai($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('contractsIndex');
      $ac = getac($_COOKIE['authoritySubc']);
      $sc = $_COOKIE['subcomid'];
      
      if(isset($args['s']) && $args['s']!=0){
        $s = $args['s'];
      }else{
        $s = [1,2,3,4,5,6,7];
      }//合同状态

      

      if(isset($args['p']) && is_numeric($args['p']) && $args['p']>1){
        $p = $args['p'];
        $srow = ($p*10)-10;
      }else{
        $p = 1;
        $srow = 0;
      }
      

      $list = $db->select('contracts',[
          "[>]companies" => ["uid"=>"id"],
          "[>]customs" => ["uid"=>"id"],
          "[>]contract_type" => ["type"=>"id"],
          "[>]member_subcompany" => ["subc"=>"id"],
          "[>]member" => ["ywuid"=>"id"],
          "[>]member(rm)" => ["runmember"=>"id"],
          "[>]contract_status" => ["status"=>"id"]
          ],[
          'contracts.id(id)',
          'contracts.cno(cno)',
          'contracts.utype(utype)',
          'contracts.uid(uid)',
          'contracts.money_total(money_total)',
          'contracts.money_ok(money_ok)',
          'contracts.order_day(order_day)',
          'contracts.runmember(runmember)',
          'contracts.ywuid(ywuid)',
          'contracts.ywoid(ywoid)',
          'contracts.start_day(start_day)',
          'contracts.end_day(end_day)',
          'contracts.status(status)',
          'contract_status.statusname(statusname)',
          'companies.companyname(coname)',
          'customs.name(cuname)',
          'contract_type.typename(typename)',
          'member_subcompany.subcompanyname(owenSubCompany)',
          'member.name(owenSaler)',
          'rm.name(owenRuner)'
          ],[
        'AND'=>[
        'contracts.subc'=>$ac,
        'contracts.status'=>[2,3]],
        "ORDER" => ["contracts.id"=>"DESC"],
        "LIMIT" => [$srow,10]
        ]);
      
      $count = [];
      $count['all'] = $db->count('contracts',['contracts.subc'=>$ac]);
      $count['list'] = $db->count('contracts',['AND'=>['contracts.subc'=>$ac,'contracts.status'=>[2,3]]]);
      $count['today'] = $db->count('contracts',['AND'=>[
        'creattime[>=]'=>date('Y-m-d 00:00:00'),
        'creattime[<=]'=>date('Y-m-d 23:59:59'),
        'contracts.subc'=>$ac,
        'contracts.status'=>$s
        ]]);
      

      $cslist = $db->select('contract_status','*');

      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'list' => $list,
        'count' => $count,
        'p' => $p,
        's' => $s,
        'cslist' => $cslist,
        'cmodel' => 3
      ];
      return $this->app->renderer->render($response, './contracts.php', $as);
    }

    public function detail($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('contractsIndex');

      if(isset($args['id'])){
        $id = $args['id'];
        $m = $db->get('contracts',[
          "[>]companies" => ["uid"=>"id"],
          "[>]customs" => ["uid"=>"id"],
          "[>]contract_type" => ["type"=>"id"],
          "[>]member(m1)" => ["ywuid"=>"id"],
          "[>]member(m2)"=>['creatUid'=>'id'],
          "[>]member(m3)" => ["runmember"=>"id"],
          "[>]member_subcompany(ms1)" => ["subc"=>"id"],
          "[>]member_subcompany(ms2)"=>['m2.subcompany'=>'id'],
          "[>]member_subcompany(ms3)"=>['m3.subcompany'=>'id'],
          "[>]contract_status" => ["status"=>"id"]
          ],[
          'contracts.id(id)',
          'contracts.cno(cno)',
          'contracts.utype(utype)',
          'contracts.item(item)',
          'contracts.uid(uid)',
          'contracts.money_total(money_total)',
          'contracts.money_ok(money_ok)',
          'contracts.order_day(order_day)',
          'contracts.runmember(runmember)',
          'contracts.ywuid(ywuid)',
          'contracts.ywoid(ywoid)',
          'contracts.start_day(start_day)',
          'contracts.end_day(end_day)',
          'contracts.status(status)',
          'contracts.creattime(creattime)',
          'contracts.more(more)',
          'contracts.pics(pics)',
          'contracts.prov(prov)',
          'contracts.city(city)',
          'contracts.area(area)',
          'contracts.money_before(money_before)',
          'contracts.paytype(paytype)',
          'contracts.content(content)',
          'contracts.cost(cost)',
          'contracts.zq(zq)',
          'contract_status.statusname(statusname)',
          'companies.companyname(coname)',
          'customs.name(cuname)',
          'customs.mobile(cumobile)',
          'contract_type.typename(typename)',
          'm1.name(owenSaler)',
          'm2.name(staffName)',
          'm2.mobile(staffMobile)',
          'm3.name(owenRuner)',
          'ms1.subcompanyname(owenSubCompany)',
          'ms2.subcompanyname(staffCompany)',
          'ms3.subcompanyname(owenRunerCompany)',
          ],['contracts.id'=>$id]);
        if($m['utype']==1){
          $cou = $db->get('companies',[
              "[>]customs(m1)" => ["companies.cus_1"=>"id"],
              "[>]customs(m2)" => ["companies.cus_2"=>"id"],
              "[>]customs(m3)" => ["companies.cus_3"=>"id"],
              "[>]customs(m4)" => ["companies.cus_4"=>"id"],
              "[>]customs(m5)" => ["companies.cus_5"=>"id"],
            ],[
            'm1.name(m1name)',
            'm1.mobile(m1mobile)',
            'm2.name(m2name)',
            'm2.mobile(m2mobile)',
            'm3.name(m3name)',
            'm3.mobile(m3mobile)',
            'm4.name(m4name)',
            'm4.mobile(m4mobile)',
            'm5.name(m5name)',
            'm5.mobile(m5mobile)',
            ],['companies.id'=>$m['uid']]);
          $m['couser'] = $cou['m1name'].$cou['m1mobile'].' '.$cou['m2name'].$cou['m2mobile'].'  '.$cou['m3name'].$cou['m3mobile'].' '.$cou['m4name'].$cou['m4mobile'].' '.$cou['m5name'].$cou['m5mobile'];
        }
        
        //
        $m['paper'] = $db->select('contracts_paper','*',['cid'=>$id]);

      }

      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'm' => $m,
        'mid' => $id,
      ];
      return $this->app->renderer->render($response, './contracts_detail.php', $as);
    }

    public function bookingandcost($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('contractsIndex');

      if(isset($args['id'])){
        $id = $args['id'];
        $m = $db->get('contracts',[
          "[>]companies" => ["uid"=>"id"],
          "[>]customs" => ["uid"=>"id"],
          "[>]contract_type" => ["type"=>"id"],
           "[>]member(m1)" => ["ywuid"=>"id"],
           "[>]member(m2)"=>['creatUid'=>'id'],
           "[>]member(m3)" => ["runmember"=>"id"],
           "[>]member_subcompany(ms1)" => ["subc"=>"id"],
          "[>]member_subcompany(ms2)"=>['m2.subcompany'=>'id'],
          "[>]contract_status" => ["status"=>"id"]
          ],[
          'contracts.id(id)',
          'contracts.cno(cno)',
          'contracts.utype(utype)',
          'contracts.item(item)',
          'contracts.uid(uid)',
          'contracts.money_total(money_total)',
          'contracts.money_ok(money_ok)',
          'contracts.creattime(creattime)',
          'contracts.money_before(money_before)',
          'contracts.paytype(paytype)',
          'contracts.content(content)',
          'contracts.cost(cost)',
          'contracts.zq(zq)',
          'contract_status.statusname(statusname)',
          'companies.companyname(coname)',
          'customs.name(cuname)',
          'customs.mobile(cumobile)',
          'contract_type.typename(typename)',
          'm1.name(owenSaler)',
          'm2.name(staffName)',
          'm2.mobile(staffMobile)',
          'm3.name(owenRuner)',
          'ms1.subcompanyname(owenSubCompany)',
          'ms2.subcompanyname(staffCompany)',
          ],['contracts.id'=>$id]);
        if($m['utype']==1){
          $cou = $db->get('companies',[
              "[>]customs(m1)" => ["companies.cus_1"=>"id"],
              "[>]customs(m2)" => ["companies.cus_2"=>"id"],
              "[>]customs(m3)" => ["companies.cus_3"=>"id"],
              "[>]customs(m4)" => ["companies.cus_4"=>"id"],
              "[>]customs(m5)" => ["companies.cus_5"=>"id"],
            ],[
            'm1.name(m1name)',
            'm1.mobile(m1mobile)',
            'm2.name(m2name)',
            'm2.mobile(m2mobile)',
            'm3.name(m3name)',
            'm3.mobile(m3mobile)',
            'm4.name(m4name)',
            'm4.mobile(m4mobile)',
            'm5.name(m5name)',
            'm5.mobile(m5mobile)',
            ],['companies.id'=>$m['uid']]);
          $m['couser'] = $cou['m1name'].$cou['m1mobile'].' '.$cou['m2name'].$cou['m2mobile'].'  '.$cou['m3name'].$cou['m3mobile'].' '.$cou['m4name'].$cou['m4mobile'].' '.$cou['m5name'].$cou['m5mobile'];
        }
        
        //
        $zzlog = $db->select('contracts_entry',[
          '[>]member(m1)'=>['contracts_entry.memberid'=>'id'],
          '[>]contracts_entry_source'=>['contracts_entry.source'=>'id']
          ],[
          'contracts_entry.id(id)',
          'contracts_entry.contract_id(contract_id)',
          'contracts_entry.money(money)',
          'contracts_entry.entry_day(entry_day)',
          'contracts_entry_source.sourcename(source)',
          'contracts_entry.memberid(memberid)',
          'contracts_entry.zq(zq)',
          'contracts_entry.creattime(creatTime)',
          'contracts_entry.text(text)',
          'm1.name(cname)',
          ],[
          'contracts_entry.contract_id'=>$id,
          'ORDER'=>['contracts_entry.id'=>'DESC']
          ]);

        $costlog = $db->select('contracts_cost',[
          '[>]member(m1)'=>['contracts_cost.uid'=>'id'],
          '[>]member(m2)'=>['contracts_cost.zcuid'=>'mobile']
          ],[
          'contracts_cost.id(id)',
          'contracts_cost.cid(contract_id)',
          'contracts_cost.money(money)',
          'contracts_cost.costdate(costdate)',
          'contracts_cost.uid(uid)',
          'contracts_cost.creattime(creatTime)',
          'contracts_cost.text(text)',
          'm1.name(cname)',
          'm2.name(zcname)'
          ],[
          'contracts_cost.cid'=>$id,
          'ORDER'=>['contracts_cost.id'=>'DESC']
          ]);

      }else{
        return $response->withRedirect($this->app->router->pathFor('errorNoId'));
      }

      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'm' => $m,
        'mid' => $id,
        'zzlog' => $zzlog,
        'costlog' => $costlog
      ];
      return $this->app->renderer->render($response, './contracts_detail_bandc.php', $as);
    }

    public function bookingform($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('contractsIndex');

      if(isset($args['cid'])){
        $cid = $args['cid'];
      }else{
        return $response->withRedirect($this->app->router->pathFor('errorNoId'));
      }
      if(isset($args['id'])){
        $id = $args['id'];
        $m = $db->get('contracts_entry','*',['id'=>$id]);
      }else{
        $id = 0;
        $m = '';
      }
      $source = $db->select('contracts_entry_source','*');
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'id' => $id,
        'cid' => $cid,
        'm' => $m,
        'source' => $source
      ];
      return $this->app->renderer->render($response, './bookingform.php', $as);
    }

    public function savebooking($request, $response, $args){
      global $flag,$msg,$data,$db;

      if(isset($args['cid'])){
        $cid = $args['cid'];
        
        $zq = $_POST['zq'];
        $cdate = $_POST['entry_day'];
        $money = $_POST['money'];//本次入账金额
        $source = $_POST['source'];
        $text = $_POST['text'];


        if(isset($args['id'])){
          $id = $args['id'];

          //上次入账:被修改项目的金额
          $oid = $db->get('contracts_entry','*',['id'=>$id]);
          $oidmoney = $oid['money'];

          $so = $db->get("contracts",['money_total','money_ok','money_before'],['id'=>$cid]);
          $money_total = $so['money_total'];//总金额
          $money_ok = $so['money_ok'];//已到账-上次到账
          $money_before = $so['money_before'];//预付款

          // 当前金额 +（已入账 - 上次入账）<= 总金额
          $ta = $money + ($money_ok - $oidmoney);
          if($ta <= $money_total){

            $ce = $db->update("contracts", [
              "money_ok[+]" => ($money - $oidmoney),
              "zq" => $zq
            ],['id'=>$cid]);
              
            $celog = $db->update("contracts_entry", [
              "money" => $money,
              "entry_day" => $cdate,
              "creattime" => date('Y-m-d H:i:s'),
              "source" => $source,
              "zq" => $zq,
              "text" => $text,
              "memberid" => $_COOKIE['staffID']
            ],['id'=>$id]);
            
            $json = array('flag' => 200,'msg' => '修改入帐项目成功', 'data' => []);
          
          }else{
            $json = array('flag' => 400,'msg' => '当前金额超过允许入帐金额'.($money_total - $money_ok + $oidmoney), 'data' => []);
          }

          
        }else{
          
          //获取当前款项信息
          $old=$db->get("contracts",['money_total','money_ok','money_before'],['id'=>$cid]);
          $money_total = $old['money_total'];//总金额
          $money_ok = $old['money_ok'];//已到账
          $money_before = $old['money_before'];//预付款
          if(($money + $money_ok) >= $money_before){ //本次+已到>= 预付  状态2
            if(($money + $money_ok) < $money_total){
              $status = 2;
            }else{
              $status = 3;
            }
          }else{
            $status = 2;
          }

          if($money+$money_ok<=$money_total){
            $ce = $db->update("contracts", [
              "money_ok[+]" => $money,
              "status" => $status,
              "zq" => $zq
            ],['id'=>$cid]);
            
            $celog = $db->insert("contracts_entry", [
              "contract_id" => $cid,
              "money" => $money,
              "entry_day" => $cdate,
              "creattime" => date('Y-m-d H:i:s'),
              "source" => $source,
              "zq" => $zq,
              "text" => $text,
              'cstatus'=>$status,
              "memberid" => $_COOKIE['staffID']
            ]);

            $json = array('flag' => 200,'msg' => '添加入帐项目成功', 'data' => []);
          }else{
            $json = array('flag' => 400,'msg' => '超过了最大入帐金额：'.($money_total-$money_ok), 'data' => []);
          }
          
        }
      }else{
        $json = array('flag' => 400,'msg' => '参数错误。', 'data' => []);
      }
      return $response->withJson($json);
    }

    public function runform($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('contractsIndex');

      if(isset($args['cid'])){
        $cid = $args['cid'];
        $c = $db->get('contracts','*',['id'=>$cid]);
      }else{
        return $response->withRedirect($this->app->router->pathFor('errorNoId'));
      }
      if(isset($args['id'])){
        $id = $args['id'];
        $m = $db->get('contracts_run','*',['id'=>$id]);
      }else{
        $id = 0;
        $m = '';
      }
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'id' => $id,
        'cid' => $cid,
        'm' => $m,
        'c' => $c
      ];
      return $this->app->renderer->render($response, './runform.php', $as);
    }

    public function saverun($request, $response, $args){
      global $flag,$msg,$data,$db;

      if(isset($args['cid'])){
        $cid = $args['cid'];
        
        $month = isset($_POST['month']) ? $_POST['month'] : NULL;
        $isend = isset($_POST['isend']) ? $_POST['isend'] : 0;
        $text = $_POST['text'];
        $pics = $_POST['pics'];

        if(isset($args['id'])){
          $id = $args['id'];
          //edit
          $db->update('contracts_run',[
              'cid' => $cid,
              'uid' => $_COOKIE['staffID'],
              'month' => $month,
              'isend' => $isend,
              'text' => $text,
              'pics' => $pics
            ],['id'=>$id]);
          if($isend == 1){
            $db->update('contracts',['status'=>7],['id'=>$cid]);
          }
           $json = array('flag' => 200,'msg' => '修改合同执行进度成功', 'data' => []);
        }else{
          //creat new
          $db->insert('contracts_run',[
              'cid' => $cid,
              'uid' => $_COOKIE['staffID'],
              'month' => $month,
              'isend' => $isend,
              'creattime' => date('Y-m-d H:i:s'),
              'text' => $text,
              'pics' => $pics
            ]);
          if($isend == 1){
            $db->update('contracts',['status'=>7],['id'=>$cid]);
          }
          $json = array('flag' => 200,'msg' => '添加合同执行进度成功', 'data' => []);
        }

      }else{
        $json = array('flag' => 400,'msg' => '参数错误。', 'data' => []);
      }
      return $response->withJson($json);
    }

    public function executelog($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('contractsIndex');
        if(isset($args['id'])){
          $id = $args['id'];
          $m = $db->get('contracts',[
            "[>]companies" => ["uid"=>"id"],
            "[>]customs" => ["uid"=>"id"],
            "[>]contract_type" => ["type"=>"id"],
            "[>]member(m1)" => ["ywuid"=>"id"],
            "[>]member(m2)"=>['creatUid'=>'id'],
            "[>]member(m3)" => ["runmember"=>"id"],
            "[>]member_subcompany(ms1)" => ["subc"=>"id"],
            "[>]member_subcompany(ms2)"=>['m2.subcompany'=>'id'],
            "[>]member_subcompany(ms3)"=>['m3.subcompany'=>'id'],
            "[>]contract_status" => ["status"=>"id"]
            ],[
            'contracts.id(id)',
            'contracts.cno(cno)',
            'contracts.utype(utype)',
            'contracts.type(type)',
            'contracts.item(item)',
            'contracts.uid(uid)',
            'contracts.creattime(creattime)',
            'contracts.start_day(start_day)',
            'contracts.end_day(end_day)',
            'contracts.content(content)',
            'contract_status.statusname(statusname)',
            'companies.companyname(coname)',
            'customs.name(cuname)',
            'customs.mobile(cumobile)',
            'contract_type.typename(typename)',
            'm1.name(owenSaler)',
            'm2.name(staffName)',
            'm2.mobile(staffMobile)',
            'm3.name(owenRuner)',
            'ms1.subcompanyname(owenSubCompany)',
            'ms2.subcompanyname(staffCompany)',
            'ms3.subcompanyname(runerCompany)',
            ],['contracts.id'=>$id]);
          if($m['utype']==1){
            $cou = $db->get('companies',[
                "[>]customs(m1)" => ["companies.cus_1"=>"id"],
                "[>]customs(m2)" => ["companies.cus_2"=>"id"],
                "[>]customs(m3)" => ["companies.cus_3"=>"id"],
                "[>]customs(m4)" => ["companies.cus_4"=>"id"],
                "[>]customs(m5)" => ["companies.cus_5"=>"id"],
              ],[
              'm1.name(m1name)',
              'm1.mobile(m1mobile)',
              'm2.name(m2name)',
              'm2.mobile(m2mobile)',
              'm3.name(m3name)',
              'm3.mobile(m3mobile)',
              'm4.name(m4name)',
              'm4.mobile(m4mobile)',
              'm5.name(m5name)',
              'm5.mobile(m5mobile)',
              ],['companies.id'=>$m['uid']]);
            $m['couser'] = $cou['m1name'].$cou['m1mobile'].' '.$cou['m2name'].$cou['m2mobile'].'  '.$cou['m3name'].$cou['m3mobile'].' '.$cou['m4name'].$cou['m4mobile'].' '.$cou['m5name'].$cou['m5mobile'];
          }
          
          //
          $runlog = $db->select('contracts_run',[
            '[>]member(m1)'=>['contracts_run.uid'=>'id'],
            "[>]member_subcompany(ms1)"=>['m1.subcompany'=>'id'],
            ],[
            'contracts_run.id(id)',
            'contracts_run.uid(uid)',
            'contracts_run.month(month)',
            'contracts_run.text(text)',
            'contracts_run.isend(isend)',
            'contracts_run.creattime(creatTime)',
            'contracts_run.type(type)',
            'contracts_run.img1(img1)',
            'contracts_run.img2(img2)',
            'contracts_run.img3(img3)',
            'contracts_run.img4(img4)',
            'contracts_run.img5(img5)',
            'contracts_run.img6(img6)',
            'contracts_run.pics(pics)',
            'm1.name(m1name)',
            'ms1.subcompanyname(m1Company)',
            ],[
            'contracts_run.cid'=>$id,
            'ORDER'=>['contracts_run.id'=>'DESC']
            ]);

          $pailog = $db->select('contracts_pai_log',[
            '[>]member(m1)'=>['contracts_pai_log.memberid'=>'id'],
            '[>]member(m2)'=>['contracts_pai_log.runuid'=>'id'],
            "[>]member_subcompany(ms1)"=>['m1.subcompany'=>'id'],
            "[>]member_subcompany(ms2)"=>['m2.subcompany'=>'id'],
            ],[
            'contracts_pai_log.id(id)',
            'contracts_pai_log.contract_id(contract_id)',
            'contracts_pai_log.runuid(runuid)',
            'contracts_pai_log.type(type)',
            'contracts_pai_log.creattime(creatTime)',
            'contracts_pai_log.text(text)',
            'm1.name(m1name)',
            'm2.name(m2name)',
            'ms1.subcompanyname(m1Company)',
            'ms2.subcompanyname(m2Company)',
            ],[
            'contracts_pai_log.contract_id'=>$id,
            'ORDER'=>['contracts_pai_log.id'=>'DESC']
            ]);

        }else{
          return $response->withRedirect($this->app->router->pathFor('errorNoId'));
        }

        $as = [
          'settings'=>$this->app->get('settings'),
          'path' => $path,
          'm' => $m,
          'mid' => $id,
          'runlog' => $runlog,
          'pailog' => $pailog
        ];
        return $this->app->renderer->render($response, './contracts_detail_executelog.php', $as);
    }
    
    public function close($request, $response, $args){
      global $flag,$msg,$data,$db;
      //$path = $this->app->router->pathFor('customsIndex');
      //$foo = $request->getAttribute('foo');中间件传过来的参数
      if(isset($args['id'])){
        $mid = $args['id'];
        $up = $db->update("contracts", [
          'status'=>6
        ],['id'=>$mid]);
        if($up){
          $flag = 200;
          $msg = '合同关闭成功，客户ID:'.$mid.'。关闭原因：'.$_POST['msg'];
          //wlog('10','关闭客户',$msg,$mid);
        }else{
          $mid = 0;
          $flag = 400;
          $msg = '合同关闭失败，数据有误。';
        }
        
      }
      
      $json = array('flag' => $flag,'msg' => $msg, 'data' => $data,'id' => $mid);
      return $response->withJson($json);
    }

    public function form($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('contractsIndex');
      $sc = $_COOKIE['subcomid'];
      if(isset($args['id'])){
        $mid = $args['id'];
        $m = $db->get('contracts',[
            'contracts.id(id)',
            'contracts.cno(cno)',
            'contracts.utype(utype)',
            'contracts.ywuid(ywuid)',
            'contracts.uid(uid)',
            'contracts.type(type)',
            'contracts.item(item)',
            'contracts.paytype(paytype)',
            'contracts.start_day(start_day)',
            'contracts.end_day(end_day)',
            'contracts.money_total(money_total)',
            'contracts.order_day(order_day)',
            'contracts.content(content)',
            'contracts.more(more)',
            'contracts.city(city)',
            'contracts.prov(prov)',
            'contracts.area(area)',
            'contracts.pics(pics)',
          ],['contracts.id'=>$mid]);
        if($m['utype'] == 1){
          $u = $db->get('companies',['companyname'],['id'=>$m['uid']]);
          $m['uname'] = $u['companyname'];
        }else{
          $u = $db->get('customs',['name','mobile'],['id'=>$m['uid']]);
          $m['uname'] = $u['name'].$u['mobile'];
        }

        if(!$m){
          return $response->withRedirect($this->app->router->pathFor('errorNoId'));
        }else{

          
        }
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
      return $this->app->renderer->render($response, './contracts_form.php', $as);
    }

    public function save($request, $response, $args){
      global $flag,$msg,$data,$db;

      //合同号
      if(isset($_POST['cno']) && $_POST['cno']!=''){
        $cno = $_POST['cno'];
      }else{
        $cno = date('mdHi').rand(0,100);
      }

      //项目
      $item = isset($_POST['item']) ? $_POST['item'] : 0;

      if(isset($args['id']) && $args['id']!=0){
        //修改合同
        $id = $args['id'];
        $up = $db->update("contracts", [
            "cno" => $cno,
            "utype" => $_POST['utype'],
            "uid" => $_POST['uid'],
            "ywuid" => $_POST['ywuid'],
            "ywoid" => $_POST['ywoid'],
            "type" => $_POST['type'],
            "item" => $item,
            "paytype" => $_POST['paytype'],
            "start_day" => $_POST['start_day'],
            "end_day" => $_POST['end_day'],
            "money_total" => $_POST['money_total'],
            "order_day" => $_POST['order_day'],
            "more" => $_POST['more'],
            "prov" => $_POST['prov'],
            "city" => $_POST['city'],
            "area" => $_POST['area'],
            "pics" => $_POST['pics'],
            "content" => $_POST['content'],
            "money_before" => $_POST['money_before']
          ],['id'=>$id]);
        
        $json = array('flag' => 200,'msg' => '合同已修改成功。合同ID：'.$id, 'data' => [], 'id'=>$id);
        return $response->withJson($json);
      }else{
        //创新新合同
        $has = $db->get('contracts',['cno'],['cno'=>$cno]);
        if($has){
          $json = array('flag' => 400,'msg' => '合同号已存在'.$cno, 'data' => []);
          return $response->withJson($json);
        }

        $newId = $db->insert("contracts", [
          "utype" => $_POST['utype'],
          "item" => $item,
          "cno" => $cno,
          "uid" => $_POST['uid'],
          "ywuid" => $_POST['ywuid'],
          "ywoid" => $_POST['ywoid'],
          "type" => $_POST['type'],
          "start_day" => $_POST['start_day'],
          "end_day" => $_POST['end_day'],
          "money_total" => $_POST['money_total'],
          "order_day" => $_POST['order_day'],
          "more" => $_POST['more'],
          "content" => $_POST['content'],
          "money_before" => $_POST['money_before'],
          "creatUid" => $_COOKIE['staffID'],
          "paytype" => $_POST['paytype'],
          "status" => 1,
          "prov" => $_POST['prov'],
          "pics" => $_POST['pics'],
          "city" => $_POST['city'],
          "area" => $_POST['area'],
          "subc"=>$_POST['ywoid'],
          "money_ok"=>0,
          "creattime" => date('Y-m-d H:i:s')
        ]);
          
        if($newId > 0){
          $flag = 200;
          $msg = '录入新合同已成功。合同ID：'.$newId;

          //生成喜报
          $xi = $db->insert("redpaper", [
            "type" => $_POST['type'],
            "day" => $_POST['order_day'],
            "money" => $_POST['money_total'],
            "uid" => $_POST['ywuid']]);

        }else{
          $flag = 400;
          $msg = '录入失败，请重试。注意数据格式。';
        }
        $json = array('flag' => $flag,'msg' => $msg, 'data' => $data, 'id'=>$newId);
        return $response->withJson($json);
      }
    }

    public function searchkey($request, $response, $args){
        global $flag,$msg,$data,$db;
        $key = $_POST['key'];
        $type = $_POST['type'];
        
        if($type == 1){
          $data = $db->select('companies',['id','companyname'],[
              'companyname[~]' => $key
            ]);
        }else{
          $data = $db->select('customs',['id','name','mobile'],[
              'name[~]' => $key
              ]);
        }
        $json = array('flag' => 200,'msg' => '搜索已完成'.$key, 'data' => $data);
        return $response->withJson($json);
    }

    //合同搜索
    public function searchform($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('contractsIndex');
      $scom = $db->select('member_subcompany','*',['ORDER'=>['id'=>'ASC']]);
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'scom' => $scom
      ];
      return $this->app->renderer->render($response, './contracts_search.php', $as);
    }
    //合同搜索结果
    public function searchresult($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('contractsIndex');
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
      
      $list = $db->select('contracts',[
          "[>]companies" => ["uid"=>"id"],
          "[>]customs" => ["uid"=>"id"],
          "[>]contract_type" => ["type"=>"id"],
          "[>]member_subcompany" => ["subc"=>"id"],
          "[>]member" => ["ywuid"=>"id"],
          "[>]member(rm)" => ["runmember"=>"id"],
          "[>]contract_status" => ["status"=>"id"]
          ],[
          'contracts.id(id)',
          'contracts.cno(cno)',
          'contracts.utype(utype)',
          'contracts.uid(uid)',
          'contracts.money_total(money_total)',
          'contracts.money_ok(money_ok)',
          'contracts.order_day(order_day)',
          'contracts.runmember(runmember)',
          'contracts.ywuid(ywuid)',
          'contracts.ywoid(ywoid)',
          'contracts.start_day(start_day)',
          'contracts.end_day(end_day)',
          'contracts.status(status)',
          'contract_status.statusname(statusname)',
          'companies.companyname(coname)',
          'customs.name(cuname)',
          'contract_type.typename(typename)',
          'member_subcompany.subcompanyname(owenSubCompany)',
          'member.name(owenSaler)',
          'rm.name(owenRuner)'
          ],[
            'AND'=>[
              'OR'=>[
                'contracts.id[~]'=>$key,
                'contracts.cno[~]'=>$key,
                'companies.companyname[~]'=>$key,
                'customs.name[~]'=>$key,
              ],
              'contracts.subc'=>$ac,
          ],
          "ORDER" => ["contracts.id"=>"DESC"]
        ]);

      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'list' => $list,
        'p' => $p,
        'key' => $key
      ];
      return $this->app->renderer->render($response, './contracts_search_result.php', $as);
    }

    //报表
    public function report($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('contractsIndex');
      if($args['year'] == ''){
        $year = date('Y');
      }else{
         $year = $args['year'];
      }

      $month = date('m');
      $ac = getac($_COOKIE['authoritySubc']);
      $sc = $_COOKIE['subcomid'];
      $count=[];
      $count['all'] = $db->count('contracts',['AND'=>['subc'=>$ac]]);
      
      $count['thismonth'] =$db->count('contracts',['AND'=>[
        'subc'=>$ac,
        'creattime[>=]'=>date('y-m-1 0:0:0'),
        'creattime[<=]'=>date('y-m-31 23:59:59')]]);
      $count['today'] = $db->count('contracts',['AND'=>[
        'subc'=>$ac,
        'creattime[>=]'=>date('y-m-d 0:0:0'),
        'creattime[<=]'=>date('y-m-d 23:59:59')]]);

      for($i=0;$i<12;$i++){
        $count['lineall'][$i] = $db->count('contracts',['AND'=>[
        'subc'=>$ac,
        'creattime[>=]'=>date($year.'-'.($i+1).'-1 0:0:0'),
        'creattime[<=]'=>date($year.'-'.($i+1).'-31 23:59:59')]]);
      }
      


      $as = [
        'settings'=>$this->app->get('settings'),
        'year' => $year,
        'count' => $count,
        'path' => $path
      ];
      return $this->app->renderer->render($response, './contracts_report.php', $as);
    }
}
