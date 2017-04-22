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
						<?php $cmodel=1; require 'customs_detail_nav.php';?>
					</div>
					<div class="infobox">
					<?php if($m['hasCompany']){?>
						<div class="listname"><i class="iconfont icon-uilist"></i>  关联的公司</div>
						<table width="100%" class="table">
							<thead>
								<tr>
									<th>ID</th>
									<th>企业名称</th>
									<th style="text-align:left;">企业简称</th>
									<th>关联业务员</th>
									<th>营业执照号</th>
									<th>工商所在地</th>
									<th>办公所在地</th>
									<th>状态</th>
									<th width="80">操作</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									
										foreach ($m['hasCompany'] as $o) {
								?>
								<tr <?php if($o['status']==1){echo 'class="disabled"';}?>>
									<td><?php echo $o['id'];?></td>
									<td class="text-left"><?php echo $o['companyname'];?></td>
									<td class="text-left"><?php echo $o['decname'];?></td>
									<td>
										<?php echo($o['subcompanyname']);?>
											- 
										<?php echo($o['ywname']);?>
									</td>
									<td><?php echo $o['cno'];?></td>
									
									<td><?php echo $o['prov'];?> - <?php echo $o['city'];?> - <?php echo $o['area'];?></td>
									<td><?php echo $o['bgprov'];?> - <?php echo $o['bgcity'];?> - <?php echo $o['bgarea'];?></td>
									
									<td><?php if($o['status']==0){echo '正常';}else{echo '关闭';} ?></td>
									<td>
										<a target="_blank" href="<?php echo($settings['renderer']['home_path']);?>company/detail/<?php echo $o['id'];?>" class="btn btn-link btn-gray">查看</a>
									</td>
								</tr>
								<?php }?>
							</tbody>
						</table>
						<div class="height10"></div><?php }?>
						<?php if($m['hasContracts']){?>
						<div class="listname"><i class="iconfont icon-uilist"></i> 关联的合同</div>
						<table width="100%" class="table">
						<thead>
							<tr>
								<th style="width:50px;">ID</th>
								<th>合同编号</th>
								<th>客户类型</th>
								<th>合同类型</th>
								<th>合同执行周期</th>
								<th>签约主体</th>
								<th style="min-width:50px;">合同总金额</th>
								<th style="min-width:50px;">已入账金额</th>
								<th style="min-width:50px;">余款</th>
								<th>关联业务员</th>
								<th>执行员</th>
								<th>签单时间</th>
								<th>状态</th>
								<th width="80">操作</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							
								foreach ($m['hasContracts'] as $o) {
						?>
							<tr  <?php if($o['status']==6){echo 'class="disabled"';}?>>
								<td><?php echo $o['id'];?></td>
								<td><?php echo $o['cno'];?></td>
								<td><?php if($o['utype']==1){echo '企业';}elseif($o['utype']==2){echo "个人";}else{echo "";}?></td>
								<td><?php echo $o['typename'];?></td>
								<td><?php echo $o['start_day'];?> ~ <?php echo $o['end_day'];?></td>
								<td>
									<?php if($o['utype']==1){ 
										echo $o['companyname'];
									}elseif($o['utype']==2){
										echo $o['cname'];
									}?>
								</td>
								<td><?php echo $o['money_total'];?></td>
								<td><?php echo $o['money_ok'];?></td>
								<td class="text-color-red">
									<?php echo sprintf("%.2f",$o['money_total']-$o['money_ok']);?>
								</td>
								<td><?php echo $o['yscname'];?> - <?php echo $o['yname'];?></td>
								<td><?php echo $o['yscname'];?> - <?php echo $o['runname'];?></td>
								<td><?php echo $o['order_day'];?></td>
								<td><?php echo $o['statusname'];?></td>
								<td>
									<a target="_blank" href="<?php echo($settings['renderer']['home_path']);?>contracts/detail/<?php echo $o['id'];?>" class="btn btn-link btn-gray">查看</a>
								</td>
							</tr>
							<?php }?>
						</tbody>
					</table><?php }?>
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
