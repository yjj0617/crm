<?php 
	require 'header.php';
?>
	<body >
	<?php require 'head.php';?>
		<section>
			<div class="ubox">
				<div class="pull-left u-avatar">
					<i class="iconfont icon-iconfontxingxing" style="font-size:32px;color:#fff;"></i>
				</div>
				<div class="pull-left" style="margin-left:20px;padding-top:8px;">
					<a href="<?php echo($settings['renderer']['home_path']);?>mine"><span class="text-color-blue font-size-18"><?php echo($u['name']);?></span></a>
					&nbsp;&nbsp;
					<span class="text-color-gray font-size-12">[ <?php echo($u['subcompanyname']);?> - <?php echo($u['departmentname']);?> - <?php echo($u['positionname']);?> ]</span>
					<br />
					<span class="text-color-gray font-size-12">您的积分：<span class="text-color-red"><?php echo(get_integral($_COOKIE['staffID'],date('Ym')));?></span>，所在分公司排名：<span class="text-color-red"><?php echo(get_integral_ranking($_COOKIE['staffID'],date('Ym')));?></span>， [ <a href="<?php echo($settings['renderer']['home_path']);?>ranking" class="text-color-blue">查看成就榜</a> ]， [ <a href="<?php echo($settings['renderer']['home_path']);?>integral/log" class="text-color-blue">增减记录</a> ]</span>
				</div>
				<div class="kq">
					<?php if(count($dk) == 0){?>
					<button type="button" class='dk green'>打卡</button>
					<?php }elseif(count($dk) == 1){?>
						<button type="button" class='dk red'>打卡</button>
					<?php }else{ ?>
						<button type="button" class='dk gray'>打卡</button>
					<?php } ?>
					<?php if(count($daily)==1){?>
						<i class="iconfont icon-duigou text-color-red dailyok"></i>
					<?php } ?>
					<button type="button" class='daily'>日报</button>
					<i class="iconfont icon-fuwu5"></i>上班 <span class="text-color-green"><?php if(count($dk)>0){ echo(date('H:i',strtotime($dk[0]['worktime'])));}?></span><br />
					<i class="iconfont icon-shangxiaban"></i>下班 <span class="text-color-red"><?php if(count($dk)>1){echo(date('H:i',strtotime($dk[1]['worktime'])));}?></span>
				</div>
				<div class="clock"><canvas id="canvas" width="80" height="80"></canvas></div>
				<div class="pull-right quick-app">
					
					<a href="<?php echo($settings['renderer']['home_path']);?>customs/form">
						<span class="text-color-blue"><i class="iconfont icon-anonymous-iconfont" style="font-size:28px"></i></span><br />
						<span class="font-size-12 text-color-gray">录客户</span>
					</a>
					<a href="<?php echo($settings['renderer']['home_path']);?>companies/form">
						<span class="text-color-red"><i class="iconfont icon-anonymous-iconfont" style="font-size:28px"></i></span><br />
						<span class="font-size-12 text-color-gray">录企业</span>
					</a>
					<a href="<?php echo($settings['renderer']['home_path']);?>contracts/form">
						<span class="text-color-green"><i class="iconfont icon-anonymous-iconfont" style="font-size:28px"></i></span><br />
						<span class="font-size-12 text-color-gray">录合同</span>
					</a>
					<a href="<?php echo($settings['renderer']['home_path']);?>opportunity/form">
						<span class="text-color-orange"><i class="iconfont icon-shangjibaobeiffcc" style="font-size:28px"></i></span><br />
						<span class="font-size-12 text-color-gray">发商机</span>
					</a>
					<a href="<?php echo($settings['renderer']['home_path']);?>complain/form">
						<span class="text-color-red"><i class="iconfont icon-tousu" style="font-size:28px"></i></span><br />
						<span class="font-size-12 text-color-gray">录投诉</span>
					</a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="index-cells">
				<div class="cell">
					<div class="index-model">
						<div class="index-model-head">
							<span class="pull-right font-size-12">
								<a href="<?php echo($settings['renderer']['home_path']);?>notices" class="text-color-gray">全部</a>
							</span>
							<i class="iconfont icon-dot"></i> 最新公告
						</div>
						<div class="index-model-body">
							<ul class="artices">
								<?php if($notice){
									foreach ($notice as $n) {
									?>
								<li>
									<i class="iconfont icon-gonggao text-color-orange"></i> <a class="showNotice" data-href="<?php echo($settings['renderer']['home_path']);?>executive/notice/detail/<?php echo($n['id']);?>"><?php echo($n['title']);?></a>
									<span class="day font-size-12 text-color-gray"><?php echo(date('m-d H:i',strtotime($n['creattime'])));?></span>
								</li>
								<?php }} ?>
							</ul>
						</div>
					</div>
					
					<div class="height20"></div>
					<div class="index-model"  style="height:calc(100% - 398px);">
						<div class="index-model-head">
							<span class="pull-right font-size-12">
								<span class="text-color-red hand">
									我要出外勤
								</span>
								<span class="w15"></span>
								<a href="<?php echo($settings['renderer']['home_path']);?>oto" class="text-color-gray">全部</a>
							</span>
							<i class="iconfont icon-dot"></i> 外勤记录
						</div>
						<div class="index-model-body">
							<ul class="artices">
								<?php if($oto){
									foreach ($oto as $ot) {
									?>
								<li>
									<i class="iconfont icon-chucha- text-color-orange"></i> 
									<span class="text-color-red">[ <?php echo($ot['staffName']);?> ]</span>
									<?php echo($ot['affair']);?>
									<span class="day font-size-12 text-color-gray"><?php echo(date('m-d H:i',strtotime($ot['start'])));?> ~ <?php echo(date('m-d H:i',strtotime($ot['end'])));?></span>
								</li>
								<?php }} ?>
							</ul>
						</div>
					</div>

					<div class="height20"></div>
					<div class="index-model">
						<div class="index-model-head">
							<span class="text-color-red"><i class="iconfont icon-dot"></i> 
							喜报</span>
						</div>
						<div class="index-model-body" style="background: rgba(255,0,0,1)">
							<div class="swiper-container">
        					<div class="swiper-wrapper" >
							<?php if($xb){
									foreach ($xb as $x) {
									?>
									<div class="swiper-slide">
									<div class="xbbox">
										<span class="font-size-14"><?php echo $x['day'];?></span>
										<br />
										<span class="font-size-28"><?php echo $x['money'];?>元</span>
										<br />
									<span class="font-size-12">[ <?php echo($x['subcompanyname'].' - '.$x['departmentname'].' - '.$x['name']);?> ] <br />恭喜签约“<?php echo($x['typename']);?>”业务。</span>
									</div>
									</div>
							<?php }} ?>
							</div>
							<div class="swiper-pagination"></div>
							</div>
						</div>
					</div>
					
				</div>
				
				<div class="cell" style="width: calc(50% - 20px);">
					<div class="index-model" style="height:calc(100% - 8px);">
						<div class="index-model-head">
							<span class="pull-right font-size-12">
								<a class="newplan" data-href="<?php echo($settings['renderer']['home_path']);?>/executive/workplan/form">[ 新增计划 ]</a>
							</span>
							<i class="iconfont icon-dot"></i> 我的工作计划
						</div>
						<div class="index-model-body">
							<ul class="workPlans">
								<?php 

									
									if($_COOKIE['staffID']!=1){
										$plan = $db->select('member_workplan',[
										'[>]member(m1)'=>['member_workplan.creatstaffId'=>'id'],
										'[>]member(m2)'=>['member_workplan.staffId'=>'id']
										],[
										'member_workplan.id(id)',
										'member_workplan.title(title)',
										'member_workplan.startday(startday)',
										'member_workplan.endday(endday)',
										'member_workplan.status(status)',
										'member_workplan.level(level)',
										'member_workplan.creattime(creattime)',
										'm1.name(creatName)',
										'm2.name(staffName)',
										],[
										'AND'=>[
											'member_workplan.staffId'=>$_COOKIE['staffID'],
											'member_workplan.status'=>[0,1]
										],
										"ORDER"=>[
											'member_workplan.status'=>'ASC',
											'member_workplan.startday'=>'ASC',
											'member_workplan.level'=>'DESC',
											]
										]);
									}else{
										$plan = $db->select('member_workplan',[
										'[>]member(m1)'=>['member_workplan.creatstaffId'=>'id'],
										'[>]member(m2)'=>['member_workplan.staffId'=>'id']
										],[
										'member_workplan.id(id)',
										'member_workplan.title(title)',
										'member_workplan.startday(startday)',
										'member_workplan.endday(endday)',
										'member_workplan.status(status)',
										'member_workplan.level(level)',
										'member_workplan.creattime(creattime)',
										'm1.name(creatName)',
										'm2.name(staffName)',
										],[
										
											'member_workplan.status'=>[0,1]
										,
										"ORDER"=>[
											'member_workplan.status'=>'ASC',
											'member_workplan.startday'=>'ASC',
											'member_workplan.level'=>'DESC',
											]
										]);
									}
									
								if($plan){
									foreach ($plan as $t) {
									?>
								<li class="workPlan hand level-<?php echo($t['level']);?>" data-href="<?php echo($settings['renderer']['home_path']);?>executive/workplan/detail/<?php echo($t['id']);?>">
									[<?php echo($t['staffName']);?>]<?php echo($t['title']);?>
									<div class="wp-status">
										<?php if($t['status']==0){?>
											<i class="iconfont icon-xiaozhushouweiwancheng text-color-gray"></i><br />
											<span class="font-size-12 text-color-gray">未执行</span>
										<?php }elseif($t['status']==1){?>
											<i class="iconfont icon-weiwancheng text-color-green"></i><br />
											<span class="font-size-12 text-color-green">正在执行</span>
										<?php }elseif($t['status']==2){?>
											<i class="iconfont icon-wancheng icon-weiwancheng text-color-green"></i><br />
											<span class="font-size-12 text-color-green">已按时完成</span>
										<?php }elseif($t['status']==3){?>
											<i class="iconfont icon-cuowu text-color-red"></i><br />
											<span class="font-size-12 text-color-red">未按时完成</span>
										<?php }?>
									</div>
									<div style="padding-top:5px;">
									<span class="font-size-12 text-color-gray">
										计划起止时间：<span class="text-color-green"><?php echo($t['startday']);?> - <?php echo($t['endday']);?> </span>
										
									
									<br />
									计划制订：<span class="text-color-orange"><?php echo($t['creatName']);?></span> @ <?php echo(date('m-d H:i',strtotime($t['creattime'])));?>
									</div></span>
								</li>
								<?php }} ?>
							</ul>
						</div>
					</div>
					
				</div>
				
				<div class="cell">

					<div class="index-model" style="height:calc(100% - 8px);">
						<div class="index-model-head">
							<span class="pull-right font-size-12">
								<a href="<?php echo($settings['renderer']['home_path']);?>operate/im">[ 全部 ]</a>
							</span>
							<i class="iconfont icon-dot"></i> 历史消息
						</div>
						<div class="index-model-body">
							<dl id="chatlog" class="chatlog">
								
							</dl>
						</div>
					</div>
					
				</div>
				
				
				<div class="clearfix"></div>
			</div>
		</section>
		
		
		<?php require 'js.php';?>
		<script type="text/javascript" src="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/js/swiper-3.4.1.jquery.min.js"></script>
		<script type="text/javascript">
			var swiper = new Swiper('.swiper-container', {
		        //pagination: '.swiper-pagination',
		        //paginationClickable: true,
		        spaceBetween: 30,
		        centeredSlides: true,
		        autoplay: 2500,
		        autoplayDisableOnInteraction: false,
		        loop: true
		    });
		</script>
		<script type="text/javascript">
			<?php if(count($dk) == 0){?>
				layer.msg('请先打卡',{icon: 1,time: 2000,}, function(){
	            	return false;
				});
			<?php } ?>
			$('.showNotice,.showTs,.newplan,.workPlan').click(function(){
				var href = $(this).attr('data-href');
					op = layer.open({
					  	type: 2,
					  	title:false,
					  	area: ['1000px', '580px'],
					  	content:  [href, 'yes']
					});
			});
			$('.dk').click(function(){
				<?php if(count($daily) == 0 && count($dk) == 1){?>
					layer.msg('下班打卡前，请先填写日报。',{icon: 1,time: 2000}, function(){
						var dbox = layer.open({
						  	type: 2,
						  	title:'填写日报',
						  	area: ['860px', '480px'],
						  	content:  ['<?php echo($settings['renderer']['home_path']);?>executive/daily/form', 'yes'],
						  	end:function(){
								$.post('<?php echo($settings['renderer']['home_path']);?>executive/worktime',function(e){
									if(e.flag == 200){
										layer.msg(e.msg,{icon: 1,time: 2000,}, function(){
							            	window.location.reload();
							            	return false;
										});
									}else{
										layer.msg(e.msg,{icon: 0,time: 2000,}, function(){
							            	window.location.reload();
							            	return false;
										});
									}
									return false;
								});
							}
						});
			            	
					});
				<?php }else{ ?>
				$.post('<?php echo($settings['renderer']['home_path']);?>executive/worktime',function(e){
						if(e.flag == 200){
							layer.msg(e.msg,{icon: 1,time: 2000,}, function(){
				            	window.location.reload();
				            	return false;
							});
						}else{
							layer.msg(e.msg,{icon: 0,time: 2000,}, function(){
				            	window.location.reload();
				            	return false;
							});
						}
					return false;
				});
				<?php } ?>
			});
			$('.daily').click(function(){
				var dbox = layer.open({
				  	type: 2,
				  	title:'填写日报',
				  	area: ['860px', '480px'],
				  	content:  ['<?php echo($settings['renderer']['home_path']);?>executive/daily/form', 'yes'],
				  	end:function(){
						window.location.reload();
						return false;
					}
				});			
			});
			
		</script>
		<script type="text/javascript">
				

				function chatlog(){
					$('#chatlog').html('');
					$.get('<?php echo($settings['renderer']['home_path']);?>chat/getlogJSON',function(e){
						console.log(e);
						
						for(var i = 0;i < e.data.length;i++){
							if(e.data[i].targetUid == 0){
								$('#chatlog').append('<dd><div><span class="text-color-red">[群发]</span><span class="text-color-blue">'+e.data[i].formName+'</span>：'+e.data[i].msgText+'<br /><span class="text-color-gray">'+e.data[i].sendTime+'</span></div></dd>');
							}else if(e.data[i].formUid == <?php echo($_COOKIE['staffID']);?>){
								$('#chatlog').append('<dd><div>我@<span class="text-color-blue">'+e.data[i].targetName+'</span>：'+e.data[i].msgText+'<br /><span class="text-color-gray">'+e.data[i].sendTime+'</span></div></dd>');
							}else{
								$('#chatlog').append('<dd><div><span class="text-color-blue">'+e.data[i].formName+'</span>@我：'+e.data[i].msgText+'<br /><span class="text-color-gray">'+e.data[i].sendTime+'</span></div></dd>');
							}
							
						}
					});
				}
				chatlog();

				var canvas, ctx;
				var clockRadius = 36;
				var clockImage;

				// draw functions :
				function clear() { // clear canvas function
				    ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
				}

				function drawScene() { // main drawScene function
				    clear(); // clear canvas

				    // get current time
				    var date = new Date();
				    var hours = date.getHours();
				    var minutes = date.getMinutes();
				    var seconds = date.getSeconds();
				    hours = hours > 12 ? hours - 12 : hours;
				    var hour = hours + minutes / 60;
				    var minute = minutes + seconds / 60;

				    // save current context
				    ctx.save();

				    // draw clock image (as background)
				    ctx.drawImage(clockImage, 0, 0, 80, 80);

				    ctx.translate(canvas.width / 2, canvas.height / 2);
				    ctx.beginPath();

				    
				    // draw hour
				    ctx.save();
				    var theta = (hour - 3) * 2 * Math.PI / 12;
				    ctx.rotate(theta);
				    ctx.beginPath();
				    ctx.moveTo(-8, -1);
				    ctx.lineTo(-8, 1);
				    ctx.lineTo(clockRadius * 0.5, 1);
				    ctx.lineTo(clockRadius * 0.5, -1);
				    ctx.fillStyle = '#555';
				    ctx.fill();
				    ctx.restore();

				    // draw minute
				    ctx.save();
				    var theta = (minute - 15) * 2 * Math.PI / 60;
				    ctx.rotate(theta);
				    ctx.beginPath();
				    ctx.moveTo(-8, -1);
				    ctx.lineTo(-8, 1);
				    ctx.lineTo(clockRadius * 0.8, 1);
				    ctx.lineTo(clockRadius * 0.8, -1);
				    ctx.fillStyle = '#555';
				    ctx.fill();
				    ctx.restore();

				    // draw second
				    ctx.save();
				    var theta = (seconds - 15) * 2 * Math.PI / 60;
				    ctx.rotate(theta);
				    ctx.beginPath();
				    ctx.moveTo(-8, -1);
				    ctx.lineTo(-8, 1);
				    ctx.lineTo(clockRadius * 0.9, 1);
				    ctx.lineTo(clockRadius * 0.9, -1);
				    ctx.fillStyle = '#f00';
				    ctx.fill();
				    ctx.restore();

				    ctx.restore();
				}

				// initialization
				$(function(){
				    canvas = document.getElementById('canvas');
				    ctx = canvas.getContext('2d');

				    // var width = canvas.width;
				    // var height = canvas.height;

					clockImage = new Image();
					clockImage.src = '<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>/dist/img/clock.png';

				    setInterval(drawScene, 1000); // loop drawScene
				});

				
		</script>
	</body>
</html>
