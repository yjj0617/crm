<?php 
	require 'header.php';
?>
	<body >
	<?php require 'head.php';?>
	<?php $modelNo=3; require 'sidebar.php';?>
		<section>
			<div class="pbox">
				<div class="box-head">
					<div class="pull-left">
						<i class="iconfont icon-sousuo"></i>
					</div>
					<div class="pull-left" style="padding-left:10px;">
						当前 [ <span class="text-color-red">员工</span> ] 搜索结果，您设定的关键词为：<span class="text-color-red"><?php echo($key);?></span>，
						总计 <span class="text-color-red"><?php echo(count($list));?></span> 个结果。
						如需重新搜索，请点 <a href="<?php echo($settings['renderer']['home_path']);?>hr/search" class="text-color-red">返回</a>。
					</div>
					<div class="pull-right">
						
					</div>
				</div>
				<div class="box-body">
					<div class="listbox">
						<table width="100%" class="table">
							<thead>
								<tr>
									<th>ID</th>
									<th>员工编号</th>
									<th>姓名</th>
									<th>性别</th>
									<th>手机号</th>
									<th>所属分公司</th>
									<th>部门</th>
									<th>岗位</th>
									<th>入职时间</th>
									<th>状态</th>
									<th width="220">操作</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($list as $o){?>
								<tr <?php if($o['status']==2){echo 'style="text-decoration: line-through;"';}?>>
								<td><?php echo($o['id']);?></td>
								<td><?php echo $o['staffid'];?></td>
								<td><?php echo $o['name'];?></td>
								<td><?php if($o['sexy']==0){echo('男');}else{echo('女');}?></td>
								<td><?php echo $o['mobile'];?></td>
								<td><?php echo $o['owenSubCompany'];?></td>
								<td><?php echo $o['owenDepartment'];?></td>
								<td><?php echo $o['owenPosition'];?></td>
								<td><?php echo $o['entryday'];?></td>
								<td><?php if($o['status']==1){echo '在职';}else{echo '离职';} ?></td>
								<td>
									<a href="<?php echo($settings['renderer']['home_path']);?>hr/detail/<?php echo $o['id'];?>" class="btn btn-link btn-gray">查看</a>
									<?php if($o['status']==1){?><a href="<?php echo($settings['renderer']['home_path']);?>sms/push/<?php echo $o['mobile'];?>" class="btn btn-link btn-green">发短信</a>
									<a href="<?php echo($settings['renderer']['home_path']);?>hr/form/<?php echo $o['id'];?>" class="btn btn-link btn-red">编辑</a>
									<a href="<?php echo($settings['renderer']['home_path']);?>hr/close/<?php echo $o['id'];?>" class="btn btn-link btn-blue close">离职</a>
									<?php } ?>
								</td>
								</tr>
								<?php }?>
							</tbody>
						</table>
					</div>
					<div class="height10"></div>
				</div>
			</div>
		</section>
		<?php require 'js.php';?>
		<script type="text/javascript">
			$(document).ready(function(){
				
			});
		</script>
	</body>
</html>
