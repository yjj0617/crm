<?php 
	require 'header.php';
?>
	<body >
	<?php require 'head.php';?>
	<?php $modelNo=5; require 'sidebar.php';?>
		<section>
			<div class="pbox">
				<div class="box-head">
					<div class="pull-left">
						<i class="iconfont icon-baobiao"></i>
					</div>
					<div class="pull-left" style="padding-left:10px;">
						已预约待面试：<span class="text-color-red"><?php echo($count['all']);?></span> 人
					</div>
					
					<div class="clearfix"></div>
				</div>
				<div class="box-body">
					<div class="tabbox">
						<span class="pull-right font-size-12">
							按状态：
							<select id="getstatus">
								<option value="">请选择</option>
								<?php foreach ($cslist as $sc) {?>
									<option <?php if($s==$sc['id']){echo('selected="selected"');}?> value="<?php echo($sc['id']);?>">
										<?php echo($sc['statusname']);?>
									</option>
								<?php } ?>
							</select>
						</span>
						 <a href="<?php echo($settings['renderer']['home_path'].'hr/talentpool');?>">全部</a>
						 <a href="<?php echo($settings['renderer']['home_path'].'hr/talentpool/appointment');?>" class="active">待面试</a>
					</div>
					<div class="listbox">
						<table width="100%" class="table">
							<thead>
								<tr>
									<th>ID</th>
									<th>姓名</th>
									<th>性别</th>
									<th>手机号</th>
									<th>出生年月</th>
									<th>所在地区</th>
									<th>目标岗位</th>	
									<th>期望薪资</th>
									<th>预约面试日期</th>
									
									<th>推荐人</th>
									<th>状态</th>
									<th width="230">操作</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($list as $o){?>
								<tr>
								<td><?php echo($o['id']);?></td>
								<td><?php echo $o['name'];?></td>
								<td><?php if($o['sexy']==0){echo('男');}else{echo('女');}?></td>
								<td><?php echo $o['mobile'];?></td>
								<td><?php echo $o['birthday'];?></td>
								<td><?php echo $o['positionarea'];?></td>
								<td><?php echo $o['selfposition'];?></td>
								<td class="text-color-red"><?php echo $o['expectedsalary'];?></td>
								<td class="text-color-blue"><?php echo $o['interviewtime'];?></td>
								<td class="text-color-blue">
									<?php echo $o['refstaffSubc'];?> -
									<?php echo $o['refstaffname'];?>
								</td>
								<td><?php echo($o['statusName']);?></td>
								<td class="text-left">
									<a href="<?php echo($settings['renderer']['home_path']);?>hr/talentpool/detail/<?php echo $o['id'];?>" class="btn btn-link btn-gray">查看</a>
									<?php if($o['status']==1){?>
									<a data-id="<?php echo $o['id'];?>" class="btn btn-link btn-green appointment">预约面试</a>
									<?php } ?>
									<?php if($o['status']==2){?>
									<a data-id="<?php echo $o['id'];?>" class="btn btn-link btn-blue msok">面试通过</a>
									<?php } ?>
									<?php if($o['status']==4){?>
									<a data-id="<?php echo $o['id'];?>" class="btn btn-link btn-oranage ok">入职</a>
									<?php } ?>
									<?php if($o['status']==1 || $o['status']==2){?>
									<a data-id="<?php echo $o['id'];?>" class="btn btn-link btn-red pass">PASS</a>
									<?php } ?>
									<?php if($o['status']==1 || $o['status']==4){?>
									
									<a data-id="<?php echo $o['id'];?>" class="btn btn-link btn-white close">关闭</a>
									<?php } ?>
								</td>
								</tr>
								<?php }?>
							</tbody>
						</table>
						<?php
							pagenavi($settings['renderer']['home_path'].'hr/talentpool/appointment',$p,$count['all'],10,"");
						?>
					</div>
				</div>
			</div>
		</section>
		
		<?php require 'js.php';?>
	
		<script type="text/javascript">
			$(document).ready(function(){
				$('#getstatus').change(function(){
					var sid = $(this).val();
					if(sid!=''){
						window.location = "<?php echo($settings['renderer']['home_path'].'hr/talentpool/');?>"+sid;
					}else{
						window.location = "<?php echo($settings['renderer']['home_path'].'hr/talentpool');?>";
					}
				});
			});
		</script>
		
	</body>
</html>
