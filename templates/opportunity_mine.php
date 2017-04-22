<?php 
	require 'header.php';
?>
	<body >
	<?php require 'head.php';?>
	<?php $modelNo = 5; require 'sidebar.php';?>
		<section>
			<div class="pbox">
				<div class="box-head">
					<div class="pull-left">
						<i class="iconfont icon-shangjibaobeiffcc"></i>
					</div>
					<div class="pull-left" style="padding-left:10px;">
						与我相关的商机数：<span class="text-color-red"><?php echo($count['all']);?></span> 条
					</div>
					
					<div class="pull-right">
						您所在分公司： <span class="text-color-green"><?php echo($u['subcompanyname']);?></span>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="box-body">
					<div class="tabbox">
						
						<a href="<?php echo($settings['renderer']['home_path'].'opportunity/mine/2');?>" <?php if($status==2){echo('class="active"');}?>>已处理,需跟进</a>
						<a href="<?php echo($settings['renderer']['home_path'].'opportunity/mine/3');?>" <?php if($status==3){echo('class="active"');}?>>已签单</a>
						<a href="<?php echo($settings['renderer']['home_path'].'opportunity/mine/4');?>" <?php if($status==4){echo('class="active"');}?>>已关闭</a>
						
					</div>
					<div class="listbox">
						<table width="100%" class="table">
							<thead>
								<tr>
									<th width="50">ID</th>
									<th>客户</th>
									<th width="400">咨询业务</th>
									<th>地区</th>
									<th>来源</th>
									<th>渠道</th>
									<th>录入时间</th>
									<th>状态</th>
									<th width="160">操作</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($list as $o){?>
								<tr>
								<td><?php echo($o['id']);?></td>
								<td class="text-left">
									<?php echo($o['uname']);?>
									<br />
									<span class="text-color-blue"><?php echo($o['mobile']);?></span>
								</td>
								
								<td class="text-left">
									<?php echo($o['catename']);?>
									<?php if($o['itemId']!=0){ echo ('：'.$o['item']);}?>
									<br />
									<span class="text-color-red"><?php echo($o['text']);?></span>
								</td>
								<td class="text-left"><?php echo($o['prov']);?> - <?php echo($o['city']);?> - <?php echo($o['area']);?></td>
								
								<td><?php echo($o['form']);?></td>
								<td><?php echo($o['qd']);?></td>
								<td><?php echo($o['creattime']);?></td>
								<td><?php echo($o['statusName']);?></td>
								<td>
									<a data-href="<?php echo($settings['renderer']['home_path']);?>opportunity/detail/<?php echo $o['id'];?>" class="btn btn-link btn-gray view">查看</a>
									<?php if($o['status']==3 && $o['contractId']!=''){?>
										<a target="_blank" href="<?php echo($settings['renderer']['home_path']);?>contracts/detail/<?php echo $o['contractId'];?>" class="btn btn-link btn-blue">合同</a>
									<?php } ?>
									<?php if($o['status']==1 || $o['status']==2){?>
									<a data-href="<?php echo($settings['renderer']['home_path']);?>opportunity/detail/<?php echo $o['id'];?>" class="btn btn-link btn-red do">处理</a>
									<?php } ?>
								</td>
								</tr>
								<?php }?>
							</tbody>
						</table>
						<?php
							
							pagenavi($settings['renderer']['home_path'].'opportunity',$p,$counts,7,"$status");
						?>
					</div>
				</div>
			</div>
		</section>

		<?php require 'js.php';?>
	
		<script type="text/javascript">
			$(document).ready(function(){
				$('.view, .do').click(function(){
					var href = $(this).attr('data-href');
					op = layer.open({
					  	type: 2,
					  	title:false,
					  	area: ['1160px', '580px'],
					  	content:  [href, 'yes']
					});
				});
			});
		</script>
		
	</body>
</html>
