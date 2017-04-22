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
						当前 [ <span class="text-color-red">企业</span> ] 搜索结果，您设定的关键词为：<span class="text-color-red"><?php echo($key);?></span>，
						总计 <span class="text-color-red"><?php echo(count($list));?></span> 个结果。
						如需重新搜索，请点 <a href="<?php echo($settings['renderer']['home_path']);?>companies/search" class="text-color-red">返回</a>。
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
									<th width="50">ID</th>
									<th>公司名</th>
									<th>简称</th>
									<th>所属分公司</th>
									<th>业务员</th>
									<th>工商所属</th>
									<th>办公所属</th>
									<th>录入时间</th>
									<th>有效合同</th>
									<th width="180">操作</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($list as $o){?>
								<tr>
								<td><?php echo($o['id']);?></td>
								<td class="text-left"><?php echo $o['name'];?></td>
								<td><?php echo $o['sname'];?></td>
								<td><?php echo $o['owenSubCompany'];?></td>
								<td><?php echo $o['owenSaler'];?></td>
								<td><?php echo $o['prov'];?>-<?php echo $o['city'];?>-<?php echo $o['area'];?></td>
								<td><?php echo $o['bgprov'];?>-<?php echo $o['bgcity'];?>-<?php echo $o['bgarea'];?></td>
								<td><?php echo $o['creattime'];?></td>
								<td class="text-color-red">
								<?php 
									$h = hascontracts($o['id']);
									if($h == true){
										echo('有');
									}
								?>
								</td>
								<td>
									<a href="<?php echo($settings['renderer']['home_path']);?>companies/detail/<?php echo $o['id'];?>" class="btn btn-link btn-gray">查看</a>
									
									<a href="<?php echo($settings['renderer']['home_path']);?>companies/form/<?php echo $o['id'];?>" class="btn btn-link btn-red">编辑</a>
									<a href="<?php echo($settings['renderer']['home_path']);?>companies/detail/<?php echo $o['id'];?>/contracts" class="btn btn-link btn-blue">合同</a>
									
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
