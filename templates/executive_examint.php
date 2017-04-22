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
						申领审批
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
							<label class="form-filed-name">申请人</label>
							<div class="form-filed-box">
									<?php echo($apply['name'])?>	
							</div>
							<div class="form-filed-msg text-color-gray"></i> </div>
							<div class="clearfix"></div>
														
							
						</div>
						
						<div class="form-item">
							<label class="form-filed-name">联系方式</label>
							<div class="form-filed-box">
								<?php echo($apply['bmobile'])?>
							</div>
							<div class="form-filed-msg text-color-gray"></i> </div>
							<div class="clearfix"></div>							
							
						</div> 
						<div class="form-item">
							<label class="form-filed-name">所在部门</label>
							<div class="form-filed-box">
								<?php echo($apply['department'])?>
									
							</div>
							<div class="form-filed-msg text-color-gray"></i> </div>
							<div class="clearfix"></div>
														
							
						</div>                      
						<div class="form-item">
							<label class="form-filed-name">物品名称</label>
							<div class="form-filed-box">
								<?php echo($apply['letmname'])?>
							</div>
							<div class="form-filed-msg text-color-gray"></i> </div>
							<div class="clearfix"></div>							
							
						</div> 							
						<div class="form-item">
							<label class="form-filed-name">库存数量</label>
							<div class="form-filed-box">
								<?php echo($apply['number'])?>
							</div>
							<div class="form-filed-msg text-color-gray"></i> </div>
							<div class="clearfix"></div>							
							
						</div>
						<div class="form-item">
							<label class="form-filed-name">申领数量</label>
							<div class="form-filed-box">
								<?php echo($apply['snumber'])?>
								
							</div>
							<div class="form-filed-msg text-color-gray"></i> </div>
							<div class="clearfix"></div>						
							
						</div> 						
						<div class="form-item">
							<label class="form-filed-name">申请说明</label>
							<div class="form-filed-box">
								<?php echo($apply['remarks'])?>								
							</div>							
						</div>	
						<div class="form-item form-item-btn">
						<?php if($apply['status']==0){?>
								<a href="<?php echo($settings['renderer']['home_path']);?>executive/sagree/<?php echo $apply['id'];?>" class="btn btn-big btn-blue btn-w100">同意</a>
								<button class="btn btn-big btn-red btn-w100"><i class="iconfont icon-baochi"></i>不同意</button>
								<?php }?>
							<?php if($apply['status']==1||$apply['status']==2){?>
								<a href="<?php echo($settings['renderer']['home_path']);?>executive/applyedit" class="btn btn-big btn-blue btn-w100">返回</a>
							<?php }?>		
							
								

						</div>
						<!--隐藏传输域-->											
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
