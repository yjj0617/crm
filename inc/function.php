<?php
	
	function getstaff($id){
		//获取当前用户信息
		global $db;
		$d = $db->get('member',[
			"[>]member_subcompany" => ["subcompany"=>"id"],
			"[>]member_department" => ["department"=>"id"],
			"[>]member_position" => ["position"=>"id"]
			],[
			'member.id(id)',
			'member.name(name)',
			'member.mobile(mobile)',
			'member.city(city)',
			'member.authoritySubc(authoritySubc)',
			'member_subcompany.id(subcompanyid)',
			'member_subcompany.subcompanyname(subcompanyname)',
			'member_department.departmentname(departmentname)',
			'member_position.positionname(positionname)'
			],['member.id'=>$id]);
		return $d;
	}

	function getac($ac){
		//返回权限范围（分公司）数组
		$array = explode(',',$ac);
		return $array;
	}

	function hasauthority($num){
		//获取当前用户的权限列表
		global $db;
		$mobile = $_COOKIE['mobile'];
		$u = $db->get('member',['authority'],['mobile'=>$mobile]);
		$u_authority = $u['authority'];
		$array = explode(',',$u_authority);
		if(in_array($num,$array)){
			return true;
		}else{
			return false;
		}
		
	}

	function pagenavi($model,$p = 1,$count,$size=10,$where){
		//通用分页
		if($where != ''){
			if($count>=$size){
			$ps=ceil($count/$size);
			$p1=$p-1;
			$p2=$p-2;
			$n1=$p+1;
			$n2=$p+2;
			$tpl="<a href='$model/$where/1'>&lt;&lt; 最前页</a>";
			if($p1>=1){$tpl.="<a href='$model/$where/$p1'>&lt; 上页</a>";}
			if($p2>=1){$tpl.="<a href='$model/$where/$p2'>$p2</a>";}
			if($p1>=1){$tpl.="<a href='$model/$where/$p1'>$p1</a>";}
			$tpl.="<a  class='active'>$p</a>";
			if($n1<=$ps){$tpl.="<a href='$model/$where/$n1'>$n1</a>";}
			if($n2<=$ps){$tpl.="<a href='$model/$where/$n2'>$n2</a>";}
			if($n1<=$ps){$tpl.="<a href='$model/$where/$n1'>下页 &gt;</a>";}
			$tpl.="<a href='$model/$where/$ps'>最后页 &gt;&gt;</a>";
			$tpl.="&nbsp;&nbsp;&nbsp;&nbsp;第 $p 页/总 $ps 页，总计 $count 条纪录";
			
			echo "<div class='list-pagging'>".$tpl."&nbsp;&nbsp;跳转到：<select onchange='window.location.href = this.value;'>";
			for($i=1;$i<=$ps;$i++){
				if($i==$p){
					echo "<option value='$model/$where/$i' selected = 'selected'>".$i."</option>";
				}else{
					echo "<option value='$model/$where/$i'>".$i."</option>";
				}
			}
			
			echo "</select> 页</div>";
			}
		}else{
			if($count>=$size){
			$ps=ceil($count/$size);
			$p1=$p-1;
			$p2=$p-2;
			$n1=$p+1;
			$n2=$p+2;
			$tpl="<a href='$model/1'>&lt;&lt; 最前页</a>";
			if($p1>=1){$tpl.="<a href='$model/$p1'>&lt; 上页</a>";}
			if($p2>=1){$tpl.="<a href='$model/$p2'>$p2</a>";}
			if($p1>=1){$tpl.="<a href='$model/$p1'>$p1</a>";}
			$tpl.="<a  class='active'>$p</a>";
			if($n1<=$ps){$tpl.="<a href='$model/$n1'>$n1</a>";}
			if($n2<=$ps){$tpl.="<a href='$model/$n2'>$n2</a>";}
			if($n1<=$ps){$tpl.="<a href='$model/$n1'>下页 &gt;</a>";}
			$tpl.="<a href='$model/$ps'>最后页 &gt;&gt;</a>";
			$tpl.="&nbsp;&nbsp;&nbsp;&nbsp;第 $p 页/总 $ps 页，总计 $count 条纪录";
			
			echo "<div class='list-pagging'>".$tpl."&nbsp;&nbsp;跳转到：<select onchange='window.location.href = this.value;'>";
			for($i=1;$i<=$ps;$i++){
				if($i==$p){
					echo "<option value='$model/$i' selected = 'selected'>".$i."</option>";
				}else{
					echo "<option value='$model/$i'>".$i."</option>";
				}
			}
			
			echo "</select> 页</div>";
			}
		}
	}

	function wlog($type,$logtype,$logtext,$targetId){
		//写入操作纪录
		global $db,$ip;
	    if (getenv("HTTP_CLIENT_IP"))  
	        $ip = getenv("HTTP_CLIENT_IP");  
	    else if(getenv("HTTP_X_FORWARDED_FOR"))  
	        $ip = getenv("HTTP_X_FORWARDED_FOR");  
	    else if(getenv("REMOTE_ADDR"))  
	        $ip = getenv("REMOTE_ADDR");  
	    else $ip = "Unknow"; 

		$log = $db->insert("wlog", [
				"type" => $type,
				"memberid" => $_COOKIE['staffID'],
				"logtype" => $logtype,
				"logtext" => $logtext,
				'targetId' => $targetId,
				"ip" => $ip,
				"creattime" => date('Y-m-d H:i:s')
		]);
		if($log){
			return true;
		}else{
			return false;
		}
	}

	function getpicbyId($id){
		//返回图片
		Global $db;
		$result = $db->get('mcms_attachment','*',['AND'=>['type'=>0,'id'=>$id]]);
      	return $result;
    }

    function getfilebyId($id){
    	//返回文件
		Global $db;
		$result = $db->get('mcms_attachment','*',['AND'=>['type'=>1,'id'=>$id]]);
      	return $result;
    }

    function hascontracts($id){
    	//返回指定企业是否有正在执行的合同
    	global $db;
    	$has = $db->get('contracts',['id'],[
    		'AND'=>[
    			'status[!]' => [6,7],
    			'utype' => 1,
    			'uid' => $id
    		]]);
    	if($has){
    		return true;
    	}else{
    		return false;
    	}
    }

    function wscpush($type,$formName,$formUid,$formUtype,$targetUid,$targetUtype,$msgType,$msgText,$Title){
    	global $db;
    	$time = date('Y-m-d H:i:s');
    	$db->insert('chat_messages',[
    		'type' => $type,
    		'formName' => $formName,
    		'formUid' => $formUid,
    		'formUtype' => $formUtype,
    		'targetUid' => $targetUid,
    		'targetUtype' => $targetUtype,
    		'msgType' => $msgType,
    		'Title' => $Title,
    		'msgText' => $msgText,
    		'sendTime' => $time
    		]);
	    $data = json_encode(array(
	        'type' => $type,
	        'formName' => $formName,
	        'formUid' => $formUid,
	        'formUtype' => $formUtype,
	        'targetUid' => $targetUid,
	        'targetUtype' => $targetUtype,
	        'msgType' => $msgType,
	        'msgText' => $msgText,
	        'sendTime' => $time,
	        'Title' => $Title
	    ));
    	$client = new \Common\Library\WebSocketClient();
	    $client->connect('localhost', 8021, '/');
	    $rs = $client->sendData($data);
	    if( $rs !== true ){
			return false;
		}else{
			return true;
		}
    }

	function is_serialized($data) {
		//判断是否序列化
		$data = trim($data);
		if ('N;' == $data) return true;
		if (!preg_match('/^([adObis]):/', $data, $badions)) return false;
		switch ($badions[1]) {
		case 'a':
		case 'O':
		case 's':
			if (preg_match("/^{$badions[1]}:[0-9]+:.*[;}]\$/s", $data)) return true;
			break;
		case 'b':
		case 'i':
		case 'd':
			if (preg_match("/^{$badions[1]}:[0-9.E-]+;\$/", $data)) return true;
			break;
		}
		return false;
	}

	function hasinarray($id,$t){
		//获取目录用户的权限列表
		$array = explode(',',$t);
		if(in_array($id,$array)){
			return true;
		}else{
			return false;
		}
	}

	function nongli($riqi){
		//优化修改 20160807 FXL 
		$nian=date('Y',strtotime($riqi));
		$yue=date('m',strtotime($riqi));
		$ri=date('d',strtotime($riqi));
		  
		 #源码部分原作者：沈潋(S&S Lab) 
		 #农历每月的天数 
		 $everymonth=array( 
		          0=>array(8,0,0,0,0,0,0,0,0,0,0,0,29,30,7,1), 
		          1=>array(0,29,30,29,29,30,29,30,29,30,30,30,29,0,8,2), 
		          2=>array(0,30,29,30,29,29,30,29,30,29,30,30,30,0,9,3), 
		          3=>array(5,29,30,29,30,29,29,30,29,29,30,30,29,30,10,4), 
		          4=>array(0,30,30,29,30,29,29,30,29,29,30,30,29,0,1,5), 
		          5=>array(0,30,30,29,30,30,29,29,30,29,30,29,30,0,2,6), 
		          6=>array(4,29,30,30,29,30,29,30,29,30,29,30,29,30,3,7), 
		          7=>array(0,29,30,29,30,29,30,30,29,30,29,30,29,0,4,8), 
		          8=>array(0,30,29,29,30,30,29,30,29,30,30,29,30,0,5,9), 
		          9=>array(2,29,30,29,29,30,29,30,29,30,30,30,29,30,6,10), 
		          10=>array(0,29,30,29,29,30,29,30,29,30,30,30,29,0,7,11), 
		          11=>array(6,30,29,30,29,29,30,29,29,30,30,29,30,30,8,12), 
		          12=>array(0,30,29,30,29,29,30,29,29,30,30,29,30,0,9,1), 
		          13=>array(0,30,30,29,30,29,29,30,29,29,30,29,30,0,10,2), 
		          14=>array(5,30,30,29,30,29,30,29,30,29,30,29,29,30,1,3), 
		          15=>array(0,30,29,30,30,29,30,29,30,29,30,29,30,0,2,4), 
		          16=>array(0,29,30,29,30,29,30,30,29,30,29,30,29,0,3,5), 
		          17=>array(2,30,29,29,30,29,30,30,29,30,30,29,30,29,4,6), 
		          18=>array(0,30,29,29,30,29,30,29,30,30,29,30,30,0,5,7), 
		          19=>array(7,29,30,29,29,30,29,29,30,30,29,30,30,30,6,8), 
		          20=>array(0,29,30,29,29,30,29,29,30,30,29,30,30,0,7,9), 
		          21=>array(0,30,29,30,29,29,30,29,29,30,29,30,30,0,8,10), 
		          22=>array(5,30,29,30,30,29,29,30,29,29,30,29,30,30,9,11), 
		          23=>array(0,29,30,30,29,30,29,30,29,29,30,29,30,0,10,12), 
		          24=>array(0,29,30,30,29,30,30,29,30,29,30,29,29,0,1,1), 
		          25=>array(4,30,29,30,29,30,30,29,30,30,29,30,29,30,2,2), 
		          26=>array(0,29,29,30,29,30,29,30,30,29,30,30,29,0,3,3), 
		          27=>array(0,30,29,29,30,29,30,29,30,29,30,30,30,0,4,4), 
		          28=>array(2,29,30,29,29,30,29,29,30,29,30,30,30,30,5,5), 
		          29=>array(0,29,30,29,29,30,29,29,30,29,30,30,30,0,6,6), 
		          30=>array(6,29,30,30,29,29,30,29,29,30,29,30,30,29,7,7), 
		          31=>array(0,30,30,29,30,29,30,29,29,30,29,30,29,0,8,8), 
		          32=>array(0,30,30,30,29,30,29,30,29,29,30,29,30,0,9,9), 
		          33=>array(5,29,30,30,29,30,30,29,30,29,30,29,29,30,10,10), 
		          34=>array(0,29,30,29,30,30,29,30,29,30,30,29,30,0,1,11), 
		          35=>array(0,29,29,30,29,30,29,30,30,29,30,30,29,0,2,12), 
		          36=>array(3,30,29,29,30,29,29,30,30,29,30,30,30,29,3,1), 
		          37=>array(0,30,29,29,30,29,29,30,29,30,30,30,29,0,4,2), 
		          38=>array(7,30,30,29,29,30,29,29,30,29,30,30,29,30,5,3), 
		          39=>array(0,30,30,29,29,30,29,29,30,29,30,29,30,0,6,4), 
		          40=>array(0,30,30,29,30,29,30,29,29,30,29,30,29,0,7,5), 
		          41=>array(6,30,30,29,30,30,29,30,29,29,30,29,30,29,8,6), 
		          42=>array(0,30,29,30,30,29,30,29,30,29,30,29,30,0,9,7), 
		          43=>array(0,29,30,29,30,29,30,30,29,30,29,30,29,0,10,8), 
		          44=>array(4,30,29,30,29,30,29,30,29,30,30,29,30,30,1,9), 
		          45=>array(0,29,29,30,29,29,30,29,30,30,30,29,30,0,2,10), 
		          46=>array(0,30,29,29,30,29,29,30,29,30,30,29,30,0,3,11), 
		          47=>array(2,30,30,29,29,30,29,29,30,29,30,29,30,30,4,12), 
		          48=>array(0,30,29,30,29,30,29,29,30,29,30,29,30,0,5,1), 
		          49=>array(7,30,29,30,30,29,30,29,29,30,29,30,29,30,6,2), 
		          50=>array(0,29,30,30,29,30,30,29,29,30,29,30,29,0,7,3), 
		          51=>array(0,30,29,30,30,29,30,29,30,29,30,29,30,0,8,4), 
		          52=>array(5,29,30,29,30,29,30,29,30,30,29,30,29,30,9,5), 
		          53=>array(0,29,30,29,29,30,30,29,30,30,29,30,29,0,10,6), 
		          54=>array(0,30,29,30,29,29,30,29,30,30,29,30,30,0,1,7), 
		          55=>array(3,29,30,29,30,29,29,30,29,30,29,30,30,30,2,8), 
		          56=>array(0,29,30,29,30,29,29,30,29,30,29,30,30,0,3,9), 
		          57=>array(8,30,29,30,29,30,29,29,30,29,30,29,30,29,4,10), 
		          58=>array(0,30,30,30,29,30,29,29,30,29,30,29,30,0,5,11), 
		          59=>array(0,29,30,30,29,30,29,30,29,30,29,30,29,0,6,12), 
		          60=>array(6,30,29,30,29,30,30,29,30,29,30,29,30,29,7,1), 
		          61=>array(0,30,29,30,29,30,29,30,30,29,30,29,30,0,8,2), 
		          62=>array(0,29,30,29,29,30,29,30,30,29,30,30,29,0,9,3), 
		          63=>array(4,30,29,30,29,29,30,29,30,29,30,30,30,29,10,4), 
		          64=>array(0,30,29,30,29,29,30,29,30,29,30,30,30,0,1,5), 
		          65=>array(0,29,30,29,30,29,29,30,29,29,30,30,29,0,2,6), 
		          66=>array(3,30,30,30,29,30,29,29,30,29,29,30,30,29,3,7), 
		          67=>array(0,30,30,29,30,30,29,29,30,29,30,29,30,0,4,8), 
		          68=>array(7,29,30,29,30,30,29,30,29,30,29,30,29,30,5,9), 
		          69=>array(0,29,30,29,30,29,30,30,29,30,29,30,29,0,6,10), 
		          70=>array(0,30,29,29,30,29,30,30,29,30,30,29,30,0,7,11), 
		          71=>array(5,29,30,29,29,30,29,30,29,30,30,30,29,30,8,12), 
		          72=>array(0,29,30,29,29,30,29,30,29,30,30,29,30,0,9,1), 
		          73=>array(0,30,29,30,29,29,30,29,29,30,30,29,30,0,10,2), 
		          74=>array(4,30,30,29,30,29,29,30,29,29,30,30,29,30,1,3), 
		          75=>array(0,30,30,29,30,29,29,30,29,29,30,29,30,0,2,4), 
		          76=>array(8,30,30,29,30,29,30,29,30,29,29,30,29,30,3,5), 
		          77=>array(0,30,29,30,30,29,30,29,30,29,30,29,29,0,4,6), 
		          78=>array(0,30,29,30,30,29,30,30,29,30,29,30,29,0,5,7), 
		          79=>array(6,30,29,29,30,29,30,30,29,30,30,29,30,29,6,8), 
		          80=>array(0,30,29,29,30,29,30,29,30,30,29,30,30,0,7,9), 
		          81=>array(0,29,30,29,29,30,29,29,30,30,29,30,30,0,8,10), 
		          82=>array(4,30,29,30,29,29,30,29,29,30,29,30,30,30,9,11), 
		          83=>array(0,30,29,30,29,29,30,29,29,30,29,30,30,0,10,12), 
		          84=>array(10,30,29,30,30,29,29,30,29,29,30,29,30,30,1,1), 
		          85=>array(0,29,30,30,29,30,29,30,29,29,30,29,30,0,2,2), 
		          86=>array(0,29,30,30,29,30,30,29,30,29,30,29,29,0,3,3), 
		          87=>array(6,30,29,30,29,30,30,29,30,30,29,30,29,29,4,4), 
		          88=>array(0,30,29,30,29,30,29,30,30,29,30,30,29,0,5,5), 
		          89=>array(0,30,29,29,30,29,29,30,30,29,30,30,30,0,6,6), 
		          90=>array(5,29,30,29,29,30,29,29,30,29,30,30,30,30,7,7), 
		          91=>array(0,29,30,29,29,30,29,29,30,29,30,30,30,0,8,8), 
		          92=>array(0,29,30,30,29,29,30,29,29,30,29,30,30,0,9,9), 
		          93=>array(3,29,30,30,29,30,29,30,29,29,30,29,30,29,10,10), 
		          94=>array(0,30,30,30,29,30,29,30,29,29,30,29,30,0,1,11), 
		          95=>array(8,29,30,30,29,30,29,30,30,29,29,30,29,30,2,12), 
		          96=>array(0,29,30,29,30,30,29,30,29,30,30,29,29,0,3,1), 
		          97=>array(0,30,29,30,29,30,29,30,30,29,30,30,29,0,4,2), 
		          98=>array(5,30,29,29,30,29,29,30,30,29,30,30,29,30,5,3), 
		          99=>array(0,30,29,29,30,29,29,30,29,30,30,30,29,0,6,4), 
		          100=>array(0,30,30,29,29,30,29,29,30,29,30,30,29,0,7,5), 
		          101=>array(4,30,30,29,30,29,30,29,29,30,29,30,29,30,8,6), 
		          102=>array(0,30,30,29,30,29,30,29,29,30,29,30,29,0,9,7), 
		          103=>array(0,30,30,29,30,30,29,30,29,29,30,29,30,0,10,8), 
		          104=>array(2,29,30,29,30,30,29,30,29,30,29,30,29,30,1,9), 
		          105=>array(0,29,30,29,30,29,30,30,29,30,29,30,29,0,2,10), 
		          106=>array(7,30,29,30,29,30,29,30,29,30,30,29,30,30,3,11), 
		          107=>array(0,29,29,30,29,29,30,29,30,30,30,29,30,0,4,12), 
		          108=>array(0,30,29,29,30,29,29,30,29,30,30,29,30,0,5,1), 
		          109=>array(5,30,30,29,29,30,29,29,30,29,30,29,30,30,6,2), 
		          110=>array(0,30,29,30,29,30,29,29,30,29,30,29,30,0,7,3), 
		          111=>array(0,30,29,30,30,29,30,29,29,30,29,30,29,0,8,4), 
		          112=>array(4,30,29,30,30,29,30,29,30,29,30,29,30,29,9,5), 
		          113=>array(0,30,29,30,29,30,30,29,30,29,30,29,30,0,10,6), 
		          114=>array(9,29,30,29,30,29,30,29,30,30,29,30,29,30,1,7), 
		          115=>array(0,29,30,29,29,30,29,30,30,30,29,30,29,0,2,8), 
		          116=>array(0,30,29,30,29,29,30,29,30,30,29,30,30,0,3,9), 
		          117=>array(6,29,30,29,30,29,29,30,29,30,29,30,30,30,4,10), 
		          118=>array(0,29,30,29,30,29,29,30,29,30,29,30,30,0,5,11), 
		          119=>array(0,30,29,30,29,30,29,29,30,29,29,30,30,0,6,12), 
		          120=>array(4,29,30,30,30,29,30,29,29,30,29,30,29,30,7,1) 
		          ); 
		############################## 
		 #农历天干 
		 $mten=array("null","甲","乙","丙","丁","戊","己","庚","辛","壬","癸"); 
		 #农历地支 
		 $mtwelve=array("null","子(鼠)","丑(牛)","寅(虎)","卯(兔)","辰(龙)", 
		         "巳(蛇)","午(马)","未(羊)","申(猴)","酉(鸡)","戌(狗)","亥(猪)"); 
		 #农历月份 
		 $mmonth=array("闰","正","二","三","四","五","六", 
		        "七","八","九","十","十一","十二","月"); 
		 #农历日 
		 $mday=array("null","初一","初二","初三","初四","初五","初六","初七","初八","初九","初十", 
		       "十一","十二","十三","十四","十五","十六","十七","十八","十九","二十", 
		       "廿一","廿二","廿三","廿四","廿五","廿六","廿七","廿八","廿九","三十"); 
		############################## 
		 #星期 
		 $weekday = array("星期日","星期一","星期二","星期三","星期四","星期五","星期六"); 
		 #阳历总天数 至1900年12月21日 
		 $total=11; 
		 #阴历总天数 
		 $mtotal=0; 
		############################## 
		 #获得当日日期 
		 //$today=getdate(); //获取今天的日期
		 if($nian<1901 || $nian>2020) die("年份出错！"); 
		 //$cur_wday=$today["wday"]; //星期中第几天的数字表示
		 for($y=1901;$y<$nian;$y++) { //计算到所求日期阳历的总天数-自1900年12月21日始,先算年的和 
		    $total+=365; 
		    if ($y%4==0) $total++; 
		 } 
		 switch($yue) { //再加当年的几个月 
		     case 12: 
		       $total+=30; 
		     case 11: 
		       $total+=31; 
		     case 10: 
		       $total+=30; 
		     case 9: 
		       $total+=31; 
		     case 8: 
		       $total+=31; 
		     case 7: 
		       $total+=30; 
		     case 6: 
		       $total+=31; 
		     case 5: 
		       $total+=30; 
		     case 4: 
		       $total+=31; 
		     case 3: 
		       $total+=28; 
		     case 2: 
		       $total+=31; 
		 } 
		 if($nian%4 == 0 && $yue>2) $total++; //如果当年是闰年还要加一天 
		 $total=$total+$ri-1; //加当月的天数 
		 $flag1=0; //判断跳出循环的条件 
		 $j=0; 
		 while ($j<=120){ //用农历的天数累加来判断是否超过阳历的天数 
		   $i=1; 
		   while ($i<=13){ 
		      $mtotal+=$everymonth[$j][$i]; 
		      if ($mtotal>=$total){ 
		         $flag1=1; 
		         break; 
		      } 
		      $i++; 
		   } 
		   if ($flag1==1) break; 
		   $j++; 
		 } 
		 if($everymonth[$j][0]<>0 and $everymonth[$j][0]<$i){ //原来错在这里，对闰月没有修补 
		   $mm=$i-1; 
		 } 
		 else{ 
		   $mm=$i; 
		 } 
		 if($i==$everymonth[$j][0]+1 and $everymonth[$j][0]<>0) { 
		   $nlmon=$mmonth[0].$mmonth[$mm];#闰月 
		 } 
		 else { 
		   $nlmon=$mmonth[$mm].$mmonth[13]; 
		 } 
		 #计算所求月份1号的农历日期 
		 $md=$everymonth[$j][$i]-($mtotal-$total); 
		 if($md > $everymonth[$j][$i]) 
		   $md-=$everymonth[$j][$i]; 
		 $nlday=$mday[$md]; 
		   
		 //$nowday=date("Y年n月j日 ")."w".$weekday[$cur_wday]." ".$mten[$everymonth[$j][14]].$mtwelve[$everymonth[$j][15]]."年".$nlmon.$nlday; 
		 $nowday=$mten[$everymonth[$j][14]].$mtwelve[$everymonth[$j][15]]."年 ".$nlmon.$nlday; 
		 return $nowday;
	}

	function my_sort($arrays,$sort_key,$sort_order=SORT_ASC,$sort_type=SORT_NUMERIC ){ 
		// 数组排序
		// SORT_ASC - 默认，按升序排列。(A-Z)
		// SORT_DESC - 按降序排列。(Z-A)
		// 随后可以指定排序的类型：
		// SORT_REGULAR - 默认。将每一项按常规顺序排列。
		// SORT_NUMERIC - 将每一项按数字顺序排列。
		// SORT_STRING - 将每一项按字母顺序排列 
        if(is_array($arrays)){   
            foreach ($arrays as $array){   
                if(is_array($array)){   
                    $key_arrays[] = $array[$sort_key];   
                }else{   
                    return false;   
                }   
            }   
        }else{   
            return false;   
        }  
        array_multisort($key_arrays,$sort_order,$sort_type,$arrays);   
        return $arrays;   
    }

    function get_integral($uid,$month){
    	//获取员工指定月份积分值
    	global $db;
    	$in = $db->get('member_integral',['integral'],[
    		'AND'=>[
				'staffid' => $uid,
				'month' => $month
    		]]);
    	if($in){
    		return $in['integral'];
    	}else{
    		return 0.00;
    	}
    }

    function get_integral_ranking($uid,$month){
    	//获取员工指定月份在所在分公司的积分排名
    	global $db;
    	$sc = $_COOKIE['subcomid'];
    	$in = $db->select('member_integral',[
    		'[>]member'=>['member_integral.staffid' => 'id']
    		],[
    		'member_integral.staffid',
    		'member_integral.integral'
    		],[
				'AND'=>[
					'member.subcompany' => $sc,
					'member.status' => 1,
					'member_integral.month' => $month
				],
				'ORDER'=>['member_integral.integral'=>'DESC']
    		]);
    	$r = 0;
    	$rank = 0;
    	foreach ($in as $v) {
    		$r ++;
    		if($v['staffid'] == $uid ){
    			$rank = $r;
    		}
    	}
    	return $rank;
    }

    function getip(){
    	if (getenv("HTTP_CLIENT_IP"))  
	        $ip = getenv("HTTP_CLIENT_IP");  
	    else if(getenv("HTTP_X_FORWARDED_FOR"))  
	        $ip = getenv("HTTP_X_FORWARDED_FOR");  
	    else if(getenv("REMOTE_ADDR"))  
	        $ip = getenv("REMOTE_ADDR");  
	    else $ip = "Unknow";
	    return $ip;
    }
    