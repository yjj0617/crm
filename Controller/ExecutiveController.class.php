<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \interop\Container\ContainerInterface;
use \Slim\Views\PhpRenderer;
use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;

class ExecutiveController 
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
  		$path = $this->app->router->pathFor('executiveIndex');

      //$push = wscpush('sengmsg','系统',0,'satff',0,'satff','msg','考勤系统已在新系统上线','通知');//群发推送
  		$as = [
  			'settings'=>$this->app->get('settings'),
  			'path' => $path
  		];
  		return $this->app->renderer->render($response, './executive.php', $as);
    }

    public function notice($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('executiveIndex');
    }

    public function noticedetail($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('executiveIndex');
      
    }

    public function savenotice($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('executiveIndex');
    }

    public function worktime($request, $response, $args){
      global $flag,$msg,$data,$db;
      $has = $db->select('member_worktime',['id'],[
        'AND'=>[
            'staffid' => $_COOKIE['staffID'],
            'workday' => date('Y-m-d')
          ]
        ]);
      if(count($has)<2){
        $db->insert('member_worktime',[
            'staffid' => $_COOKIE['staffID'],
            'workday' => date('Y-m-d'),
            'worktime' => date('Y-m-d H:i:s'),
            'ip' => getip()
          ]);
        $json = array('flag' => 200,'msg' => '打卡成功', 'data' => []);
        return $response->withJson($json);
      }else{
        $db->update('member_worktime',[
            'worktime' => date('Y-m-d H:i:s'),
            'ip' => getip()
          ],[
            'id'=>$has[1]['id']
          ]);
        $json = array('flag' => 200,'msg' => '您已经打过两次卡了，建议不要重复打卡。', 'data' => []);
        return $response->withJson($json);
      }
      //
    }

    public function worktimelog($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('executiveIndex');
      $sc = $_COOKIE['subcomid'];
      if(isset($args['year'])){
        $year = $args['year'];
      }else{
        $year = date('Y');
      }

      if(isset($args['month'])){
        $month = $args['month'];
      }else{
        $month = date('m');
      }

      if(isset($args['day'])){
        $day = $args['day'];
      }else{
        $day = date('d');
      }

      $u = $db->select('member',[
          'member.id(id)',
          'member.name(name)'
        ],[
          'AND'=>[
            'status' => 1,
            'subcompany' => $sc
          ]
        ]);
      $list = [];
      $i=0;
      foreach ($u as $ul) {
        $list[$i]['id'] = $ul['id'];
        $list[$i]['name'] = $ul['name'];
        
        $hasdaily = $db->get('member_daily','*',[
        'AND'=>[
          'day'=>"$year-$month-$day",
          'uid'=>$ul['id']
          ]
        ]);
        $list[$i]['hasdaily'] = $hasdaily;

        $wt = $db->select('member_worktime','*',[
            'AND'=>[
              'member_worktime.workday'=>"$year-$month-$day",
              'staffid'=>$ul['id']
            ]
            
          ]);
        $list[$i]['worktime'] = $wt;
        $list[$i]['workday'] = "$year-$month-$day";
        $i++;
      }
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'list' => $list,
        'thisyear' => $year,
        'thismonth' => $month,
        'thisday' => $day
      ];
      return $this->app->renderer->render($response, './executive_kq.php', $as);
    }

    //外勤事务
    public function minelog($request, $response, $args){
       global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('executiveIndex');
      $sc = $_COOKIE['subcomid'];
      // var_dump($sc);
      // exit;
       if(isset($args['year'])){
        $year = $args['year'];
      }else{
        $year = date('Y');
      }

      if(isset($args['month'])){
        $month = $args['month'];
      }else{
        $month = date('m');
      }

      if(isset($args['day'])){
        $day = $args['day'];
      }else{
        $day = date('d');
      }
      //查询外勤表信息
     $c=$db->select('member_mine',[
         'member_mine.id(id)',
          'member_mine.name(name)',
          'member_mine.shiwu(shiwu)',
          'member_mine.ortime(ortime)',
          'member_mine.resd(resd)',
          'member_mine.worktime(worktime)',
          'member_mine.time(time)',          
      ],
      ['ORDER'=>['id'=>'DESC']]);
      //点击日期查询数据
     $a=$db->select('member_mine','*',[
          'worktime'=>"$year-$month-$day",
      ]);
      $list = [];
      $i=0;
      foreach ($a as $ul) {
        $list[$i]['id'] = $ul['id'];
        $list[$i]['name'] = $ul['name'];
        $list[$i]['shiwu'] = $ul['shiwu'];
        $list[$i]['ortime'] = $ul['ortime'];
        $list[$i]['resd'] = $ul['resd'];
        $list[$i]['worktime'] = $ul['worktime'];
        $list[$i]['time'] = $ul['time'];        
        $wt = $db->select('member_mine','*',[
            'AND'=>[
              'member_mine.worktime'=>"$year-$month-$day",              
            ]            
          ],
          ['ORDER'=>['id'=>'DESC']]);//倒序
        $list[$i]['worktime'] = $a;
        $i++;
      }
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,      
        'thisyear' => $year,
        'thismonth' => $month,
        'thisday' => $day,
        'list' => $list,
        'c'=>$c        
      ];
      return $this->app->renderer->render($response, './executive_wq.php', $as);
       
    }

    //查看外勤具体信息
    public function notdetail($request, $response, $args){      
       global $flag,$msg,$data,$db;
      $id=$args;
      $path = $this->app->router->pathFor('executiveIndex');
      $sc = $_COOKIE['subcomid'];
      if(isset($args['year'])){
        $year = $args['year'];
      }else{
        $year = date('Y');
      }

      if(isset($args['month'])){
        $month = $args['month'];
      }else{
        $month = date('m');
      }

      if(isset($args['day'])){
        $day = $args['day'];
      }else{
        $day = date('d');
      }

      $u = $db->select('member',[
          'member.id(id)',
          'member.name(name)'
        ],[
          'AND'=>[
            'status' => 1,
            'subcompany' => $sc
          ]
        ]);
    //查询外勤表信息
     $mode=$db->get('member_mine','*',[
        'id'=>$id,
      ]); 
      //查询外勤类型
      $type=$db->select('contract_type',[
            'contract_type.typename(typename)',
      ],[
            'pid'=>0,
      ]);
     
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,      
        'thisyear' => $year,
        'thismonth' => $month,
        'thisday' => $day,
        'mode'=>$mode,
        'type'=>$type,
        
      ];     
      return $this->app->renderer->render($response, './executive_detail.php', $as);    
    }

    //出外勤信息添加
    public function notadd($request,$response,$args){
       global $flag,$msg,$data,$db;
        $id=$args;
      $path = $this->app->router->pathFor('executiveIndex');
      $sc = $_COOKIE['subcomid'];
      $mo=$_COOKIE['mobile'];
      //查询用户信息
      $mode=$db->get('member','*',[
        'mobile'=>$mo,
      ]);
      // 查询部门信息
             $b=$db->get('member_department',[
                'member_department.departmentname(departmentname)',
              ],[
                'id'=>$mode['department'],
              ]);
             //查询区域部门
            $sub=$db->get('member_subcompany',[
              'member_subcompany.subcompanyname(subcompanyname)',
                
              ],[
                  'id'=>$mode['subcompany'],
              ]);
            $red=$db->get('member_position',[
              'member_position.positionname(positionname)',
              ],[
              'id'=>$mode['position'],
              ]);
              //查询外勤类型
              $type=$db->select('contract_type',[
                  'contract_type.typename(typename)',
                ],[
                  'pid'=>0,
                ]);
              // var_dump($type);
              // exit;

      if(isset($args['year'])){
        $year = $args['year'];
      }else{
        $year = date('Y');
      }

      if(isset($args['month'])){
        $month = $args['month'];
      }else{
        $month = date('m');
      }

      if(isset($args['day'])){
        $day = $args['day'];
      }else{
        $day = date('d');
      }

      $u = $db->select('member',[
          'member.id(id)',
          'member.name(name)'
        ],[
          'AND'=>[
            'status' => 1,
            'subcompany' => $sc
          ]
        ]);

      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,      
        'thisyear' => $year,
        'thismonth' => $month,
        'thisday' => $day,
        'mode'=>$mode,
        'b'=>$b,
        'sub'=>$sub,
        'red'=>$red,
        'type'=>$type,               
      ];    
      return $this->app->renderer->render($response, './executive_add.php',$as);     
    }

    //外勤信息添加
    public function notinsert($request,$response,$args){
        global $flag,$msg,$data,$db;
        // var_dump($_POST);
        // exit;
           $sc = $_COOKIE['subcomid'];
           $mo=$_COOKIE['mobile'];
          $time=$_POST['YYYY'].'-'.$_POST['MM'].'-'.$_POST['DD'].' '.$_POST['HH'].'时'.$_POST['II'].'分';
          $ortime=$_POST['YY'].'-'.$_POST['MO'].'-'.$_POST['DE'].' '.$_POST['H'].'时'.$_POST['I'].'分';           
           $address=$_POST['prov'].'-'.$_POST['city'].'-'.$_POST['area'].'-'.$_POST['addr'];
           $s=date('Y-m-d H:i:s');
           $t=$_POST['YYYY'].'-'.$_POST['MM'].'-'.$_POST['DD']; 

            $a=$db->insert('member_mine',[
              'name' => $_POST['name'],
              'mobile' => $_POST['mobile'],
              'shiwu' => $_POST['shiwu'],
              'address' => $address,
              'time' => $time,
              'departmentname'=>$_POST['departmentname'],
              'ortime' => $ortime,
              'shuo' => $_POST['shuo'],              
              'resd' => $s,
              'worktime' => $t,
              ]);
             $path = $this->app->router->pathFor('executiveIndex');
     

      if(isset($args['year'])){
        $year = $args['year'];
      }else{
        $year = date('Y');
      }

      if(isset($args['month'])){
        $month = $args['month'];
      }else{
        $month = date('m');
      }

      if(isset($args['day'])){
        $day = $args['day'];
      }else{
        $day = date('d');
      }

     //点击日期查询数据
     $a=$db->select('member_mine','*',[
          'worktime'=>"$year-$month-$day",
      ]);
      $list = [];
      $i=0;
      foreach ($a as $ul) {
        $list[$i]['id'] = $ul['id'];
        $list[$i]['name'] = $ul['name'];
        $list[$i]['shiwu'] = $ul['shiwu'];
        $list[$i]['ortime'] = $ul['ortime'];
        $list[$i]['resd'] = $ul['resd'];
        $list[$i]['worktime'] = $ul['worktime'];
        $list[$i]['time'] = $ul['time'];        

        $wt = $db->select('member_mine','*',[
            'AND'=>[
              'member_mine.worktime'=>"$year-$month-$day",
              
            ]
            
          ]);
        $list[$i]['worktime'] = $a;
        $i++;
      }
    //查询外勤表信息
     $c=$db->select('member_mine',[
         'member_mine.id(id)',
          'member_mine.name(name)',
          'member_mine.shiwu(shiwu)',
          'member_mine.ortime(ortime)',
           'member_mine.resd(resd)', 
             'member_mine.time(time)',          
      ]);
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,      
        'thisyear' => $year,
        'thismonth' => $month,
        'thisday' => $day,
        'c'=>$c,
        'list'=>$list,
        
      ];          
      return $this->app->renderer->render($response, './executive_wq.php', $as);           
    }

    //修改外勤信息、、、、、、、、、、、
    public function notupdate($request,$response,$args){       
       global $flag,$msg,$data,$db;
       //修改信息
       $s=date('Y-m-d H:i:s'); 
       $id=$_POST['id'];
       $a=$db->update('member_mine',[
              'name' => $_POST['name'],
              'mobile' => $_POST['mobile'],
              'shiwu' => $_POST['shiwu'],
              'address' => $_POST['address'],
              'time' => $_POST['time'],
              'ortime' => $_POST['ortime'],
              'shuo' => $_POST['shuo'],              
              'resd' => $s,
        ],[
          'id'=>$id,
        ]);

      $path = $this->app->router->pathFor('executiveIndex');
      $sc = $_COOKIE['subcomid'];

      if(isset($args['year'])){
        $year = $args['year'];
      }else{
        $year = date('Y');
      }

      if(isset($args['month'])){
        $month = $args['month'];
      }else{
        $month = date('m');
      }

      if(isset($args['day'])){
        $day = $args['day'];
      }else{
        $day = date('d');
      }

      $u = $db->select('member',[
          'member.id(id)',
          'member.name(name)'
        ],[
          'AND'=>[
            'status' => 1,
            'subcompany' => $sc
          ]
        ]);
    //查询外勤表信息
     $c=$db->select('member_mine',[
         'member_mine.id(id)',
          'member_mine.name(name)',
          'member_mine.shiwu(shiwu)',
          'member_mine.ortime(ortime)',
           'member_mine.resd(resd)',                                  
      ]); 
       //点击日期查询数据
     $a=$db->select('member_mine','*',[
          'worktime'=>"$year-$month-$day",
      ]);
      $list = [];
      $i=0;
      foreach ($a as $ul) {
        $list[$i]['id'] = $ul['id'];
        $list[$i]['name'] = $ul['name'];
        $list[$i]['shiwu'] = $ul['shiwu'];
        $list[$i]['ortime'] = $ul['ortime'];
        $list[$i]['resd'] = $ul['resd'];
        $list[$i]['worktime'] = $ul['worktime'];
        $list[$i]['time'] = $ul['time'];        

        $wt = $db->select('member_mine','*',[
            'AND'=>[
              'member_mine.worktime'=>"$year-$month-$day",
              
            ]
            
          ]);
        $list[$i]['worktime'] = $a;
        $i++;
      }
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,      
        'thisyear' => $year,
        'thismonth' => $month,
        'thisday' => $day,
        'c'=>$c,
        'list'=>$list,
               
      ];          
      return $this->app->renderer->render($response, './executive_wq.php', $as);        
    }

    //节日福利模块开始
    //加载查询节日福利列表//////////////////////////////////
    public function notselect($request,$response,$args){
         global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('executiveIndex');
      $sc = $_COOKIE['subcomid'];
       if(isset($args['year'])){
        $year = $args['year'];
      }else{
        $year = date('Y');
      }
      if(isset($args['month'])){
        $month = $args['month'];
      }else{
        $month = date('m');
      }

      if(isset($args['day'])){
        $day = $args['day'];
      }else{
        $day = date('d');
      }
      //查询所有节日福利数据数据
      $welfare=$db->select('member_welfare','*',[
            'ORDER'=>['id'=>'DESC'],
        ]);
      //点击日期查询数据
     $a=$db->select('member_welfare','*',[
          'stime'=>"$year-$month-$day",
      ],[
        'ORDER'=>['id'=>'DESC'],
      ]);
      $list = [];
      $i=0;
      foreach ($a as $ul) {
        $list[$i]['id'] = $ul['id'];
        $list[$i]['jname'] = $ul['jname'];
        $list[$i]['jtime'] = $ul['jtime'];
        $list[$i]['statu'] = $ul['statu'];
        $list[$i]['wname'] = $ul['wname'];        
        $wt = $db->select('member_welfare','*',[
            'AND'=>[
              'member_mine.stime'=>"$year-$month-$day",             
            ]           
          ]);
        $list[$i]['stime'] = $a;
        $i++;
      }
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,      
        'thisyear' => $year,
        'thismonth' => $month,
        'thisday' => $day,
        'list' => $list,
        'welfare'=>$welfare,
      ];
      return $this->app->renderer->render($response, './executive_jie.php', $as);
    }
    //添加节日福利页面。。。。。。。。。。。。。。。。。。。。
    public function notjieadd($request,$response,$args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('executiveIndex');
      $sc = $_COOKIE['subcomid'];
      $mo=$_COOKIE['mobile'];
      //查询用户信息
      $mode=$db->get('member','*',[
        'mobile'=>$mo,
      ]);
      //查询库存表
      $wsock=$db->select('member_wstock',[
          'member_wstock.id(id)',
          'member_wstock.name(name)',
        ]);
      if(isset($args['year'])){
        $year = $args['year'];
      }else{
        $year = date('Y');
      }
      if(isset($args['month'])){
        $month = $args['month'];
      }else{
        $month = date('m');
      }

      if(isset($args['day'])){
        $day = $args['day'];
      }else{
        $day = date('d');
      }
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,      
        'thisyear' => $year,
        'thismonth' => $month,
        'thisday' => $day,
        'mode'=>$mode,
        'wsock'=>$wsock,              
      ];    
      return $this->app->renderer->render($response, './executive_jieadd.php',$as);   
    }
    //节日信息写入数据库
    public function notjieinsert($request,$response,$args){
          $time=$_POST['YYYY'].'-'.$_POST['MM'].'-'.$_POST['DD'];//开始时间
          global $flag,$msg,$data,$db;
          $path = $this->app->router->pathFor('executiveIndex');
          $stime=date('Y-n-j');
          $wtime=date('Y-m-d H:i:s');
          $sc = $_COOKIE['subcomid'];
          $mo=$_COOKIE['mobile'];
          //查询用户信息
          $mode=$db->get('member','*',[
            'mobile'=>$mo,
          ]);
          //查询仓库表得到物品id
          $wstock=$db->get('member_wstock','*',[
              'name'=>$_POST['wname'],
            ]);
          //将数据写入节日数据库member_welfare
          $welfare=$db->insert('member_welfare',[
            'jname'=>$_POST['jname'],//节日名称
            'jtime'=>$time,//节日开始时间
            'wname'=>$_POST['wname'],//发放物品的名称
            'jcontent'=>$_POST['jcontent'],//备注
            'uid'=>$_POST['id'],//登录用户的id
            'statu'=>'0',//状态 默认为0未发放1已发放
            'stime'=>$stime,//与日期查询匹配
            'pid'=>$wstock['id'],//物品的id
            'wftime'=>$wtime,//提交时间
            'number'=>$_POST['number'],
            ]);
          //写入操作记录
          $stock=$db->insert('member_stock',[
              'wname'=>$_POST['wname'],//物品名称
              // 'wstatus'=>'1',//状态 与添加物品等区分开
              'wtime'=>$wtime,//操作时间
              'tname'=>$mode['name'],//员工米鞥成
              'remarks'=>$_POST['jcontent'],//备注
              'wupdate'=>'福利发放',//操作内容
              'uid'=>$_POST['id'],//员工id
              'upid'=>$wstock['id'],//发放物品的id
              'sc'=>$mode['name'],//发放人
              'stime'=>$stime,//匹配点击日期查询
              'number'=>$_POST['number'],//规定申请的数量
            ]);
          if(isset($args['year'])){
            $year = $args['year'];
          }else{
            $year = date('Y');
          }
          if(isset($args['month'])){
            $month = $args['month'];
          }else{
            $month = date('m');
          }

          if(isset($args['day'])){
            $day = $args['day'];
          }else{
            $day = date('d');
          }
          //查询所有节日福利数据数据
          $welfare=$db->select('member_welfare','*');
          //点击日期查询数据
         $a=$db->select('member_welfare','*',[
              'stime'=>"$year-$month-$day",
          ]);
          $list = [];
          $i=0;
          foreach ($a as $ul) {
            $list[$i]['id'] = $ul['id'];
            $list[$i]['jname'] = $ul['jname'];
            $list[$i]['jtime'] = $ul['jtime'];
            $list[$i]['statu'] = $ul['statu'];
            $list[$i]['wname'] = $ul['wname'];        
            $wt = $db->select('member_welfare','*',[
                'AND'=>[
                  'member_mine.stime'=>"$year-$month-$day",             
                ]           
              ]);
            $list[$i]['stime'] = $a;
            $i++;
          }
          $as = [
            'settings'=>$this->app->get('settings'),
            'path' => $path,      
            'thisyear' => $year,
            'thismonth' => $month,
            'thisday' => $day,
            'list' => $list,
            'welfare'=>$welfare,
          ];
      return $this->app->renderer->render($response, './executive_jie.php', $as);

    }

    //点击发放修改状态并写入操作记录
    public function notgrant($request,$response,$args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('executiveIndex');
      $sc = $_COOKIE['subcomid'];
      $mo=$_COOKIE['mobile'];
      $time=date('Y-m-d H:i:s');
      $stime=date('Y-n-j');
      //查询用户信息
      $mode=$db->get('member','*',[
        'mobile'=>$mo,
      ]);
      //根据id修改节日表member_welfare里的状态
        $up=$db->update('member_welfare',[
            'statu'=>'1',
          ],[
              'id'=>$args,
          ]);
        //查询几日表的信息
        $welfare=$db->get('member_welfare','*',[
              'id'=>$args,
          ]);
            //查询仓库表得到物品id
          $wstock=$db->get('member_wstock','*',[
              'id'=>$welfare['pid'],
            ]);
        //写入记录表member_stock
        $stock=$db->insert('member_stock',[
            'wname'=>$welfare['wname'],//物品名称
            'number'=>$welfare['number'],//操作数量
            // 'wstatus'=>'1',//状态
            'wtime'=>$time,//提交时间
            'wupdate'=>'发放',//操作类型
            'upid'=>$wstock['id'],//物品id
            'sc'=>$mode['name'],//操作员工名字
            'stime'=>$stime,//匹配时间
            'uid'=>$mode['id'],//登录员工的id
          ]);
       if(isset($args['year'])){
        $year = $args['year'];
      }else{
        $year = date('Y');
      }
      if(isset($args['month'])){
        $month = $args['month'];
      }else{
        $month = date('m');
      }
      if(isset($args['day'])){
        $day = $args['day'];
      }else{
        $day = date('d');
      }
      //查询所有节日福利数据数据
      $welfare=$db->select('member_welfare','*');
      //点击日期查询数据
     $a=$db->select('member_welfare','*',[
          'stime'=>"$year-$month-$day",
      ]);
      $list = [];
      $i=0;
      foreach ($a as $ul) {
        $list[$i]['id'] = $ul['id'];
        $list[$i]['jname'] = $ul['jname'];
        $list[$i]['jtime'] = $ul['jtime'];
        $list[$i]['statu'] = $ul['statu'];
        $list[$i]['wname'] = $ul['wname'];        
        $wt = $db->select('member_welfare','*',[
            'AND'=>[
              'member_mine.stime'=>"$year-$month-$day",             
            ]           
          ]);
        $list[$i]['stime'] = $a;
        $i++;
      }
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,      
        'thisyear' => $year,
        'thismonth' => $month,
        'thisday' => $day,
        'list' => $list,
        'welfare'=>$welfare,
      ];
      return $this->app->renderer->render($response, './executive_jie.php', $as);
    }
    //点击领取 写入记录表  领取的数量减去长裤的数量在修改回去
    public function notreceive($request,$response,$args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('executiveIndex');
      $sc = $_COOKIE['subcomid'];
      $mo=$_COOKIE['mobile'];
      $time=date('Y-m-d H:i:s');
      $stime=date('Y-n-j');
      //查询用户信息
      $mode=$db->get('member','*',[
        'mobile'=>$mo,
      ]);
      //根据传过来的id来查询节日福利发放表
      $welfare=$db->get('member_welfare','*',[
            'id'=>$args,
        ]);
      //查询仓库表
      $wstock=$db->get('member_wstock','*',[
            'id'=>$welfare['pid'],
        ]);
      $g=$wstock['number']-$welfare['number'];
     //  //将新的数量修改回数据库
      $update=$db->update('member_wstock',[
            'number'=>$g,
        ],[
            'id'=>$welfare['pid'],
        ]);
     //   //写入记录表member_stock
        $stock=$db->insert('member_stock',[
            'wname'=>$welfare['wname'],//物品名称
            'number'=>$welfare['number'],//操作数量
            'tname'=>$mode['name'],//领取人姓名
            'wmobile'=>$mode['mobile'],//领取人电话
            'wstatus'=>'1',//状态
            'wtime'=>$time,//提交时间
            'wupdate'=>'领取',//操作类型
            'upid'=>$wstock['id'],//物品id
            'stime'=>$stime,//匹配时间
            'uid'=>$mode['id'],//登录员工的id
            'jid'=>$args['id'],//节日表id
          ]);
        if(isset($args['year'])){
        $year = $args['year'];
      }else{
        $year = date('Y');
      }
      if(isset($args['month'])){
        $month = $args['month'];
      }else{
        $month = date('m');
      }
      if(isset($args['day'])){
        $day = $args['day'];
      }else{
        $day = date('d');
      }
      //查询所有节日福利数据数据
      $welfare=$db->select('member_welfare','*',[
              'ORDER'=>['id'=>'DESC'],
        ]);
      //点击日期查询数据
     $a=$db->select('member_welfare','*',[
          'stime'=>"$year-$month-$day",
      ],[
          'ORDER'=>['id'=>'DESC'],
      ]);
      $list = [];
      $i=0;
      foreach ($a as $ul) {
        $list[$i]['id'] = $ul['id'];
        $list[$i]['jname'] = $ul['jname'];
        $list[$i]['jtime'] = $ul['jtime'];
        $list[$i]['statu'] = $ul['statu'];
        $list[$i]['wname'] = $ul['wname'];        
        $wt = $db->select('member_welfare','*',[
            'AND'=>[
              'member_mine.stime'=>"$year-$month-$day",             
            ]           
          ]);
        $list[$i]['stime'] = $a;
        $i++;
      }
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,      
        'thisyear' => $year,
        'thismonth' => $month,
        'thisday' => $day,
        'list' => $list,
        'welfare'=>$welfare,
      ];
      return $this->app->renderer->render($response, './executive_jie.php', $as);
    }
    //查看领取记录信息
    public function notjledit($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('executiveIndex');
      $sc = $_COOKIE['subcomid'];
      $mo=$_COOKIE['mobile'];
      //查询用户信息
      $mode=$db->get('member','*',[
        'mobile'=>$mo,
      ]);
        if(isset($args['year'])){
        $year = $args['year'];
      }else{
        $year = date('Y');
      }
      if(isset($args['month'])){
        $month = $args['month'];
      }else{
        $month = date('m');
      }
      if(isset($args['day'])){
        $day = $args['day'];
      }else{
        $day = date('d');
      }
      //查询所有节日领取的操作记录member_stock
      $stock=$db->select('member_stock','*',[
            'jid'=>$args,
        ]);
      //点击日期查询数据
     $a=$db->select('member_stock','*',[
          'OR'=>[
          'stime'=>"$year-$month-$day",
          'jid'=>$args,
          ]
      ],[
          'ORDER'=>['id'=>'DESC'],
      ]);
      $list = [];
      $i=0;
      foreach ($a as $ul) {
        $list[$i]['id'] = $ul['id'];//id
        $list[$i]['tname'] = $ul['tname']; //领取员工      
        $list[$i]['wmobile'] = $ul['wmobile']; //电话      
        $list[$i]['wname'] = $ul['wname'];//物品名称
        $list[$i]['number'] = $ul['number'];//物品数量
        $list[$i]['wtime'] = $ul['wtime']; //领取时间       
        $wt = $db->select('member_welfare','*',[
            'AND'=>[
              'member_mine.stime'=>"$year-$month-$day",
              'jid'=>$args,             
            ]           
          ]);
        $list[$i]['stime'] = $a;
        $i++;
      }
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,      
        'thisyear' => $year,
        'thismonth' => $month,
        'thisday' => $day,
        'list' => $list,
        'stock'=>$stock,
      ];
      return $this->app->renderer->render($response, './executive_jledit.php', $as);
    }
    public function dailyform($request, $response, $args){
      global $flag,$msg,$data,$db;
      $m = $db->get('member_daily','*',[
        'AND'=>[
          'day'=>date('Y-m-d'),
          'uid'=>$_COOKIE['staffID']
          ]
        ]);
      $as = [
        'settings' => $this->app->get('settings'),
        'm' => $m
      ];
      return $this->app->renderer->render($response, './dailyform.php', $as);
    }

    public function dailysave($request, $response, $args){
      global $flag,$msg,$data,$db;
      $daily = $_POST['editorValue'];
      $has = $db->get('member_daily','*',[
        'AND'=>[
          'day'=>date('Y-m-d'),
          'uid'=>$_COOKIE['staffID']
          ]
        ]);
      if($has){
        $db->update('member_daily',[
          'daily' => $daily
          ],[
        'AND'=>[
          'day'=>date('Y-m-d'),
          'uid'=>$_COOKIE['staffID']
          ]
        ]);
      }else{
        $db->insert('member_daily',[
          'day' => date('Y-m-d'),
          'uid' => $_COOKIE['staffID'],
          'daily' => $daily,
          'creattime' => date('Y-m-d H:i:s')
        ]);
      }
      $json = array('flag' => 200,'msg' => '日报已保存成功', 'data' => []);
        return $response->withJson($json);
    }

    public function dailydetail($request, $response, $args){
      global $flag,$msg,$data,$db;
      $m = $db->get('member_daily','*',[
        'AND'=>[
          'day'=>$args['day'],
          'uid'=>$args['uid']
          ]
        ]);
      $as = [
        'settings' => $this->app->get('settings'),
        'm' => $m
      ];
      return $this->app->renderer->render($response, './dailydetail.php', $as);
    }

    public function workplandetail($request, $response, $args){
      global $flag,$msg,$data,$db;

      $m = $db->get('member_workplan',[
            '[>]member(m1)'=>['member_workplan.creatstaffId'=>'id']
            ],[
            'member_workplan.id(id)',
            'member_workplan.title(title)',
            'member_workplan.startday(startday)',
            'member_workplan.endday(endday)',
            'member_workplan.status(status)',
            'member_workplan.plancontent(plancontent)',
            'member_workplan.level(level)',
            'member_workplan.creattime(creattime)',
            'm1.name(creatName)',
            ],['member_workplan.id'=>$args['id']]);
      
      $as = [
        'settings' => $this->app->get('settings'),
        'm' => $m
      ];
      return $this->app->renderer->render($response, './workplandetail.php', $as);
    }
    //加载物品列表页
    public function notapply($request, $response, $args){
      global $flag,$msg,$data,$db;
       $path = $this->app->router->pathFor('executiveIndex');
      $sc = $_COOKIE['subcomid'];
       if(isset($args['year'])){
        $year = $args['year'];
      }else{
        $year = date('Y');
      }
      if(isset($args['month'])){
        $month = $args['month'];
      }else{
        $month = date('m');
      }
      if(isset($args['day'])){
        $day = $args['day'];
      }else{
        $day = date('d');
      }
      //查询数据
      $goods=$db->select('member_wstock',[
          'member_wstock.id(id)',
          'member_wstock.name(name)',
          'member_wstock.number(number)',
          'member_wstock.wtime(wtime)',
        ],[
          'ORDER'=>['id'=>'DESC'],
        ]);
      //点击日期查询数据
     $a=$db->select('member_wstock','*',[
          'wtime'=>"$year-$month-$day",
      ],[
          'ORDER'=>['id'=>'DESC'],
      ]);
      $list = [];
      $i=0;
      foreach ($a as $ul) {
        $list[$i]['id'] = $ul['id'];
        $list[$i]['name'] = $ul['name'];
        $list[$i]['number'] = $ul['number'];
        $list[$i]['wtime'] = $ul['wtime'];
        $wt = $db->select('member_wstock','*',[
            'AND'=>[
              'member_wstock.wtime'=>"$year-$month-$day",              
            ]            
          ]);
        $list[$i]['wtime'] = $a;
            $list[$i]['wtime'] = "$year-$month-$day";

        $i++;
      }
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,      
        'thisyear' => $year,
        'thismonth' => $month,
        'thisday' => $day,
        'list' => $list,
        'goods'=>$goods,
        'a'=>$a,                
      ];
      return $this->app->renderer->render($response, './executive_wlist.php', $as);
    }
    //加载添加物品页面
    public function notaddietms($request, $response, $args){
     global $flag,$msg,$data,$db;
        
      $path = $this->app->router->pathFor('executiveIndex');
      $sc = $_COOKIE['subcomid'];
      $mo=$_COOKIE['mobile'];
      //查询用户信息
      $mode=$db->get('member','*',[
        'mobile'=>$mo,
      ]);
      // 查询部门信息
             $b=$db->get('member_department',[
                'member_department.departmentname(departmentname)',
              ],[
                'id'=>$mode['department'],
              ]);
             //查询区域部门
            $sub=$db->get('member_subcompany',[
              'member_subcompany.subcompanyname(subcompanyname)',
                
              ],[
                  'id'=>$mode['subcompany'],
              ]);
            $red=$db->get('member_position',[
              'member_position.positionname(positionname)',
              ],[
              'id'=>$mode['position'],
              ]);

      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,      
        'mode'=>$mode,
        'b'=>$b,
        'sub'=>$sub,
        'red'=>$red,           
      ];    
      return $this->app->renderer->render($response, './executive_addietms.php',$as); 
    }

    //将添加的物品信息写入数据库
    public function notwinsert($request, $response, $args){
          global $flag,$msg,$data,$db;        
        $path = $this->app->router->pathFor('executiveIndex');
        $time=date('Y-n-j H:i:s');
        $stime=date('Y-n-j');
        $mo=$_COOKIE['mobile'];
         //查询用户信息
      $mode=$db->get('member','*',[
        'mobile'=>$mo,
      ]);
      $adde=$db->select('member_wstock',[
          'member_wstock.name(name)',
        ]);     
      $sc = $_COOKIE['subcomid'];
       if(isset($args['year'])){
        $year = $args['year'];
      }else{
        $year = date('Y');
      }
      if(isset($args['month'])){
        $month = $args['month'];
      }else{
        $month = date('m');
      }
      if(isset($args['day'])){
        $day = $args['day'];
      }else{
        $day = date('d');
      }    
      //点击日期查询数据
     $a=$db->select('member_wstock','*',[
          'wtime'=>"$year-$month-$day",
      ]);
      $list = [];
      $i=0;
      foreach ($a as $ul) {
        $list[$i]['id'] = $ul['id'];
        $list[$i]['name'] = $ul['name'];
        $list[$i]['shiwu'] = $ul['shiwu'];
        $list[$i]['ortime'] = $ul['ortime'];
        $list[$i]['resd'] = $ul['resd'];
        $list[$i]['worktime'] = $ul['worktime'];
        $list[$i]['time'] = $ul['time'];        
        $wt = $db->select('member_mine','*',[
            'AND'=>[
              'member_mine.worktime'=>"$year-$month-$day",              
            ]            
          ]);
        $list[$i]['worktime'] = $a;
        $i++;
      }
        //写入数据库zscrm_member_stock
        $add=$db->insert('member_stock',[
          'wname'=>$_POST['wname'],
          'number'=>$_POST['number'],
          'wstatus'=>'0',
          'wtime'=>$time,
          'tname'=>$_POST['tname'],
          'wmobile'=>$_POST['wmobile'],
          'departmentname'=>$_POST['departmentname'],
          'remarks'=>$_POST['remarks'],
          'wupdate'=>'入库操作',

          ]);
          //写入数据库
          $addr=$db->insert('member_wstock',[
              'name'=>$_POST['wname'],
              'number'=>$_POST['number'],
              'wtime'=>$stime,
              'remarks'=>$_POST['remarks'],
            ]);      
        //查询数据
        $goods=$db->select('member_wstock',[
          'member_wstock.id(id)',
          'member_wstock.name(name)',
          'member_wstock.number(number)',
          'member_wstock.wtime(wtime)',          
        ]);
        // var_dump($goods);
        // exit;               
         $as = [
         'settings'=>$this->app->get('settings'),
        'path' => $path,      
        'thisyear' => $year,
        'thismonth' => $month,
        'thisday' => $day,
        'list' => $list,
        'goods'=>$goods,
        'mode'=>$mode,                         
      ];
      return $this->app->renderer->render($response, './executive_wlist.php', $as);                            
    }
    public function notaddit($request, $response, $args){
       global $flag,$msg,$data,$db;        
      $path = $this->app->router->pathFor('executiveIndex');
      $sc = $_COOKIE['subcomid'];
      $mo=$_COOKIE['mobile'];
      $time=date('Y-n-j');
      //查询用户信息
      $mode=$db->get('member','*',[
        'mobile'=>$mo,
      ]);
      // 查询部门信息
             $b=$db->get('member_department',[
                'member_department.departmentname(departmentname)',
              ],[
                'id'=>$mode['department'],
              ]);
             //查询区域部门
            $sub=$db->get('member_subcompany',[
              'member_subcompany.subcompanyname(subcompanyname)',
                
              ],[
                  'id'=>$mode['subcompany'],
              ]);
            $red=$db->get('member_position',[
              'member_position.positionname(positionname)',
              ],[
              'id'=>$mode['position'],
              ]);
            //查询物品库表
            $ku=$db->get('member_wstock','*',[
                'id'=>$args,
              ]);       
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,      
        'mode'=>$mode,
        'b'=>$b,
        'sub'=>$sub,
        'red'=>$red,
        'ku'=>$ku,//查询物品库表的name字段           
      ];    
      return $this->app->renderer->render($response, './executive_storage.php',$as); 
    }

    //修改物品数量
    public function notwupdate($request, $response, $args){
       global $flag,$msg,$data,$db;        
        $path = $this->app->router->pathFor('executiveIndex');
        $sc = $_COOKIE['subcomid'];
        $mo=$_COOKIE['mobile'];
        $time=date('Y-m-d H:i:s');
        //查询仓库表
        $cang=$db->get('member_wstock','*',[
          'id'=>$_POST['id'],
          ]);
        $num=$cang['number']+$_POST['number'];//输入的数量与查询的数量相加
        //修改数量
        $cangku=$db->update('member_wstock',[
            'number'=>$num,
          ],[
            'id'=>$_POST['id'],
          ]);
        //把追加库存的操作数据写入操作列表
        $ca=$db->insert('member_stock',[
          'number'=>$_POST['number'],//商品数量
          'remarks'=>$_POST['remarks'],//商品说明
          'tname'=>$_POST['tname'],//入库人的名字
          'wmobile'=>$_POST['wmobile'],//入库人电话
          'departmentname'=>$_POST['departmentname'],//入库人的所在部门
          'wname'=>$_POST['wname'],//商品名字            
          'wtime'=>$time,//入库时间
          'wstatus'=>'0',//状态
          'wupdate'=>'入库操作',//出入库
          'qian'=>$cang['number'],
          'znumber'=>$num,
          'upid'=>$_POST['id'],
          ]);       
           //查询用户信息
      $mode=$db->get('member','*',[
        'mobile'=>$mo,
      ]);
      $adde=$db->select('member_wstock',[
          'member_wstock.name(name)',
        ]);     
      $sc = $_COOKIE['subcomid'];
       if(isset($args['year'])){
        $year = $args['year'];
      }else{
        $year = date('Y');
      }
      if(isset($args['month'])){
        $month = $args['month'];
      }else{
        $month = date('m');
      }
      if(isset($args['day'])){
        $day = $args['day'];
      }else{
        $day = date('d');
      }    
      //点击日期查询数据
     $a=$db->select('member_mine','*',[
          'worktime'=>"$year-$month-$day",
      ]);
      $list = [];
      $i=0;
      foreach ($a as $ul) {
        $list[$i]['id'] = $ul['id'];
        $list[$i]['name'] = $ul['name'];
        $list[$i]['shiwu'] = $ul['shiwu'];
        $list[$i]['ortime'] = $ul['ortime'];
        $list[$i]['resd'] = $ul['resd'];
        $list[$i]['worktime'] = $ul['worktime'];
        $list[$i]['time'] = $ul['time'];        
        $wt = $db->select('member_mine','*',[
            'AND'=>[
              'member_mine.worktime'=>"$year-$month-$day",              
            ]            
          ]);
        $list[$i]['worktime'] = $a;
        $i++;
      }     
        //查询数据
        $goods=$db->select('member_wstock',[
          'member_wstock.id(id)',
          'member_wstock.name(name)',
          'member_wstock.number(number)',
          'member_wstock.wtime(wtime)',          
        ]);             
         $as = [
         'settings'=>$this->app->get('settings'),
        'path' => $path,      
        'thisyear' => $year,
        'thismonth' => $month,
        'thisday' => $day,
        'list' => $list,
        'goods'=>$goods,
        'mode'=>$mode,                         
      ];
      return $this->app->renderer->render($response, './executive_wlist.php', $as);      
    }
    //加载查看物品详细页面
    public function notwedit($request, $response, $args){
          global $flag,$msg,$data,$db;        
          $path = $this->app->router->pathFor('executiveIndex');
          $sc = $_COOKIE['subcomid'];
          $mo=$_COOKIE['mobile'];
          //查询用户信息
          $mode=$db->get('member','*',[
            'mobile'=>$mo,
          ]);
          // 查询部门信息
          $b=$db->get('member_department',[
              'member_department.departmentname(departmentname)',
          ],[
              'id'=>$mode['department'],
          ]);
          //查询区域部门
          $sub=$db->get('member_subcompany',[
              'member_subcompany.subcompanyname(subcompanyname)',
                    
          ],[
              'id'=>$mode['subcompany'],
          ]);
          $red=$db->get('member_position',[
              'member_position.positionname(positionname)',
          ],[
              'id'=>$mode['position'],
          ]);
          //查询库存表 显示库存信息
          $wstock=$db->get('member_wstock','*',[
              'id'=>$args,
            ]);
          $as = [
            'settings'=>$this->app->get('settings'),
            'path' => $path,      
            'mode'=>$mode,
            'b'=>$b,
            'sub'=>$sub,
            'red'=>$red,
            'wstock'=>$wstock,           
          ];    
          return $this->app->renderer->render($response, './executive_wpedit.php',$as); 
    }
    //执行数据修改和操作记录
    public function notwpupdate($request, $response, $args){
      global $flag,$msg,$data,$db;        
        $path = $this->app->router->pathFor('executiveIndex');
        $sc = $_COOKIE['subcomid'];
        $mo=$_COOKIE['mobile'];
        $time=date('Y-m-d H:i:s');
        //查询修改前仓库表
         $qian=$db->get('member_wstock','*',[
                  'id'=>$_POST['id'],
                  ]);

        //修改数量
        $cangku=$db->update('member_wstock',[
            'name'=>$_POST['wname'],
            'number'=>$_POST['number'],
            'remarks'=>$_POST['remarks'],
          ],[
            'id'=>$_POST['id'],
          ]);
        //查询修改后库存表
          $cang=$db->get('member_wstock','*',[
                  'id'=>$_POST['id'],
                  ]);

        //把追加库存的操作数据写入操作列表
        $ca=$db->insert('member_stock',[
          'number'=>$_POST['number'],//商品数量
          'remarks'=>$_POST['remarks'],//商品说明
          'tname'=>$_POST['tname'],//入库人的名字
          'wmobile'=>$_POST['wmobile'],//入库人电话
          'departmentname'=>$_POST['departmentname'],//入库人的所在部门
          'wname'=>$_POST['wname'],//商品名字            
          'wtime'=>$time,//时间
          'wstatus'=>'0',//状态
          'qian'=>$qian['number'],
          'znumber'=>$cang['number'],
          'wupdate'=>'修改操作',
          'upid'=>$_POST['id'],
          ]); 
           //查询用户信息
      $mode=$db->get('member','*',[
        'mobile'=>$mo,
      ]);
      $adde=$db->select('member_wstock',[
          'member_wstock.name(name)',
        ]);     
      $sc = $_COOKIE['subcomid'];
       if(isset($args['year'])){
        $year = $args['year'];
      }else{
        $year = date('Y');
      }
      if(isset($args['month'])){
        $month = $args['month'];
      }else{
        $month = date('m');
      }
      if(isset($args['day'])){
        $day = $args['day'];
      }else{
        $day = date('d');
      }    
      //点击日期查询数据
     $a=$db->select('member_mine','*',[
          'worktime'=>"$year-$month-$day",
      ]);
      $list = [];
      $i=0;
      foreach ($a as $ul) {
        $list[$i]['id'] = $ul['id'];
        $list[$i]['name'] = $ul['name'];
        $list[$i]['shiwu'] = $ul['shiwu'];
        $list[$i]['ortime'] = $ul['ortime'];
        $list[$i]['resd'] = $ul['resd'];
        $list[$i]['worktime'] = $ul['worktime'];
        $list[$i]['time'] = $ul['time'];        
        $wt = $db->select('member_mine','*',[
            'AND'=>[
              'member_mine.worktime'=>"$year-$month-$day",              
            ]            
          ]);
        $list[$i]['worktime'] = $a;
        $i++;
      }     
        //查询数据
        $goods=$db->select('member_wstock',[
          'member_wstock.id(id)',
          'member_wstock.name(name)',
          'member_wstock.number(number)',
          'member_wstock.wtime(wtime)',          
        ]);             
         $as = [
         'settings'=>$this->app->get('settings'),
        'path' => $path,      
        'thisyear' => $year,
        'thismonth' => $month,
        'thisday' => $day,
        'list' => $list,
        'goods'=>$goods,
        'mode'=>$mode,                         
      ];
      return $this->app->renderer->render($response, './executive_wlist.php', $as);
    }
    //加载申领页面。。。。。。。。。
    public function notrecadd($request, $response, $args){
           global $flag,$msg,$data,$db;        
            $path = $this->app->router->pathFor('executiveIndex');
            $sc = $_COOKIE['subcomid'];
            $mo=$_COOKIE['mobile'];
            //查询用户信息
            $mode=$db->get('member','*',[
              'mobile'=>$mo,
            ]);
            // 查询部门信息
             $b=$db->get('member_department',[
                  'member_department.departmentname(departmentname)',
             ],[
                  'id'=>$mode['department'],
            ]);
                   //查询区域部门
            $sub=$db->get('member_subcompany',[
                'member_subcompany.subcompanyname(subcompanyname)',
                      
            ],[
                'id'=>$mode['subcompany'],
            ]);
            $red=$db->get('member_position',[
                'member_position.positionname(positionname)',
            ],[
                'id'=>$mode['position'],
            ]);
            //查询仓库表
            $wstock=$db->get('member_wstock','*',[
                'id'=>$args,
              ]);
            $as = [
              'settings'=>$this->app->get('settings'),
              'path' => $path,      
              'mode'=>$mode,
              'b'=>$b,
              'sub'=>$sub,
              'red'=>$red,
              'wstock'=>$wstock,           
            ];    
            return $this->app->renderer->render($response, './executive_recadd.php',$as); 
    }
    //申请 申领表单提交 写入
    public function notsinsert($request, $response, $args){
       global $flag,$msg,$data,$db;
        $path = $this->app->router->pathFor('executiveIndex');
        $sc = $_COOKIE['subcomid'];
        $time=date('Y-m-d H:i:s');
        $stime=date('Y-n-j');
        //查询库存表
        $wstock=$db->get('member_wstock','*',[
            'id'=>$_POST['upid'],
          ]);
        //如果输入的数量大于库存的数量 阻止提交
        if($_POST['snumber']>$wstock['number']){
          return $response->withRedirect($this->app->router->pathFor('errorNoId'));
        }
        $snumber=$wstock['number']-$_POST['snumber'];
          //把申请物品写入操作记录member_stock
        $receive=$db->insert('member_stock',[
            'wname'=>$_POST['wname'],//申请申领物品的名称
            'number'=>$_POST['snumber'],//申请物品的数量
            'wstatus'=>'0',//状态
            'wtime'=>$time,//申领时间
            'tname'=>$_POST['tname'],//申领员工姓名
            'wmobile'=>$_POST['wmobile'],//申领员工的电话
            'departmentname'=>$_POST['departmentname'],//员工所在的区-部门-职位
            'remarks'=>$_POST['remarks'],//备注信息
            'qian'=>$_POST['number'],//申请物品前的库存
            'wupdate'=>'申请',
            'upid'=>$_POST['upid'],//申领物品的id
            'stime'=>$stime,//点击查询日期的时间字段            
          ]);
        //写入申请表member_receive
        $receive=$db->insert('member_receive',[
            'name'=>$_POST['tname'],//申领的员工姓名
            'letmname'=>$_POST['wname'],//申领的物品名
            'bmobile'=>$_POST['wmobile'],//申领的员工电话
            'department'=>$_POST['departmentname'],//员工所在的区-部门-职位
            'snumber'=>$_POST['snumber'],//员工申请的数量
            'btime'=>$time,//申请的提交时间
            'status'=>0,//状态 默认0
            'upid'=>$_POST['upid'],//申请物品的id
            'pid'=>$_POST['pid'],//申请员工的id
            'remarks'=>$_POST['remarks'],//备注信息
            'stime'=>$stime,//点击查询日期的时间字段
            'number'=>$_POST['number'],//库存总数量
          ]);
       if(isset($args['year'])){
        $year = $args['year'];
      }else{
        $year = date('Y');
      }
      if(isset($args['month'])){
        $month = $args['month'];
      }else{
        $month = date('m');
      }
      if(isset($args['day'])){
        $day = $args['day'];
      }else{
        $day = date('d');
      }
      //点击日期查询数据
     $a=$db->select('member_receive','*',[
          'stime'=>"$year-$month-$day",
      ],[
            'ORDER'=>['id'=>'DESC'],
      ]);
      $list = [];
      $i=0;
      foreach ($a as $ul) {
        $list[$i]['id'] = $ul['id'];
        $list[$i]['name'] = $ul['name'];//申请人的姓名
        $list[$i]['letmname'] = $ul['letmname'];//申请的物品名称
        $list[$i]['department'] = $ul['department'];//申请人所在的部门
        $list[$i]['snumber'] = $ul['snumber'];//申请物品的数量
        $list[$i]['btime'] = $ul['btime'];//填写申请的时间
        $list[$i]['number'] = $ul['number'];//总库存
        $list[$i]['status'] = $ul['status'];//状态
        $wt = $db->select('member_receive','*',[
            'AND'=>[
              'member_.stime'=>"$year-$month-$day",              
            ]            
          ],[
              'ORDER'=>['id'=>'DESC'],
          ]);
        $list[$i]['stime'] = $a;
            $list[$i]['stime'] = "$year-$month-$day";

        $i++;
      }
          //查询数据
        $goods=$db->select('member_receive','*',[
            'ORDER'=>['id'=>'DESC'],
          ]);
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,      
        'thisyear' => $year,
        'thismonth' => $month,
        'thisday' => $day,
        'list' => $list,
        'a'=>$a,
        'goods'=>$goods,                
      ];
      return $this->app->renderer->render($response, './executive_applyedit.php', $as);
    }
    //加载申请列表页
    public function notapplyedit($request, $response, $args){
      global $flag,$msg,$data,$db;
       $path = $this->app->router->pathFor('executiveIndex');
      $sc = $_COOKIE['subcomid'];
       if(isset($args['year'])){
        $year = $args['year'];
      }else{
        $year = date('Y');
      }
      if(isset($args['month'])){
        $month = $args['month'];
      }else{
        $month = date('m');
      }
      if(isset($args['day'])){
        $day = $args['day'];
      }else{
        $day = date('d');
      }
      //点击日期查询数据
     $a=$db->select('member_receive','*',[
          'stime'=>"$year-$month-$day",
      ]);
      $list = [];
      $i=0;
      foreach ($a as $ul) {
        $list[$i]['id'] = $ul['id'];
        $list[$i]['name'] = $ul['name'];//申请人的姓名
        $list[$i]['letmname'] = $ul['letmname'];//申请的物品名称
        $list[$i]['department'] = $ul['department'];//申请人所在的部门
        $list[$i]['snumber'] = $ul['snumber'];//申请物品的数量
        $list[$i]['btime'] = $ul['btime'];//填写申请的时间
        $list[$i]['number'] = $ul['number'];//总库存
        $list[$i]['status'] = $ul['status'];//状态
        $wt = $db->select('member_receive','*',[
            'AND'=>[
              'member_.stime'=>"$year-$month-$day",              
            ]            
          ]);
        $list[$i]['stime'] = $a;
            $list[$i]['stime'] = "$year-$month-$day";

        $i++;
      }
          //查询数据
        $goods=$db->select('member_receive','*');
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,      
        'thisyear' => $year,
        'thismonth' => $month,
        'thisday' => $day,
        'list' => $list,
        'a'=>$a,
        'goods'=>$goods,                
      ];
      return $this->app->renderer->render($response, './executive_applyedit.php', $as);
    }
    //加载详细信息并审批页面
    public function notrexamint($request, $response, $args){
        global $flag,$msg,$data,$db;
        $path = $this->app->router->pathFor('executiveIndex');
        $sc = $_COOKIE['subcomid'];
        //查询申请信息
        $apply=$db->get('member_receive','*',[
              'id'=>$args,
          ]);
            $as = [
              'settings'=>$this->app->get('settings'),
              'path' => $path,      
              'apply'=>$apply,           
            ];    
            return $this->app->renderer->render($response, './executive_examint.php',$as);
    }
    //同意申请物品
    public function notsagree($request, $response, $args){
         global $flag,$msg,$data,$db;
         $path = $this->app->router->pathFor('executiveIndex');
        $sc = $_COOKIE['subcomid'];
        $time=date('Y-m-d H:i:s');
        $stime=date('Y-n-j');
         $mo=$_COOKIE['mobile'];
            //查询用户信息
            $mode=$db->get('member','*',[
              'mobile'=>$mo,
            ]);
        //查询申请表
       $apply=$db->get('member_receive','*',[
              'id'=>$args,
          ]);
       // var_dump($apply);
       //查询仓库表
      $ws=$db->get('member_wstock','*',[
              'id'=>$apply,
          ]);
      // var_dump($ws);
      // exit;
       $unumber=$apply['number']-$apply['snumber'];
       
      //拿到相减的值后修改入库存表
      $wstock=$db->update('member_wstock',[
        'number'=>$unumber,
        ],[
          'id'=>$apply['upid'],
        ]);
        //把操作信息写入记录列表
      $insert=$db->insert('member_stock',[
          'wname'=>$apply['letmname'],//物品的名称
          'number'=>$apply['snumber'],//操作数量 或入或出
          'wtime'=>$time,//操作时间
          'tname'=>$apply['name'],//员工姓名
          'wmobile'=>$apply['bmobile'],//员工电话
          'departmentname'=>$apply['department'],//员工部门信息
          'remarks'=>$apply['remarks'],//说明
          'qian'=>$ws['number'],//未修改前的总库存
          'znumber'=>$unumber,//库存总数量
          'chu'=>$apply['snumber'],//出库的数量
          'wupdate'=>'出库操作',//操作状态
          'upid'=>$apply['upid'],//物品的id
          'sc'=>$mode['name'],//审核人的名称
          'stime'=>$stime//点击日期查询时需要的数据
        ]);
      //修改申请表里的状态和数量
      $receive=$db->update('member_receive',[
          'status'=>'1',
          'number'=>$unumber,
        ],[
          'id'=>$args,
        ]);
    
      if(isset($args['year'])){
        $year = $args['year'];
      }else{
        $year = date('Y');
      }
      if(isset($args['month'])){
        $month = $args['month'];
      }else{
        $month = date('m');
      }
      if(isset($args['day'])){
        $day = $args['day'];
      }else{
        $day = date('d');
      }
      //点击日期查询数据
     $a=$db->select('member_receive','*',[
          'stime'=>"$year-$month-$day",
      ]);
      $list = [];
      $i=0;
      foreach ($a as $ul) {
        $list[$i]['id'] = $ul['id'];
        $list[$i]['name'] = $ul['name'];//申请人的姓名
        $list[$i]['letmname'] = $ul['letmname'];//申请的物品名称
        $list[$i]['department'] = $ul['department'];//申请人所在的部门
        $list[$i]['snumber'] = $ul['snumber'];//申请物品的数量
        $list[$i]['btime'] = $ul['btime'];//填写申请的时间
        $list[$i]['number'] = $ul['number'];//总库存
        $list[$i]['status'] = $ul['status'];//状态
        $wt = $db->select('member_receive','*',[
            'AND'=>[
              'member_.stime'=>"$year-$month-$day",              
            ]            
          ]);
        $list[$i]['stime'] = $a;
            $list[$i]['stime'] = "$year-$month-$day";

        $i++;
      }
          //查询数据
        $goods=$db->select('member_receive','*');
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,      
        'thisyear' => $year,
        'thismonth' => $month,
        'thisday' => $day,
        'list' => $list,
        'a'=>$a,
        'goods'=>$goods,                
      ];
      return $this->app->renderer->render($response, './executive_applyedit.php', $as);

    }
    //查看物品的操作记录列表
    public function notrecord($request, $response, $args){
        global $flag,$msg,$data,$db;
         $path = $this->app->router->pathFor('executiveIndex');
        $sc = $_COOKIE['subcomid'];
        $time=date('Y-m-d H:i:s');
         $mo=$_COOKIE['mobile'];
            //查询用户信息
            $mode=$db->get('member','*',[
              'mobile'=>$mo,
            ]);      
      if(isset($args['year'])){
        $year = $args['year'];
      }else{
        $year = date('Y');
      }
      if(isset($args['month'])){
        $month = $args['month'];
      }else{
        $month = date('m');
      }
      if(isset($args['day'])){
        $day = $args['day'];
      }else{
        $day = date('d');
      }
      //点击日期查询数据
          $a = $db->select('member_stock','*',[
          'OR'=>[
            'upid'=>$args,
            'stime'=>"$year-$month-$day",
          ]
        ]);

      $list = [];
      $i=0;
      foreach ($a as $ul) {
        $list[$i]['id'] = $ul['id'];
        $list[$i]['tname'] = $ul['tname'];//申请人姓名
        $list[$i]['wname'] = $ul['wname'];//物品名称
        $list[$i]['wupdate'] = $ul['wupdate'];//操作目的
        $list[$i]['number'] = $ul['number'];//操作数量
        $list[$i]['wtime'] = $ul['wtime'];//操作数量                      
        $wt = $db->select('member_stock','*',[
            'AND'=>[
              'member_stock.stime'=>"$year-$month-$day",              
            ]            
          ]);
        $list[$i]['stime'] = $a;
            $list[$i]['stime'] = "$year-$month-$day";

        $i++;
      }
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,      
        'thisyear' => $year,
        'thismonth' => $month,
        'thisday' => $day,
        'list' => $list,               
      ];
      return $this->app->renderer->render($response, './executive_record.php', $as);
    }
    //超看具体的操作信息
    public function notcedit($request, $response, $args){
       global $flag,$msg,$data,$db;        
          $path = $this->app->router->pathFor('executiveIndex');
          $sc = $_COOKIE['subcomid'];
          //查询member_stock表的单条数据
          $stock=$db->get('member_stock','*',[
              'id'=>$args,
            ]);
          $as = [
            'settings'=>$this->app->get('settings'),
            'path' => $path,
            'stock'=>$stock,            
          ];    
          return $this->app->renderer->render($response, './executive_cedit.php',$as); 
    }
    ////////行政模块下的病事公假模块开始///////////////
    //加载病事公假列表页
    public function notsearch($request, $response, $args){
       global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('executiveIndex');
      $sc = $_COOKIE['subcomid'];
      $mo=$_COOKIE['mobile'];
        //查询用户信息
      $mode=$db->get('member','*',[
          'mobile'=>$mo,
      ]);
       if(isset($args['year'])){
        $year = $args['year'];
      }else{
        $year = date('Y');
      }

      if(isset($args['month'])){
        $month = $args['month'];
      }else{
        $month = date('m');
      }

      if(isset($args['day'])){
        $day = $args['day'];
      }else{
        $day = date('d');
      }
      //查询申请表 member_leave
    $c=$db->select('member_leave','*',[
        'ORDER'=>['id'=>'DESC'],
      ]);
      //点击日期查询数据
     $a=$db->select('member_leave','*',[
          'wtime'=>"$year-$month-$day",
      ],[
          'ORDER'=>['id'=>'DESC'],
      ]);

      $list = [];
      $i=0;
      foreach ($a as $ul) {
        $list[$i]['id'] = $ul['id'];
        $list[$i]['name'] = $ul['name'];
        $list[$i]['ontime'] = $ul['ontime'];
        $list[$i]['offtime'] = $ul['offtime'];
        $list[$i]['statu'] = $ul['statu'];
        $list[$i]['content'] = $ul['content'];
        $list[$i]['uid']=$ul['uid'];       

        $wt = $db->select('member_leave','*',[
            'AND'=>[
              'member_mine.wtime'=>"$year-$month-$day",              
            ]            
          ]);
        $list[$i]['wtime'] = $a;
        $i++;
      }
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,      
        'thisyear' => $year,
        'thismonth' => $month,
        'thisday' => $day,
        'list' => $list,
        'c'=>$c,
        'mode'=>$mode,
        
      ];
      return $this->app->renderer->render($response, './executive_search.php', $as);
    }
    //加载申请页面
    public function notleaveadd($request, $response, $args){
      global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('executiveIndex');
      $sc = $_COOKIE['subcomid'];
      $mo=$_COOKIE['mobile'];
      //查询用户信息
      $mode=$db->get('member','*',[
        'mobile'=>$mo,
      ]);
      // 查询部门信息
             $b=$db->get('member_department',[
                'member_department.departmentname(departmentname)',
              ],[
                'id'=>$mode['department'],
              ]);
             //查询区域部门
            $sub=$db->get('member_subcompany',[
              'member_subcompany.subcompanyname(subcompanyname)',
                
              ],[
                  'id'=>$mode['subcompany'],
              ]);
            $red=$db->get('member_position',[
              'member_position.positionname(positionname)',
              ],[
              'id'=>$mode['position'],
              ]);

      if(isset($args['year'])){
        $year = $args['year'];
      }else{
        $year = date('Y');
      }

      if(isset($args['month'])){
        $month = $args['month'];
      }else{
        $month = date('m');
      }

      if(isset($args['day'])){
        $day = $args['day'];
      }else{
        $day = date('d');
      }

      $u = $db->select('member',[
          'member.id(id)',
          'member.name(name)'
        ],[
          'AND'=>[
            'status' => 1,
            'subcompany' => $sc
          ]
        ]);

      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,      
        'thisyear' => $year,
        'thismonth' => $month,
        'thisday' => $day,
        'mode'=>$mode,
        'b'=>$b,
        'sub'=>$sub,
        'red'=>$red,
                     
      ];    
      return $this->app->renderer->render($response, './executive_leaveadd.php',$as);
    }
    //表单提交写入数据库
      public function notlinsert($request, $response, $args){
        global $flag,$msg,$data,$db;
        $path = $this->app->router->pathFor('executiveIndex');
        $sc = $_COOKIE['subcomid'];
        $ontime=$_POST['YYYY'].'-'.$_POST['MM'].'-'.$_POST['DD'];
        $offtime=$_POST['YY'].'-'.$_POST['MO'].'-'.$_POST['DE'];
        $stime=date('Y-m-d H:i:s');
        $wtime=date('Y-n-j');
        $mo=$_COOKIE['mobile'];
      //查询用户信息
      $mode=$db->get('member','*',[
        'mobile'=>$mo,
      ]);
        //将申请数据写入数据库
        $leave=$db->insert('member_leave',[
            'name'=>$_POST['name'],//员工姓名
            'uid'=>$_POST['uid'],//申请员工的id
            'ontime'=>$ontime,//开始时间
            'offtime'=>$offtime,//结束时间
            'content'=>$_POST['content'],//请假类型
            'statu'=>'0',
            'remarks'=>$_POST['remarks'],//备注
            'stime'=>$stime,
            'wtime'=>$wtime,
          ]);
        $mo=$_COOKIE['mobile'];
        //查询用户信息
      $mode=$db->get('member','*',[
          'mobile'=>$mo,
      ]);
       if(isset($args['year'])){
        $year = $args['year'];
      }else{
        $year = date('Y');
      }

      if(isset($args['month'])){
        $month = $args['month'];
      }else{
        $month = date('m');
      }

      if(isset($args['day'])){
        $day = $args['day'];
      }else{
        $day = date('d');
      }
      //查询申请表 member_leave
  $c=$db->select('member_leave','*');
      //点击日期查询数据
     $a=$db->select('member_leave','*',[
          'wtime'=>"$year-$month-$day",
      ]);

      $list = [];
      $i=0;
      foreach ($a as $ul) {
        $list[$i]['id'] = $ul['id'];
        $list[$i]['name'] = $ul['name'];
        $list[$i]['ontime'] = $ul['ontime'];
        $list[$i]['offtime'] = $ul['offtime'];
        $list[$i]['statu'] = $ul['statu'];
        $list[$i]['content'] = $ul['content'];       

        $wt = $db->select('member_leave','*',[
            'AND'=>[
              'member_mine.wtime'=>"$year-$month-$day",
              
            ]
            
          ]);
        $list[$i]['wtime'] = $a;
        $i++;
      }
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,      
        'thisyear' => $year,
        'thismonth' => $month,
        'thisday' => $day,
        'list' => $list,
        'c'=>$c,
        'mode'=>$mode,
        
      ];
      return $this->app->renderer->render($response, './executive_search.php', $as);  
      }
      //加载审核页面 
      public function nottiral($request, $response, $args){
         global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('executiveIndex');
      $sc = $_COOKIE['subcomid'];
      $mo=$_COOKIE['mobile'];
      //查询用户信息
      $mode=$db->get('member','*',[
        'mobile'=>$mo,
      ]);
      // 查询部门信息
             $b=$db->get('member_department',[
                'member_department.departmentname(departmentname)',
              ],[
                'id'=>$mode['department'],
              ]);
             //查询区域部门
            $sub=$db->get('member_subcompany',[
              'member_subcompany.subcompanyname(subcompanyname)',
                
              ],[
                  'id'=>$mode['subcompany'],
              ]);
            $red=$db->get('member_position',[
              'member_position.positionname(positionname)',
              ],[
              'id'=>$mode['position'],
              ]);
            //查询申请表
            $leave=$db->get('member_leave','*',[
                'id'=>$args,
              ]);
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,      
        'mode'=>$mode,
        'b'=>$b,
        'sub'=>$sub,
        'red'=>$red,
        'leave'=>$leave,
                     
      ];    
      return $this->app->renderer->render($response, './executive_tiral.php',$as);
      }

      //点击同意后的方法
      public function nottupdate($request, $response, $args){
        global $flag,$msg,$data,$db;
       $path = $this->app->router->pathFor('executiveIndex');
        $mo=$_COOKIE['mobile'];
      //查询登录用户信息
      $mode=$db->get('member','*',[
        'mobile'=>$mo,
      ]);
       //修改申请表里的状态 
       $leave=$db->update('member_leave',[
          'statu'=>'1',
          'check'=>$mode['name'],
        ],[
          'id'=>$args,
        ]);
         $mo=$_COOKIE['mobile'];
        //查询用户信息
      $mode=$db->get('member','*',[
          'mobile'=>$mo,
      ]);
       if(isset($args['year'])){
        $year = $args['year'];
      }else{
        $year = date('Y');
      }

      if(isset($args['month'])){
        $month = $args['month'];
      }else{
        $month = date('m');
      }

      if(isset($args['day'])){
        $day = $args['day'];
      }else{
        $day = date('d');
      }
      //查询申请表 member_leave
  $c=$db->select('member_leave','*');
      //点击日期查询数据
     $a=$db->select('member_leave','*',[
          'wtime'=>"$year-$month-$day",
      ]);

      $list = [];
      $i=0;
      foreach ($a as $ul) {
        $list[$i]['id'] = $ul['id'];
        $list[$i]['name'] = $ul['name'];
        $list[$i]['ontime'] = $ul['ontime'];
        $list[$i]['offtime'] = $ul['offtime'];
        $list[$i]['statu'] = $ul['statu'];
        $list[$i]['content'] = $ul['content'];       

        $wt = $db->select('member_leave','*',[
            'AND'=>[
              'member_mine.wtime'=>"$year-$month-$day",
              
            ]
            
          ]);
        $list[$i]['wtime'] = $a;
        $i++;
      }
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,      
        'thisyear' => $year,
        'thismonth' => $month,
        'thisday' => $day,
        'list' => $list,
        'c'=>$c,
        'mode'=>$mode,
        
      ];
      return $this->app->renderer->render($response, './executive_search.php', $as);
      }
      //加载查看详细申请信息页面
      public function nottiraledit($request, $response, $args){
         global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('executiveIndex');
      $sc = $_COOKIE['subcomid'];
      $mo=$_COOKIE['mobile'];
      //查询用户信息
      $mode=$db->get('member','*',[
        'mobile'=>$mo,
      ]);
      // 查询部门信息
             $b=$db->get('member_department',[
                'member_department.departmentname(departmentname)',
              ],[
                'id'=>$mode['department'],
              ]);
             //查询区域部门
            $sub=$db->get('member_subcompany',[
              'member_subcompany.subcompanyname(subcompanyname)',
                
              ],[
                  'id'=>$mode['subcompany'],
              ]);
            $red=$db->get('member_position',[
              'member_position.positionname(positionname)',
              ],[
              'id'=>$mode['position'],
              ]);
            //查询申请表
            $leave=$db->get('member_leave','*',[
                'id'=>$args,
              ]);
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,      
        'mode'=>$mode,
        'b'=>$b,
        'sub'=>$sub,
        'red'=>$red,
        'leave'=>$leave,                     
      ];    
      return $this->app->renderer->render($response, './executive_tiraledit.php',$as);
      }
      //点击拒绝跳此方法
      public function notnoupdate($request, $response, $args){
        global $flag,$msg,$data,$db;
       $path = $this->app->router->pathFor('executiveIndex');
        $mo=$_COOKIE['mobile'];
      //查询登录用户信息
      $mode=$db->get('member','*',[
        'mobile'=>$mo,
      ]);
       //修改申请表里的状态 
       $leave=$db->update('member_leave',[
          'statu'=>'2',
          'check'=>$mode['name'],
        ],[
          'id'=>$args,
        ]);
         $mo=$_COOKIE['mobile'];
        //查询用户信息
      $mode=$db->get('member','*',[
          'mobile'=>$mo,
      ]);
       if(isset($args['year'])){
        $year = $args['year'];
      }else{
        $year = date('Y');
      }

      if(isset($args['month'])){
        $month = $args['month'];
      }else{
        $month = date('m');
      }

      if(isset($args['day'])){
        $day = $args['day'];
      }else{
        $day = date('d');
      }
      //查询申请表 member_leave
  $c=$db->select('member_leave','*');
      //点击日期查询数据
     $a=$db->select('member_leave','*',[
          'wtime'=>"$year-$month-$day",
      ]);

      $list = [];
      $i=0;
      foreach ($a as $ul) {
        $list[$i]['id'] = $ul['id'];
        $list[$i]['name'] = $ul['name'];
        $list[$i]['ontime'] = $ul['ontime'];
        $list[$i]['offtime'] = $ul['offtime'];
        $list[$i]['statu'] = $ul['statu'];
        $list[$i]['content'] = $ul['content'];       

        $wt = $db->select('member_leave','*',[
            'AND'=>[
              'member_mine.wtime'=>"$year-$month-$day",              
            ]            
          ]);
        $list[$i]['wtime'] = $a;
        $i++;
      }
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,      
        'thisyear' => $year,
        'thismonth' => $month,
        'thisday' => $day,
        'list' => $list,
        'c'=>$c,
        'mode'=>$mode,        
      ];
      return $this->app->renderer->render($response, './executive_search.php', $as);
      }
      
      //加载修改页面
      public function notbupdate($request, $response, $args){
          global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('executiveIndex');
      $sc = $_COOKIE['subcomid'];
      $mo=$_COOKIE['mobile'];
      //查询用户信息
      $mode=$db->get('member','*',[
        'mobile'=>$mo,
      ]);
      // 查询部门信息
             $b=$db->get('member_department',[
                'member_department.departmentname(departmentname)',
              ],[
                'id'=>$mode['department'],
              ]);
             //查询区域部门
            $sub=$db->get('member_subcompany',[
              'member_subcompany.subcompanyname(subcompanyname)',
                
              ],[
                  'id'=>$mode['subcompany'],
              ]);
            $red=$db->get('member_position',[
              'member_position.positionname(positionname)',
              ],[
              'id'=>$mode['position'],
              ]);
      if(isset($args['year'])){
        $year = $args['year'];
      }else{
        $year = date('Y');
      }
      if(isset($args['month'])){
        $month = $args['month'];
      }else{
        $month = date('m');
      }
      if(isset($args['day'])){
        $day = $args['day'];
      }else{
        $day = date('d');
      }
      //查询申请病假表
      $leave=$db->get('member_leave','*',[
          'id'=>$args,
        ]);
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,      
        'thisyear' => $year,
        'thismonth' => $month,
        'thisday' => $day,
        'mode'=>$mode,
        'b'=>$b,
        'sub'=>$sub,
        'red'=>$red,
        'leave'=>$leave
                     
      ];    
      return $this->app->renderer->render($response, './executive_bupdate.php',$as);
      }

      //执行申请病假公式修改操作
      public function notupdateb($request, $response, $args){
        global $flag,$msg,$data,$db;
       $path = $this->app->router->pathFor('executiveIndex');
        $mo=$_COOKIE['mobile'];
        $ontime=$_POST['YYYY'].'-'.$_POST['MM'].'-'.$_POST['DD'];
        $offtime=$_POST['YY'].'-'.$_POST['MO'].'-'.$_POST['DE'];
      //查询登录用户信息
      $mode=$db->get('member','*',[
        'mobile'=>$mo,
      ]);
       //修改申请表里的状态 
       $leave=$db->update('member_leave',[
         'remarks'=>$_POST['remarks'],//修改备注
         'content'=>$_POST['content'],//修改类型
         'ontime'=>$ontime,
         'offtime'=>$offtime,
        ],[
          'id'=>$_POST['id'],
        ]);
         $mo=$_COOKIE['mobile'];     
        //查询用户信息
      $mode=$db->get('member','*',[
          'mobile'=>$mo,
      ]);
       if(isset($args['year'])){
        $year = $args['year'];
      }else{
        $year = date('Y');
      }

      if(isset($args['month'])){
        $month = $args['month'];
      }else{
        $month = date('m');
      }

      if(isset($args['day'])){
        $day = $args['day'];
      }else{
        $day = date('d');
      }
      //查询申请表 member_leave
  $c=$db->select('member_leave','*');
      //点击日期查询数据
     $a=$db->select('member_leave','*',[
          'wtime'=>"$year-$month-$day",
      ]);

      $list = [];
      $i=0;
      foreach ($a as $ul) {
        $list[$i]['id'] = $ul['id'];
        $list[$i]['name'] = $ul['name'];
        $list[$i]['ontime'] = $ul['ontime'];
        $list[$i]['offtime'] = $ul['offtime'];
        $list[$i]['statu'] = $ul['statu'];
        $list[$i]['content'] = $ul['content'];       

        $wt = $db->select('member_leave','*',[
            'AND'=>[
              'member_mine.wtime'=>"$year-$month-$day",              
            ]            
          ]);
        $list[$i]['wtime'] = $a;
        $i++;
      }
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,      
        'thisyear' => $year,
        'thismonth' => $month,
        'thisday' => $day,
        'list' => $list,
        'c'=>$c,
        'mode'=>$mode,        
      ];
      return $this->app->renderer->render($response, './executive_search.php', $as);
      }
      ///////病事公假结束。。。。。。。。。。。。。。。。。
      
      //加载办公采购列表页
      public function notpurchase($request, $response, $args){
         global $flag,$msg,$data,$db;
      $path = $this->app->router->pathFor('executiveIndex');
      $sc = $_COOKIE['subcomid'];
      if(isset($args['year'])){
        $year = $args['year'];
      }else{
        $year = date('Y');
      }

      if(isset($args['month'])){
        $month = $args['month'];
      }else{
        $month = date('m');
      }

      if(isset($args['day'])){
        $day = $args['day'];
      }else{
        $day = date('d');
      }

      $u = $db->select('member_purchase','*');
      $list = [];
      $i=0;
      foreach ($u as $ul) {
        $list[$i]['id'] = $ul['id'];
        $list[$i]['wname'] = $ul['wname'];//物品名称
        $list[$i]['price'] = $ul['price'];//单价
        $list[$i]['total'] = $ul['total'];//总价
        $list[$i]['number'] = $ul['number'];//数量
        $list[$i]['statu'] = $ul['statu'];//状态
        $list[$i]['ctime'] = $ul['ctime'];//添加时间
        $list[$i]['name'] = $ul['name'];//申请人
        $hasdaily = $db->get('member_purchase','*',[
        'AND'=>[
          'stime'=>"$year-$month-$day",
          ]
        ]);
        $list[$i]['hasdaily'] = $hasdaily;

        $wt = $db->select('member_worktime','*',[
            'AND'=>[
              'member_purchase.stime'=>"$year-$month-$day",
            ]            
          ]);
        $list[$i]['stime'] = $wt;
        $list[$i]['stime'] = "$year-$month-$day";
        $i++;
      }
      $as = [
        'settings'=>$this->app->get('settings'),
        'path' => $path,
        'list' => $list,
        'thisyear' => $year,
        'thismonth' => $month,
        'thisday' => $day
      ];
      return $this->app->renderer->render($response, './executive_pustlist.php', $as);
      }
      //加载采购申请页面
      public function notpleaseadd($request, $response, $args){
        global $flag,$msg,$data,$db;
        $path = $this->app->router->pathFor('executiveIndex');
        $sc = $_COOKIE['subcomid'];
        $mo=$_COOKIE['mobile'];
         $mode=$db->get('member','*',[
            'mobile'=>$mo,
          ]);
        if(isset($args['id'])){
           $mid = $args['id'];
            $m = $db->get('member_purchase','*',['id'=>$mid]);
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
        'ctype' => $ctype,
        'mode'=>$mode,
      ];
      return $this->app->renderer->render($response, './executive_pleaseadd.php', $as);
      }
      //执行采购信息添加 Ajax
      public function notpleinsert($request, $response, $args){
        global $flag,$msg,$data,$db;
        $path = $this->app->router->pathFor('executiveIndex');
          $mid = $db->insert("member_purchase", [
            "wname" => $request->getParsedBody()['wname'],//物品名称
            "number" => $request->getParsedBody()['number'],//购买数量
            "price" => $request->getParsedBody()['price'],//单价
            "total" => $request->getParsedBody()['total'],//总价
            "name" => $request->getParsedBody()['name'],//采购人 
            "remarks" => $request->getParsedBody()['remarks'],//备注
            "uid" => '1',//员工id
            "ctime" => date('Y-m-d H:i:s')//添加时间
            ]);       
          if($mid>0){
            $flag = 200;
            $msg = '添加已成功';
          }else{
            $mid = 0;
            $flag = 400;
            $msg = '失败，数据有误。';
          }     
        $json = array('flag' => $flag,'msg' => $msg, 'data' => [],);
        return $response->withJson($json);
      }
}
