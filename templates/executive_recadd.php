<?php 
	require 'header.php';
?>
	<body >
	<link rel="stylesheet" href="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/css/clndr.css">
	<?php require 'head.php';?>
	<?php $modelNo = 7; require 'sidebar.php';?>
		<section>
			<div class="pbox">
				<div class="box-head">
					<div class="pull-left">
						<i class="iconfont icon-fuwu5"></i>
					</div>
					<div class="pull-left" style="padding-left:10px;">
						物品申领
					</div>
					<div class="pull-right">
						您的权限范围： <span class="text-color-green"><?php echo($u['authoritySubc']);?></span>，
						您所在分公司： <span class="text-color-green"><?php echo($u['subcompanyname']);?></span>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="box-body">
					<div class="qklist">
					<form id="mform" method="post" action="<?php echo($settings['renderer']['home_path']);?>executive/sinsert" onsubmit="return demo()" name="reg_testdate">
						<div class="form-item">
							<label class="form-filed-name">姓名</label>
							<div class="form-filed-box">
									<?php echo($mode['name'])?>	
							</div>
							<div class="form-filed-msg text-color-gray"></i> </div>
							<div class="clearfix"></div>
														
							
						</div>
						
						<div class="form-item">
							<label class="form-filed-name">联系方式</label>
							<div class="form-filed-box">
								<?php echo($mode['mobile'])?>
							</div>
							<div class="form-filed-msg text-color-gray"></i> </div>
							<div class="clearfix"></div>							
							
						</div> 
						<div class="form-item">
							<label class="form-filed-name">所在部门</label>
							<div class="form-filed-box">
									<?php echo($sub['subcompanyname'])?>-<?php echo($b['departmentname'])?>-<?php echo($red['positionname'])?>
							</div>
							<div class="form-filed-msg text-color-gray"></i> </div>
							<div class="clearfix"></div>
														
							
						</div>                      
						<div class="form-item">
							<label class="form-filed-name">物品名称</label>
							<div class="form-filed-box">
								<?php echo($wstock['name'])?>
							</div>
							<div class="form-filed-msg text-color-gray"></i> </div>
							<div class="clearfix"></div>							
							
						</div> 							
						<div class="form-item">
							<label class="form-filed-name">库存数量</label>
							<div class="form-filed-box">
								<?php echo($wstock['number'])?>
							</div>
							<div class="form-filed-msg text-color-gray"></i> </div>
							<div class="clearfix"></div>							
							
						</div>
						<div class="form-item">
							<label class="form-filed-name">申领数量</label>
							<div class="form-filed-box">
								<input type="text" name="snumber" id="aid" onfocus="funa()" onblur="fund()" required class="input input-default input-w250" value="" datatype="s2-8"/>
							</div><span id="mm"></span>
							<div class="form-filed-msg text-color-gray"></i> </div>
							<div class="clearfix"></div>						
							
						</div> 						
							<div class="form-item">
							<label class="form-filed-name">备注</label>
							<div class="form-filed-box">
								<textarea  name="remarks" class="input input-default" style="width:400px;height:100px;" ></textarea>
							</div>
							
						</div>	

						<div class="form-item form-item-btn">

								<button type="submit" id="submiti" class="btn btn-big btn-red btn-w100"><i class="iconfont icon-baochi"></i> 提交</button>	
								

						</div>
						<!--隐藏传输域-->
						<input type="hidden" name="tname" value="<?php echo($mode['name'])?>">
						<input type="hidden" name="wmobile" value="<?php echo($mode['mobile'])?>">
						<input type="hidden" name="pid" value="<?php echo($mode['id'])?>">
						<input type="hidden" name="departmentname" value="<?php echo($sub['subcompanyname'])?>-<?php echo($b['departmentname'])?>-<?php echo($red['positionname'])?>">
						<input type="hidden" name="wname" value="<?php echo($wstock['name'])?>">
						<input type="hidden" name="number" value="<?php echo($wstock['number'])?>">
						<input type="hidden" name="upid" value="<?php echo($wstock['id'])?>">						
						</form>
					
					</div>
					
				</div>
			</div>
		</section>
		<?php require 'js.php';?>
		<script src="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/js/underscore-min.js"></script>
    	<script src="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/js/moment-with-locales.min.js"></script>
    	<script src="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/js/clndr.js"></script>
		<script type="text/javascript">

			function funa()	{
				mm=document.getElementById('mm');
				mm.innerHTML="请输入数量 (注:不得超过库存数量)";
				mm.style.color="blue";
			}
			function fund(){
				aid=document.getElementById('aid');
				val=aid.value;
				if(val.match(/^[1-9]\d*$/)==null){
					mm.innerHTML="请输入数量";
					mm.style.color="red";
					return false;
				}else{
					mm.innerHTML="正确";
					mm.style.color="green";
					return true;
				}
			}	
		</script>

	</body>
</html>
