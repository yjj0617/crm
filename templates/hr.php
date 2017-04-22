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
						在职总员工数：<span class="text-color-red"><?php echo($count['all']);?></span> 人
					</div>
					<div class="pull-left" style="padding-left:10px;">
						当前分公司在职员工数：<span class="text-color-red"><?php echo($count['subconine']);?></span> 人
					</div>
					<div class="pull-right">
						您所在分公司： <span class="text-color-green"><?php echo($u['subcompanyname']);?></span>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="box-body">
					<div class="tabbox">
						<?php if($_COOKIE['subcomid']==1){?>
							<span class="pull-right font-size-12">
								查看其它分公司：
								<select id="getsubcsatff">
									<option value="">请选择</option>
								<?php foreach ($subcompanylist as $sc) {?>
									<option <?php if($subc==$sc['id']){echo('selected="selected"');}?> value="<?php echo($sc['id']);?>">
										<?php echo($sc['subcompanyname']);?>
									</option>
								<?php } ?>
								</select>
							</span>
						<?php } ?>
						 <a href="<?php echo($settings['renderer']['home_path'].'hr/1/'.$subc);?>" <?php if($s==1){echo('class="active"');}?>>在职员工</a>

						 <a href="<?php echo($settings['renderer']['home_path'].'hr/2/'.$subc);?>" <?php if($s==2){echo('class="active"');}?>>离职员工</a>
						 
					</div>
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
						<?php
							$counts = $count['subc'];
							pagenavi($settings['renderer']['home_path'].'hr',$p,$counts,10,"$s/$subc");
						?>
					</div>
				</div>
			</div>
		</section>
		
		<?php require 'js.php';?>
	
		<script type="text/javascript">
			$(document).ready(function(){
				$('#getsubcsatff').change(function(){
					var sid = $(this).val();
					if(sid!=''){
						window.location = "<?php echo($settings['renderer']['home_path'].'hr/1/');?>"+sid;
					}else{
						window.location = "<?php echo($settings['renderer']['home_path'].'hr/1');?>";
					}
					
				});
			});
		</script>
		
	</body>
</html>
