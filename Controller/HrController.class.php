<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \interop\Container\ContainerInterface;
use \Slim\Views\PhpRenderer;
use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;

class HrController 
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
  		$path = $this->app->router->pathFor('hrIndex');
  		$ac = getac($_COOKIE['authoritySubc']);
      $sc = $_COOKIE['subcomid'];
      
      if(isset($args['s'])){
        $s = $args['s'];
      }else{
        $s = 1;
      }//在/离职状态

      if(isset($args['subc'])){
        $subc = $args['subc'];
      }else{
        $subc = $sc;
      }

      if(isset($args['p']) && is_numeric($args['p']) && $args['p']>1){
        $p = $args['p'];
        $srow = ($p*10)-10;
      }else{
        $p = 1;
        $srow = 0;
      }
      

      $list = $db->select('member',[
          "[>]member_subcompany" => ["subcompany"=>"id"],
          "[>]member_department" => ["department"=>"id"],
          "[>]member_position" => ["position"=>"id"]
          ],[
          'member.id(id)',
          'member.staffid(staffid)',
          'member.name(name)',
          'member.mobile(mobile)',
          'member.birthday(birthday)',
          'member.sexy(sexy)',
          'member.entryday(entryday)',
          'member.status(status)',
          'member_subcompany.subcompanyname(owenSubCompany)',
          'member_department.departmentname(owenDepartment)',
          'member_position.positionname(owenPosition)'
          ],[
        'AND'=>[
        'member.status'=>$s,
        'member.subcompany'=>$subc],
        "ORDER" => ["member.status"=>"ASC","member.id"=>"DESC"],
        "LIMIT" => [$srow,10]
        ]);
      
      $count = [];
      $count['all'] = $db->count('member',['status'=>1]);
      $count['subconine'] = $db->count('member',['AND'=>['status'=>1,'subcompany'=>$subc]]);
      $count['subc'] = $db->count('member',['AND'=>[
        'status'=>$s,
        'subcompany'=>$subc]
        ]);

      $subcompany = $db->select('member_subcompany','*');

  		$as = [
  			'settings'=>$this->app->get('settings'),
  			'path' => $path,
        'list' => $list,
  			'count' => $count,
        'p' => $p,
        'subc' => $subc,
        's' => $s,
        'subcompanylist' => $subcompany
  		];
  		return $this->app->renderer->render($response, './hr.php', $as);
    }

    public function detail($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('hrIndex');

      if(isset($args['id'])){
        $id = $args['id'];
        $m = $db->get('member',[
          "[>]member_subcompany" => ["subcompany"=>"id"],
          "[>]member_department" => ["department"=>"id"],
          "[>]mcms_attachment" => ["pics"=>"id"],
          "[>]member_position" => ["position"=>"id"]
          ],[
          'member.id(id)',
          'member.staffid(staffid)',
          'member.name(name)',
          'member.mobile(mobile)',
          'member.birthday(birthday)',
          'member.sexy(sexy)',
          'member.entryday(entryday)',
          'member.status(status)',
          'mcms_attachment.uri(photo)',
          'member.political(political)',
          'member.nation(nation)',
          'member.sfz(sfz)',
          'member.crossprev(crossprev)',
          'member.crossaddress(crossaddress)',
          'member.school(school)',
          'member.specialty(specialty)',
          'member.education(education)',
          'member.familyphone(familyphone)',
          'member.familyaddress(familyaddress)',
          'member.emergencycontact(emergencycontact)',
          'member.emergencyphone(emergencyphone)',
          'member.bank(bank)',
          'member.bankcard(bankcard)',
          'member.certificate(certificate)',
          'member.outtime(outtime)',
          'member.prov(prov)',
          'member.city(city)',
          'member.area(area)',
          'member.authority(authority)',
          'member.authoritySubc(authoritySubc)',
          'member.openID(openID)',
          'member.more(more)',
          'member.remuneration(remuneration)',
          'member_subcompany.subcompanyname(owenSubCompany)',
          'member_department.departmentname(owenDepartment)',
          'member_position.positionname(owenPosition)'
          ],['member.id'=>$id]);
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
      return $this->app->renderer->render($response, './hr_detail.php', $as);
    }

    public function talentpool($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('hrIndex');
      $ac = getac($_COOKIE['authoritySubc']);
      $sc = $_COOKIE['subcomid'];
      
     
      if(isset($args['s']) || $args['s']!=0){
        $s = $args['s'];
        $sa = $args['s'];
      }else{
        $s = [1,2,3,4,5,6,7];
        $sa = 0;
      }

      if(isset($args['p']) && is_numeric($args['p']) && $args['p']>1){
        $p = $args['p'];
        $srow = ($p*10)-10;
      }else{
        $p = 1;
        $srow = 0;
      }
      

      $list = $db->select('member_job',[
        "[>]member_job_status"=>['member_job.status'=>'id'],
        "[>]member"=>['member_job.referralcode'=>'id'],
        "[>]member_subcompany"=>['member.subcompany'=>'id']
        ],[
          'member_job.id(id)',
          'member_job.name(name)',
          'member_job.mobile(mobile)',
          'member_job.birthday(birthday)',
          'member_job.sexy(sexy)',
          'member_job.status(status)',
          'member_job.birthday(birthday)',
          'member_job.positionarea(positionarea)',
          'member_job.selfposition(selfposition)',
          'member_job.expectedsalary(expectedsalary)',
          'member_job.workdate(workdate)',
          'member_job_status.statusname(statusName)',
          'member_job.creattime(creattime)',
          'member.name(refstaffname)',
          'member_subcompany.subcompanyname(refstaffSubc)'
          ],[
          'member_job.status' => $s,
          "ORDER" => ["member_job.id"=>"DESC"],
          "LIMIT" => [$srow,10]
        ]);
      
      $count = [];
      $count['all'] = $db->count('member_job',['member_job.status' => $s]);
      $count['ok'] = $db->count('member_job',['status'=>7]);

      $cslist = $db->select('member_job_status','*');

      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'list' => $list,
        'count' => $count,
        'cslist' => $cslist,
        's' => $sa,
        'p' => $p,
        
      ];
      return $this->app->renderer->render($response, './hr_talentpool.php', $as);
    }

    public function talentpoolappo($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('hrIndex');
      $ac = getac($_COOKIE['authoritySubc']);
      $sc = $_COOKIE['subcomid'];
      
     
      

      if(isset($args['p']) && is_numeric($args['p']) && $args['p']>1){
        $p = $args['p'];
        $srow = ($p*10)-10;
      }else{
        $p = 1;
        $srow = 0;
      }
      

      $list = $db->select('member_job',[
        "[>]member_job_status"=>['member_job.status'=>'id'],
        "[>]member"=>['member_job.referralcode'=>'id'],
        "[>]member_subcompany"=>['member.subcompany'=>'id']
        ],[
          'member_job.id(id)',
          'member_job.name(name)',
          'member_job.mobile(mobile)',
          'member_job.birthday(birthday)',
          'member_job.sexy(sexy)',
          'member_job.status(status)',
          'member_job.birthday(birthday)',
          'member_job.positionarea(positionarea)',
          'member_job.selfposition(selfposition)',
          'member_job.expectedsalary(expectedsalary)',
          'member_job.interviewtime(interviewtime)',
          'member_job_status.statusname(statusName)',
          'member_job.creattime(creattime)',
          'member.name(refstaffname)',
          'member_subcompany.subcompanyname(refstaffSubc)'
          ],[
          'member_job.status' => 2,
          "ORDER" => ["member_job.id"=>"DESC"],
          "LIMIT" => [$srow,10]
        ]);
      
      $count = [];
      $count['all'] = $db->count('member_job',['member_job.status' => 2]);

      $cslist = $db->select('member_job_status','*');

      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'list' => $list,
        'count' => $count,
        'cslist' => $cslist,
        's' => 2,
        'p' => $p,
        
      ];
      return $this->app->renderer->render($response, './hr_talentpool_appo.php', $as);
    }

    public function talentpooldetil($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('hrIndex');

      if(isset($args['id'])){
        $id = $args['id'];
        $m = $db->get('member',[
          "[>]member_subcompany" => ["subcompany"=>"id"],
          "[>]member_department" => ["department"=>"id"],
          "[>]mcms_attachment" => ["pics"=>"id"],
          "[>]member_position" => ["position"=>"id"]
          ],[
          'member.id(id)',
          'member.staffid(staffid)',
          'member.name(name)',
          'member.mobile(mobile)',
          'member.birthday(birthday)',
          'member.sexy(sexy)',
          'member.entryday(entryday)',
          'member.status(status)',
          'mcms_attachment.uri(photo)',
          'member.political(political)',
          'member.nation(nation)',
          'member.sfz(sfz)',
          'member.crossprev(crossprev)',
          'member.crossaddress(crossaddress)',
          'member.school(school)',
          'member.specialty(specialty)',
          'member.education(education)',
          'member.familyphone(familyphone)',
          'member.familyaddress(familyaddress)',
          'member.emergencycontact(emergencycontact)',
          'member.emergencyphone(emergencyphone)',
          'member.bank(bank)',
          'member.bankcard(bankcard)',
          'member.certificate(certificate)',
          'member.outtime(outtime)',
          'member.prov(prov)',
          'member.city(city)',
          'member.area(area)',
          'member.authority(authority)',
          'member.authoritySubc(authoritySubc)',
          'member.openID(openID)',
          'member.more(more)',
          'member.remuneration(remuneration)',
          'member_subcompany.subcompanyname(owenSubCompany)',
          'member_department.departmentname(owenDepartment)',
          'member_position.positionname(owenPosition)'
          ],['member.id'=>$id]);
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
      return $this->app->renderer->render($response, './hr_detail.php', $as);
    }

    public function authority($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('hrIndex');
      $sc = $_COOKIE['subcomid'];
      if(isset($args['id'])){
        $id = $args['id'];
        $m = $db->get('member',[
          "[>]member_subcompany" => ["subcompany"=>"id"],
          "[>]member_department" => ["department"=>"id"],
          "[>]member_position" => ["position"=>"id"]
          ],[
          'member.id(id)',
          'member.staffid(staffid)',
          'member.name(name)',
          'member.authority(authority)',
          'member.authoritySubc(authoritySubc)',
          'member.status(status)',
          'member_subcompany.subcompanyname(owenSubCompany)',
          'member_department.departmentname(owenDepartment)',
          'member_position.positionname(owenPosition)'
          ],['member.id'=>$id]);
        if(!$m){
          return $response->withRedirect($this->app->router->pathFor('errorNoId'));
        }
      }
      if($sc!=1){
        $mc = $db->select('member_subcompany','*',['id'=>$sc]);
      }else{
        $mc = $db->select('member_subcompany','*');
      }

      $ss = $db->select('member_authority','*',['ORDER'=>['orderid'=>'ASC']]);

      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'm' => $m,
        'mid' => $id,
        'mc' => $mc,
        'ss' => $ss
      ];
      return $this->app->renderer->render($response, './hr_detail_authority.php', $as);
    }

    public function saveauthority($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('hrIndex');
      $sc = $_COOKIE['subcomid'];
      if(isset($args['id'])){
        $id = $args['id'];
        if(isset($_POST['authority'])){
          $a = $_POST['authority'];
          $authority = '';
          foreach ($a as $o) {
            $authority .= $o.',';
          }
        }else{
          $authority = '';
        }
        if(isset($_POST['authoritySubc'])){
          $b = $_POST['authoritySubc'];
          $authoritySubc = '';
          foreach ($b as $bs) {
            $authoritySubc .= $bs.',';
          }
        }else{
          $authoritySubc = '';
        }

        $up = $db->update('member',[
          'authority' => $authority,
          'authoritySubc' => $authoritySubc
          ],['id'=>$id]);

        $json = array('flag' => 200,'msg' => '权限保存已成功', 'data' => '');
        return $response->withJson($json);
      }else{
        $json = array('flag' => 400,'msg' => '参数有误', 'data' => '');
        return $response->withJson($json);
      }
      
    }

    public function remuneration($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('hrIndex');
      $sc = $_COOKIE['subcomid'];
      
      if(isset($args['id'])){
        $id = $args['id'];
        $m = $db->get('member',[
          "[>]member_subcompany" => ["subcompany"=>"id"],
          "[>]member_department" => ["department"=>"id"],
          "[>]member_position" => ["position"=>"id"]
          ],[
          'member.id(id)',
          'member.staffid(staffid)',
          'member.name(name)',
          'member.authority(authority)',
          'member.authoritySubc(authoritySubc)',
          'member.status(status)',
          'member.remuneration(remunerationM)',
          'member_subcompany.subcompanyname(owenSubCompany)',
          'member_department.departmentname(owenDepartment)',
          'member_position.positionname(owenPosition)'
          ],['member.id'=>$id]);
        if(!$m){
          return $response->withRedirect($this->app->router->pathFor('errorNoId'));
        }
        //查询当月工资条有否生成
        $month = date('Ym',strtotime('-1 month'));
        $hasgz = $db->get('member_remuneration','*',['AND'=>['staffId'=>$id,'month'=>$month]]);
        if($hasgz){
          $m['remuneration'] = $hasgz;
        }else{
          if($m['remuneration'] == NULL){
            $mre = 0;
          }else{
            $mre = $m['remuneration'];
          }
          $sat = $db->get('member',['subcompany'],['id'=>$id]);
          $db->insert('member_remuneration',[
            'staffId'=>$id,
            'month'=>$month,
            'subc' => $sat['subcompany'],
            'remuneration'=>$mre,
            'status'=>0,
            'creattime'=>date('Y-m-d H:i:s')
          ]);
          $m['remuneration'] = $db->get('member_remuneration','*',['AND'=>['staffId'=>$id,'month'=>$month]]);
        }
        $m['oldremuneration'] = $db->select('member_remuneration','*',[
            'staffId'=>$id
            ]);
      }

      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'm' => $m,
        'mid' => $id
      ];
      return $this->app->renderer->render($response, './hr_detail_remuneration.php', $as);
    }

    public function saveremuneration($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('hrIndex');
      $sc = $_COOKIE['subcomid'];
      
      if(isset($args['id'])){
        $id = $args['id'];
        $month = date('Ym',strtotime('-1 month'));
        $total = $_POST['remuneration'] + $_POST['tc'] + $_POST['fd'] - $_POST['sb'] - $_POST['fk'];
        $up = $db->update('member_remuneration',[
          'remuneration'=>$_POST['remuneration'],
          'tc'=>$_POST['tc'],
          'fd'=>$_POST['fd'],
          'sb'=>$_POST['sb'],
          'fk'=>$_POST['fk'],
          'total' => $total,
          'more'=>$_POST['more']
          ],['AND'=>['staffId'=>$id,'month'=>$month]]);
        $json = array('flag' => 200,'msg' => '工资条已生成成功', 'data' => '');
        return $response->withJson($json);
      }else{
        $json = array('flag' => 400,'msg' => '参数有误', 'data' => '');
        return $response->withJson($json);
      }

    }

    public function remunerationlog($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('hrIndex');
      $sc = $_COOKIE['subcomid'];
      $ac = getac($_COOKIE['authoritySubc']);
      if(!isset($args['month'])){
        $month = date('Ym',strtotime('-1 month'));
      }else{
        $month = $args['month'];
      }

      if(!isset($args['subc'])){
        $subc = $sc;
      }else{
        $subc = $args['subc'];
      }

      if(isset($args['p']) && is_numeric($args['p']) && $args['p']>1){
        $p = $args['p'];
        $srow = ($p*10)-10;
      }else{
        $p = 1;
        $srow = 0;
      }
      $count = $db->count('member_remuneration','*',['AND'=>[
            'month'=>$month,
            'subc'=>$subc
            ]]
      );
      $list = $db->select('member_remuneration',[
          "[>]member_subcompany" => ["subc"=>"id"],
          "[>]member" => ["staffId"=>"id"]
        ],[
        'member_remuneration.id(id)',
        'member_remuneration.staffId(staffId)',
        'member_remuneration.month(month)',
        'member_remuneration.remuneration(remuneration)',
        'member_remuneration.tc(tc)',
        'member_remuneration.fd(fd)',
        'member_remuneration.fk(fk)',
        'member_remuneration.sb(sb)',
        'member_remuneration.total(total)',
        'member_remuneration.creattime(creattime)',
        'member_remuneration.more(more)',
        'member_remuneration.status(status)',
        'member_subcompany.subcompanyname(subcname)',
        'member.name(satffname)'
        ],['AND'=>[
            'month'=>$month,
            'subc'=>$subc],
            'ORDER'=>['id'=>'DESC'],
            "LIMIT" => [$srow,10]
      ]);
      $subcompany = $db->select('member_subcompany','*');

      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'month' => $month,
        'subc' => $subc,
        'mid' => $id,
        'list' => $list,
        'count' => $count,
        'p' => $p,
        'subcompanylist' => $subcompany
      ];
      return $this->app->renderer->render($response, './hr_detail_remunerationlog.php', $as);
    }

    public function performance($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('hrIndex');
      $sc = $_COOKIE['subcomid'];
      $ac = getac($_COOKIE['authoritySubc']);
      if(!isset($args['month'])){
        $month = date('Ym',strtotime('-1 month'));
      }else{
        $month = $args['month'];
      }

      if(isset($args['id'])){
        $id = $args['id'];
        $m = $db->get('member',[
          "[>]member_subcompany" => ["subcompany"=>"id"],
          "[>]member_department" => ["department"=>"id"],
          "[>]member_position" => ["position"=>"id"]
          ],[
          'member.id(id)',
          'member.staffid(staffid)',
          'member.name(name)',
          'member.authority(authority)',
          'member.authoritySubc(authoritySubc)',
          'member.status(status)',
          'member.remuneration(remunerationM)',
          'member_subcompany.subcompanyname(owenSubCompany)',
          'member_department.departmentname(owenDepartment)',
          'member_position.positionname(owenPosition)'
          ],['member.id'=>$id]);
        if(!$m){
          return $response->withRedirect($this->app->router->pathFor('errorNoId'));
        }
        //获取用户收款记录
        //解析数字格式的月份
        $mmonth = substr($month,0,4).'-'.substr($month,-2,2);
        $m2 = date('Y-m-1',strtotime($mmonth));
        $m3 = date('Y-m-31',strtotime($mmonth));
        $list = $db->select('contracts_entry',[
            "[>]contracts" => ["contracts_entry.contract_id"=>"id"],
            "[>]contracts_entry_source" => ["contracts_entry.source"=>"id"],
            "[>]contract_type" => ["contracts.type"=>"id"],
            "[>]customs" => ["contracts.uid"=>"id"],
            "[>]companies" => ["contracts.uid"=>"id"]
          ],[
            'contracts_entry.id(id)',
            'contracts_entry.contract_id(contract_id)',
            'contracts_entry.money(money)',
            'contracts_entry.entry_day(entry_day)',
            'contracts_entry.source(source)',
            'contracts_entry.creattime(creattime)',
            'contracts_entry.sker(sker)',
            'contracts_entry.text(text)',
            'contracts.cno(cno)',
            'contracts.money_total(money_total)',
            'contracts.money_ok(money_ok)',
            'contracts.type(type)',
            'contracts.paytype(paytype)',
            'contracts.cost(cost)',
            'contracts.utype(cutype)',
            'customs.name(cusname)',
            'companies.decname(comname)',
            'contract_type.typename(typename)',
            'contracts_entry_source.sourcename(sourcename)',
            'contracts_entry_source.sourceaccount(sourceaccount)',
          ],[
           'AND'=>[
            'contracts_entry.sker'=>$id,
            'contracts_entry.entry_day[>=]'=>$m2,
            'contracts_entry.entry_day[<=]'=>$m3
           ],
           'ORDER'=> ['id'=>'DESC']
          ]);
      }
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'month' => $month,
        'm' => $m,
        'list' => $list,
        'mid' => $id
      ];
      return $this->app->renderer->render($response, './hr_detail_performance.php', $as);
    }

    public function candc($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('hrIndex');
      $sc = $_COOKIE['subcomid'];
      $ac = getac($_COOKIE['authoritySubc']);
      
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'month' => $month
      ];
      return $this->app->renderer->render($response, './hr_detail_candc.php', $as);
    }

    public function msg($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('hrIndex');
      $sc = $_COOKIE['subcomid'];
      $ac = getac($_COOKIE['authoritySubc']);
      
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'month' => $month
      ];
      return $this->app->renderer->render($response, './hr_detail_msg.php', $as);
    }

    public function getstaffJSON($request, $response, $args){
      global $flag,$msg,$data,$db;
      $ac = getac($_COOKIE['authoritySubc']);
      $sc = $_COOKIE['subcomid'];
      $list = $db->select('chat_passageway',
        ["[>]member" => ["chat_passageway.uid" => "id"]],
        [
          'member.id(id)',
          'member.name(name)',
          'member.mobile(mobile)'
        ],
        ['AND'=>[
          'chat_passageway.passageway[!]' => NULL,
          'member.id[!]'=>$_COOKIE['staffID'],
          'member.status'=>1,
          'member.subcompany'=>$sc
        ]]
      );

      $json = array('flag' => 200,'msg' => '在线员工列表', 'data' => $list,'time'=>date('Y-m-d H:i:s'));
      return $response->withJson($json);
    }

    public function searchform($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('hrIndex');
      $scom = $db->select('member_subcompany','*',['ORDER'=>['id'=>'ASC']]);
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'scom' => $scom
      ];
      return $this->app->renderer->render($response, './hr_search.php', $as);
    }

    public function searchresult($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('hrIndex');
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

      $list = $db->select('member',[
          "[>]member_subcompany" => ["subcompany"=>"id"],
          "[>]member_department" => ["department"=>"id"],
          "[>]member_position" => ["position"=>"id"]
          ],[
          'member.id(id)',
          'member.staffid(staffid)',
          'member.name(name)',
          'member.mobile(mobile)',
          'member.birthday(birthday)',
          'member.sexy(sexy)',
          'member.entryday(entryday)',
          'member.status(status)',
          'member_subcompany.subcompanyname(owenSubCompany)',
          'member_department.departmentname(owenDepartment)',
          'member_position.positionname(owenPosition)'
          ],['OR'=>[
            'member.name[~]' => $key,
            'member.mobile[~]' => $key
          ],
            "ORDER" => ["member.id"=>"DESC"]
          ]);
      
      

      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'list' => $list,
        'p' => $p,
        'key' => $key
      ];
      return $this->app->renderer->render($response, './hr_search_result.php', $as);
    }

    public function form($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('hrIndex');
      $sc = $_COOKIE['subcomid'];

      if(isset($args['id'])){
        $mid = $args['id'];
        $m = $db->get('member',[
          "[>]member_subcompany" => ["subcompany"=>"id"],
          "[>]member_department" => ["department"=>"id"],
          "[>]mcms_attachment" => ["pics"=>"id"],
          "[>]member_position" => ["position"=>"id"]
          ],[
          'member.id(id)',
          'member.staffid(staffid)',
          'member.name(name)',
          'member.mobile(mobile)',
          'member.birthday(birthday)',
          'member.sexy(sexy)',
          'member.entryday(entryday)',
          'member.status(status)',
          'mcms_attachment.uri(photo)',
          'member.political(political)',
          'member.nation(nation)',
          'member.sfz(sfz)',
          'member.crossprev(crossprev)',
          'member.crossaddress(crossaddress)',
          'member.school(school)',
          'member.specialty(specialty)',
          'member.education(education)',
          'member.familyphone(familyphone)',
          'member.familyaddress(familyaddress)',
          'member.emergencycontact(emergencycontact)',
          'member.emergencyphone(emergencyphone)',
          'member.bank(bank)',
          'member.bankcard(bankcard)',
          'member.certificate(certificate)',
          'member.outtime(outtime)',
          'member.prov(prov)',
          'member.city(city)',
          'member.area(area)',
          'member.authority(authority)',
          'member.authoritySubc(authoritySubc)',
          'member.openID(openID)',
          'member.more(more)',
          'member.remuneration(remuneration)',
          'member.position(position)',
          'member.department(department)',
          'member.subcompany(subcompany)',
          'member.ismanager(ismanager)',
          'member.pics(pics)',
          'member_subcompany.subcompanyname(owenSubCompany)',
          'member_department.departmentname(owenDepartment)',
          'member_position.positionname(owenPosition)'
          ],['member.id' => $mid]);
      }else{
        $mid = '';
        $m = '';
      }
      
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'mid' => $mid,
        'm' => $m,
      ];
      return $this->app->renderer->render($response, './hr_form.php', $as);
    }

    public function save($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('hrIndex');
      $u = getstaff($_COOKIE['staffID']);
      $form = $u['name'].$u['mobile'];
      if(isset($request->getParsedBody()['ismanager']) && $request->getParsedBody()['ismanager']!=''){
          $ismanager = $request->getParsedBody()['ismanager'];
        }else{
          $ismanager = 0;
        }
      if(isset($args['id'])){
        $mid = $args['id'];
        $up = $db->update("member", [
          "name" => $request->getParsedBody()['name'],
          "staffid" => $request->getParsedBody()['staffid'],
          "mobile" => $request->getParsedBody()['mobile'],
          "ismanager" => $ismanager,
          "sexy" => $request->getParsedBody()['sexy'],
          "birthday" => $request->getParsedBody()['birthday'],
          "political" => $request->getParsedBody()['political'],
          "nation" => $request->getParsedBody()['nation'],
          "sfz" => $request->getParsedBody()['sfz'],
          "crossprev" => $request->getParsedBody()['crossprev'],
          "crossaddress" => $request->getParsedBody()['crossaddress'],
          "school" => $request->getParsedBody()['school'],
          "specialty" => $request->getParsedBody()['specialty'],
          "education" => $request->getParsedBody()['education'],
          "familyphone" => $request->getParsedBody()['familyphone'],
          "familyaddress" => $request->getParsedBody()['familyaddress'],
          "emergencycontact" => $request->getParsedBody()['emergencycontact'],
          "emergencyphone" => $request->getParsedBody()['emergencyphone'],
          "bank" => $request->getParsedBody()['bank'],
          "bankcard" => $request->getParsedBody()['bankcard'],
          "certificate" => $request->getParsedBody()['certificate'],
          "subcompany" => $request->getParsedBody()['subcompany'],
          "department" => $request->getParsedBody()['department'],
          "position" => $request->getParsedBody()['position'],
          "pics" => $request->getParsedBody()['pics'],
          "entryday" => $request->getParsedBody()['entryday'],
          "prov" => $request->getParsedBody()['prov'],
          "city" => $request->getParsedBody()['city'],
          "area" => $request->getParsedBody()['area'],
          "more" => $request->getParsedBody()['more'],
          "remuneration" => $request->getParsedBody()['remuneration']
        ],['id'=>$mid]);
        if($up){
          $flag = 200;
          $msg = '员工编辑成功。员工ID:'.$mid;
          //wlog('12','编辑客户',$msg,$mid);
        }else{
          $mid = 0;
          $flag = 400;
          $msg = '员工编辑失败，数据有误。';
        }
        
      }else{
        $pwd = md5(substr($request->getParsedBody()['mobile'], -6));
       

        $mid = $db->insert("member", [
          "name" => $request->getParsedBody()['name'],
          "staffid" => $request->getParsedBody()['staffid'],
          "mobile" => $request->getParsedBody()['mobile'],
          "password" => $pwd,
          "ismanager" => $ismanager,
          "sexy" => $request->getParsedBody()['sexy'],
          "birthday" => $request->getParsedBody()['birthday'],
          "political" => $request->getParsedBody()['political'],
          "nation" => $request->getParsedBody()['nation'],
          "sfz" => $request->getParsedBody()['sfz'],
          "crossprev" => $request->getParsedBody()['crossprev'],
          "crossaddress" => $request->getParsedBody()['crossaddress'],
          "school" => $request->getParsedBody()['school'],
          "specialty" => $request->getParsedBody()['specialty'],
          "education" => $request->getParsedBody()['education'],
          "familyphone" => $request->getParsedBody()['familyphone'],
          "familyaddress" => $request->getParsedBody()['familyaddress'],
          "emergencycontact" => $request->getParsedBody()['emergencycontact'],
          "emergencyphone" => $request->getParsedBody()['emergencyphone'],
          "bank" => $request->getParsedBody()['bank'],
          "bankcard" => $request->getParsedBody()['bankcard'],
          "certificate" => $request->getParsedBody()['certificate'],
          "subcompany" => $request->getParsedBody()['subcompany'],
          "department" => $request->getParsedBody()['department'],
          "position" => $request->getParsedBody()['position'],
          "more" => $request->getParsedBody()['more'],
          "pics" => $request->getParsedBody()['pics'],
          "status" => 1,
          "entryday" => $request->getParsedBody()['entryday'],
          "outtime" =>'',
          "creattime" => date('Y-m-d H:i:s'),
          "authority" => '',
          "prov" => $request->getParsedBody()['prov'],
          "city" => $request->getParsedBody()['city'],
          "area" => $request->getParsedBody()['area'],
          "remuneration" => $request->getParsedBody()['remuneration']
        ]);
        if($mid>0){
          $flag = 200;
          $msg = '添加员工已成功。新员工ID:'.$mid;
          //wlog('9','创建客户',$msg,$mid);
        }else{
          $mid = 0;
          $flag = 400;
          $msg = '添加员工失败，数据有误。';
        }
      }
      
      $json = array('flag' => $flag,'msg' => $msg, 'data' => $data,'id' => $mid);
      return $response->withJson($json);
    }
      

}
