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
						当前 [ <span class="text-color-red">客户</span> ] 搜索结果，您设定的关键词为：<span class="text-color-red"><?php echo($key);?></span>，
						总计 <span class="text-color-red"><?php echo(count($list));?></span> 个结果。
						如需重新搜索，请点 <a href="<?php echo($settings['renderer']['home_path']);?>customs/search" class="text-color-red">返回</a>。
					</div>
					<div class="pull-right">
						您的权限范围： <span class="text-color-green"><?php echo($u['authoritySubc']);?></span>，
						您所在分公司： <span class="text-color-green"><?php echo($u['subcompanyname']);?></span>
					</div>
				</div>
				<div class="box-body">
					<div class="listbox">
						<table width="100%" class="table">
							<thead>
								<tr>
									<th>ID</th>
									<th>姓名</th>
									<th>手机号</th>
									<th>备用手机</th>
									<th>所属分公司</th>
									<th>关联业务员</th>
									<th>所在地</th>
									<th>录入时间</th>
									<th>状态</th>
									<th width="220">操作</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($list as $o){?>
								<tr <?php if($o['status']==1){echo 'style="text-decoration: line-through;"';}?>>
								<td><?php echo($o['id']);?></td>
								<td><?php echo $o['name'];?></td>
								<td><?php echo $o['mobile'];?></td>
								<td><?php echo $o['mobile2'];?></td>
								<td><?php echo $o['owenSubCompany'];?></td>
								<td><?php echo $o['owenSaler'];?></td>
								<td><?php echo $o['prov'];?> - <?php echo $o['city'];?> - <?php echo $o['area'];?></td>
								
								<td><?php echo $o['creattime'];?></td>
								<td><?php if($o['status']==0){echo '正常';}else{echo '已关闭';} ?></td>
								<td>
									<a href="<?php echo($settings['renderer']['home_path']);?>customs/detail/<?php echo $o['id'];?>" class="btn btn-link btn-gray">查看</a>
									<a href="<?php echo($settings['renderer']['home_path']);?>sms/push/<?php echo $o['mobile'];?>" class="btn btn-link btn-green">发短信</a>
									<a href="<?php echo($settings['renderer']['home_path']);?>customs/form/<?php echo $o['id'];?>" class="btn btn-link btn-red">编辑</a>
									<a href="<?php echo($settings['renderer']['home_path']);?>customs/close/<?php echo $o['id'];?>" class="btn btn-link btn-oranage close">关闭</a>
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
		</script>
		<script type="text/javascript">
			//$(document).ready(function(){
				// $('.mycustoms').height($(window).height()-135);
				// $('.waitrun').height($(window).height()-597);
			//});
		</script>
		
	</body>
</html>
