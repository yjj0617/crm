<?php 
	require 'header.php';
?>
	<body >
	<?php require 'head.php';?>
	<?php $modelNo=4; require 'sidebar.php';?>
		<section>
			<div class="pbox">
				<div class="box-head">
					<div class="pull-left">
						<i class="iconfont icon-baobiao"></i>
					</div>
					<div class="pull-left" style="padding-left:10px;">
						<span class="text-color-red"><?php echo($month);?></span> 月份薪资表
					</div>
					
					<div class="pull-right">
						您所在分公司： <span class="text-color-green"><?php echo($u['subcompanyname']);?></span>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="box-body">
					<div class="tabbox">
						
							<span class="pull-right font-size-12">
								月份：
								<select id="year" name="year">
									<option value="<?php echo(date('Y'));?>"><?php echo(date('Y'));?></option>
								</select>-
								<select id="month" name="month">
									<?php for($i=1;$i<=12;$i++){?>
									<option value="<?php echo($i);?>"><?php echo($i);?></option>
									<?php } ?>
								</select>
							<?php if($_COOKIE['subcomid']==1){?>
								&nbsp;&nbsp;&nbsp;&nbsp;
								查看其它分公司：
								<select id="getsubcsatff">
									<option value="">请选择</option>
								<?php foreach ($subcompanylist as $sc) {?>
									<option <?php if($subc==$sc['id']){echo('selected="selected"');}?> value="<?php echo($sc['id']);?>">
										<?php echo($sc['subcompanyname']);?>
									</option>
								<?php } ?>
								</select>
								<?php } ?>
							</span>
						
						 <a class="active">薪资列表</a>
						 
					</div>
					<div class="listbox">
						<table class="table" width="100%">
										<thead>
											<th>月份</th>
											<th>所属公司</th>
											<th>员工</th>
											<th>基本薪资</th>
											<th>绩效提成</th>
											<th>浮动工资</th>
											<th>社保代扣</th>
											<th>罚款扣款</th>
											<th>实发薪资合计</th>
											<th>生成时间</th>
											<th>状态</th>
											<th>备注</th>
											<th>操作</th>
										</thead>
										<tbody>
										<?php 
											if($list){
											foreach($list as $or){?>
											<tr>
												<td><?php echo($or['month']);?></td>
												<td><?php echo($or['subcname']);?></td>
												<td><?php echo($or['satffname']);?></td>
												<td><?php echo($or['remuneration']);?></td>
												<td><?php echo($or['tc']);?></td>
												<td><?php echo($or['fd']);?></td>
												<td><?php echo($or['sb']);?></td>
												<td><?php echo($or['fk']);?></td>
												<td><?php echo($or['total']);?></td>

												<td><?php echo($or['creattime']);?></td>
												<td><?php if($or['status']==1){
													echo('已发放');
												}else{ echo('<span class="text-color-gray">未发放</span>');}?></td>
												<td width='300'><?php echo($or['more']);?></td>
												<td>
												<a href="<?php echo($settings['renderer']['home_path']);?>hr/detail/<?php echo $or['staffId'];?>/remuneration" class="btn btn-link btn-gray">查看</a>
												</td>
											</tr>
										<?php }} ?>
										</tbody>
									</table>
						<?php
							
							pagenavi($settings['renderer']['home_path'].'hr/remunerationlog',$p,$count,10,"$subc/$month");
						?>
					</div>
				</div>
			</div>
		</section>
		
		<?php require 'js.php';?>
	
		<script type="text/javascript">
			$(document).ready(function(){
				function fix(num, length) {
				  return ('' + num).length < length ? ((new Array(length + 1)).join('0') + num).slice(-length) : '' + num;
				}
				$('#getsubcsatff,#month').change(function(){
					<?php if($_COOKIE['subcomid']!=1){?>
						var sid = <?php echo($_COOKIE['subcomid']);?>;
					<?php }else{?>
						var sid = $('#getsubcsatff').val();
					<?php }?>
					var year = $('#year').val();
					var month = fix($('#month').val(),2);
					var ym = year +''+ month;
					if(sid!=''){
						window.location = "<?php echo($settings['renderer']['home_path'].'hr/remunerationlog/');?>"+sid+'/'+ym;
					}else{
						window.location = "<?php echo($settings['renderer']['home_path'].'hr/remunerationlog/1/');?>"+ym;
					}
				});
			});
		</script>
		
	</body>
</html>
