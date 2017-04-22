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
						查看物品信息
					</div>
					<div class="pull-right">
						您的权限范围： <span class="text-color-green"><?php echo($u['authoritySubc']);?></span>，
						您所在分公司： <span class="text-color-green"><?php echo($u['subcompanyname']);?></span>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="box-body">
					<div class="qklist">
					<form id="mform" method="post" action="<?php echo($settings['renderer']['home_path']);?>executive/wpupdate" onsubmit="return demo()" name="reg_testdate">
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
								<input type="text" name="wname" id="did" onfocus="fun()" onblur="func()" required class="input input-default input-w250" value="<?php echo($wstock['name'])?>" datatype="s2-8"/>
									
							</div>
							<div class="form-filed-msg text-color-gray"></i> </div>
							<div class="clearfix"></div>
						</div>
					     <div class="form-item">
							<label class="form-filed-name">库存总数</label>
							<div class="form-filed-box">
								<input type="text" name="number" id="aid" onfocus="funa()" onblur="fund()" required class="input input-default input-w250" value="<?php echo($wstock['number'])?>" datatype="s2-8"/>
								
							</div>
							<div class="form-filed-msg text-color-gray"></i> </div>
							<div class="clearfix"></div>
						</div>          								
							<div class="form-item">
							<label class="form-filed-name">备注</label>
							<div class="form-filed-box">
								<textarea  name="remarks" class="input input-default" style="width:400px;height:100px;"><?php echo($wstock['remarks']) ?></textarea>
							</div>							
						</div>	
						<div class="form-item form-item-btn">
								<button type="submit" id="submiti" class="btn btn-big btn-red btn-w100"><i class="iconfont icon-baochi"></i> 提交修改</button>
						</div>
						<!--隐藏传输域-->
						<input type="hidden" name="tname" value="<?php echo($mode['name'])?>">
						<input type="hidden" name="id" value="<?php echo($wstock['id'])?>">

						<input type="hidden" name="wmobile" value="<?php echo($mode['mobile'])?>">
						<input type="hidden" name="departmentname" value="<?php echo($sub['subcompanyname'])?>-<?php echo($b['departmentname'])?>-<?php echo($red['positionname'])?>">
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
			function fun(){
				ss=document.getElementById('ss');
				ss.innerHTML="请输入物品名称，注:不要重复录入";
				ss.style.color="red";
			}
			function func(){
				did=document.getElementById('did');
				val=did.value;
				if(val.match(/[\u4e00-\u9fa5]/)==null){
					ss.innerHTML="请输入物品名称";
					ss.style.color="blue";
					return false;
				}else{
					ss.innerHTML="正确";
					ss.style.color="green";
					return true;
				}
			}
			function funa()	{
				mm=document.getElementById('mm');
				mm.innerHTML="请输入数量";
				mm.style.color="red";
			}
			function fund(){
				aid=document.getElementById('aid');
				val=aid.value;
				if(val.match(/^[1-9]\d*$/)==null){
					mm.innerHTML="请输入数量";
					mm.style.color="blue";
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
