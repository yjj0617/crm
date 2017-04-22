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
						员工 [ <span class="text-color-red"><?php echo($m['name']);?></span> ] 的权限配置
					</div>
					<div class="pull-right text-right" style="padding-left:50px;min-width:500px;">
					</div>
				</div>
				<div class="box-body">
					<div class="tabbox">
						<?php $cmodel=2;  require 'hr_detail_nav.php';?>
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
								<label class="cells-filed-name">基本薪资</label>
								<div class="cells-filed-box">
									<?php 
										if($m['remunerationM']!= 0.00 || $m['remunerationM'] != NULL){
											echo($m['remunerationM']);
										}else{
											echo('( 未设定 )');
										}
									?> <span class="text-color-blue">元 / 月</span>
								</div>
								<div class="clearfix"></div>
							</div>

							<div class="cells-item">
								<label class="cells-filed-name">当前薪资计算月份</label>
								<div class="cells-filed-box">
									<?php echo(date('Y年m月',strtotime('-1 month')));?>
									<span class="text-color-gray">( 本月计算上月1日～31日薪资 )</span>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">当月薪资计算</label>
								<div class="cells-filed-box" style="max-width:80%;width:80%;">
									<div class="pull-left text-center" style="width:150px;">
										<span class="font-size-12 text-color-gray">基本薪资</span>
										<br />
										<span class="font-size-24"><?php echo($m['remunerationM']);?></span>
									</div>
									<div class="pull-left">
										<span class="text-color-red font-size-24">+</span>
									</div>
									<div class="pull-left text-center" style="width:150px;">
										<span class="font-size-12 text-color-gray">绩效提成</span>
										<br />
										<span class="font-size-24"><?php echo(sprintf("%.2f",$m['remuneration']['tc']));?></span>
									</div>
									<div class="pull-left">
										<span class="text-color-red font-size-24">+</span>
									</div>
									<div class="pull-left text-center" style="width:150px;">
										<span class="font-size-12 text-color-gray">浮动工资</span>
										<br />
										<span class="font-size-24"><?php echo(sprintf("%.2f",$m['remuneration']['fd']));?></span>
									</div>
									<div class="pull-left">
										<span class="text-color-blue font-size-24">-</span>
									</div>
									<div class="pull-left text-center" style="width:150px;">
										<span class="font-size-12 text-color-gray">社保代扣</span>
										<br />
										<span class="font-size-24 text-color-blue"><?php echo(sprintf("%.2f",$m['remuneration']['sb']));?></span>
									</div>
									<div class="pull-left">
										<span class="text-color-blue font-size-24">-</span>
									</div>
									<div class="pull-left text-center" style="width:150px;">
										<span class="font-size-12 text-color-gray">罚款扣款</span>
										<br />
										<span class="font-size-24 text-color-blue"><?php echo(sprintf("%.2f",$m['remuneration']['fk']));?></span>
									</div>
									<div class="pull-left">
										<span class="text-color-gray font-size-24">=</span>
									</div>
									<div class="pull-left text-center" style="width:150px;">
										<span class="font-size-12 text-color-gray">实发薪资合计</span>
										<br />
										<span class="font-size-24"><?php echo(sprintf("%.2f",$m['remuneration']['total']));?></span>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="clearfix"></div>
							</div>

							<div class="cells-item">
								<label class="cells-filed-name">生成工资条</label>
								<div class="cells-filed-box">
									<?php if($m['remuneration']['total'] == 0.00 || $m['remuneration']['total'] == NULL){?>
									当月工资条尚未生成，请填写以下内容并点击生成工资条。
									<?php }else{ ?>
										如需修改，请填写以下内容。
									<?php } ?>

									<form id="mform" method="post" style="margin-top:15px;">
									<div class="form-item">
										<label class="form-filed-name">绩效提成</label>
										<div class="form-filed-box">
											<input type="number" name="tc" class="input input-default" value="<?php echo($m['remuneration']['tc']);?>"  />
										</div>
										<div class="form-filed-msg text-color-gray">
											<a href="<?php echo($settings['renderer']['home_path'].'hr/detail/'.$mid.'/performance');?>" target="_blank" class="text-color-blue">查看当月绩效详情</a>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="form-item">
										<label class="form-filed-name">浮动工资</label>
										<div class="form-filed-box">
											<input type="number" name="fd" class="input input-default" value="<?php echo($m['remuneration']['fd']);?>"  />
										</div>
										<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 浮动工资为突发情况下无法正常计算的不确定工资，如无则不填。</div>
										<div class="clearfix"></div>
									</div>
									<div class="form-item">
										<label class="form-filed-name">社保代扣</label>
										<div class="form-filed-box">
											<input type="number" name="sb" class="input input-default" value="<?php echo($m['remuneration']['sb']);?>"  />
										</div>
										<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 填写当月社保扣款额。</div>
										<div class="clearfix"></div>
									</div>
									<div class="form-item">
										<label class="form-filed-name">罚款扣款</label>
										<div class="form-filed-box">
											<input type="number" name="fk" class="input input-default" value="<?php echo($m['remuneration']['fk']);?>"  />
										</div>
										<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 如无则可不填。</div>
										<div class="clearfix"></div>
									</div>
									<div class="form-item">
										<label class="form-filed-name">备注</label>
										<div class="form-filed-box">
											<textarea name="more" class="input" style="width:600px;height:80px;"><?php echo($m['remuneration']['more']);?></textarea>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="form-item form-item-btn">
										<button type="button" id="submit" class="btn btn-big btn-red btn-w100"><i class="iconfont icon-baochi"></i> 保存并生成工资条</button>
									</div>
									<input type="hidden" name="remuneration" value="<?php echo($m['remunerationM']);?>" />
									</form>


								</div>
								<div class="clearfix"></div>
							</div>

							<div class="cells-item">
								<label class="cells-filed-name">近12个月工资条</label>
								<div class="cells-filed-box">
									<table class="table" width="100%">
										<thead>
											<th>月份</th>
											<th>基本薪资</th>
											<th>绩效提成</th>
											<th>浮动工资</th>
											<th>社保代扣</th>
											<th>罚款扣款</th>
											<th>实发薪资合计</th>
											<th>生成时间</th>
											<th>状态</th>
											<th>备注</th>
										</thead>
										<tbody>
										<?php 
											if($m['oldremuneration']){
											foreach($m['oldremuneration'] as $or){?>
											<tr>
												<td><?php echo($or['month']);?></td>
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
											</tr>
										<?php }} ?>
										</tbody>
									</table>
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
				$('#submit').click(function(){
					var uri = '<?php echo($settings['renderer']['home_path']);?>hr/detail/<?php echo($mid);?>/remuneration';
					$.post(uri,$('#mform').serialize(), function(data){
			          var d = data;
			          console.log(d);
			          if(d.flag == 200){
			            alert(d.msg);
			            window.location = '<?php echo($settings['renderer']['home_path']);?>hr/detail/<?php echo($mid);?>/remuneration'; 
			            return false;
			          }else{
			            alert(d.msg);
			            window.location.reload();
			          }
			        });
				});
			});
		</script>
		
	</body>
</html>
