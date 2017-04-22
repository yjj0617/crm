<?php 
	require 'header.php';
?>
	<body>
	<?php require 'head.php';?>
	<?php $modelNo=1; require 'sidebar.php';?>
		<section>
			<div class="pbox">
				<div class="box-head">
					<div class="pull-left">
						<i class="iconfont icon-hetong"></i>
					</div>
					<div class="pull-left" style="padding-left:10px;">
						编号 [ <span class="text-color-red"><?php echo($m['cno']);?></span> ] 的合同详细资料
					</div>
					<div class="pull-right text-right" style="padding-left:50px;min-width:500px;">
						该合同于 [ <span class="text-color-red"><?php echo($m['creattime']);?></span> ] 被录入，录入人 [ <span class="text-color-red"><?php echo($m['staffCompany']);?> - <?php echo($m['staffName']);?> - <?php echo($m['staffMobile']);?></span> ]
						
					</div>
				</div>
				<div class="box-body">
					<div class="tabbox">
						<?php $cmodel=0;  require 'contracts_detail_nav.php';?>
					</div>
					<div class="infobox">
						<div class="cells">
							<div class="cells-item">
								<label class="cells-filed-name">ID</label>
								<div class="cells-filed-box">
									<span class="pull-right">
									<?php if($m['status']!=6 && $m['status']!=7){?>
										<a href="<?php echo($settings['renderer']['home_path']);?>contracts/form/<?php echo $m['id'];?>" class="btn btn-link btn-red">编辑合同信息</a>
										<a href="<?php echo($settings['renderer']['home_path']);?>contracts/close/<?php echo $m['id'];?>" class="btn btn-link btn-white">关闭</a>
									<?php } ?>
									</span>
									
									<?php echo($m['id']);?>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">签约主体</label>
								<div class="cells-filed-box">
									<?php  if($m['utype']==1){ ?>
										<a class="text-color-blue" target="_blank" href="<?php echo($settings['renderer']['home_path']);?>companies/detail/<?php echo $m['uid'];?>"><?php echo($m['coname']);?></a>

											<span class="text-color-green">{ <?php echo($m['couser']);?> }</span>

									<?php	}else{ ?>
										[个人] <a class="text-color-blue" target="_blank" href="<?php echo($settings['renderer']['home_path']);?>customs/detail/<?php echo $m['uid'];?>"><?php echo($m['cuname']);?></a> <span class="text-color-green">[ <?php echo($m['cumobile']);?> ]</span>
									<?php	} ?>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">业务类型</label>
								<div class="cells-filed-box">
									<?php echo($m['typename']);?>
									<?php 
										if(is_serialized($m['item']) == true){
											echo('[<span class="text-color-blue"> ');
											foreach (unserialize($m['item']) as $o) {
												$ct = $db->get('contract_type','*',['id'=>$o]);
												if($ct){
													echo $ct['typename'].', ';
												}
											}
											echo('</span> ]');
										}
									?>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">执行周期</label>
								<div class="cells-filed-box">
									<?php echo($m['start_day']);?> ~ <?php echo($m['end_day']);?>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">状态</label>
								<div class="cells-filed-box" style="width:30%;">
									<?php echo($m['statusname']);?>
								</div>
								<div class="pull-right speed">
									<span <?php if($m['status']==1){echo('class="active"');}?>>1.已签约待付款</span>
									<span <?php if($m['status']==2 || $m['status']==3){echo('class="active"');}?>>2.待派单</span>
									<span <?php if($m['status']==4 || $m['status']==5){echo('class="active"');}?>>3.执行中</span>
									<span <?php if($m['status']==7){echo('class="active"');}?>>4.执行完成</span>
									<span <?php if($m['status']==8){echo('class="active"');}?>>5.业务员确认</span>
									<span <?php if($m['status']==9){echo('class="active"');}?>>6.财务确认合同结束</span>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">付款类型</label>
								<div class="cells-filed-box">
									<?php echo($m['paytype']);?>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">合同金额</label>
								<div class="cells-filed-box">
									<?php echo($m['money_total']);?> 元
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">约定预付款金额</label>
								<div class="cells-filed-box">
									<?php echo($m['money_before']);?> 元
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">已入帐金额</label>
								<div class="cells-filed-box" style="width:60%">
									<?php echo($m['money_ok']);?> 元
									<span class="text-color-blue">[ 
									<?php
									$b = 100;
									if($m['money_total']!=0){
										$b = ($m['money_ok']/$m['money_total'])*100;
										echo('完成度：'.sprintf("%.2f",$b));
									}
									?>
									% ]</span>
								</div>
								<div class="pull-right">
									<?php if($b<100){?>
									<a href="<?php echo($settings['renderer']['home_path']);?>contracts/detail/<?php echo $m['id'];?>/bookingandcost" class="btn btn-link btn-red">录入收款项</a>
									<?php } ?>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">余款</label>
								<div class="cells-filed-box">
									<?php echo(sprintf("%.2f",$m['money_total']-$m['money_ok']));?> 元
								</div>
								<div class="clearfix"></div>
							</div>

							<div class="cells-item">
								<label class="cells-filed-name">当前已付款帐期</label>
								<div class="cells-filed-box">
									<?php echo($m['zq']);?>
								</div>
								<div class="clearfix"></div>
							</div>

							<div class="cells-item">
								<label class="cells-filed-name">当前成本</label>
								<div class="cells-filed-box" style="width:60%">
									<?php echo($m['cost']);?> 元
								</div>
								<div class="pull-right">
									<a href="<?php echo($settings['renderer']['home_path']);?>contracts/detail/<?php echo $m['id'];?>/bookingandcost" class="btn btn-link btn-red">录入成本项</a>
								</div>
								<div class="clearfix"></div>
							</div>

							<div class="cells-item">
								<label class="cells-filed-name">地区所属</label>
								<div class="cells-filed-box">
									<?php echo($m['prov']);?> - <?php echo($m['city']);?> - <?php echo($m['area']);?>
								</div>
								<div class="clearfix"></div>
							</div>
							
							<div class="cells-item">
								<label class="cells-filed-name">业务员</label>
								<div class="cells-filed-box">
									<?php echo $m['owenSubCompany'];?> - <?php echo $m['owenSaler'];?>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">执行人</label>
								<div class="cells-filed-box">
									<?php echo($m['owenRunerCompany']);?> - <?php echo($m['owenRuner']);?>
								</div>
								<div class="clearfix"></div>
							</div>
							
							<div class="cells-item">
								<label class="cells-filed-name">签约时间</label>
								<div class="cells-filed-box">
									<?php echo($m['order_day']);?>
								</div>
								<div class="clearfix"></div>
							</div>

							
							<div class="cells-item">
								<label class="cells-filed-name">合同内容</label>
								<div class="cells-filed-box"><?php echo($m['content']);?></div>
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
								<?php 
									if($m['pics']!=''){
									foreach (json_decode($m['pics']) as $i) {
									$t = getpicbyId($i);
								?>
									<a target="_blank" href="<?php echo($assets_path.$t['uri']);?>">
									<img width="48" height="48" src="<?php echo($settings['renderer']['home_path'].$t['thumbnail']);?>"  />
									</a>
								
								<?php }}?>

								<?php 
									if($m['paper']!=''){
									foreach ($m['paper'] as $i) {
									
								?>
									<a target="_blank" href="<?php echo($i['uri']);?>">
									<img width="48" height="48" src="<?php echo($i['uri']);?>"  />
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
