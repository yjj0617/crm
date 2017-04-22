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
						员工 [ <span class="text-color-red"><?php echo($m['name']);?></span> ] 的 [ <?php echo($month);?> ]绩效。
					</div>
					<div class="pull-right text-right" style="padding-left:50px;min-width:500px;">
					</div>
				</div>
				<div class="box-body">
					<div class="tabbox">
						<?php $cmodel=4;  require 'hr_detail_nav.php';?>
					</div>
					<div class="infobox">
						<div class="cells">
							<div class="cells-item">
								<label class="cells-filed-name">ID</label>
								<div class="cells-filed-box">
									<?php echo($m['id']);?>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">员工编号</label>
								<div class="cells-filed-box">
									<?php 
										echo($m['staffid']);
									?>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">员工姓名</label>
								<div class="cells-filed-box">
									<?php 
										echo($m['name']);
										if($m['status']==1){
											echo(' <span class="text-color-gray">[在职]</span>');
										}else{
											echo(' <span class="text-color-gray">[已离职]</span>');
										}
									?>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">所属</label>
								<div class="cells-filed-box">
									<?php echo($m['owenSubCompany']);?>
									<span class="text-color-gray">-></span> <?php echo($m['owenDepartment']);?>
									<span class="text-color-gray">-></span> <?php echo($m['owenPosition']);?>
								</div>
								<div class="clearfix"></div>
							</div>

							<div class="cells-item">
								<label class="cells-filed-name">当前绩效计算月份</label>
								<div class="cells-filed-box">
									<span class="pull-right font-size-12" style="padding-right:50px;">
										查看其它月份：
										<select id="year" name="year">
											<option value="<?php echo(date('Y'));?>"><?php echo(date('Y'));?></option>
										</select> -
										<select id="month" name="month">
											<option value="0">选择</option>
											<?php for($i=1;$i<=12;$i++){?>
											<option value="<?php echo($i);?>"><?php echo($i);?></option>
											<?php } ?>
										</select>
									</span>
									<?php echo(date('Y年m月',strtotime('-1 month')));?>
									<span class="text-color-gray">( 本月计算上月1日～31日薪资 )</span>
								</div>
								<div class="clearfix"></div>
							</div>

							<div class="cells-item">
								<label class="cells-filed-name">当月绩效核算</label>
								<div class="cells-filed-box" style="max-width:80%;width:80%;">
									<span id="total" class="font-size-24 text-color-red">0</span> 元
									<div class="clearfix"></div>
								</div>
								<div class="clearfix"></div>
							</div>

							
							<div class="cells-item">
								<label class="cells-filed-name">核算周期内收款记录</label>
								<div class="cells-filed-box" style="max-width:100%;width:100%;margin-top:10px;">
									<table class="table" width="100%">
										<thead>
											<th>ID</th>
											<th>合同ID</th>
											<th>合同类型</th>
											<th>合同编号</th>
											<th>签约主体</th>
											<th>合同总金额</th>
											<th>总成本</th>
											<th>已入帐款</th>
											<th>本笔收款</th>
											<th>是否核算</th>
											<th>提成比例</th>
											<th>提成金额</th>
											<th>入帐日期</th>
											<th>操作</th>
										</thead>
										<tbody>
										<?php 
											$totaln = 0;
											if($list){
												
											foreach($list as $or){
												$ls = $or['money_total'] - $or['cost'];
												?>
											<tr>
												<td class="text-color-gray"><?php echo($or['id']);?></td>
												<td class="text-color-gray"><?php echo($or['contract_id']);?></td>
												<td class="text-color-gray">
												<?php echo($or['typename']);?></td>
												<td class="text-color-gray"><?php echo($or['cno']);?></td>
												<td class="text-color-gray">
													<?php if($or['cutype']==1){
															echo($or['comname']);
														}else{
															echo($or['cusname'].'[ 个人 ]');
														}
													?>
												</td>
												<td><?php echo($or['money_total']);?></td>
												<td><?php echo($or['cost']);?></td>
												<td><?php echo($or['money_ok']);?></td>
												<td><?php echo($or['money']);?></td>
												<td>
												<?php 
													if($or['money_ok']==$or['money_total']){
														echo('是');
													}else{
														echo('<span class="text-color-gray">否</span>');
													}
												?></td>
												<td class="text-color-gray">
												<?php 
													if($or['type']==1){
														if($or['paytype']=='半年付'){
															echo('(1/12/)*(2/3)');
														}elseif($or['paytype']=='季付'){
															echo('(1/12)*(1/3)');
														}else{
															echo('1/12');
														}
													}else{
														if($ls<4000){
															echo('12%');
														}elseif($ls>=4000 && $ls<7000){
															echo('14%');
														}elseif($ls>=7000 && $ls<11000){
															echo('16%');
														}elseif($ls>=11000 && $ls<16000){
															echo('18%');
														}elseif($ls>=16000 && $ls<22000){
															echo('20%');
														}elseif($ls>=22000 && $ls<29000){
															echo('22%');
														}elseif($ls>=29000 && $ls<37000){
															echo('24%');
														}elseif($ls>=37000){
															echo('30%');
														}
														
													}?>
												</td>
												<td class="tsnum">
												<?php 
												
												if($or['money_ok']==$or['money_total']){
													$n = 0;
													if($or['type']==1){

														if($or['paytype']=='半年付'){
															$n = ($ls*1/12/3*2);
														}elseif($or['paytype']=='季付'){
															$n = ($ls*1/12/3);
														}else{
															$n = ($ls*1/12);
														}


													}else{
														
														if($ls<4000){
															$n = ($ls*0.12);
														}elseif($ls>=4000 && $ls<7000){
															$n = ($ls*0.14);
														}elseif($ls>=7000 && $ls<11000){
															$n = ($ls*0.16);
														}elseif($ls>=11000 && $ls<16000){
															$n = ($ls*0.18);
														}elseif($ls>=16000 && $ls<22000){
															$n = ($ls*0.20);
														}elseif($ls>=22000 && $ls<29000){
															$n = ($ls*0.22);
														}elseif($ls>=29000 && $ls<37000){
															$n = ($ls*0.24);
														}elseif($ls>=37000){
															$n = ($ls*0.30);
														}
														
													} 
													echo($n);
													$totaln = $totaln + $n;
												}?>
												</td>
												<td class="text-color-gray"><?php echo($or['entry_day']);?></td>

												<td><a target="_blank" href="<?php echo($settings['renderer']['home_path']);?>contracts/detail/<?php echo $or['contract_id'];?>" class="btn btn-link btn-gray">查看合同</a></td>
											</tr>
										<?php }} ?>
										</tbody>
									</table>
									<span class="hide" id="tan"><?php echo($totaln);?></span>
								</div>
								<div class="clearfix"></div>
							</div>
							
							
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php require 'js.php';?>
		<script type="text/javascript">
		</script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#total').html($('#tan').html());
				
				function fix(num, length) {
				  return ('' + num).length < length ? ((new Array(length + 1)).join('0') + num).slice(-length) : '' + num;
				}

				$('#month').change(function(){
					var year = $('#year').val();
					var month = fix($('#month').val(),2);
					var ym = year +''+ month;
					
					window.location = "<?php echo($settings['renderer']['home_path'].'hr/detail/'.$mid);?>"+'/performance/'+ym;
					
				});
			});
		</script>
		
	</body>
</html>
