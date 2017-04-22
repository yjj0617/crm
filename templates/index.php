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
					<span class="text-color-blue font-size-18"><?php echo($u['name']);?></span>
					&nbsp;&nbsp;
					<span class="text-color-gray font-size-12">[ <?php echo($u['subcompanyname']);?> - <?php echo($u['departmentname']);?> - <?php echo($u['positionname']);?> ]</span>
					<br />
					<span class="text-color-gray font-size-12">您的积分：<span class="text-color-red">230</span>，分公司排名：<span class="text-color-red">23</span>。 [ <a href="" class="text-color-blue">查看成就榜</a> ]</span>
				</div>
				<div class="pull-right quick-app">
					<a href="<?php echo($settings['renderer']['home_path']);?>contracts/form">
						<span class="text-color-green"><i class="iconfont icon-anonymous-iconfont" style="font-size:28px"></i></span><br />
						<span class="font-size-12 text-color-gray">录合同</span>
					</a>
					<a href="<?php echo($settings['renderer']['home_path']);?>customs/form">
						<span class="text-color-blue"><i class="iconfont icon-anonymous-iconfont" style="font-size:28px"></i></span><br />
						<span class="font-size-12 text-color-gray">录客户</span>
					</a>
					<a href="<?php echo($settings['renderer']['home_path']);?>companies/form">
						<span class="text-color-red"><i class="iconfont icon-anonymous-iconfont" style="font-size:28px"></i></span><br />
						<span class="font-size-12 text-color-gray">录企业</span>
					</a>
					<a href="<?php echo($settings['renderer']['home_path']);?>opportunity/form">
						<span class="text-color-orange"><i class="iconfont icon-shangjibaobeiffcc" style="font-size:28px"></i></span><br />
						<span class="font-size-12 text-color-gray">发商机</span>
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
									<i class="iconfont icon-gonggao text-color-orange"></i> <a class="showNotice" data-href="<?php echo($n['id']);?>"><?php echo($n['title']);?></a>
									<span class="day font-size-12 text-color-gray"><?php echo(date('m-d H:i',strtotime($n['creattime'])));?></span>
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
					<div class="height20"></div>
					<div class="index-model">
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
							<span class="pull-right font-size-12">
								<a href="<?php echo($settings['renderer']['home_path']);?>complain" class="text-color-gray">全部</a>
							</span>
							<i class="iconfont icon-dot"></i> 待处理投诉
						</div>
						<div class="index-model-body">
							<ul class="artices">
								<?php if($ts){
									foreach ($ts as $t) {
									?>
								<li class="showTs" data-href="<?php echo($t['id']);?>">
									<i class="iconfont icon-tousu text-color-orange"></i> 
									[ <span class="text-color-red"><?php echo($t['sName']);?></span> ] 
									<?php echo($t['text']);?>
									<br />
									<span class="font-size-12 text-color-gray"><?php echo($t['cName']);?> - <?php echo($t['cMobile']);?> @ <?php echo(date('m-d H:i',strtotime($t['creattime'])));?></span>
								</li>
								<?php }} ?>
							</ul>
						</div>
					</div>
					
				</div>
				
				<div class="cell">
					<div class="index-model">
						<div class="index-model-head">
							<i class="iconfont icon-dot"></i> 与我相关的合同
						</div>
						<div class="index-model-body" style="height:520px;">
							
						</div>
					</div>
					
				</div>
				<div class="cell">
					<div class="index-model">
						<div class="index-model-head">
							<i class="iconfont icon-dot"></i> 我的客户
						</div>
						<div class="index-model-body" style="height:520px;">
							
						</div>
					</div>
				</div>
				<div class="cell">
					
					<div class="index-model">
						<div class="index-model-head">
							<i class="iconfont icon-dot"></i> 发送消息
						</div>
						<div class="index-model-body" style="height:190px;">
							<div class="font-size-12" style="padding:0 15px;">
								<select id="targetUid" class="input" style="width:150px">
									
								</select>
								<span class="w15"></span>
								<a href="" class="text-color-blue">[ 高级群发 ]</a>
							</div>
							<div style="padding:15px;">
								<textarea maxlength="120" id="msgText" class="textarea font-size-12 text-color-blue" style="height:60px;"></textarea>
							</div>
							<div style="padding:0 15px;">
								<button type="button" class="btn btn-big btn-red btn-w100 send">发送</button>
								<span class="w15"></span>
								<span class="text-color-gray font-size-12">消息仅支持向在线同事发送</span>
							</div>
						</div>
					</div>
					<div class="height20"></div>
					<div class="index-model">
						<div class="index-model-head">
							<span class="pull-right font-size-12">
								<a href="">[ 全部 ]</a>
							</span>
							<i class="iconfont icon-dot"></i> 历史消息
						</div>
						<div class="index-model-body" style="height:265px;">
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
				//onlinestaff();
				//更新在线员工列表
				function onlinestaff(){
					$('#targetUid').empty();
					$.get('<?php echo($settings['renderer']['home_path']);?>hr/getonlineJSON',function(e){
						console.log(e);
						//var s ='';
						$('#targetUid').append('<option value="0">全部在线同事</option>');
						for(var i = 0;i < e.data.length;i++){
							$('#targetUid').append('<option value="'+e.data[i].id+'">'+e.data[i].name+'</option>');
						}
					});
				}

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

		
				$('.send').click(function(){
					var targetUid = $('#targetUid').val();
					var msgText = $('#msgText').val();
					var Time = getNowFormatDate();
					if(msgText == ''){
						alert('消息内容不能为空');
						return false;
					}
					sengmsg('<?php echo($u['name']);?>',<?php echo($_COOKIE['staffID']);?>,'staff',targetUid,'staff','msg',msgText,Time,'新消息');
					$('#msgText').val('');
				});
			
		</script>
	</body>
</html>
