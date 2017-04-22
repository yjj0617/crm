<?php 
	require 'header.php';
?>
	<body >
	<?php require 'head.php';?>
	<?php $modelNo=7; require 'sidebar.php';?>
		<section>

			<div class="pbox">
				<div class="box-head">
					<div class="pull-left">
						<i class="iconfont icon-baobiao"></i>
					</div>
					<div class="pull-left" style="padding-left:10px;">
						总服务数：<span class="text-color-red"><?php echo($count['all']);?></span> 项
					</div>
					
					<div class="clearfix"></div>
				</div>
				<div class="box-body">
					<div class="tabbox">
						
					</div>
					<div class="listbox">
						<table width="100%" class="table">
							<thead>
								<tr>
									<th>ID</th>
									<th>服务项目名称</th>
									<th>所属分类</th>
									<th>市场价</th>
									<th>统一价</th>
									<th>页面模板</th>
									<th>状态</th>
									<th>各地报价</th>
									<th width="220">操作</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($list as $o){?>
								<tr>
								<td><?php echo($o['id']);?></td>
								<td><?php echo($o['title']);?></td>
								<td><?php echo($o['cateName']);?></td>
								<td><del><?php echo($o['marketPrice']);?></del></td>
								<td class="text-color-red"><?php echo($o['allPrice']);?></td>
								<td><?php echo($o['template']);?></td>
								
								<td><?php if($o['status']==0){echo('已上架');}else{echo('已下架');} ?></td>
								<td>
									<a href="<?php echo($settings['renderer']['home_path']);?>cms/projects/detail/<?php echo($o['id']);?>" class="btn btn-link btn-oranage">管理</a>
								</td>
								<td>
									<a href="<?php echo($settings['renderer']['home_path']);?>cms/projects/detail/<?php echo($o['id']);?>" class="btn btn-link btn-gray">查看</a>
									<a href="<?php echo($settings['renderer']['home_path']);?>cms/projects/form/<?php echo($o['id']);?>" class="btn btn-link btn-red">编辑</a>
									<?php if($o['status']!=0){?>
									<a data-id="<?php echo($o['id']);?>" class="btn btn-link btn-green off">上架</a>
									<?php }else{?>
									<a data-id="<?php echo($o['id']);?>" class="btn btn-link btn-white off">下架</a>
									<?php } ?>
								</td>
								</tr>
								<?php }?>
							</tbody>
						</table>
						<?php
							
							pagenavi($settings['renderer']['home_path'].'cms/projects',$p,$count['all'],10,"");
						?>
					</div>
				</div>
			</div>

		</section>
		<?php require 'js.php';?>
	</body>
</html>
