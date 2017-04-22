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
						<i class="iconfont icon-baobiao"></i>
					</div>
					<div class="pull-left" style="padding-left:10px;">
						总企业数：<span class="text-color-red"><?php echo($count['all']);?></span> 家
					</div>
					<div class="pull-right">
						您的权限范围： <span class="text-color-green"><?php echo($u['authoritySubc']);?></span>，
						您所在分公司： <span class="text-color-green"><?php echo($u['subcompanyname']);?></span>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="box-body">
					<div class="tabbox">
						 <a href="<?php echo($settings['renderer']['home_path'].'companies');?>"<?php if($thismod==0){?> class="active"<?php } ?>>全部企业</a>
						 <a href="<?php echo($settings['renderer']['home_path'].'companies/30daykeyend');?>"<?php if($thismod==1){?> class="active"<?php } ?>>30天内税盘到期</a>
						 <a href="<?php echo($settings['renderer']['home_path'].'companies/30dayvpdnend');?>"<?php if($thismod==2){?> class="active"<?php } ?>>30天内VPDN到期</a>
						 <a href="<?php echo($settings['renderer']['home_path'].'companies/yearcheck');?>"<?php if($thismod==3){?> class="active"<?php } ?>>工商年检提醒</a>
					</div>
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
									<th>在执行合同</th>
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
						<?php
							$counts = $count['all'];
							pagenavi($settings['renderer']['home_path'].'companies',$p,$counts,10,"");
						?>
					</div>
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
