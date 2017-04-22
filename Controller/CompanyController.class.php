<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \interop\Container\ContainerInterface;
use \Slim\Views\PhpRenderer;
use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;

class CompanyController 
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
  		$path = $this->app->router->pathFor('companiesIndex');
  		
  		$ac = getac($_COOKIE['authoritySubc']);
      $sc = $_COOKIE['subcomid'];

      if(isset($args['p']) && is_numeric($args['p']) && $args['p']>1){
        $p = $args['p'];
        $srow = ($p*10)-10;
      }else{
        $p = 1;
        $srow = 0;
      }
      

      $list = $db->select('companies',[
          "[>]member_subcompany" => ["subc"=>"id"],
          "[>]member" => ["ywuid"=>"id"]
          ],[
          'companies.id(id)',
          'companies.companyname(name)',
          'companies.decname(sname)',
          'companies.prov(prov)',
          'companies.city(city)',
          'companies.area(area)',
          'companies.bgprov(bgprov)',
          'companies.bgcity(bgcity)',
          'companies.bgarea(bgarea)',
          'companies.creattime(creattime)',
          'member_subcompany.subcompanyname(owenSubCompany)',
          'member.name(owenSaler)'
          ],[
        'AND'=>[
        'companies.status'=>0,
        'companies.subc'=>$ac],
        "ORDER" => ["companies.status"=>"ASC","companies.id"=>"DESC"],
        "LIMIT" => [$srow,10]
        ]);
      
      $count = [];
      $count['all'] = $db->count('companies',['AND'=>['status'=>0,'subc'=>$ac]]);
    

      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'list' => $list,
        'count' => $count,
        'p' => $p,
        'thismod'=>0
      ];
  		return $this->app->renderer->render($response, './company.php', $as);
    }

    public function keyend($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('companiesIndex');
      $dayjia30 = date('y-m-d', strtotime(' +30 day'));
      $ac = getac($_COOKIE['authoritySubc']);
      $sc = $_COOKIE['subcomid'];

      if(isset($args['p']) && is_numeric($args['p']) && $args['p']>1){
        $p = $args['p'];
        $srow = ($p*10)-10;
      }else{
        $p = 1;
        $srow = 0;
      }
      

      $list = $db->select('companies',[
          "[>]member_subcompany" => ["subc"=>"id"],
          "[>]member" => ["ywuid"=>"id"]
          ],[
          'companies.id(id)',
          'companies.companyname(name)',
          'companies.decname(sname)',
          'companies.prov(prov)',
          'companies.city(city)',
          'companies.area(area)',
          'companies.bgprov(bgprov)',
          'companies.bgcity(bgcity)',
          'companies.bgarea(bgarea)',
          'companies.creattime(creattime)',
          'member_subcompany.subcompanyname(owenSubCompany)',
          'member.name(owenSaler)'
          ],[
        'AND'=>[
        'companies.na_end_day[<=]'=>$dayjia30,
        'companies.na_end_day[!]'=>['0000-00-00',NULL],
        'companies.status'=>0,
        'companies.subc'=>$ac],
        "ORDER" => ["companies.status"=>"ASC","companies.id"=>"DESC"],
        "LIMIT" => [$srow,10]
        ]);
      
      $count = [];
      $count['all'] = $db->count('companies',['AND'=>[
        'companies.na_end_day[<=]'=>$dayjia30,
        'companies.na_end_day[!]'=>['0000-00-00',NULL],
        'companies.status'=>0,
        'companies.subc'=>$ac
        ]]);
    

      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'list' => $list,
        'count' => $count,
        'p' => $p,
        'thismod'=>1
      ];
      return $this->app->renderer->render($response, './company.php', $as);
    }

    public function vpdnend($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('companiesIndex');
      
      $ac = getac($_COOKIE['authoritySubc']);
      $sc = $_COOKIE['subcomid'];
      $dayjia30 = date('y-m-d', strtotime(' +30 day'));

      if(isset($args['p']) && is_numeric($args['p']) && $args['p']>1){
        $p = $args['p'];
        $srow = ($p*10)-10;
      }else{
        $p = 1;
        $srow = 0;
      }
      

      $list = $db->select('companies',[
          "[>]member_subcompany" => ["subc"=>"id"],
          "[>]member" => ["ywuid"=>"id"]
          ],[
          'companies.id(id)',
          'companies.companyname(name)',
          'companies.decname(sname)',
          'companies.prov(prov)',
          'companies.city(city)',
          'companies.area(area)',
          'companies.bgprov(bgprov)',
          'companies.bgcity(bgcity)',
          'companies.bgarea(bgarea)',
          'companies.creattime(creattime)',
          'member_subcompany.subcompanyname(owenSubCompany)',
          'member.name(owenSaler)'
          ],[
        'AND'=>[
        'companies.vpn_end_day[<=]'=>$dayjia30,
        'companies.vpn_end_day[!]'=>['0000-00-00',NULL],
        'companies.status'=>0,
        'companies.subc'=>$ac],
        "ORDER" => ["companies.status"=>"ASC","companies.id"=>"DESC"],
        "LIMIT" => [$srow,10]
        ]);
      
      $count = [];
      $count['all'] = $db->count('companies',['AND'=>[
        'companies.vpn_end_day[<=]'=>$dayjia30,
        'companies.vpn_end_day[!]'=>['0000-00-00',NULL],
        'companies.status'=>0,
        'companies.subc'=>$ac
        ]]);
    

      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'list' => $list,
        'count' => $count,
        'p' => $p,
        'thismod'=>2
      ];
      return $this->app->renderer->render($response, './company.php', $as);
    }

    public function yearcheck($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('companiesIndex');
      
      $ac = getac($_COOKIE['authoritySubc']);
      $sc = $_COOKIE['subcomid'];
      $sday = date('y-12-31', strtotime(' -1 year'));
      $sdays = date('y-1-1', strtotime(' -1 year'));

      if(isset($args['p']) && is_numeric($args['p']) && $args['p']>1){
        $p = $args['p'];
        $srow = ($p*10)-10;
      }else{
        $p = 1;
        $srow = 0;
      }
      

      $list = $db->select('companies',[
          "[>]member_subcompany" => ["subc"=>"id"],
          "[>]member" => ["ywuid"=>"id"]
          ],[
          'companies.id(id)',
          'companies.companyname(name)',
          'companies.decname(sname)',
          'companies.prov(prov)',
          'companies.city(city)',
          'companies.area(area)',
          'companies.bgprov(bgprov)',
          'companies.bgcity(bgcity)',
          'companies.bgarea(bgarea)',
          'companies.creattime(creattime)',
          'member_subcompany.subcompanyname(owenSubCompany)',
          'member.name(owenSaler)'
          ],[
        'AND'=>[
        'companies.companyctime[<]'=>$sday,
        'companies.companyctime[>]'=>$sdays,
        'companies.companyctime[!]'=>['0000-00-00',NULL],
        'companies.status'=>0,
        'companies.subc'=>$ac],
        "ORDER" => ["companies.status"=>"ASC","companies.id"=>"DESC"],
        "LIMIT" => [$srow,10]
        ]);
      
      $count = [];
      $count['all'] = $db->count('companies',['AND'=>[
        'companies.companyctime[<]'=>$sday,
        'companies.companyctime[>]'=>$sdays,
        'companies.companyctime[!]'=>['0000-00-00',NULL],
        'companies.status'=>0,
        'companies.subc'=>$ac
        ]]);
    

      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'list' => $list,
        'count' => $count,
        'p' => $p,
        'thismod'=>3
      ];
      return $this->app->renderer->render($response, './company.php', $as);
    }







    public function searchform($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('companiesIndex');
      $scom = $db->select('member_subcompany','*',['ORDER'=>['id'=>'ASC']]);
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'scom' => $scom
      ];
      return $this->app->renderer->render($response, './company_search.php', $as);
    }

    public function searchresult($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('companiesIndex');
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
      
      $list = $db->select('companies',[
          "[>]member_subcompany" => ["subc"=>"id"],
          "[>]member" => ["ywuid"=>"id"]
          ],[
          'companies.id(id)',
          'companies.companyname(name)',
          'companies.decname(sname)',
          'companies.prov(prov)',
          'companies.city(city)',
          'companies.area(area)',
          'companies.bgprov(bgprov)',
          'companies.bgcity(bgcity)',
          'companies.bgarea(bgarea)',
          'companies.creattime(creattime)',
          'member_subcompany.subcompanyname(owenSubCompany)',
          'member.name(owenSaler)'
          ],[
        'AND'=>[
          'OR'=>[
            'companies.companyname[~]' => $key,
            'companies.decname[~]' => $key
          ],
        'companies.subc'=>$ac],
        "ORDER" => ["companies.status"=>"ASC","companies.id"=>"DESC"]
        ]);

      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'list' => $list,
        'p' => $p,
        'key' => $key
      ];
      return $this->app->renderer->render($response, './company_search_result.php', $as);
    }

    public function report($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('companiesIndex');
      if($args['year'] == ''){
        $year = date('Y');
      }else{
         $year = $args['year'];
      }

      $month = date('m');
      $ac = getac($_COOKIE['authoritySubc']);
      $sc = $_COOKIE['subcomid'];
      $count=[];
      $count['all'] = $db->count('companies',['AND'=>['status'=>0,'subc'=>$ac]]);
      
      $count['thismonth'] =$db->count('companies',['AND'=>[
        'status'=>0,
        'subc'=>$ac,
        'creattime[>=]'=>date('y-m-1 0:0:0'),
        'creattime[<=]'=>date('y-m-31 23:59:59')]]);
      $count['today'] = $db->count('companies',['AND'=>[
        'status'=>0,
        'subc'=>$ac,
        'creattime[>=]'=>date('y-m-d 0:0:0'),
        'creattime[<=]'=>date('y-m-d 23:59:59')]]);

      for($i=0;$i<12;$i++){
        $count['lineall'][$i] = $db->count('companies',['AND'=>[
        'status'=>0,
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
      return $this->app->renderer->render($response, './company_report.php', $as);
    }

    public function form($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('companiesIndex');
      $sc = $_COOKIE['subcomid'];

      if(isset($args['id'])){
        $mid = $args['id'];
        $m = $db->get('companies',[
            '[>]customs(c1)'=>['cus_1'=>'id'],
            '[>]customs(c2)'=>['cus_2'=>'id'],
            '[>]customs(c3)'=>['cus_3'=>'id'],
            '[>]customs(c4)'=>['cus_4'=>'id'],
            '[>]customs(c5)'=>['cus_5'=>'id']
            ],[
            'companies.id(id)',
            'companies.companyname(companyname)',
            'companies.decname(decname)',
            'companies.cno(cno)',
            'companies.swno(swno)',
            'companies.prov(prov)',
            'companies.city(city)',
            'companies.area(area)',
            'companies.address(address)',
            'companies.companyctime(companyctime)',
            'companies.companym(companym)',
            'companies.fr(fr)',
            'companies.hy(hy)',
            'companies.content(content)',
            'companies.more(more)',
            'companies.na(na)',
            'companies.napwd(napwd)',
            'companies.na_end_day(na_end_day)',
            'companies.nb(nb)',
            'companies.nbpwd(nbpwd)',
            'companies.vpn(vpn)',
            'companies.vpnpwd(vpnpwd)',
            'companies.vpn_end_day(vpn_end_day)',
            'companies.ctype(ctype)',
            'companies.webpname(webpname)',
            'companies.webppwd(webppwd)',
            'companies.bgprov(bgprov)',
            'companies.bgcity(bgcity)',
            'companies.bgarea(bgarea)',
            'companies.bgaddress(bgaddress)',
            'companies.ywuid(ywuid)',
            'companies.fp(fp)',
            'companies.hds(hds)',
            'companies.qp(qp)',
            'companies.subc(subc)',
            'companies.pics(pics)',
            'c1.id(c1id)',
            'c2.id(c2id)',
            'c3.id(c3id)',
            'c4.id(c4id)',
            'c5.id(c5id)',
            'c1.name(c1name)',
            'c2.name(c2name)',
            'c3.name(c3name)',
            'c4.name(c4name)',
            'c5.name(c6name)'
          ],['companies.id'=>$mid]);

        if(!$m){
          return $response->withRedirect($this->app->router->pathFor('errorNoId'));
        }else{

          $m['customs'] = $m['c1name'].','.$m['c2name'].','.$m['c3name'].','.$m['c4name'].','.$m['c5name'];
          $m['customsid'] = $m['c1id'].','.$m['c2id'].','.$m['c3id'].','.$m['c4id'].','.$m['c5id'];
        }
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
      return $this->app->renderer->render($response, './company_form.php', $as);
    }

    public function save($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('companiesIndex');
      $sc = $_COOKIE['subcomid'];

      $cus = $request->getParsedBody()['customsid'];
      $cus = explode(",", $cus);
      $cus[0] = isset($cus[0]) ? $cus[0] : 0;
      $cus[1] = isset($cus[1]) ? $cus[1] : 0;
      $cus[2] = isset($cus[2]) ? $cus[2] : 0;
      $cus[3] = isset($cus[3]) ? $cus[3] : 0;
      $cus[4] = isset($cus[4]) ? $cus[4] : 0;

      $fp = isset($_POST['fp']) ? $_POST['fp'] : 0;
      $hds = isset($_POST['hds']) ? $_POST['hds'] : 0;
      $qp = isset($_POST['qp']) ? $_POST['qp'] : 0;

      if(isset($args['id'])){
        $mid = $args['id'];
        $up = $db->update("companies", [
          "companyname" => $_POST['companyname'],
          "decname" => $_POST['decname'],
          "cno" => $_POST['cno'],
          "swno" => $_POST['swno'],
          "companyctime" => $_POST['companyctime'],
          "companym" => $_POST['companym'],
          "fr" => $_POST['fr'],
          "hy" => $_POST['hy'],
          "content" => $_POST['content'],
          "prov" => $_POST['prov'],
          "city" => $_POST['city'],
          "area" => $_POST['area'],
          "address" => $_POST['address'],
          "bgprov" => $_POST['bgprov'],
          "bgcity" => $_POST['bgcity'],
          "bgarea" => $_POST['bgarea'],
          "bgaddress" => $_POST['bgaddress'],
          "ywuid" => $_POST['ywuid'],
          "na" => $_POST['na'],
          "napwd" => $_POST['napwd'],
          "nb" => $_POST['nb'],
          "nbpwd" => $_POST['nbpwd'],
          "vpn" => $_POST['vpn'],
          "vpnpwd" => $_POST['vpnpwd'],
          "webpname" => $_POST['webpname'],
          "webppwd" => $_POST['webppwd'],
          "more" => $_POST['more'],
          "cus_1" => $cus[0],
          "cus_2" => $cus[1],
          "cus_3" => $cus[2],
          "cus_4" => $cus[3],
          "cus_5" => $cus[4],
          "pics" => $_POST['pics'],
          "ctype" => $_POST['ctype'],
          "fp" => $fp,
          "hds" => $hds,
          "qp" => $qp,
          "subc"=>$sc
        ],['id'=>$mid]);
        if($up){
          $flag = 200;
          $msg = '企业资料编辑成功。客户ID:'.$mid;
          //wlog('12','编辑客户',$msg,$mid);
        }else{
          //$mid = 0;
          $flag = 400;
          $msg = '没有修改任何数据。';
        }
        
      }else{
        $mid = $db->insert("companies", [
          "companyname" => $_POST['companyname'],
          "decname" => $_POST['decname'],
          "cno" => $_POST['cno'],
          "swno" => $_POST['swno'],
          "companyctime" => $_POST['companyctime'],
          "companym" => $_POST['companym'],
          "fr" => $_POST['fr'],
          "hy" => $_POST['hy'],
          "content" => $_POST['content'],
          "prov" => $_POST['prov'],
          "city" => $_POST['city'],
          "area" => $_POST['area'],
          "address" => $_POST['address'],
          "bgprov" => $_POST['bgprov'],
          "bgcity" => $_POST['bgcity'],
          "bgarea" => $_POST['bgarea'],
          "bgaddress" => $_POST['bgaddress'],
          "ywuid" => $_POST['ywuid'],
          "na" => $_POST['na'],
          "napwd" => $_POST['napwd'],
          "nb" => $_POST['nb'],
          "nbpwd" => $_POST['nbpwd'],
          "vpn" => $_POST['vpn'],
          "vpnpwd" => $_POST['vpnpwd'],
          "webpname" => $_POST['webpname'],
          "webppwd" => $_POST['webppwd'],
          "more" => $_POST['more'],
          "cus_1" => $cus[0],
          "cus_2" => $cus[1],
          "cus_3" => $cus[2],
          "cus_4" => $cus[3],
          "cus_5" => $cus[4],
          "pics" => $_POST['pics'],
          "ctype" => $_POST['ctype'],
          "fp" => $fp,
          "hds" => $hds,
          "qp" => $qp,
          "subc"=>$sc,
          "status" => 0,
          "creattime" => date('Y-m-d H:i:s'),
          "creatUid" =>$_COOKIE['staffID']
        ]);
        if($mid > 0){
          $flag = 200;
          $msg = '添加新企业已成功。企业ID:'.$mid;
          //wlog('9','创建客户',$msg,$mid);
        }else{
          $mid = 0;
          $flag = 400;
          $msg = '添加企业失败，数据有误。';
        }
      }
      
      $json = array('flag' => $flag,'msg' => $msg, 'data' => $data,'id' => $mid);
      return $response->withJson($json);
    }

    public function detail($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('companiesIndex');

      if(isset($args['id'])){
        $mid = $args['id'];
        $m = $db->get('companies',[
            '[>]customs(c1)'=>['cus_1'=>'id'],
            '[>]customs(c2)'=>['cus_2'=>'id'],
            '[>]customs(c3)'=>['cus_3'=>'id'],
            '[>]customs(c4)'=>['cus_4'=>'id'],
            '[>]customs(c5)'=>['cus_5'=>'id'],
            '[>]member(m1)'=>['ywuid'=>'id'],
            '[>]member(m2)'=>['creatUid'=>'id'],
            '[>]member_subcompany(ms1)'=>['m1.subcompany'=>'id'],
            '[>]member_subcompany(ms2)'=>['m2.subcompany'=>'id']
            ],[
            'companies.id(id)',
            'companies.companyname(companyname)',
            'companies.decname(decname)',
            'companies.cno(cno)',
            'companies.swno(swno)',
            'companies.prov(prov)',
            'companies.city(city)',
            'companies.area(area)',
            'companies.address(address)',
            'companies.companyctime(companyctime)',
            'companies.companym(companym)',
            'companies.fr(fr)',
            'companies.hy(hy)',
            'companies.content(content)',
            'companies.more(more)',
            'companies.na(na)',
            'companies.napwd(napwd)',
            'companies.na_end_day(na_end_day)',
            'companies.nb(nb)',
            'companies.nbpwd(nbpwd)',
            'companies.vpn(vpn)',
            'companies.vpnpwd(vpnpwd)',
            'companies.vpn_end_day(vpn_end_day)',
            'companies.ctype(ctype)',
            'companies.webpname(webpname)',
            'companies.webppwd(webppwd)',
            'companies.bgprov(bgprov)',
            'companies.bgcity(bgcity)',
            'companies.bgarea(bgarea)',
            'companies.bgaddress(bgaddress)',
            'companies.ywuid(ywuid)',
            'companies.fp(fp)',
            'companies.hds(hds)',
            'companies.qp(qp)',
            'companies.subc(subc)',
            'companies.status(status)',
            'companies.creattime(creattime)',
            'companies.pics(pics)',
            'c1.id(c1id)',
            'c2.id(c2id)',
            'c3.id(c3id)',
            'c4.id(c4id)',
            'c5.id(c5id)',
            'c1.name(c1name)',
            'c2.name(c2name)',
            'c3.name(c3name)',
            'c4.name(c4name)',
            'c5.name(c5name)',
            'm1.name(owenSaler)',
            'm2.name(staffName)',
            'm2.mobile(staffMobile)',
            'ms1.subcompanyname(owenSubCompany)',
            'ms2.subcompanyname(staffCompany)'
          ],['companies.id'=>$mid]);
        if(!$m){
          return $response->withRedirect($this->app->router->pathFor('errorNoId'));
        }else{
          $m['customs'] = [$m['c1name'],$m['c2name'],$m['c3name'],$m['c4name'],$m['c5name']];
          $m['customsid'] = [$m['c1id'],$m['c2id'],$m['c3id'],$m['c4id'],$m['c5id']];
        }


      }

      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'm' => $m,
        'mid' => $mid,
      ];
      return $this->app->renderer->render($response, './company_detail.php', $as);
    }

    public function detailcontracts($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('companiesIndex');
      if(isset($args['id'])){
        $mid = $args['id'];
        $m = $db->get('companies',[
            '[>]customs(c1)'=>['cus_1'=>'id'],
            '[>]customs(c2)'=>['cus_2'=>'id'],
            '[>]customs(c3)'=>['cus_3'=>'id'],
            '[>]customs(c4)'=>['cus_4'=>'id'],
            '[>]customs(c5)'=>['cus_5'=>'id'],
            '[>]member(m1)'=>['ywuid'=>'id'],
            '[>]member(m2)'=>['creatUid'=>'id'],
            '[>]member_subcompany(ms1)'=>['m1.subcompany'=>'id'],
            '[>]member_subcompany(ms2)'=>['m2.subcompany'=>'id']
            ],[
            'companies.id(id)',
            'companies.companyname(companyname)',
            'companies.decname(decname)',
            'companies.creattime(creattime)',
            'c1.id(c1id)',
            'c2.id(c2id)',
            'c3.id(c3id)',
            'c4.id(c4id)',
            'c5.id(c5id)',
            'c1.name(c1name)',
            'c2.name(c2name)',
            'c3.name(c3name)',
            'c4.name(c4name)',
            'c5.name(c6name)',
            'm1.name(owenSaler)',
            'm2.name(staffName)',
            'm2.mobile(staffMobile)',
            'ms1.subcompanyname(owenSubCompany)',
            'ms2.subcompanyname(staffCompany)'
          ],['companies.id'=>$mid]);
        if(!$m){
          return $response->withRedirect($this->app->router->pathFor('errorNoId'));
        }else{
          $m['customs'] = [$m['c1name'],$m['c2name'],$m['c3name'],$m['c4name'],$m['c5name']];
          $m['customsid'] = [$m['c1id'],$m['c2id'],$m['c3id'],$m['c4id'],$m['c5id']];

          $m['hasContracts'] = $db->select('contracts',[
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
            ],['AND'=>['contracts.utype'=>1,'contracts.uid'=>$mid],'ORDER'=>['contracts.status'=>'ASC']]);
        }


      }

      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'm' => $m,
        'mid' => $mid,
      ];
      return $this->app->renderer->render($response, './company_detail_contracts.php', $as);
    }

      

}
