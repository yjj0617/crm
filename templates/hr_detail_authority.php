<?php 
	require 'header.php';
?>
	<body >
	<?php require 'head.php';?>
	<?php $modelNo = 1; require 'sidebar.php';?>
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
						<?php $cmodel=1;  require 'hr_detail_nav.php';?>
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
							
							<div class="form">
							<form id="mform" method="post">
								<div class="form-item">
									<label class="form-filed-name">权限范围</label>
									<div class="form-filed-box" style="width:60%;max-width: calc(60%);">
										<?php 
										foreach($mc as $c){?>
											<label class="form-filed-box-label">
												<input type="checkbox" <?php if(hasinarray($c['id'],$m['authoritySubc']) == true){echo('checked="checked"');}?> name="authoritySubc[]" value="<?php echo($c['id']);?>" />
												[<?php echo($c['id']);?>]
												<?php echo($c['subcompanyname']);?>
											</label>
										<?php }?>
									</div>
									<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 设定员工对[ 客户、企业、合同 ]的查阅范围</div>
									<div class="clearfix"></div>
								</div>
								<div class="form-item">
									<label class="form-filed-name">操作权限</label>
									<div class="form-filed-box" style="width:60%;max-width: calc(60%);">
										<?php 
										foreach($ss as $s){?>
											<label class="form-filed-box-label">
												<input type="checkbox" <?php if(hasinarray($s['id'],$m['authority']) == true){echo('checked="checked"');}?> name="authority[]" value="<?php echo($s['id']);?>" />
												<?php echo($s['authorityname']);?>
											</label>
										<?php }?>
									</div>
									<div class="form-filed-msg text-color-gray"><i class="iconfont icon-gantanhao text-color-red"></i> 设定员工对需要权限操作的模块的操作权限</div>
									<div class="clearfix"></div>
								</div>
								
								<div class="form-item form-item-btn">
									<button type="button" id="submit" class="btn btn-big btn-red btn-w100"><i class="iconfont icon-baochi"></i> 保存</button>
								</div>
							</form>
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
					var uri = '<?php echo($settings['renderer']['home_path']);?>hr/detail/<?php echo($mid);?>/authority';
					$.post(uri,$('#mform').serialize(), function(data){
			          var d = data;
			          console.log(d);
			          if(d.flag == 200){
			            alert(d.msg);
			            window.location = '<?php echo($settings['renderer']['home_path']);?>hr/detail/<?php echo($mid);?>/authority'; 
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
