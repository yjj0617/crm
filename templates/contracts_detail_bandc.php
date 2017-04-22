<?php 
	require 'header.php';
?>
	<body>
	<?php require 'head.php';?>
	<?php $modelNo = 1; require 'sidebar.php';?>
		<section>
			<div class="pbox">
				<div class="box-head">
					<div class="pull-left">
						<i class="iconfont icon-hetong"></i>
					</div>
					<div class="pull-left" style="padding-left:10px;">
						编号 [ <span class="text-color-red"><?php echo($m['cno']);?></span> ] 的合同款项成本
					</div>
					<div class="pull-right text-right" style="padding-left:50px;min-width:500px;">
						该合同于 [ <span class="text-color-red"><?php echo($m['creattime']);?></span> ] 被录入，录入人 [ <span class="text-color-red"><?php echo($m['staffCompany']);?> - <?php echo($m['staffName']);?> - <?php echo($m['staffMobile']);?></span> ]
						
					</div>
				</div>
				<div class="box-body">
					<div class="tabbox">
						<?php $cmodel=2;  require 'contracts_detail_nav.php';?>
					</div>
					<div class="infobox">
						<table class="table" width="100%">
							<thead>
								<tr>
									<th>签约主体</th>	
									<th>合同金额</th>
									<th>约定预付款金额</th>
									<th>已入帐金额</th>
									<th>余款</th>
									<th>当前已付款帐期</th>
									<th>当前成本合计</th>
									<th width="200">操作</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php  if($m['utype']==1){ ?>
										<a class="text-color-blue" target="_blank" href="<?php echo($settings['renderer']['home_path']);?>companies/detail/<?php echo $m['uid'];?>"><?php echo($m['coname']);?></a>

											<span class="text-color-green">{ <?php echo($m['couser']);?> }</span>

									<?php	}else{ ?>
										[个人] <a class="text-color-blue" target="_blank" href="<?php echo($settings['renderer']['home_path']);?>customs/detail/<?php echo $m['uid'];?>"><?php echo($m['cuname']);?></a> <span class="text-color-green">[ <?php echo($m['cumobile']);?> ]</span>
									<?php	} ?></td>
									<td><?php echo($m['money_total']);?> 元</td>
									<td><?php echo($m['money_before']);?> 元</td>
									<td><?php echo($m['money_ok']);?> 元
									<span class="text-color-blue">[ 
									<?php
									if($m['money_total']!=0){
										$b = ($m['money_ok']/$m['money_total'])*100;
										echo('完成度：'.sprintf("%.2f",$b));
									}
									?>% ]</span></td>
									<td>
										<span class="text-color-red"><?php echo(sprintf("%.2f",$m['money_total']-$m['money_ok']));?></span> 元
									</td>
									<td><?php echo($m['zq']);?></td>
									<td><?php echo($m['cost']);?> 元
									</td>
									<td>
										<a data-cid="<?php echo($m['id']);?>" class="btn btn-link btn-red addsk"><i class="iconfont icon-anonymous-iconfont"></i> 收款入帐</a>
									</td>
								</tr>
							</tbody>
						</table>
						<div class="pull-left" style="width:calc(50% - 40px);padding:0 20px;background:#fff;height:calc(100% - 88px);overflow:auto;">
							<div class="timeline">
							<?php if($zzlog){
								foreach ($zzlog as $l) { ?>
									<div class="timeline-item">
										<div class="timeline-timebox">
											<span class="font-size-18"><?php echo(date('H:i',strtotime($l['creatTime'])));?></span>
											<br />
											<span class="font-size-12"><?php echo(date('m月d日',strtotime($l['creatTime'])));?></span>
										</div>
										<div class="timeline-body">
											<a data-cid="<?php echo($m['id']);?>" data-id="<?php echo($l['id']);?>" class="pull-right editbooking"><i class="iconfont icon-bianji1"></i></a>
											<div class="font-size-18 text-color-red">
												收款：<?php echo($l['money']);?> 元
											</div> 
											<?php if($l['text']!=''){?>
												<div class="text-color-blue font-size-12" style="padding-top:5px;padding-left:2px;">备注：<?php echo($l['text']);?></div>
												<?php } ?>
											<div class="timeline-body-meta font-size-12 text-color-gray">
												<i class="iconfont icon-wo"></i> 
												
												录入：<?php echo($l['cname']);?> 
												
												<span class="w15"></span> 
												收款渠道：<?php echo($l['source']);?>
												<span class="w15"></span>
												入帐日：<?php echo($l['entry_day']);?>	
											
											</div>
										</div>
										<div class="clearfix"></div>
									</div>
							<?php } } ?>
							</div>
						</div>
						<div class="pull-right" style="width:calc(50% - 41px);padding:0 20px;background:#fff;height:calc(100% - 88px);overflow:auto;">
							<div class="timeline">
							<?php if($costlog){
								foreach ($costlog as $l) { ?>
									<div class="timeline-item">
										<div class="timeline-timebox">
											<span class="font-size-18"><?php echo(date('H:i',strtotime($l['creatTime'])));?></span>
											<br />
											<span class="font-size-12"><?php echo(date('m月d日',strtotime($l['creatTime'])));?></span>
										</div>
										<div class="timeline-body">
											<div class="font-size-18 text-color-orange">
												报销：<?php echo($l['money']);?> 元
											</div>
											
											<div class="timeline-body-meta font-size-12 text-color-gray">
												<i class="iconfont icon-wo"></i> 
												
												录入：<?php echo($l['cname']);?> 
												<span class="w15"></span> 
												报销人：<?php echo($l['zcname']);?>
												<span class="w15"></span>
												支出项：<span class="text-color-red"><?php echo($l['text']);?></span>	
											
											</div>
										</div>
										<div class="clearfix"></div>
									</div>
							<?php } } ?>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</section>
		<?php require 'js.php';?>
		<script type="text/javascript">
		</script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('.addsk').click(function(){
					var cid = $(this).attr('data-cid');
					var op = layer.open({
					  	type: 2,
					  	title:'款项入帐',
					  	area: ['860px', '480px'],
					  	content:  ['<?php echo($settings['renderer']['home_path']);?>contracts/bookingform/'+cid, 'yes'],
					  	cancel:function(){
							window.location.reload();
							return false;
						}
					});
				});
				$('.editbooking').click(function(){
					var cid = $(this).attr('data-cid');
					var id = $(this).attr('data-id');
					var op = layer.open({
					  	type: 2,
					  	title:'编辑入帐款项',
					  	area: ['860px', '480px'],
					  	content:  ['<?php echo($settings['renderer']['home_path']);?>contracts/bookingform/'+cid+'/'+id, 'yes'],
					  	cancel:function(){
							window.location.reload();
							return false;
						},
						end:function(){
							window.location.reload();
							return false;
						}
					});
				});
			});
		</script>
		
	</body>
</html>
