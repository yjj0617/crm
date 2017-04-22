<?php 
	require 'header.php';
?>
	<body >
	<?php require 'head.php';?>
	<?php $modelNo=1; require 'sidebar.php';?>
		<section>
			<div class="pbox">
				<div class="box-head">
					<div class="pull-left">
						<i class="iconfont icon-kehu"></i>
					</div>
					<div class="pull-left" style="padding-left:10px;">
						客户 [ <span class="text-color-red"><?php echo($m['name']);?></span> ] 的详细资料
					</div>
					<div class="pull-right text-right" style="padding-left:50px;min-width:500px;">
						该客户于 [ <span class="text-color-red"><?php echo($m['creattime']);?></span> ] 
						成为平台用户，注册方式为 [ <span class="text-color-red"><?php if($m['from']==0){ echo('线下录入');}elseif($m['from']==1){echo('微信注册');}elseif($m['from']==2){echo('网站注册');}else{echo('其它方式');}?></span> ]
						<?php if($m['from']==0){echo('，由 [ <span class="text-color-red">'.$m['staffCompany'].' - '.$m['staffName']).' - '.$m['staffMobile'].'</span> ] 录入。';} ?>
					</div>
				</div>
				<div class="box-body">
					<div class="tabbox">
						<?php $cmodel=0;  require 'customs_detail_nav.php';?>
					</div>
					<div class="infobox">
						<div class="cells">
							<div class="cells-item">
								<label class="cells-filed-name">ID</label>
								<div class="cells-filed-box">
									<span class="pull-right">
										<a href="<?php echo($settings['renderer']['home_path']);?>customs/form/<?php echo $m['id'];?>" class="btn btn-link btn-red">编辑基本信息</a>
										<a href="<?php echo($settings['renderer']['home_path']);?>sms/push/<?php echo $m['mobile'];?>" class="btn btn-link btn-green">发送短信</a>
										<?php if($m['openID']!=''){?>
										<a href="<?php echo($settings['renderer']['home_path']);?>wechat/push/<?php echo $m['mobile'];?>" class="btn btn-link btn-blue">发送微信消息</a>
										<?php } ?>
									</span>
									
									<?php echo($m['id']);?>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">客户姓名</label>
								<div class="cells-filed-box">
									<?php 
										echo($m['name']);
										if($m['status']==0){
											echo(' <span class="text-color-gray">[正常]</span>');
										}else{
											echo(' <span class="text-color-gray">[已关闭]</span>');
										}
									?>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">手机号码</label>
								<div class="cells-filed-box"><?php echo($m['mobile']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">备用手机</label>
								<div class="cells-filed-box"><?php echo($m['mobile2']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">性别</label>
								<div class="cells-filed-box">
									<?php 
										if($m['sexy']==0){
											echo('先生');
										}else{
											echo('女士');
										}
									?>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">出生年月</label>
								<div class="cells-filed-box"><?php echo($m['birthday']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">身份证号码</label>
								<div class="cells-filed-box"><?php echo($m['sfz']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">所在地</label>
								<div class="cells-filed-box"><?php echo($m['prov']);?>-<?php echo($m['city']);?>-<?php echo($m['area']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">详细地址</label>
								<div class="cells-filed-box"><?php echo($m['address']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">openID</label>
								<div class="cells-filed-box"><?php echo($m['openID']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">最近登录微信时间</label>
								<div class="cells-filed-box"><?php echo($m['wxloingtime']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">关联的业务员</label>
								<div class="cells-filed-box"><?php echo($m['owenSubCompany'].' - '.$m['owenSaler']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">备注</label>
								<div class="cells-filed-box"><?php echo($m['more']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">图片与照片</label>
								<div class="cells-filed-box">
								<?php if($m['img_1']!=''){?>
									<a target="_blank" href="<?php echo($m['img_1']);?>"><img src="<?php echo($m['img_1']);?>" width="48" height="48" /></a>
								<?php }?>
								<?php if($m['img_2']!=''){?>
									<a target="_blank" href="<?php echo($m['img_2']);?>"><img src="<?php echo($m['img_2']);?>" width="48" height="48" /></a>
								<?php }?>
								<?php if($m['img_3']!=''){?>
									<a target="_blank" href="<?php echo($m['img_3']);?>"><img src="<?php echo($m['img_3']);?>" width="48" height="48" /></a>
								<?php }?>
								<?php if($m['img_4']!=''){?>
									<a target="_blank" href="<?php echo($m['img_4']);?>"><img src="<?php echo($m['img_4']);?>" width="48" height="48" /></a>
								<?php }?>
								<?php 
									if($m['pics']!=''){
									foreach (json_decode($m['pics']) as $i) {
									$t = getpicbyId($i);
								?>
									<a target="_blank" href="<?php echo($assets_path.$t['uri']);?>">
									<img width="48" height="48" src="<?php echo($settings['renderer']['home_path'].$t['thumbnail']);?>"  />
									</a>
								
								<?php }}?>

								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php require 'js.php';?>
		<script type="text/javascript">
		</script>
		<script type="text/javascript">
			//$(document).ready(function(){
				// $('.mycustoms').height($(window).height()-135);
				// $('.waitrun').height($(window).height()-597);
			//});
		</script>
		
	</body>
</html>
