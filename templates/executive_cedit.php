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
						记录信息查看
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
									<?php echo($stock['tname'])?>	
							</div>
							<div class="form-filed-msg text-color-gray"></i> </div>
							<div class="clearfix"></div>									
						</div>
						
						<div class="form-item">
							<label class="form-filed-name">联系方式</label>
							<div class="form-filed-box">
								<?php echo($stock['wmobile'])?>
							</div>
							<div class="form-filed-msg text-color-gray"></i> </div>
							<div class="clearfix"></div>							
						</div> 
						<div class="form-item">
							<label class="form-filed-name">所在部门</label>
							<div class="form-filed-box">
									<?php echo($stock['departmentname'])?>
							</div>
							<div class="form-filed-msg text-color-gray"></i> </div>
							<div class="clearfix"></div>
						</div>                      
						<div class="form-item">
							<label class="form-filed-name">物品名称</label>
							<div class="form-filed-box">
									<?php echo($stock['wname'])?>
							</div>
							<div class="form-filed-msg text-color-gray"></i> </div>
							<div class="clearfix"></div>
						</div> 
						<div class="form-item">
							<label class="form-filed-name">操作数量</label>
							<div class="form-filed-box">
									<?php echo($stock['number'])?>
							</div>
							<div class="form-filed-msg text-color-gray"></i> </div>
							<div class="clearfix"></div>
						</div> 								
						<div class="form-item">
							<label class="form-filed-name">操作状态</label>
							<div class="form-filed-box">
									<?php echo($stock['wupdate'])?>
							</div>
							<div class="form-filed-msg text-color-gray"></i> </div>
							<div class="clearfix"></div>
						</div>	
						<div class="form-item">
							<label class="form-filed-name">操作前库存</label>
							<div class="form-filed-box">
									<?php echo($stock['qian'])?>
							</div>
							<div class="form-filed-msg text-color-gray"></i> </div>
							<div class="clearfix"></div>
						</div>
						<?php if($stock['znumber']){?>
						<div class="form-item">
							<label class="form-filed-name">操作后库存</label>
							<div class="form-filed-box">
									<?php echo($stock['znumber'])?>
							</div>
							<div class="form-filed-msg text-color-gray"></i> </div>
							<div class="clearfix"></div>
						</div>
						<?php }?>
						<div class="form-item">
							<label class="form-filed-name">操作时间</label>
							<div class="form-filed-box">
									<?php echo($stock['wtime'])?>
							</div>
							<div class="form-filed-msg text-color-gray"></i> </div>
							<div class="clearfix"></div>
						</div>
						<?php if($stock['sc']){?>
						<div class="form-item">
							<label class="form-filed-name">审核人</label>
							<div class="form-filed-box">
									<?php echo($stock['sc'])?>
							</div>
							<div class="form-filed-msg text-color-gray"></i> </div>
							<div class="clearfix"></div>
						</div>
						<?php }?>
						<div class="form-item">
							<label class="form-filed-name">备注</label>
							<div class="form-filed-box">
									<?php echo($stock['remarks'])?>
							</div>
							<div class="form-filed-msg text-color-gray"></i> </div>
							<div class="clearfix"></div>
						</div>						
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
