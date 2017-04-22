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
						员工 [ <span class="text-color-red"><?php echo($m['name']);?></span> ] 的详细资料
					</div>
					<div class="pull-right text-right" style="padding-left:50px;min-width:500px;">
						
					</div>
				</div>
				<div class="box-body">
					<div class="tabbox">
						<?php $cmodel=0;  require 'hr_detail_nav.php';?>
					</div>
					<div class="infobox">
						<div class="card">
							<div class="card-img">
							<?php if($m['photo']!=''){?>
								<img src="<?php echo($assets_path.$m['photo']);?>" width="150" height="200" />
							<?php }else{?>
								<img src="<?php echo($settings['renderer']['home_path'].$settings['renderer']['template_path']);?>dist/img/nophoto.png" width="150" height="200" />
							<?php }?>
							</div>
							<div class="card-info text-center">
								<span class="font-size-14"><?php echo($m['staffid']);?></span>
								<br />
								<span class="font-size-28"><?php echo($m['name']);?></span><br />
								<span class="font-size-14"><?php echo($m['mobile']);?></span>
								<div class="clearfix" style="margin-top:15px;"></div>
								<div class="pull-left card-meta">
									<span class="font-size-12">公司</span>
									<br />
									<?php echo($m['owenSubCompany']);?>
								</div>
								<div class="pull-left card-meta">
									<span class="font-size-12">部门</span>
									<br />
									<?php echo($m['owenDepartment']);?>
								</div>
								<div class="pull-left card-meta">
									<span class="font-size-12">岗位</span>
									<br />
									<?php echo($m['owenPosition']);?>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="cells">
							<div class="cells-item">
								<label class="cells-filed-name">ID</label>
								<div class="cells-filed-box">
									<span class="pull-right">
										<a href="<?php echo($settings['renderer']['home_path']);?>hr/form/<?php echo $m['id'];?>" class="btn btn-link btn-red">编辑基本信息</a>
										<a href="<?php echo($settings['renderer']['home_path']);?>sms/push/<?php echo $m['mobile'];?>" class="btn btn-link btn-green">发送短信</a>
										
									</span>
									
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
								<label class="cells-filed-name">手机号码</label>
								<div class="cells-filed-box"><?php echo($m['mobile']);?></div>
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
								<label class="cells-filed-name">入职时间</label>
								<div class="cells-filed-box"><?php echo($m['entryday']);?></div>
								<div class="clearfix"></div>
							</div>

							<div class="cells-item">
								<label class="cells-filed-name">openID[微信]</label>
								<div class="cells-filed-box"><?php echo($m['openID']);?></div>
								<div class="clearfix"></div>
							</div>

							<div class="item-space"></div>
							<div class="cells-item">
								<label class="cells-filed-name">性别</label>
								<div class="cells-filed-box">
									<?php 
										if($m['sexy']==0){
											echo('先生');
										}else{
											echo('女士');
										}
									?>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">出生年月</label>
								<div class="cells-filed-box"><?php echo($m['birthday']);?>
								<span class="text-color-blue">[ 
									<?php echo(nongli(date('Ymd',strtotime($m['birthday']))));?> ]</span>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">身份证号码</label>
								<div class="cells-filed-box"><?php echo($m['sfz']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">民族</label>
								<div class="cells-filed-box"><?php echo($m['nation']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">政治面貌</label>
								<div class="cells-filed-box"><?php echo($m['political']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="item-space"></div>
							<div class="cells-item">
								<label class="cells-filed-name">户口所在地</label>
								<div class="cells-filed-box"><?php echo($m['crossprev']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">户口详细地址</label>
								<div class="cells-filed-box"><?php echo($m['crossaddress']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="item-space"></div>
							<div class="cells-item">
								<label class="cells-filed-name">毕业学校</label>
								<div class="cells-filed-box"><?php echo($m['school']);?></div>
								<div class="clearfix"></div>
							</div>

							<div class="cells-item">
								<label class="cells-filed-name">所学专业</label>
								<div class="cells-filed-box"><?php echo($m['specialty']);?></div>
								<div class="clearfix"></div>
							</div>

							<div class="cells-item">
								<label class="cells-filed-name">最高学历</label>
								<div class="cells-filed-box"><?php echo($m['education']);?></div>
								<div class="clearfix"></div>
							</div>

							<div class="cells-item">
								<label class="cells-filed-name">执业资格证书</label>
								<div class="cells-filed-box"><?php echo($m['certificate']);?></div>
								<div class="clearfix"></div>
							</div>
							
							<div class="item-space"></div>
							
							<div class="cells-item">
								<label class="cells-filed-name">当前所在地</label>
								<div class="cells-filed-box"><?php echo($m['prov']);?>-<?php echo($m['city']);?>-<?php echo($m['area']);?></div>
								<div class="clearfix"></div>
							</div>

							<div class="item-space"></div>
							<div class="cells-item">
								<label class="cells-filed-name">家庭电话</label>
								<div class="cells-filed-box"><?php echo($m['familyphone']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">联系地址</label>
								<div class="cells-filed-box"><?php echo($m['familyaddress']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">紧急联系人</label>
								<div class="cells-filed-box"><?php echo($m['emergencycontact']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">紧急联系电话</label>
								<div class="cells-filed-box"><?php echo($m['emergencyphone']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="item-space"></div>
							<div class="cells-item">
								<label class="cells-filed-name">开户银行</label>
								<div class="cells-filed-box"><?php echo($m['bank']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="cells-item">
								<label class="cells-filed-name">卡号</label>
								<div class="cells-filed-box"><?php echo($m['bankcard']);?></div>
								<div class="clearfix"></div>
							</div>
							<div class="item-space"></div>
							<div class="cells-item">
								<label class="cells-filed-name">备注</label>
								<div class="cells-filed-box"><?php echo($m['more']);?></div>
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
			//$(document).ready(function(){
				// $('.mycustoms').height($(window).height()-135);
				// $('.waitrun').height($(window).height()-597);
			//});
		</script>
		
	</body>
</html>
